<?php

// Đăng ký mã shortcode
function giftcardmagic_shortcode() {
  ob_start();
  ?>
  <div id="wizard">
    <h2>Bước 1</h2>
    <section>
      <!-- Nội dung bước 1 -->
    </section>

    <h2>Bước 2</h2>
    <section>
      <!-- Nội dung bước 2 -->
    </section>

    <!-- Thêm các bước khác nếu cần -->
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('giftcardmagic', 'giftcardmagic_shortcode');
