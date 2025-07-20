    <header>
        <div class="width">
            <div class="header">
                <a href="<?php echo $url; ?>">
                <div class="logo_header">
        <img 
            src="<?php echo $url; ?>assets/icons/<?php echo $logo; ?>" 
            class="svg_logo_header"
            style="height: 40px; width: 40px; border-radius: 50%; padding: 5px;">
        <p><?php echo $title_name; ?></p>
    </div>

    <style>
    .profile_greeting {
    display: flex;
    align-items: center;
    gap: 8px; 
    text-decoration: none;
    color: inherit;
}
.greeting_text {
    margin: 0;
    font-weight: 600;
    font-size: 14px;
}
.box_img_menu_header img {
    height: 32px;
    width: 32px;
    border-radius: 50%;
    object-fit: cover;
}
 header {
    box-shadow: none !important;
  }
  .box_search_header,
  .search_header,
  .search_header input,
  .search_header button {
    box-shadow: none !important;
  }
</style>
                </a>
                <div class="box_search_header">
                    <div class="search_header">
                        <input type="text" placeholder="<?php echo $placeholder_search; ?>" id="search_header" oninput="SearchHeader('<?php echo $url; ?>')">
                        <button><i class="ri-search-line"></i></button>
                    </div>
                    <div class="res_search_header" id="res_search_header">
                        <center><img src="<?php echo $url; ?>assets/icons/loading-o.svg" class="loading_res_search_header" id="loading_res_search_header"></center>
                        <div id="isi_res_search_header"></div>
                    </div>
                </div>
                <div class="profile_menu_header">
    <?php
    if (isset($_COOKIE['login'])) {
        $nama_user = isset($profile['nama_lengkap']) ? $profile['nama_lengkap'] : 'User';
    ?>
        <a href="<?php echo $url; ?>cart">
            <div class="box_icon_menu_header">
                <?php if ($cek_cart_header) { ?>
                    <p><?php echo $cek_cart_header; ?></p>
                <?php } ?>
                <i class="ri-shopping-bag-line"></i>
            </div>
        </a>
        <a href="<?php echo $url; ?>notification/">
            <div class="box_icon_menu_header">
                <?php if ($cek_notif_header) { ?>
                    <p><?php echo $cek_notif_header; ?></p>
                <?php } ?>
                <h5 class="ri-notification-3-line"></h5>
            </div>
        </a>
       <a href="<?php echo $url; ?>profile/user" class="profile_greeting">
    <p class="greeting_text">Hi, <?= htmlspecialchars($nama_user) ?></p>
    <div class="box_img_menu_header">
        <img src="<?php echo $url; ?>assets/image/profile/<?php echo $profile['foto']; ?>">
    </div>
</a>

    <?php
    } else {
    ?>
        <a href="<?php echo $url; ?>register/">Daftar</a>
        <p>|</p>
        <a href="<?php echo $url; ?>login/">Masuk</a>
    <?php
    }
    ?>
</div>

                </div>
            </div>
        </div>
    </header>
    <div class="back_header"></div>
    <script src="<?php echo $url; ?>assets/js/partials/header.js"></script>