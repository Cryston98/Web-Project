<?php


echo '<form class="insert_wrap" action="../function/insertScript.php" method="post">
        <fieldset>
          <legend>Youtube/PDF/Video/Imagine/Articol URL:</legend>
              <label for="title">Title
                <input type="text" name="title" id="title" autocomplete="off" maxlenght="100" value="" placeholder="Enter title ..." required />
              </label>
              <br>

              <label for="playlist">Category
                <select name="playlist"  id="playlist">
                  <option>'.$child.'</option>';
  //include "../include/playlistList.php";
                echo '</select>
              </label>
              <br>

              <label for="url">URL
                  <input type="url" name="url" id="url" autocomplete="off" value="" placeholder="http://" required />
              </label>
              <br>
              <label for="type">Type
                <select name="type"  id="type">
                  <option value="youtube">Link Youtube</option>
                  <option value="pdf">Link PDF</option>
                  <option value="video">Link Video</option>
                  <option value="images">Link Imagine</option>
                  <option value="article">Link Articol</option>
                </select>
              </label>
              <br>
              <label for="subject">Subject
                <input type="text" name="subject"  id="subject" autocomplete="off"  value="" placeholder="Ex: Relaxing,Dance,Pan Flute,etc..." required />
              </label>
              <br>
              <input type="text" style="height:0px;visibility:hidden;margin:0px" id="userID" name="userID" value="'.$user.'"/>

              <input type="submit" name="submit_value" id="submit_value" value="Save ! " />
        </fieldset>
      </form>';


?>
