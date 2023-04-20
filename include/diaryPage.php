<div id="wrap-DiaryPage">
  <div id="wrap-DiarySideLeft">


          <form action="../function/createDiaryFile.php" method="POST" onsubmit="return saveDiaryText()">
          <article id="originalSourceDiary" contenteditable="true">

            <h2> Jurnal</h2>

            <p>Aici poti adauga o nota sau o pagina de jurnal.
            </p>

          </article>
          <input type="hidden" name="contentDiaryPage" id="contentDiaryPage" value="mari"/>
          <input type="text" name="titleDiaryPage" id="titleDiaryPage" placeholder="Enter the title ... "/>
          <input type='submit' value='Send Data' id='saveDiary'>
          </form>

  </div>
  <div id="wrap-DiarySideRight">

    <div class="titleDiaryPage">
      <h3>My Arhive Diary</h3>
        <table id="customers">

          <tr>
            <th>FileName</th>
            <th>Size</th>
            <th>Last access</th>
          </tr>
          <?php include "../function/getNoteDiary.php"; ?>
        </table>

   </div>



  </div>



  </div>

</div>
