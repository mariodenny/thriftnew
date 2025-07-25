<div class="header_responsive_admin" onclick="show_box_menu_admin()">
    <i class="fas fa-bars"></i>
    <p>Menu Admin</p>
</div>

<div class="box_menu_admin" id="box_menu_admin">
    <div class="menu_admin">
        <div class="menu_profile_admin">
            <img src="<?= $url; ?>assets/icons/<?php echo $logo; ?>" alt="Logo Admin">
            <p class="admin_name"><?= $profile_adm['nama_lengkap']; ?></p>
        </div>

        <div class="menu_list">
            <style>
                /* === Struktur Menu === */
                .menu_list a {
                    text-decoration: none;
                    padding-left: 30px;
                    display: block;
                    margin: 0;
                }

                /* === Item Menu === */
                .menu_list_isi,
                .menu_list_isi_active {
                    display: flex;
                    align-items: center;
                    gap: 0px;
                    padding-left: 10px;
                    margin: -10px ;
                    border-radius: 4px;
                    color: #333;
                    font-size: 14px;
                    transition: background 0.3s ease;
                    cursor: pointer;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .menu_list_isi_active {
                    background-color: #ffe0ec;
                    font-weight: bold;
                }

                /* Hover Effect */
                .menu_list_isi:hover {
                    background-color: #f9d0dd;
                }

                /* === Ikon pada menu === */
                .box_icon_menu_list_isi {
                    width: 24px;
                    text-align: center;
                    font-size: 16px;
                    color: #ec407a;
                }

                /* === Profil Admin === */
                .menu_admin {
                    background: linear-gradient(to bottom, #ffe0ec, #fff);
                    padding: 0;
                    border-right: 1px solid #eee;
                    height: 100%;
                }
                .menu_profile_admin {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    padding: 25px 10px;
                    background-color: #ffc0cb;
                    border-radius: 0 0 10px 10px;
                }

                .menu_profile_admin img {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%;
                    object-fit: cover;
                    margin-bottom: 10px;
                    border: 2px solid white;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }

                .admin_name {
                    margin: 0;
                    font-weight: 700 !important;
                    padding-right: 22px;
                    font-size: 18px !important;
                    color: #2c3e50 !important;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }


                /* === Dropdown User Menu (Modified for alignment) === */
                .menu_list_isi_dropdown {
                    display: flex;
                    align-items: center;
                    gap: 0px;
                    padding-left: 30px; 
                  
                    /* *This is the key for alignment* */
                    margin: 2px 0;
                    border-radius: 6px;
                    cursor: pointer;
                    color: #333;
                    font-size: 14px;
                    transition: background 0.3s ease;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .menu_list_isi_dropdown:hover {
                    background-color: #f9d0dd;
                }

                /* === Dropdown Content === */
                .dropdown_menu_list {
                    /* Adjusted padding to make submenu items align more to the right */
                    padding-left: 40px; /* Increased from 30px */
                    display: none;
                }

                .dropdown_menu_list.show {
                    display: block;
                }

                .dropdown_menu_list a {
                    margin-left: 10; /* Remove extra margin for submenu links */
                }
                .dropdown_menu_list .menu_list_isi,
                .dropdown_menu_list .menu_list_isi_active {
                    padding-left: 0; /* Remove inherited padding from parent */
                }


                /* === Added line for separation === */
                .line_menu_list {
                    border-top: 1px solid #ddd;
                    margin: 10px 0;
                }
            </style>

            <?php
            // Ensure these variables are defined before including this partial
            // $url, $page_admin, $profile_adm, $logo

            $menu_items_top = [
                ['title' => 'Dashboard', 'icon' => 'fa-th-large', 'url' => 'admin', 'page' => 'dashboard'],
                ['title' => 'Produk', 'icon' => 'fa-box', 'url' => 'admin/product', 'page' => 'produk'],
                ['title' => 'Kategori', 'icon' => 'fa-th-list', 'url' => 'admin/category', 'page' => 'kategori'],
            ];

            foreach ($menu_items_top as $item) {
                $active_class = ($page_admin === $item['page']) ? 'menu_list_isi_active' : 'menu_list_isi';
                echo <<<HTML
                <a href="{$url}{$item['url']}">
                    <div class="{$active_class}">
                        <div class="box_icon_menu_list_isi">
                            <i class="fas {$item['icon']}"></i>
                        </div>
                        <p>{$item['title']}</p>
                    </div>
                </a>
HTML;
            }
            ?>

            <div class="menu_list_isi_dropdown <?php echo (in_array($page_admin, ['user_admin', 'user_user'])) ? 'menu_list_isi_active' : 'menu_list_isi'; ?>" onclick="toggleDropdown('userDropdown')">
                <div class="box_icon_menu_list_isi">
                    <i class="fas fa-users-cog"></i>
                </div>
                <p>Akun User <i class="fas fa-chevron-down" style="margin-left:auto; font-size:12px;"></i></p>
            </div>

            <div class="dropdown_menu_list" id="userDropdown">
                <?php
                $user_roles = [
                    ['role' => 'admin', 'label' => 'Admin', 'icon' => 'fa-user-shield', 'page' => 'user_admin'],
                    ['role' => 'user', 'label' => 'User', 'icon' => 'fa-user', 'page' => 'user_user'],
                ];
                foreach ($user_roles as $user) {
                    $active_class = ($page_admin === $user['page']) ? 'menu_list_isi_active' : 'menu_list_isi';
                    echo <<<HTML
                    <a href="{$url}admin/users?role={$user['role']}">
                        <div class="{$active_class}">
                            <div class="box_icon_menu_list_isi">
                                <i class="fas {$user['icon']}"></i>
                            </div>
                            <p>{$user['label']}</p>
                        </div>
                    </a>
HTML;
                }
                ?>
            </div>

            <?php
            $menu_items_bottom = [
                ['title' => 'Banner Promo', 'icon' => 'fa-sticky-note', 'url' => 'admin/promotion', 'page' => 'promo'],
                ['title' => 'Transaksi', 'icon' => 'fa-shopping-bag', 'url' => 'admin/transaction', 'page' => 'transaksi'],
                ['title' => 'Laporan Transaksi /Periode', 'icon' => 'fa-file', 'url' => 'admin/transaction_report', 'page' => 'laporan_transaksi_periode'],
                ['title' => 'Laporan Transaksi /Bulan', 'icon' => 'fa-file', 'url' => 'admin/transaction_report/month.php', 'page' => 'laporan_transaksi_bulan'],
                ['title' => 'Flash Sale', 'icon' => 'fa-bolt', 'url' => 'admin/flashsale', 'page' => 'flashsale'],
                ['title' => 'Pengaturan', 'icon' => 'fa-cog', 'url' => 'admin/settings', 'page' => 'pengaturan'],
            ];

            // Add the line above 'Pengaturan'
            $added_line_before_settings = false;
            foreach ($menu_items_bottom as $item) {
                if ($item['page'] === 'pengaturan' && !$added_line_before_settings) {
                    echo '<div class="line_menu_list"></div>'; // Garis di atas Pengaturan
                    $added_line_before_settings = true;
                }
                $active_class = ($page_admin === $item['page']) ? 'menu_list_isi_active' : 'menu_list_isi';
                echo <<<HTML
                <a href="{$url}{$item['url']}">
                    <div class="{$active_class}">
                        <div class="box_icon_menu_list_isi">
                            <i class="fas {$item['icon']}"></i>
                        </div>
                        <p>{$item['title']}</p>
                    </div>
                </a>
HTML;
            }
            ?>

            <a href="<?= $url; ?>system/admin/logout.php">
                <div class="menu_list_isi">
                    <div class="box_icon_menu_list_isi">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <p>Log Out</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('show');

    const dropdownTrigger = dropdown.previousElementSibling;
    if (dropdownTrigger.classList.contains('menu_list_isi_dropdown')) {
        // Only add active class if the dropdown itself is showing,
        // unless one of its children is already active (handled by DOMContentLoaded)
        if (dropdown.classList.contains('show')) {
             dropdownTrigger.classList.add('menu_list_isi_active');
        } else {
            // Check if any child is active before removing the active class
            const anyChildActive = dropdown.querySelector('a .menu_list_isi_active');
            if (!anyChildActive) {
                 dropdownTrigger.classList.remove('menu_list_isi_active');
            }
        }
    }
}

function show_box_menu_admin() {
    const boxMenu = document.getElementById('box_menu_admin');
    boxMenu.style.display = boxMenu.style.display === 'block' ? 'none' : 'block';
}

// Keep dropdown open if one of its children is active on page load
document.addEventListener('DOMContentLoaded', function() {
    const userDropdown = document.getElementById('userDropdown');
    const activeChildLink = userDropdown.querySelector('.menu_list_isi_active'); // Check for any active child link

    if (activeChildLink) {
        userDropdown.classList.add('show');
        // Also apply active style to the dropdown trigger if one of its children is active
        const dropdownTrigger = userDropdown.previousElementSibling;
        if (dropdownTrigger.classList.contains('menu_list_isi_dropdown')) {
            dropdownTrigger.classList.add('menu_list_isi_active');
        }
    }
});
</script>