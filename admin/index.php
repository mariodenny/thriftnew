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
include '../config.php'; // Ensure this path is correct for your setup

// Cek koneksi database
if (!isset($server) || !($server instanceof mysqli) || $server->connect_error) {
    die("⛔ Fatal Error: Database connection error. Please check config.php. " .
        (isset($server) && $server->connect_error ? $server->connect_error : "Connection object not valid."));
}

$page_admin = 'dashboard';

$jumlah_user_adm = 0;
$jumlah_produk_adm = 0;
$jumlah_kategori_adm = 0;

// Get selected date range from GET request
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Set default dates if not provided or invalid. For simplicity, default to last 30 days.
if (empty($start_date) || !strtotime($start_date)) {
    $start_date = date('Y-m-d', strtotime('-30 days'));
}
if (empty($end_date) || !strtotime($end_date)) {
    $end_date = date('Y-m-d');
}

// Pastikan tanggal akhir tidak lebih awal dari tanggal mulai
if (strtotime($start_date) > strtotime($end_date)) {
    $temp = $start_date;
    $start_date = $end_date;
    $end_date = $temp;
}


// Query jumlah user
$sj_user_adm = $server->query("SELECT * FROM `akun`");
$jumlah_user_adm = $sj_user_adm ? mysqli_num_rows($sj_user_adm) : 0;

// Query jumlah produk
$sj_produk_adm = $server->query("SELECT * FROM `iklan`");
$jumlah_produk_adm = $sj_produk_adm ? mysqli_num_rows($sj_produk_adm) : 0;

// Query jumlah kategori
$sj_kategori_adm = $server->query("SELECT * FROM `kategori`");
$jumlah_kategori_adm = $sj_kategori_adm ? mysqli_num_rows($sj_kategori_adm) : 0;

// Penjualan per kategori
$category_sales_data = [];
$sql_category_sales = "SELECT k.nama AS category_name, SUM(inv.jumlah) AS total_sold
                         FROM invoice inv
                         JOIN iklan i ON inv.id_iklan = i.id
                         JOIN kategori k ON i.id_kategori = k.id
                         WHERE inv.tipe_progress = 'Selesai'";

// Add date range filter to the query
// Menggunakan prepared statement untuk keamanan yang lebih baik
$sql_category_sales .= " AND inv.waktu BETWEEN ? AND ?";
$sql_category_sales .= " GROUP BY k.nama ORDER BY total_sold DESC";

$stmt = $server->prepare($sql_category_sales);

// --- FIX STARTS HERE ---
// Create a new variable for the end_date with time component
$end_date_with_time = $end_date . ' 23:59:59';
// Bind parameters. Use the new variable.
$stmt->bind_param("ss", $start_date, $end_date_with_time);
// --- FIX ENDS HERE ---

$stmt->execute();
$sq_category_sales = $stmt->get_result();

if ($sq_category_sales) {
    while ($data = mysqli_fetch_assoc($sq_category_sales)) {
        $category_sales_data[] = $data;
    }
}
$stmt->close(); // Tutup statement setelah digunakan

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
    $chart_data[] = (int)$row['total_sold'];

    $color = $base_colors[$color_index % count($base_colors)];
    $chart_background_colors[] = $color;
    $chart_border_colors[] = str_replace('0.8', '1', $color);
    $color_index++;
}

$js_chart_labels = json_encode($chart_labels);
$js_chart_data = json_encode($chart_data);
$js_chart_background_colors = json_encode($chart_background_colors);
$js_chart_border_colors = json_encode($chart_border_colors);

