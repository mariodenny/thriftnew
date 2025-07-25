<?php
// CEK COOKIE LOGIN ADMIN
if (!isset($_COOKIE['login_admin']) || empty($_COOKIE['login_admin'])) {
    header("Location: http://localhost/thriftnew/admin/login/");
    exit;
}

// CEGAH CACHE BACK BROWSER
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();
include '../config.php';

// Cek koneksi database
if (!isset($server) || !($server instanceof mysqli) || $server->connect_error) {
    die("⛔ Fatal Error: Database connection error. Please check config.php. " .
        (isset($server) && $server->connect_error ? $server->connect_error : "Connection object not valid."));
}

$page_admin = 'dashboard';

// Inisialisasi variabel
$jumlah_user_adm = 0;
$jumlah_user_today_adm = 0;
$jumlah_transaksi_adm = 0;
$jumlah_transaksi_today_adm = 0;
$jumlah_produk_adm = 0;
$jumlah_kategori_adm = 0;

$time_today = date("Y-m-d");

// Query jumlah user
$sj_user_adm = $server->query("SELECT * FROM `akun`");
$jumlah_user_adm = $sj_user_adm ? mysqli_num_rows($sj_user_adm) : 0;

$sj_user_today_adm = $server->query("SELECT * FROM `akun` WHERE `waktu` LIKE '$time_today%'");
$jumlah_user_today_adm = $sj_user_today_adm ? mysqli_num_rows($sj_user_today_adm) : 0;

$sj_transaksi_adm = $server->query("SELECT * FROM `invoice` WHERE `transaction`='settlement'");
$jumlah_transaksi_adm = $sj_transaksi_adm ? mysqli_num_rows($sj_transaksi_adm) : 0;

$sj_transaksi_today_adm = $server->query("SELECT * FROM `akun`, `iklan`, `invoice` WHERE invoice.id_iklan=iklan.id AND invoice.id_user=akun.id AND `transaction`='settlement' AND `waktu_transaksi` LIKE '$time_today%'");
$jumlah_transaksi_today_adm = $sj_transaksi_today_adm ? mysqli_num_rows($sj_transaksi_today_adm) : 0;

$sj_produk_adm = $server->query("SELECT * FROM `iklan`");
$jumlah_produk_adm = $sj_produk_adm ? mysqli_num_rows($sj_produk_adm) : 0;

$sj_kategori_adm = $server->query("SELECT * FROM `kategori`");
$jumlah_kategori_adm = $sj_kategori_adm ? mysqli_num_rows($sj_kategori_adm) : 0;

