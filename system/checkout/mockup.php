<?php
// ===============================================================
// COMPLETE MOCK SYSTEM - MENGGANTIKAN RAJAONGKIR API
// ===============================================================

// 1. MOCK DATA INDONESIA LENGKAP
$mock_data_indonesia = [
    'provinsi' => [
        ['id' => '1', 'name' => 'Bali'],
        ['id' => '2', 'name' => 'Bangka Belitung'],
        ['id' => '3', 'name' => 'Banten'],
        ['id' => '4', 'name' => 'Bengkulu'],
        ['id' => '5', 'name' => 'DI Yogyakarta'],
        ['id' => '6', 'name' => 'DKI Jakarta'],
        ['id' => '7', 'name' => 'Gorontalo'],
        ['id' => '8', 'name' => 'Jambi'],
        ['id' => '9', 'name' => 'Jawa Barat'],
        ['id' => '10', 'name' => 'Jawa Tengah'],
        ['id' => '11', 'name' => 'Jawa Timur'],
        ['id' => '12', 'name' => 'Kalimantan Barat'],
        ['id' => '13', 'name' => 'Kalimantan Selatan'],
        ['id' => '14', 'name' => 'Kalimantan Tengah'],
        ['id' => '15', 'name' => 'Kalimantan Timur'],
        ['id' => '16', 'name' => 'Kalimantan Utara'],
        ['id' => '17', 'name' => 'Kepulauan Riau'],
        ['id' => '18', 'name' => 'Lampung'],
        ['id' => '19', 'name' => 'Maluku'],
        ['id' => '20', 'name' => 'Maluku Utara'],
        ['id' => '21', 'name' => 'Nanggroe Aceh Darussalam (NAD)'],
        ['id' => '22', 'name' => 'Nusa Tenggara Barat (NTB)'],
        ['id' => '23', 'name' => 'Nusa Tenggara Timur (NTT)'],
        ['id' => '24', 'name' => 'Papua'],
        ['id' => '25', 'name' => 'Papua Barat'],
        ['id' => '26', 'name' => 'Riau'],
        ['id' => '27', 'name' => 'Sulawesi Barat'],
        ['id' => '28', 'name' => 'Sulawesi Selatan'],
        ['id' => '29', 'name' => 'Sulawesi Tengah'],
        ['id' => '30', 'name' => 'Sulawesi Tenggara'],
        ['id' => '31', 'name' => 'Sulawesi Utara'],
        ['id' => '32', 'name' => 'Sumatera Barat'],
        ['id' => '33', 'name' => 'Sumatera Selatan'],
        ['id' => '34', 'name' => 'Sumatera Utara']
    ],

    'kota' => [
        // DKI Jakarta (6)
        ['city_id' => '151', 'province_id' => '6', 'city_name' => 'Jakarta Barat', 'type' => 'Kota', 'postal_code' => '11220'],
        ['city_id' => '152', 'province_id' => '6', 'city_name' => 'Jakarta Pusat', 'type' => 'Kota', 'postal_code' => '10110'],
        ['city_id' => '153', 'province_id' => '6', 'city_name' => 'Jakarta Selatan', 'type' => 'Kota', 'postal_code' => '12110'],
        ['city_id' => '154', 'province_id' => '6', 'city_name' => 'Jakarta Timur', 'type' => 'Kota', 'postal_code' => '13210'],
        ['city_id' => '155', 'province_id' => '6', 'city_name' => 'Jakarta Utara', 'type' => 'Kota', 'postal_code' => '14210'],
        ['city_id' => '156', 'province_id' => '6', 'city_name' => 'Kepulauan Seribu', 'type' => 'Kabupaten', 'postal_code' => '14550'],

        // Jawa Barat (9)
        ['city_id' => '23', 'province_id' => '9', 'city_name' => 'Bandung', 'type' => 'Kota', 'postal_code' => '40111'],
        ['city_id' => '24', 'province_id' => '9', 'city_name' => 'Bekasi', 'type' => 'Kota', 'postal_code' => '17111'],
        ['city_id' => '25', 'province_id' => '9', 'city_name' => 'Bogor', 'type' => 'Kota', 'postal_code' => '16111'],
        ['city_id' => '26', 'province_id' => '9', 'city_name' => 'Cimahi', 'type' => 'Kota', 'postal_code' => '40511'],
        ['city_id' => '27', 'province_id' => '9', 'city_name' => 'Cirebon', 'type' => 'Kota', 'postal_code' => '45111'],
        ['city_id' => '28', 'province_id' => '9', 'city_name' => 'Depok', 'type' => 'Kota', 'postal_code' => '16411'],
        ['city_id' => '29', 'province_id' => '9', 'city_name' => 'Sukabumi', 'type' => 'Kota', 'postal_code' => '43111'],
        ['city_id' => '30', 'province_id' => '9', 'city_name' => 'Tasikmalaya', 'type' => 'Kota', 'postal_code' => '46111'],
        ['city_id' => '78', 'province_id' => '9', 'city_name' => 'Bandung Barat', 'type' => 'Kabupaten', 'postal_code' => '40721'],
        ['city_id' => '79', 'province_id' => '9', 'city_name' => 'Bekasi', 'type' => 'Kabupaten', 'postal_code' => '17837'],
        ['city_id' => '80', 'province_id' => '9', 'city_name' => 'Bogor', 'type' => 'Kabupaten', 'postal_code' => '16911'],
        ['city_id' => '81', 'province_id' => '9', 'city_name' => 'Ciamis', 'type' => 'Kabupaten', 'postal_code' => '46211'],
        ['city_id' => '82', 'province_id' => '9', 'city_name' => 'Cianjur', 'type' => 'Kabupaten', 'postal_code' => '43217'],
        ['city_id' => '83', 'province_id' => '9', 'city_name' => 'Cirebon', 'type' => 'Kabupaten', 'postal_code' => '45611'],
        ['city_id' => '84', 'province_id' => '9', 'city_name' => 'Garut', 'type' => 'Kabupaten', 'postal_code' => '44126'],
        ['city_id' => '85', 'province_id' => '9', 'city_name' => 'Indramayu', 'type' => 'Kabupaten', 'postal_code' => '45214'],
        ['city_id' => '86', 'province_id' => '9', 'city_name' => 'Karawang', 'type' => 'Kabupaten', 'postal_code' => '41311'],
        ['city_id' => '87', 'province_id' => '9', 'city_name' => 'Kuningan', 'type' => 'Kabupaten', 'postal_code' => '45511'],
        ['city_id' => '88', 'province_id' => '9', 'city_name' => 'Majalengka', 'type' => 'Kabupaten', 'postal_code' => '45412'],
        ['city_id' => '89', 'province_id' => '9', 'city_name' => 'Pangandaran', 'type' => 'Kabupaten', 'postal_code' => '46511'],
        ['city_id' => '90', 'province_id' => '9', 'city_name' => 'Purwakarta', 'type' => 'Kabupaten', 'postal_code' => '41119'],
        ['city_id' => '91', 'province_id' => '9', 'city_name' => 'Subang', 'type' => 'Kabupaten', 'postal_code' => '41215'],
        ['city_id' => '92', 'province_id' => '9', 'city_name' => 'Sukabumi', 'type' => 'Kabupaten', 'postal_code' => '43311'],
        ['city_id' => '93', 'province_id' => '9', 'city_name' => 'Sumedang', 'type' => 'Kabupaten', 'postal_code' => '45326'],
        ['city_id' => '94', 'province_id' => '9', 'city_name' => 'Tasikmalaya', 'type' => 'Kabupaten', 'postal_code' => '46411'],

        // Jawa Tengah (10)
        ['city_id' => '399', 'province_id' => '10', 'city_name' => 'Semarang', 'type' => 'Kota', 'postal_code' => '50111'],
        ['city_id' => '400', 'province_id' => '10', 'city_name' => 'Surakarta', 'type' => 'Kota', 'postal_code' => '57111'],
        ['city_id' => '401', 'province_id' => '10', 'city_name' => 'Magelang', 'type' => 'Kota', 'postal_code' => '56111'],
        ['city_id' => '402', 'province_id' => '10', 'city_name' => 'Pekalongan', 'type' => 'Kota', 'postal_code' => '51111'],
        ['city_id' => '403', 'province_id' => '10', 'city_name' => 'Salatiga', 'type' => 'Kota', 'postal_code' => '50711'],
        ['city_id' => '404', 'province_id' => '10', 'city_name' => 'Tegal', 'type' => 'Kota', 'postal_code' => '52111'],
        ['city_id' => '405', 'province_id' => '10', 'city_name' => 'Banjarnegara', 'type' => 'Kabupaten', 'postal_code' => '53419'],
        ['city_id' => '406', 'province_id' => '10', 'city_name' => 'Banyumas', 'type' => 'Kabupaten', 'postal_code' => '53114'],
        ['city_id' => '407', 'province_id' => '10', 'city_name' => 'Batang', 'type' => 'Kabupaten', 'postal_code' => '51211'],
        ['city_id' => '408', 'province_id' => '10', 'city_name' => 'Blora', 'type' => 'Kabupaten', 'postal_code' => '58219'],
        ['city_id' => '409', 'province_id' => '10', 'city_name' => 'Boyolali', 'type' => 'Kabupaten', 'postal_code' => '57312'],
        ['city_id' => '410', 'province_id' => '10', 'city_name' => 'Brebes', 'type' => 'Kabupaten', 'postal_code' => '52212'],
        ['city_id' => '411', 'province_id' => '10', 'city_name' => 'Cilacap', 'type' => 'Kabupaten', 'postal_code' => '53211'],
        ['city_id' => '412', 'province_id' => '10', 'city_name' => 'Demak', 'type' => 'Kabupaten', 'postal_code' => '59519'],
        ['city_id' => '413', 'province_id' => '10', 'city_name' => 'Grobogan', 'type' => 'Kabupaten', 'postal_code' => '58111'],
        ['city_id' => '414', 'province_id' => '10', 'city_name' => 'Jepara', 'type' => 'Kabupaten', 'postal_code' => '59419'],
        ['city_id' => '415', 'province_id' => '10', 'city_name' => 'Karanganyar', 'type' => 'Kabupaten', 'postal_code' => '57718'],
        ['city_id' => '416', 'province_id' => '10', 'city_name' => 'Kebumen', 'type' => 'Kabupaten', 'postal_code' => '54319'],
        ['city_id' => '417', 'province_id' => '10', 'city_name' => 'Kendal', 'type' => 'Kabupaten', 'postal_code' => '51314'],
        ['city_id' => '418', 'province_id' => '10', 'city_name' => 'Klaten', 'type' => 'Kabupaten', 'postal_code' => '57411'],
        ['city_id' => '419', 'province_id' => '10', 'city_name' => 'Kudus', 'type' => 'Kabupaten', 'postal_code' => '59311'],
        ['city_id' => '420', 'province_id' => '10', 'city_name' => 'Magelang', 'type' => 'Kabupaten', 'postal_code' => '56519'],
        ['city_id' => '421', 'province_id' => '10', 'city_name' => 'Pati', 'type' => 'Kabupaten', 'postal_code' => '59114'],
        ['city_id' => '422', 'province_id' => '10', 'city_name' => 'Pekalongan', 'type' => 'Kabupaten', 'postal_code' => '51161'],
        ['city_id' => '423', 'province_id' => '10', 'city_name' => 'Pemalang', 'type' => 'Kabupaten', 'postal_code' => '52319'],
        ['city_id' => '424', 'province_id' => '10', 'city_name' => 'Purbalingga', 'type' => 'Kabupaten', 'postal_code' => '53317'],
        ['city_id' => '425', 'province_id' => '10', 'city_name' => 'Purworejo', 'type' => 'Kabupaten', 'postal_code' => '54111'],
        ['city_id' => '426', 'province_id' => '10', 'city_name' => 'Rembang', 'type' => 'Kabupaten', 'postal_code' => '59219'],
        ['city_id' => '427', 'province_id' => '10', 'city_name' => 'Semarang', 'type' => 'Kabupaten', 'postal_code' => '50511'],
        ['city_id' => '428', 'province_id' => '10', 'city_name' => 'Sragen', 'type' => 'Kabupaten', 'postal_code' => '57211'],
        ['city_id' => '429', 'province_id' => '10', 'city_name' => 'Sukoharjo', 'type' => 'Kabupaten', 'postal_code' => '57514'],
        ['city_id' => '430', 'province_id' => '10', 'city_name' => 'Tegal', 'type' => 'Kabupaten', 'postal_code' => '52419'],
        ['city_id' => '431', 'province_id' => '10', 'city_name' => 'Temanggung', 'type' => 'Kabupaten', 'postal_code' => '56212'],
        ['city_id' => '432', 'province_id' => '10', 'city_name' => 'Wonogiri', 'type' => 'Kabupaten', 'postal_code' => '57619'],
        ['city_id' => '433', 'province_id' => '10', 'city_name' => 'Wonosobo', 'type' => 'Kabupaten', 'postal_code' => '56311'],

        // Jawa Timur (11)
        ['city_id' => '444', 'province_id' => '11', 'city_name' => 'Surabaya', 'type' => 'Kota', 'postal_code' => '60111'],
        ['city_id' => '445', 'province_id' => '11', 'city_name' => 'Malang', 'type' => 'Kota', 'postal_code' => '65111'],
        ['city_id' => '446', 'province_id' => '11', 'city_name' => 'Kediri', 'type' => 'Kota', 'postal_code' => '64111'],
        ['city_id' => '447', 'province_id' => '11', 'city_name' => 'Blitar', 'type' => 'Kota', 'postal_code' => '66111'],
        ['city_id' => '448', 'province_id' => '11', 'city_name' => 'Mojokerto', 'type' => 'Kota', 'postal_code' => '61311'],
        ['city_id' => '449', 'province_id' => '11', 'city_name' => 'Madiun', 'type' => 'Kota', 'postal_code' => '63122'],
        ['city_id' => '450', 'province_id' => '11', 'city_name' => 'Pasuruan', 'type' => 'Kota', 'postal_code' => '67117'],
        ['city_id' => '451', 'province_id' => '11', 'city_name' => 'Probolinggo', 'type' => 'Kota', 'postal_code' => '67215'],
        ['city_id' => '452', 'province_id' => '11', 'city_name' => 'Batu', 'type' => 'Kota', 'postal_code' => '65311'],

        // Bali (1)
        ['city_id' => '17', 'province_id' => '1', 'city_name' => 'Denpasar', 'type' => 'Kota', 'postal_code' => '80111'],
        ['city_id' => '18', 'province_id' => '1', 'city_name' => 'Badung', 'type' => 'Kabupaten', 'postal_code' => '80351'],
        ['city_id' => '19', 'province_id' => '1', 'city_name' => 'Bangli', 'type' => 'Kabupaten', 'postal_code' => '80619'],
        ['city_id' => '20', 'province_id' => '1', 'city_name' => 'Buleleng', 'type' => 'Kabupaten', 'postal_code' => '81111'],
        ['city_id' => '21', 'province_id' => '1', 'city_name' => 'Gianyar', 'type' => 'Kabupaten', 'postal_code' => '80511'],
        ['city_id' => '22', 'province_id' => '1', 'city_name' => 'Jembrana', 'type' => 'Kabupaten', 'postal_code' => '82251'],
        ['city_id' => '23', 'province_id' => '1', 'city_name' => 'Karangasem', 'type' => 'Kabupaten', 'postal_code' => '80819'],
        ['city_id' => '24', 'province_id' => '1', 'city_name' => 'Klungkung', 'type' => 'Kabupaten', 'postal_code' => '80719'],
        ['city_id' => '25', 'province_id' => '1', 'city_name' => 'Tabanan', 'type' => 'Kabupaten', 'postal_code' => '82111'],

        // Sumatera Utara (34)
        ['city_id' => '56', 'province_id' => '34', 'city_name' => 'Medan', 'type' => 'Kota', 'postal_code' => '20111'],
        ['city_id' => '57', 'province_id' => '34', 'city_name' => 'Binjai', 'type' => 'Kota', 'postal_code' => '20712'],
        ['city_id' => '58', 'province_id' => '34', 'city_name' => 'Pematang Siantar', 'type' => 'Kota', 'postal_code' => '21111'],
        ['city_id' => '59', 'province_id' => '34', 'city_name' => 'Tebing Tinggi', 'type' => 'Kota', 'postal_code' => '20632'],
        ['city_id' => '60', 'province_id' => '34', 'city_name' => 'Sibolga', 'type' => 'Kota', 'postal_code' => '22522'],
        ['city_id' => '61', 'province_id' => '34', 'city_name' => 'Tanjung Balai', 'type' => 'Kota', 'postal_code' => '21331'],
        ['city_id' => '62', 'province_id' => '34', 'city_name' => 'Padang Sidempuan', 'type' => 'Kota', 'postal_code' => '22727'],
        ['city_id' => '63', 'province_id' => '34', 'city_name' => 'Gunungsitoli', 'type' => 'Kota', 'postal_code' => '22813'],

        // Add more cities for other provinces as needed...
    ]
];

