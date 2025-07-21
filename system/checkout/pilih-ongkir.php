<?php
include '../../config.php';

// Input validation and sanitization
$kota_tujuan = filter_input(INPUT_POST, 'id_kota_tujuan_v', FILTER_SANITIZE_NUMBER_INT);
$berat_barang = filter_input(INPUT_POST, 'berat_barang', FILTER_SANITIZE_NUMBER_INT);
$jumlah_barang = filter_input(INPUT_POST, 'jumlah_barang', FILTER_SANITIZE_NUMBER_INT);

if (!$kota_tujuan || !$berat_barang || !$jumlah_barang) {
    echo '<div class="error-message">Data tidak valid. Silakan coba lagi.</div>';
    exit;
}

class ShippingCalculator
{
    private $rajaongkir_key;
    private $kota_id_toko;

    public function __construct($key, $kota_id)
    {
        $this->rajaongkir_key = $key;
        $this->kota_id_toko = $kota_id;
    }

    private function createCurlHandle($courier, $destination, $weight)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10, // Reduced timeout
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin={$this->kota_id_toko}&destination={$destination}&weight={$weight}&courier={$courier}",
            CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded",
                "key: {$this->rajaongkir_key}"
            ],
        ]);
        return $ch;
    }

    public function getAllShippingCosts($destination, $weight, $quantity)
    {
        $couriers = ['jne', 'tiki', 'pos'];
        $multiHandle = curl_multi_init();
        $curlHandles = [];

        // Initialize all curl handles for parallel execution
        foreach ($couriers as $courier) {
            $ch = $this->createCurlHandle($courier, $destination, $weight);
            $curlHandles[$courier] = $ch;
            curl_multi_add_handle($multiHandle, $ch);
        }

        // Execute all requests in parallel
        $running = null;
        do {
            curl_multi_exec($multiHandle, $running);
            curl_multi_select($multiHandle);
        } while ($running > 0);

        $results = [];

        // Process results
        foreach ($couriers as $courier) {
            $response = curl_multi_getcontent($curlHandles[$courier]);
            $error = curl_error($curlHandles[$courier]);

            if (!$error && $response) {
                $data = json_decode($response, true);
                if (isset($data['rajaongkir']['results'][0]['costs'])) {
                    $results[$courier] = $this->processShippingData(
                        $data['rajaongkir']['results'][0],
                        $quantity
                    );
                }
            }

            curl_multi_remove_handle($multiHandle, $curlHandles[$courier]);
            curl_close($curlHandles[$courier]);
        }

        curl_multi_close($multiHandle);
        return $results;
    }

    private function processShippingData($courierData, $quantity)
    {
        $services = [];
        $courierCode = strtoupper($courierData['code']);

        foreach ($courierData['costs'] as $index => $cost) {
            $services[] = [
                'courier' => $courierCode,
                'service' => $cost['service'],
                'description' => $cost['description'],
                'etd' => $cost['cost'][0]['etd'],
                'price' => $cost['cost'][0]['value'] * $quantity,
                'index' => $index
            ];
        }

        return $services;
    }
}

// Initialize calculator
$calculator = new ShippingCalculator($rajaongkir_key, $kota_id_toko);
$allShippingOptions = $calculator->getAllShippingCosts($kota_tujuan, $berat_barang, $jumlah_barang);

// Display results
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Pengiriman</title>
</head>

