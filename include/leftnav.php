<?php
echo '
  <div id="left-sidebar">

    <div id="openclosebtn">
       <button id="closebtn"><i class="far fa-arrow-alt-circle-left"></i>&nbsp;<span class="text-ascuns">ASCUNDE</span></button>
       <button id="openbtn"><i class="far fa-arrow-alt-circle-right"></i>&nbsp;<span class="text-ascuns">DESCHIDE</span></button>
    </div>


    <div id="logo-platform"></div>

    <div id="user-details">

          <img id="user-images" alt="profile image" src="'.$ExternPath.'images/profile.jpg" height="250" width="250" ></img>

          <br>
          <span id="user-email"><i class="far fa-envelope"></i>&nbsp;&nbsp;';
          if(isset ($_SESSION['email']))
            {
              echo  $_SESSION['email'].'-'.$_SESSION['username'];
            }else{
              echo 'default@gamil.com';
            } echo '</span>
    </div>

    <div id="navmenu">

      <a class="item-nav" href="'.$RootPath.'"><i class="ico-item fas fa-home"></i>Home</a>
      <a class="item-nav" href="'.$PagePath.'playlistPage.php"><i class="ico-item fas fa-graduation-cap"></i>Moduls</a>
      <a class="item-nav" href="'.$PagePath.'diary.php"><i class="ico-item fas fa-book"></i>Diary</a>
      <a class="item-nav" href="'.$PagePath.'event.php"><i class="ico-item  far fa-calendar-check"></i>Event</a>
      <a class="item-nav" href="'.$PagePath.'managerFile.php"><i class="ico-item fas fa-folder-open"></i>Manager</a>
      <a class="item-nav" href="'.$PagePath.'settingPage.php"><i class="ico-item fas fa-cogs"></i></i>Setting</a>
      <a class="item-nav" href="'.$PagePath.'needHelpPage.php"><i class="ico-item far fa-question-circle"></i>Support</a>
      <a class="item-nav" href="'.$ExternPath.'function/logout.php"><i class="ico-item fas fa-sign-out-alt"></i>Logout</a>
    </div>

  </div>';
?>