// Judul grafik berdasarkan filter
$chart_title = "Penjualan Per Kategori ";
if (!empty($start_date) && !empty($end_date)) {
    $chart_title .= " dari " . date('d M Y', strtotime($start_date)) . " sampai " . date('d M Y', strtotime($end_date));
} else {
    $chart_title .= "Keseluruhan";
}
$js_chart_title = json_encode($chart_title);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>
    <link rel="icon" href="../assets/icons/<?php echo isset($logo) ? htmlspecialchars($logo) : 'default_icon.svg'; ?>" type="image/svg" />
    <link rel="stylesheet" href="../assets/css/admin/index.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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

        /* Sidebar menu (assuming this is handled by partials/menu.php) */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            box-sizing: border-box;
            flex-shrink: 0;
        }

        /* Content area */
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
            text-align: center; /* Center the title */
        }

        .menu_jumlah_adm {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 900px;
            margin-bottom: 30px; /* Added margin */
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
            opacity: 0.9;
        }

        .box_text_menu_jumlah_adm h1 {
            margin: 4px 0 0;
            font-size: 1.6em;
            font-weight: 700;
        }

        .filter-section {
            margin-bottom: 25px;
            text-align: center;
            padding: 10px;
            background-color: #fff0f6;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 900px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .filter-section label {
            font-size: 1.1em;
            font-weight: bold;
            color: #34495e;
            margin-right: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .filter-section input[type="date"] {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
            cursor: pointer;
            outline: none;
            transition: border-color 0.3s ease;
            margin-right: 15px; /* Spacing between date inputs */
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .filter-section input[type="date"]:focus {
            border-color: #ec407a;
        }

        .filter-section button {
            padding: 8px 15px;
            background-color: #ec407a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .filter-section button:hover {
            background-color: #e65a9f;
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

        /* Rincian penjualan per kategori: dibatasi lebar dan responsive */
        .sales-details {
            max-width: 400px;
            margin: 0 auto 40px auto;
            padding: 20px;
            background: #fff0f6;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            width: 100%; /* Ensure it's responsive */
        }

        .sales-details h2 {
            color: #34495e;
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.5em;
            text-align: center;
        }

        .sales-details ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sales-details li {
            margin-bottom: 12px;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #333;
        }

        .sales-details li span.color-dot {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .sales-details li strong {
            flex: 1;
        }

        .sales-details li span.percent {
            color: #34495e;
            font-weight: 600;
            min-width: 50px;
            text-align: right;
            font-variant-numeric: tabular-nums;
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

            <div class="filter-section">
                <label for="start_date">Dari Tanggal:</label>
                <input type="date" id="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <label for="end_date">Sampai Tanggal:</label>
                <input type="date" id="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                <button onclick="filterChart()">Filter</button>
            </div>


            <div class="chart-container">
                <canvas id="categorySalesChart"></canvas>
            </div>

            <?php
            $total_penjualan = array_sum($chart_data);
            ?>

            <div class="sales-details">
                <h2>Rincian Penjualan Per Kategori</h2>
                <ul>
                    <?php foreach ($category_sales_data as $index => $kategori):
                        $jumlah = (int)$kategori['total_sold'];
                        $warna = $base_colors[$index % count($base_colors)];
                    ?>
                    <li>
                        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($warna); ?>;"></span>
                        <strong><?php echo htmlspecialchars($kategori['category_name']); ?></strong>
                        <span class="percent"><?php echo number_format($jumlah); ?> item</span>
                    </li>
                    <?php endforeach; ?>
                    <?php if (empty($category_sales_data)): ?>
                        <li><p>Tidak ada data penjualan untuk periode ini.</p></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<script>
    const ctx = document.getElementById('categorySalesChart').getContext('2d');
    const totalItems = <?php echo $total_penjualan ?: 0; ?>;

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
            layout: {
                padding: {
                    right: 50 // ✅ Tambahkan padding kanan global untuk chart container
                }
            },
            plugins: {
                datalabels: {
                    color: '#fff',
                    font: { size: 14, weight: 'bold' },
                    formatter: function(value) {
                        const percentage = totalItems > 0 ? ((value / totalItems) * 100).toFixed(1) : 0;
                        return percentage + '%';
                    }
                },
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        font: {
                            size: 14,
                            weight: '600'
                        },
                        padding: 15, // ✅ Jarak antara simbol dan teks legenda
                        boxWidth: 14,
                        boxHeight: 14,
                        color: '#34495e',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        textAlign: 'left' // ✅ Agar teks rata kiri di dalam kolom legenda
                    },
                    maxHeight: 400,
                    onClick: (e, legendItem, legend) => {
                        const index = legendItem.datasetIndex;
                        const ci = legend.chart;
                        ci.data.datasets[index].hidden = !ci.data.datasets[index].hidden;
                        ci.update();
                    }
                },
                title: {
                    display: true,
                    text: <?php echo $js_chart_title; ?>,
                    font: {
                        size: 20,
                         weight: 'bold'
                    },
                    color: '#34495e',
                    padding: 20
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            const value = context.parsed;
                            const percentage = totalItems > 0 ? ((value / totalItems) * 100).toFixed(1) : 0;
                            return label + value + ' item (' + percentage + '%)';
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    function filterChart() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
            alert('Tanggal "Dari" tidak boleh lebih besar dari tanggal "Sampai".');
            return;
        }

        let url = window.location.pathname;
        const params = new URLSearchParams();

        if (startDate) {
            params.append('start_date', startDate);
        }
        if (endDate) {
            params.append('end_date', endDate);
        }

        const currentParams = new URLSearchParams(window.location.search);
        currentParams.forEach((value, key) => {
            if (key !== 'start_date' && key !== 'end_date') {
                params.append(key, value);
            }
        });

        window.location.href = url + '?' + params.toString();
    }
</script>

</body>

</html>