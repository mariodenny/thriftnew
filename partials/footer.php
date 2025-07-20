<footer>
    <center><div class="width" >
        <div class="footer" >
            <div class="footer_grid">
                <h1>HALAMAN</h1>
                <a href="<?php echo $url; ?>help/bantuan">
                    <p>Bantuan</p>
                </a>
                <a href="<?php echo $url; ?>help/kebijakan-privasi">
                    <p>Kebijakan Privasi</p>
                </a>
                <a href="<?php echo $url; ?>help/tentang-kami">
                    <p>Tentang Kami</p>
                </a>
                <a href="<?php echo $url; ?>help/hubungi-kami">
                    <p>Hubungi Kami</p>
                </a>
            </div>
           
            <div class="footer_grid">
                <h1>PENGIRIMAN</h1>
                <img src="<?php echo $url; ?>assets/image/pengiriman/jnt.png">
                <img src="<?php echo $url; ?>assets/image/pengiriman/jne.png">
                <img src="<?php echo $url; ?>assets/image/pengiriman/sicepat.png">
                <img src="<?php echo $url; ?>assets/image/pengiriman/ninja.png">
                <img src="<?php echo $url; ?>assets/image/pengiriman/anteraja.png">
            </div>

            <div class="footer_grid">
                <h1>PEMBAYARAN</h1>
                <img src="<?php echo $url; ?>assets/image/pembayaran/bca.png">
</div>
            <div class="footer_grid">
                <h1>IKUTI KAMI</h1>
                <div class="footer_sosmed">
                    <?php
                    $select_social_footer = $server->query("SELECT * FROM `setting_footer`");
                    while ($data_social_footer = mysqli_fetch_assoc($select_social_footer)) {
                        if ($data_social_footer['link_social'] != '') {
                    ?>
                            <a href="<?php echo $data_social_footer['link_social']; ?>" target="_blank">
                                <div class="isi_footer_sosmed">
                                    <?php echo $data_social_footer['icon_social']; ?>
                                    <?php echo $data_social_footer['name_social']; ?>
                                </div>
                            </a>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <p class="copyright"><a href="<?php echo $url; ?>"><?php echo $title_name; ?></p>
    </div>
</footer>