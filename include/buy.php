<?php
$ExternPath="../";
include 'header.php';

echo "<div id='navIndex'>
        <ul>
        <a><li>Home</li></a>
        <a><li>About</li></a>
        <a><li>Contact</li></a>
        <a><li>LogIn</li></a>
</div>";


echo "<div id='wrapperBuy'>

        <div id='optionBuy1' class='buyItem'>
          <img class='imgOpt' src='../images/award_3.png' />
          <h2>Basic</h2>
            <p><i class='ico-item far fa-clock'></i>Calendar time 1 week </p>
            <p><i class='ico-item fas fa-hdd'></i>Store 50 links/month</p>
            <p><i class='ico-item fas fa-unlock-alt'></i>Only public playlists</p>
            <p><i class='ico-item fas fa-archive'></i>Total Space 500 links</p>

          <button class='btn_buy'>FREE</button>
        </div>
        <div id='optionBuy2' class='buyItem'>
          <img class='imgOpt' src='../images/award_1.png' />
          <h2>Premium</h2>
          <p><i class='ico-item far fa-clock'></i>Calendar time 6 months </p>
          <p><i class='ico-item fas fa-hdd'></i>Store 500 links/month</p>
          <p><i class='ico-item fas fa-unlock-alt'></i>Public & Private playlists</p>
          <p><i class='ico-item fas fa-archive'></i>Unlimited Storage Space</p>


          <form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
          <input type='hidden' name='cmd' value='_s-xclick'>
          <input type='hidden' name='hosted_button_id' value='QEGP2TLHWDM9C'>
          <button class='btn_buy'  border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'><i class='ico-item fab fa-paypal'></i>$4.99/mo</button>
          <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
          </form>



        </div>
        <div id='optionBuy3' class='buyItem'>
          <img class='imgOpt' src='../images/award_2.png' />
          <h2>Plus</h2>
          <p><i class='ico-item far fa-clock'></i>Calendar time 1 month </p>
          <p><i class='ico-item fas fa-hdd'></i>Store 300 links/month</p>
          <p><i class='ico-item fas fa-unlock-alt'></i>Only public playlists</p>
          <p><i class='ico-item fas fa-archive'></i>Total Space 10000 links</p>


          <form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
          <input type='hidden' name='cmd' value='_s-xclick'>
          <input type='hidden' name='hosted_button_id' value='EHEQVUTFYZG4W'>
          <button class='btn_buy' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'><i class='ico-item fab fa-paypal'></i>$1.99/mo</button>
          <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
          </form>
        </div>

      </div>";

      echo "<div id='bgIndex'>

      </div>";
?>