<body>
    <div class="shipping-container">
        <div class="shipping-header">
            <h2>🚚 Pilih Metode Pengiriman</h2>
            <p>Pilih kurir dan layanan pengiriman terbaik untuk pesanan Anda</p>
        </div>

        <div class="shipping-options">
            <?php
            $allOptions = [];
            foreach ($allShippingOptions as $courier => $services) {
                foreach ($services as $service) {
                    $allOptions[] = $service;
                }
            }

            // Sort by price
            usort($allOptions, function ($a, $b) {
                return $a['price'] - $b['price'];
            });

            $isFirst = true;
            foreach ($allOptions as $option):
            ?>
                <div class="shipping-option <?= $isFirst ? 'recommended' : '' ?>"
                    onclick="selectShipping('<?= htmlspecialchars($option['courier']) ?>', 
                                           '<?= htmlspecialchars($option['index']) ?>', 
                                           '<?= htmlspecialchars($option['service']) ?>', 
                                           '<?= htmlspecialchars($option['etd']) ?>', 
                                           '<?= $option['price'] ?>')">

                    <?php if ($isFirst): ?>
                        <div class="recommended-badge">💡 Rekomendasi</div>
                    <?php endif; ?>

                    <div class="shipping-content">
                        <div class="shipping-info">
                            <div class="courier-name">
                                <?= getCourierIcon($option['courier']) ?>
                                <span><?= $option['courier'] ?> <?= $option['service'] ?></span>
                            </div>
                            <?php if (!empty($option['description'])): ?>
                                <div class="service-description"><?= $option['description'] ?></div>
                            <?php endif; ?>
                            <div class="delivery-time">
                                ⏰ Estimasi <?= $option['etd'] ?> hari
                            </div>
                        </div>

                        <div class="shipping-price">
                            <div class="price-amount">Rp <?= number_format($option['price'], 0, ".", ".") ?></div>
                        </div>
                    </div>

                    <div class="selection-indicator">
                        <div class="radio-button"></div>
                    </div>
                </div>
            <?php
                $isFirst = false;
            endforeach;
            ?>
        </div>

        <?php if (empty($allOptions)): ?>
            <div class="no-shipping">
                <div class="no-shipping-icon">📦</div>
                <h3>Tidak ada opsi pengiriman tersedia</h3>
                <p>Mohon periksa kembali alamat tujuan atau hubungi customer service.</p>
            </div>
        <?php endif; ?>
    </div>

    <style>
        :root {
            --primary-color: #4F46E5;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
             */
            background: #F3F4F6;
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .shipping-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shipping-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #6366F1 100%);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }

        .shipping-header h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .shipping-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .shipping-options {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .shipping-option {
            position: relative;
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .shipping-option:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        .shipping-option.recommended {
            border-color: var(--success-color);
            background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
        }

        .shipping-option.selected {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        }

        .recommended-badge {
            position: absolute;
            top: -8px;
            left: 20px;
            background: var(--success-color);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            z-index: 1;
        }

        .shipping-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .shipping-info {
            flex: 1;
        }

        .courier-name {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 4px;
        }

        .service-description {
            font-size: 13px;
            color: var(--gray-600);
            margin-bottom: 8px;
        }

        .delivery-time {
            font-size: 13px;
            color: var(--gray-500);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .shipping-price {
            text-align: right;
        }

        .price-amount {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .selection-indicator {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        .radio-button {
            width: 20px;
            height: 20px;
            border: 2px solid var(--gray-300);
            border-radius: 50%;
            position: relative;
            transition: all 0.3s ease;
        }

        .shipping-option:hover .radio-button {
            border-color: var(--primary-color);
        }

        .shipping-option.selected .radio-button {
            border-color: var(--primary-color);
            background: var(--primary-color);
        }

        .shipping-option.selected .radio-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .no-shipping {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
        }

        .no-shipping-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .no-shipping h3 {
            font-size: 18px;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .error-message {
            background: var(--danger-color);
            color: white;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            margin: 20px;
        }

        /* Mobile Responsive */
        @media (max-width: 640px) {
            body {
                padding: 12px;
            }

            .shipping-header {
                padding: 24px 20px;
            }

            .shipping-header h2 {
                font-size: 20px;
            }

            .shipping-options {
                padding: 20px;
            }

            .shipping-option {
                padding: 16px;
            }

            .courier-name {
                font-size: 15px;
            }

            .price-amount {
                font-size: 16px;
            }

            .shipping-content {
                gap: 12px;
            }

            .selection-indicator {
                right: 16px;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid var(--gray-200);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        let selectedOption = null;

        function selectShipping(courier, index, service, etd, price) {
            // Remove previous selection
            const prevSelected = document.querySelector('.shipping-option.selected');
            if (prevSelected) {
                prevSelected.classList.remove('selected');
            }

            // Add selection to clicked option
            event.currentTarget.classList.add('selected');
            selectedOption = {
                courier,
                index,
                service,
                etd,
                price
            };

            // Call the original function if it exists
            if (typeof UbahOpsiOngkir === 'function') {
                UbahOpsiOngkir(courier, index, service, etd, price);
            }

            // Add smooth selection feedback
            event.currentTarget.style.transform = 'scale(0.98)';
            setTimeout(() => {
                event.currentTarget.style.transform = '';
            }, 150);
        }

        // Auto-select first option (recommended)
        document.addEventListener('DOMContentLoaded', function() {
            const firstOption = document.querySelector('.shipping-option.recommended');
            if (firstOption) {
                firstOption.click();
            }
        });
    </script>
</body>

</html>

<?php
function getCourierIcon($courier)
{
    $icons = [
        'JNE' => '🚚',
        'TIKI' => '📦',
        'POS' => '📮',
    ];
    return $icons[$courier] ?? '🚛';
}
?>