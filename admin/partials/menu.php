<div class="header_responsive_admin" onclick="show_box_menu_admin()">
    <i class="fas fa-bars"></i>
    <p>Menu Admin</p>
</div>

<div class="box_menu_admin" id="box_menu_admin">
    <div class="menu_admin">
        <!-- Profile Admin -->
        <div class="menu_profile_admin">
    <img src="<?= $url; ?>assets/icons/<?php echo $logo; ?>" alt="Logo Admin">
    <p class="admin_name"><?= $profile_adm['nama_lengkap']; ?></p>
</div>

        <!-- Menu List -->
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
                  gap: 10px;
                  padding-left: 10px;
                  margin: -10px 0;
                  border-radius: 6px;
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


                /* === Dropdown User Menu === */
                .menu_list_isi_dropdown {
                  display: flex;
                  align-items: center;
                  gap: 10px;
                  padding: 10px 15px;
                  margin: 2px 0;
                  border-radius: 6px;
                  cursor: pointer;
                  color: #333;
                  padding-left: 40px;
                }

                .menu_list_isi_dropdown:hover {
                  background-color: #f9d0dd;
                }

                /* === Dropdown Content === */
                .dropdown_menu_list {
                  padding-left: 30px;
                  display: none;
                }

                .dropdown_menu_list.show {
                  display: block;
                }

                .dropdown_menu_list a {
                  margin-left: 10px;
                }
            </style>

            <?php
            $menu_items = [
                ['title' => 'Dashboard', 'icon' => 'fa-th-large', 'url' => 'admin', 'page' => 'dashboard'],
                ['title' => 'Produk', 'icon' => 'fa-box', 'url' => 'admin/product', 'page' => 'produk'],
                ['title' => 'Kategori', 'icon' => 'fa-th-list', 'url' => 'admin/category', 'page' => 'kategori'],
                ['title' => 'Banner Promo', 'icon' => 'fa-sticky-note', 'url' => 'admin/promotion', 'page' => 'promo'],
                ['title' => 'Transaksi', 'icon' => 'fa-shopping-bag', 'url' => 'admin/transaction', 'page' => 'transaksi'],
                ['title' => 'Laporan Transaksi /Periode', 'icon' => 'fa-file', 'url' => 'admin/transaction_report', 'page' => 'laporan_transaksi_periode'],
                ['title' => 'Laporan Transaksi /Bulan', 'icon' => 'fa-file', 'url' => 'admin/transaction_report/month.php', 'page' => 'laporan_transaksi_bulan'],
                ['title' => 'Flash Sale', 'icon' => 'fa-bolt', 'url' => 'admin/flashsale', 'page' => 'flashsale'],
                ['title' => 'Pengaturan', 'icon' => 'fa-cog', 'url' => 'admin/settings', 'page' => 'pengaturan'],
            ];

            foreach ($menu_items as $item) {
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

            <!-- Dropdown: Akun User -->
            <div class="menu_list_isi_dropdown" onclick="toggleDropdown('userDropdown')">
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

            <div class="line_menu_list"></div>

            <!-- Logout -->
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
}

function show_box_menu_admin() {
    const boxMenu = document.getElementById('box_menu_admin');
    boxMenu.style.display = boxMenu.style.display === 'block' ? 'none' : 'block';
}
</script>