// Penjualan per kategori
$category_sales_data = [];
$sq_category_sales = $server->query("SELECT k.nama AS category_name, SUM(inv.jumlah) AS total_sold 
                                     FROM invoice inv
                                     JOIN iklan i ON inv.id_iklan = i.id
                                     JOIN kategori k ON i.id_kategori = k.id
                                     WHERE inv.tipe_progress = 'Selesai' 
                                     GROUP BY k.nama
                                     ORDER BY total_sold DESC");

if ($sq_category_sales) {
    while ($data = mysqli_fetch_assoc($sq_category_sales)) {
        $category_sales_data[] = $data;
    }
}

$chart_labels = [];
$chart_data = [];
$chart_background_colors = [];
$chart_border_colors = [];

$base_colors = [
    'rgba(255, 99, 132, 0.8)',
    'rgba(255, 159, 64, 0.8)',
    'rgba(75, 192, 192, 0.8)',
    'rgba(153, 102, 255, 0.8)',
    'rgba(255, 206, 86, 0.8)',
    'rgba(54, 162, 235, 0.8)',
    'rgba(201, 203, 207, 0.8)',
    'rgba(255, 0, 255, 0.8)',
    'rgba(0, 255, 255, 0.8)',
    'rgba(128, 0, 0, 0.8)'
];

$color_index = 0;
foreach ($category_sales_data as $row) {
    $chart_labels[] = $row['category_name'];
    $chart_data[] = $row['total_sold'];

    $color = $base_colors[$color_index % count($base_colors)];
    $chart_background_colors[] = $color;
    $chart_border_colors[] = str_replace('0.8', '1', $color);
    $color_index++;
}

$js_chart_labels = json_encode($chart_labels);
$js_chart_data = json_encode($chart_data);
$js_chart_background_colors = json_encode($chart_background_colors);
$js_chart_border_colors = json_encode($chart_border_colors);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="icon" href="../assets/icons/<?php print($logo); ?>" type="image/svg" />
    <link rel="stylesheet" href="../assets/css/admin/index.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        .admin {
            display: flex;
            width: 100%;
        }

        .admin .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
        }

        .content_admin {
            flex-grow: 1;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .title_content_admin {
            font-size: 2.2em;
            color: #34495e;
            margin-bottom: 25px;
            border-bottom: 3px solid #ff69b4;
            padding-bottom: 10px;
            width: 100%;
            max-width: 900px;
        }

        .menu_jumlah_adm {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 900px;
        }

        .isi_menu_jumlah_adm {
            background: #ec407a;
            color: white;
            padding: 14px 18px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease;
            cursor: default;
        }

        .isi_menu_jumlah_adm:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(255, 20, 147, 0.4);
        }

        .isi_menu_jumlah_adm i {
            font-size: 2.2em;
            opacity: 0.85;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .box_text_menu_jumlah_adm p {
            margin: 0;
            font-size: 0.9em;
            /* kecilkan dari 1em */
            opacity: 0.9;
        }

        .box_text_menu_jumlah_adm h1 {
            margin: 4px 0 0;
            font-size: 1.6em;
            /* kecilkan dari 1.8em */
            font-weight: 700;
        }


        .chart-container {
            background-color: #fff0f6;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 800px;
            margin: 40px auto 20px auto;
            height: 320px;
            position: relative;
        }

        .chart-container canvas {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>

<body>
    <div class="admin">
        <?php include './partials/menu.php'; ?>
        <div class="content_admin">
            <h1 class="title_content_admin">Dashboard Admin</h1>
            <div class="menu_jumlah_adm">
                <div class="isi_menu_jumlah_adm">
                    <i class="ri-user-3-fill"></i>
                    <div class="box_text_menu_jumlah_adm">
                        <p>Jumlah User</p>
                        <h1><?php echo number_format($jumlah_user_adm); ?></h1>
                    </div>
                </div>
                <div class="isi_menu_jumlah_adm">
                    <i class="ri-archive-fill"></i>
                    <div class="box_text_menu_jumlah_adm">
                        <p>Jumlah Produk</p>
                        <h1><?php echo number_format($jumlah_produk_adm); ?></h1>
                    </div>
                </div>
                <div class="isi_menu_jumlah_adm">
                    <i class="ri-file-list-2-fill"></i>
                    <div class="box_text_menu_jumlah_adm">
                        <p>Jumlah Kategori</p>
                        <h1><?php echo number_format($jumlah_kategori_adm); ?></h1>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="categorySalesChart"></canvas>
            </div>
            <?php
            // Hitung total penjualan semua kategori
            $total_penjualan = array_sum($chart_data);
            ?>
            <div style="max-width: 900px; margin: 0 auto 40px auto; padding: 20px; background: #fff0f6; border-radius: 12px; box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);">
                <h2 style="color: #34495e; font-weight: 700; margin-bottom: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                    Rincian Penjualan Per Kategori
                </h2>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <?php foreach ($category_sales_data as $index => $kategori):
                        $jumlah = $kategori['total_sold'];
                        $persen = $total_penjualan ? round(($jumlah / $total_penjualan) * 100, 2) : 0;
                        $warna = $base_colors[$index % count($base_colors)];
                    ?>
                        <li style="margin-bottom: 12px; font-size: 1.1em; display: flex; align-items: center; gap: 12px; color: #333;">
                            <span style="display:inline-block; width: 20px; height: 20px; background-color: <?php echo $warna; ?>; border-radius: 50%;"></span>
                            <strong style="flex: 1;"><?php echo htmlspecialchars($kategori['category_name']); ?></strong>
                            <span style="color: #34495e; font-weight: 600;"><?php echo $persen; ?>%</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('categorySalesChart').getContext('2d');
        const categorySalesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo $js_chart_labels; ?>,
                datasets: [{
                    label: 'Total Item Terjual',
                    data: <?php echo $js_chart_data; ?>,
                    backgroundColor: <?php echo $js_chart_background_colors; ?>,
                    borderColor: <?php echo $js_chart_border_colors; ?>,
                    borderWidth: 2,
                    hoverOffset: 30,
                    weight: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    animateRotate: true,
                    animateScale: true
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            font: {
                                size: 14,
                                weight: '600'
                            },
                            padding: 15,
                            boxWidth: 20,
                            boxHeight: 20,
                            color: '#34495e',
                            usePointStyle: true,
                            pointStyle: 'circle',
                        },
                        maxHeight: 400,
                        onClick: (e, legendItem, legend) => {
                            const index = legendItem.index;
                            const ci = legend.chart;
                            const meta = ci.getDatasetMeta(0);
                            const slice = meta.data[index];
                            slice.hidden = !slice.hidden;
                            ci.update();
                        }
                    },
                    title: {
                        display: true,
                        text: 'Penjualan Per Kategori Produk',
                        font: {
                            size: 21,
                            weight: '900'
                        },
                        color: '#34495e'
                    },

                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total ? ((value / total) * 100).toFixed(2) : 0;
                                return `${label}: ${new Intl.NumberFormat('id-ID').format(value)} item (${percentage}%)`;
                            }
                        },
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        titleFont: {
                            size: 16,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 14
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>