// 2. MOCK SHIPPING COSTS BASED ON ZONES
$shipping_zones = [
    // Zone mapping
    'zone_mapping' => [
        // Zone 1: Jabodetabek
        'zone1' => ['151', '152', '153', '154', '155', '156', '24', '25', '28'],
        // Zone 2: Jawa Barat (non-Jabodetabek)
        'zone2' => ['23', '26', '27', '29', '30', '78', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94'],
        // Zone 3: Jawa Tengah & Jawa Timur
        'zone3' => ['399', '400', '401', '402', '403', '404', '405', '406', '407', '408', '409', '410', '411', '412', '413', '414', '415', '416', '417', '418', '419', '420', '421', '422', '423', '424', '425', '426', '427', '428', '429', '430', '431', '432', '433', '444', '445', '446', '447', '448', '449', '450', '451', '452'],
        // Zone 4: Sumatera
        'zone4' => ['56', '57', '58', '59', '60', '61', '62', '63'],
        // Zone 5: Bali, Kalimantan, Sulawesi, NTB, NTT
        'zone5' => ['17', '18', '19', '20', '21', '22', '23', '24', '25'],
        // Zone 6: Maluku, Papua
        'zone6' => []
    ],

    // Pricing matrix [origin_zone][destination_zone][courier][service]
    'pricing' => [
        'zone1' => [
            'zone1' => [
                'jne' => [
                    ['service' => 'REG', 'description' => 'Layanan Reguler', 'price' => 8000, 'etd' => '1-2'],
                    ['service' => 'OKE', 'description' => 'Ongkos Kirim Ekonomis', 'price' => 6000, 'etd' => '2-3'],
                    ['service' => 'YES', 'description' => 'Yakin Esok Sampai', 'price' => 20000, 'etd' => '1']
                ],
                'tiki' => [
                    ['service' => 'REG', 'description' => 'Regular Service', 'price' => 7500, 'etd' => '1-2'],
                    ['service' => 'ECO', 'description' => 'Economy Service', 'price' => 5500, 'etd' => '3-4'],
                    ['service' => 'ONS', 'description' => 'Over Night Service', 'price' => 29000, 'etd' => '1-2']
                ],
                'pos' => [
                    ['service' => 'Paket Kilat Khusus', 'description' => 'Paket Kilat Khusus', 'price' => 14000, 'etd' => '2-4'],
                    ['service' => 'Express Next Day', 'description' => 'Express Next Day', 'price' => 28000, 'etd' => '1-2']
                ]
            ],
            'zone4' => [
                'jne' => [
                    ['service' => 'REG', 'description' => 'Layanan Reguler', 'price' => 18000, 'etd' => '3-4'],
                    ['service' => 'OKE', 'description' => 'Ongkos Kirim Ekonomis', 'price' => 15000, 'etd' => '4-5'],
                    ['service' => 'YES', 'description' => 'Yakin Esok Sampai', 'price' => 35000, 'etd' => '2-3']
                ],
                'tiki' => [
                    ['service' => 'REG', 'description' => 'Regular Service', 'price' => 17500, 'etd' => '3-4'],
                    ['service' => 'ECO', 'description' => 'Economy Service', 'price' => 14500, 'etd' => '5-6'],
                    ['service' => 'ONS', 'description' => 'Over Night Service', 'price' => 34000, 'etd' => '2-3']
                ],
                'pos' => [
                    ['service' => 'Paket Kilat Khusus', 'description' => 'Paket Kilat Khusus', 'price' => 17000, 'etd' => '3-5'],
                    ['service' => 'Express Next Day', 'description' => 'Express Next Day', 'price' => 33000, 'etd' => '2-3']
                ]
            ],
            'zone5' => [
                'jne' => [
                    ['service' => 'REG', 'description' => 'Layanan Reguler', 'price' => 22000, 'etd' => '4-5'],
                    ['service' => 'OKE', 'description' => 'Ongkos Kirim Ekonomis', 'price' => 18000, 'etd' => '5-6'],
                    ['service' => 'YES', 'description' => 'Yakin Esok Sampai', 'price' => 40000, 'etd' => '3-4']
                ],
                'tiki' => [
                    ['service' => 'REG', 'description' => 'Regular Service', 'price' => 21500, 'etd' => '4-5'],
                    ['service' => 'ECO', 'description' => 'Economy Service', 'price' => 17500, 'etd' => '6-7'],
                    ['service' => 'ONS', 'description' => 'Over Night Service', 'price' => 39000, 'etd' => '3-4']
                ],
                'pos' => [
                    ['service' => 'Paket Kilat Khusus', 'description' => 'Paket Kilat Khusus', 'price' => 21000, 'etd' => '4-6'],
                    ['service' => 'Express Next Day', 'description' => 'Express Next Day', 'price' => 38000, 'etd' => '3-4']
                ]
            ]
        ]
        // Add more origin zones as needed, copying similar structure
    ]
];

// 3. HELPER FUNCTIONS
function getZoneByCity($city_id)
{
    global $shipping_zones;
    foreach ($shipping_zones['zone_mapping'] as $zone => $cities) {
        if (in_array($city_id, $cities)) {
            return $zone;
        }
    }
    return 'zone3'; // default fallback
}

function getCityById($city_id)
{
    global $mock_data_indonesia;
    foreach ($mock_data_indonesia['kota'] as $city) {
        if ($city['city_id'] == $city_id) {
            return $city;
        }
    }
    return null;
}

function getCitiesByProvince($province_id)
{
    global $mock_data_indonesia;
    $cities = [];
    foreach ($mock_data_indonesia['kota'] as $city) {
        if ($city['province_id'] == $province_id) {
            $cities[] = $city;
        }
    }
    return $cities;
}

function getShippingCosts($origin_city_id, $destination_city_id, $weight_gram, $quantity)
{
    global $shipping_zones;

    // Convert weight to kg (minimum 1kg)
    $weight_kg = max(1, ceil($weight_gram / 1000));

    // Get zones
    $origin_zone = getZoneByCity($origin_city_id);
    $destination_zone = getZoneByCity($destination_city_id);

    // Get pricing (fallback to zone1 -> zone3 if not found)
    $pricing = isset($shipping_zones['pricing'][$origin_zone][$destination_zone])
        ? $shipping_zones['pricing'][$origin_zone][$destination_zone]
        : $shipping_zones['pricing']['zone1']['zone3'];

    $results = [];
    foreach ($pricing as $courier => $services) {
        $results[$courier] = [
            'code' => $courier,
            'name' => getCourierFullName($courier),
            'costs' => []
        ];

        foreach ($services as $index => $service) {
            $cost_per_item = $service['price'] * $weight_kg;
            $results[$courier]['costs'][] = [
                'service' => $service['service'],
                'description' => $service['description'],
                'cost' => [
                    [
                        'value' => $cost_per_item,
                        'etd' => $service['etd'],
                        'note' => ''
                    ]
                ]
            ];
        }
    }

    return $results;
}

function getCourierFullName($code)
{
    $names = [
        'jne' => 'Jalur Nugraha Ekakurir (JNE)',
        'tiki' => 'Citra Van Titipan Kilat (TIKI)',
        'pos' => 'POS Indonesia'
    ];
    return isset($names[$code]) ? $names[$code] : strtoupper($code);
}

// ===============================================================
// 4. MOCK FILE REPLACEMENTS
// ===============================================================

// MOCK req-kota.php
function mockReqKota($id_provinsi)
{
    $cities = getCitiesByProvince($id_provinsi);
    $html = '<option value="" selected disabled hidden>Pilih Kota</option>' . "\n";

    foreach ($cities as $city) {
        $html .= '<option value="' . $city['city_id'] . '">' . $city['city_name'] . '</option>' . "\n";
    }

    return $html;
}

// MOCK pilih-ongkir.php  
function mockPilihOngkir($kota_id_toko, $kota_tujuan, $berat_barang, $jumlah_barang)
{
    $shipping_costs = getShippingCosts($kota_id_toko, $kota_tujuan, $berat_barang, $jumlah_barang);

    $html = '';
    $style = '
    <style>
        .box_list_ongkir {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid var(--border-grey);
            border-radius: 3px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .judul_list_ongkir {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .judul_list_ongkir h1 {
            font-size: 15px;
            font-weight: 500;
            color: var(--black);
        }

        .judul_list_ongkir h5 {
            font-size: 15px;
            font-weight: 500;
            color: var(--orange);
        }

        .box_list_ongkir p {
            font-size: 12px;
            color: var(--semi-black);
            margin-top: 5px;
        }

        @media only screen and (max-width: 500px) {
            .judul_list_ongkir h1 {
                font-size: 13px;
            }

            .judul_list_ongkir h5 {
                font-size: 13px;
            }

            .box_list_ongkir p {
                font-size: 11px;
            }
        }
    </style>';

    foreach (['jne', 'tiki', 'pos'] as $courier_code) {
        if (isset($shipping_costs[$courier_code])) {
            $courier = $shipping_costs[$courier_code];
            foreach ($courier['costs'] as $keykon => $cost) {
                $kurir_ongkir = $courier['code'];
                $kurir_layanan_ongkir = $cost['service'];
                $etd_ongkir = $cost['cost'][0]['etd'];
                $harga_ongkir = $cost['cost'][0]['value'] * $jumlah_barang;

                $html .= '<div class="box_list_ongkir" onclick="UbahOpsiOngkir(\'' . $kurir_ongkir . '\', \'' . $keykon . '\', \'' . $kurir_layanan_ongkir . '\', \'' . $etd_ongkir . '\', \'' . $harga_ongkir . '\')">' . "\n";
                $html .= '    <div class="judul_list_ongkir">' . "\n";
                $html .= '        <h1>' . strtoupper($kurir_ongkir) . ' ' . $kurir_layanan_ongkir . '</h1>' . "\n";
                $html .= '        <h5>Rp ' . number_format($harga_ongkir, 0, ".", ".") . '</h5>' . "\n";
                $html .= '    </div>' . "\n";
                $html .= '    <p>Perkiraan sampai ' . $etd_ongkir . ' Hari</p>' . "\n";
                $html .= '</div>' . "\n";
            }
        }
    }

    return $html . $style;
}

// MOCK save-location.php (simplified - just the shipping calculation part)
function mockSaveLocation($kota_id_toko, $id_kota, $berat_barang, $jumlah_barang)
{
    // Get city data
    $city_data = getCityById($id_kota);
    if (!$city_data) {
        return ['error' => 'City not found'];
    }

    // Get shipping costs (default to JNE REG - index 0)
    $shipping_costs = getShippingCosts($kota_id_toko, $id_kota, $berat_barang, $jumlah_barang);
    $jne_costs = $shipping_costs['jne']['costs'];
    $default_service = $jne_costs[0]; // REG service

    return [
        'city_data' => $city_data,
        'kurir_ongkir' => 'jne',
        'id_kurir' => '0',
        'kurir_layanan_ongkir' => $default_service['service'],
        'etd_ongkir' => $default_service['cost'][0]['etd'],
        'harga_ongkir' => $default_service['cost'][0]['value'] * $jumlah_barang
    ];
}

// ===============================================================
// 5. TESTING EXAMPLES
// ===============================================================

echo "=== TESTING MOCK SYSTEM ===\n\n";

// Test 1: req-kota.php
echo "1. Mock req-kota.php (Provinsi ID: 9 - Jawa Barat):\n";
echo mockReqKota('9');
echo "\n";

// Test 2: pilih-ongkir.php  
echo "2. Mock pilih-ongkir.php (Jakarta Pusat -> Bandung, 1000g, 2 items):\n";
$pilih_result = mockPilihOngkir('152', '23', 1000, 2);
echo substr($pilih_result, 0, 500) . "...\n\n"; // Show first 500 chars

// Test 3: save-location.php
echo "3. Mock save-location.php calculation:\n";
$save_result = mockSaveLocation('152', '23', 1000, 2);
print_r($save_result);

// Test 4: Show available cities for different provinces
echo "\n4. Available cities per province (sample):\n";
foreach (['6', '9', '10', '1'] as $prov_id) {
    $cities = getCitiesByProvince($prov_id);
    $prov_name = '';
    foreach ($mock_data_indonesia['provinsi'] as $prov) {
        if ($prov['id'] == $prov_id) {
            $prov_name = $prov['name'];
            break;
        }
    }
    echo "Provinsi: $prov_name ($prov_id) - " . count($cities) . " cities\n";
}

// ===============================================================
// 6. COMPLETE FILE CONTENTS FOR COPY-PASTE
// ===============================================================

echo "\n\n=== READY-TO-USE FILE CONTENTS ===\n\n";

echo "--- NEW req-kota.php ---\n";
echo '<?php
$id_provinsi = $_POST[\'id_provinsi\'];

// Include mock data (put the mock data above here)
echo mockReqKota($id_provinsi);
?>';

echo "\n\n--- NEW pilih-ongkir.php ---\n";
echo '<?php
include \'../../config.php\';

$kota_tujuan  = $_POST[\'id_kota_tujuan_v\'];
$berat_barang = $_POST[\'berat_barang\'];
$jumlah_barang = $_POST[\'jumlah_barang\'];

// Include mock data (put the mock data above here)
echo mockPilihOngkir($kota_id_toko, $kota_tujuan, $berat_barang, $jumlah_barang);
?>';

echo "\n\n--- NEW save-location.php (shipping part only) ---\n";
echo '<?php
include \'../../config.php\';

$id_invoice = $_POST[\'id_invoice\'];
$id_provinsi = $_POST[\'id_provinsi\'];
$id_kota = $_POST[\'id_kota\'];
$alamat_lengkap = $_POST[\'alamat_lengkap\'];
$id_kurir = \'0\';

$select_invoice_sl = $server->query("SELECT * FROM `invoice`, `iklan` WHERE invoice.idinvoice=$id_invoice AND invoice.id_iklan=iklan.id ");
$data_invoice_sl = mysqli_fetch_assoc($select_invoice_sl);

$berat_barang = $data_invoice_sl[\'berat\'];
$jumlah_barang = $data_invoice_sl[\'jumlah\'];

// Mock calculation instead of CURL
$mock_result = mockSaveLocation($kota_id_toko, $id_kota, $berat_barang, $jumlah_barang);

if (!isset($mock_result[\'error\'])) {
    $city_data = $mock_result[\'city_data\'];
    $provinsi_d = $city_data[\'province\']; // You need to get province name from city data
    $kota_d = $city_data[\'city_name\'];
    
    $provinsi_inv = $id_provinsi . \',\' . $provinsi_d;
    $kota_inv = $id_kota . \',\' . $kota_d;
    
    $kurir_ongkir = $mock_result[\'kurir_ongkir\'];
    $kurir_layanan_ongkir = $mock_result[\'kurir_layanan_ongkir\'];
    $etd_ongkir = $mock_result[\'etd_ongkir\'];
    $harga_ongkir = $mock_result[\'harga_ongkir\'];
    
    // Continue with database updates...
    // (rest of the original code for database operations)
}
?>';

?> 'price' => 19000, 'etd' => '1']
],
'pos' => [
['service' => 'Paket Kilat Khusus', 'description' => 'Paket Kilat Khusus', 'price' => 7000, 'etd' => '1-2'],
['service' => 'Express Next Day', 'description' => 'Express Next Day', 'price' => 18000, 'etd' => '1']
]
],
'zone2' => [
'jne' => [
['service' => 'REG', 'description' => 'Layanan Reguler', 'price' => 12000, 'etd' => '1-2'],
['service' => 'OKE', 'description' => 'Ongkos Kirim Ekonomis', 'price' => 9000, 'etd' => '2-3'],
['service' => 'YES', 'description' => 'Yakin Esok Sampai', 'price' => 25000, 'etd' => '1']
],
'tiki' => [
['service' => 'REG', 'description' => 'Regular Service', 'price' => 11500, 'etd' => '1-2'],
['service' => 'ECO', 'description' => 'Economy Service', 'price' => 8500, 'etd' => '3-4'],
['service' => 'ONS', 'description' => 'Over Night Service', 'price' => 24000, 'etd' => '1']
],
'pos' => [
['service' => 'Paket Kilat Khusus', 'description' => 'Paket Kilat Khusus', 'price' => 11000, 'etd' => '2-3'],
['service' => 'Express Next Day', 'description' => 'Express Next Day', 'price' => 23000, 'etd' => '1']
]
],
'zone3' => [
'jne' => [
['service' => 'REG', 'description' => 'Layanan Reguler', 'price' => 15000, 'etd' => '2-3'],
['service' => 'OKE', 'description' => 'Ongkos Kirim Ekonomis', 'price' => 12000, 'etd' => '3-4'],
['service' => 'YES', 'description' => 'Yakin Esok Sampai', 'price' => 30000, 'etd' => '1-2']
],
'tiki' => [
['service' => 'REG', 'description' => 'Regular Service', 'price' => 14500, 'etd' => '2-3'],
['service' => 'ECO', 'description' => 'Economy Service', 'price' => 11500, 'etd' => '4-5'],
['service' => 'ONS', 'description' => 'Over Night Service',