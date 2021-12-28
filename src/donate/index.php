<?php

require_once 'bootstrap.php';

?>

<?php include_once('./includes/header.php'); ?>

          <!-- About -->
          <section>
            <h2 id="about"><a href="#about">#</a>About</h2>
            <p>We are a non-profit organization that helps the retro community by selling NFTs.</p>
            <p>Please <span class="nes-text is-primary">donate</span> now !</p>
          </section>


          <!-- Shop -->
          <section>
            <h2 id="shop"><a href="#shop">#</a>Shop</h2>
            
            <section class="showcase">
              <section class="nes-container with-title"><h3 class="title">Items</h3>
                <p>Enter your email, select one of the items and get one exclusive voucher to redeem your NFT next year !</p>
                <div class="nes-field">
                  <input type="email" id="user_email" class="nes-input is-dark" placeholder='your@email.com'>
                </div>
              </section>
              <br>
          
              <div class="coreteam-members">

                <section class="nes-container is-dark member-card">
                  <i class="nes-charmander"></i>
                  <div class="profile">
                    <h4 class="name">Charmander</h4>
                    <p>Shiny edition !</p>
                    <a class="nes-btn is-warning" onclick="location.href = 'checkout?Amount=20&UserEmail=' + document.getElementById('user_email').value">
                      <i class="nes-icon coin is-small"></i> Buy for 20 <i class="nes-icon coin is-small"></i>
                    </a>
                  </div>
                </section>
                
                <section class="nes-container is-dark member-card">
                  <i class="nes-kirby"></i>
                  <div class="profile">
                    <h4 class="name">Kirby</h4>
                    <p>Unique color !</p>
                    <a class="nes-btn is-warning" onclick="location.href = 'checkout?Amount=50&UserEmail=' + document.getElementById('user_email').value">
                      <i class="nes-icon coin is-small"></i> Buy for 50 <i class="nes-icon coin is-small"></i>
                    </a>
                  </div>
                </section>
                
                <section class="nes-container is-dark member-card">
                  <i class="nes-icon star is-large"></i>
                  <div class="profile">
                    <h4 class="name">Secret</h4>
                    <p>Most expensive !</p>
                    <a class="nes-btn is-disabled">
                      <i class="nes-icon coin is-small"></i> Buy for 42000 <i class="nes-icon coin is-small"></i>
                    </a>
                  </div>
                </section>

              </div>

          </section>
          

          <!-- Disclaimer -->
          <section>
            <h2 id="disclaimer"><a href="#disclaimer">#</a>Disclaimer</h2>
            <p>The payment process is handled by a <u>3rd-party website</u> which informs us if your transaction has been successfully paid. <span class="nes-text is-error"><strong>All donations are non-refundable.</strong></span></p>
          </section>

<?php include_once('./includes/footer.php'); ?>