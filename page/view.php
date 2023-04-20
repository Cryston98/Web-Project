<?php

$ExternPath="../";
$RootPath="../index.php";
$PagePath="";
session_start();
$playlist=$_GET['playlist'];
$user=$_SESSION['username'];
if (isset($_GET['playlist'])) {
  $parent=$_GET['playlist'];
}else{
  $parent='';
}

if (isset($_GET['subcategory'])) {
  $child=$_GET['subcategory'];
}else{
  $child='';
}

$CurentPath=$_SERVER["PHP_SELF"]."?playlist=".$playlist."&subcategory=".$child;

//'https://player.vimeo.com/video/317300570';//$_REQUEST["LinkPlayerURL"];

include $ExternPath.'include/header.php';
include $ExternPath.'include/db_connect.php';

echo '<body>';
//Menu menuViewPage
echo "<div id='menuViewPage'>";
echo "<div id='LocationPath'><i class=' icoNameLocation fas fa-bookmark'></i><h3 id='nameLocation'><a href='$RootPath'>Home</a><i class='fas fa-angle-right'></i><a href='../page/subcategory.php?playlist=".$parent."'>".$parent."</a><i class='fas fa-angle-right'></i>".$child."</h3></div>";



echo '<span style="color:white;margin:0px;float:right;">';
  echo '<a href="'.$RootPath.'"><button class="newLinkInsert" ><i class="ico-item1 fas fa-home"></i>Home</button></a>';
  echo '<button class="newLinkInsert" id="newLinkInsertID" ><i class="ico-item1 far fa-plus-square"></i>New Link</button>';
echo '</span>';


echo   "</div>";
//End menu menuViewPage


    echo '<div id="shadowPopUp"></div>';
    echo  '<div id="wrapper-view">';


    echo '<div class="hover_bkgr_fricc1">
        <span class="helper1"></span>
        <div>
            <div class="popupCloseButton1">X</div>';

            include $ExternPath.'include/insertForm.php';

        echo '</div>
    </div>';

          mysqli_select_db($connect,'spiderlink');
          $SQL="SELECT * FROM db_tab_link WHERE CATEGORY='$child' AND USER='$user'";
          $result=mysqli_query($connect,$SQL);


          $countOfResults=0;
          $arrayTypeLink = array();
          $arrayTypeTxt = array();
          $arrayTypeContor = array(0,0,0,0);

          $arrayNameLink = array();
          $arrayPathLink = array();
          $arraySubjectLink = array();
          $arrayButtonPlay = array();

          //  DETERMINATION ELEMENT FROM DB
              if (mysqli_num_rows($result)> 0)
               {
                  while($row = mysqli_fetch_assoc($result))
                       {
                           if($row['TYPE']=='youtube'){
                                $arrayTypeLink[$countOfResults]='<span style="color:red;"><i class="ico-item fab fa-youtube"></i></i></span>';
                                $arrayTypeTxt[$countOfResults]='youtube';
                                $arrayTypeContor[0]++;
                            }else if($row['TYPE']=='images'){
                                  $arrayTypeLink[$countOfResults]='<span><i class="ico-item fas fa-images"></i></span>';
                                  $arrayTypeTxt[$countOfResults]='images';
                                  $arrayTypeContor[1]++;
                            }else if($row['TYPE']=='pdf'){
                                    $arrayTypeLink[$countOfResults]= '<span><i class="ico-item fas fa-file-pdf"></i></span>';
                                    $arrayTypeTxt[$countOfResults]='pdf';
                                    $arrayTypeContor[2]++;
                            }else {
                                  $arrayTypeLink[$countOfResults]= '<span style="color:#2196F3;"><i class="ico-item fas fa-link"></i></span>';
                                  $arrayTypeTxt[$countOfResults]='link';
                                  $arrayTypeContor[3]++;
                            }
                          $arrayPathLink[$countOfResults] = $row['URL'];
                          $arrayNameLink[$countOfResults]=$row['TITLE'];
                          $arraySubjectLink[$countOfResults]=$row['SUBJECT'];
                          $arrayButtonPlay[$countOfResults]="<button class='bt_play' onclick='play_fc(\"".$row['URL']."\",\"".$row['TITLE']."\")' ><i class='fa fa-play inc_bt_play' style='font-size:20px;'></i></button>";
                        $countOfResults++;
                     }
                  }







    //Start Player Section
    echo '<div id="PlayerFrame">
            <h4 id="TitlePlayerURL">UNDEFINED</h4>
              <iframe  src="" id="player" allow="autoplay; encrypted-media" allowfullscreen ></iframe>';

              //Start Note Section
                echo '<div id="NoteSection">

                        <div id="NoteTile">Lista Note</div>

                        <div id="NoteArea">';

?>

                          <script>updateImage();</script>

<?php

                        echo '</div>

                     </div>';
              //End Note Section


        echo '<button onclick="openNewTab()" title ="Open New Tab" type="submit" id="FullBTN" name="submitFull" value=""><i class="fas fa-external-link-alt"></i></button>';
        echo '<button onclick="createNewNote()" title ="Create New Note" id="newNoteBTN" name="newNoteBTN" value=""><i class="fas fa-ellipsis-h"></i></button>';

      echo '
        <form action="../function/createNewNote.php" method="post" id="Area_AddNewNote">
          <input type="hidden" id="LinkPlayerURL" name="LinkPlayerURL" />
            <input type="hidden" id="LocationCall" name="LocationCall" value="'.$CurentPath.'" />

          <textarea id="NewNoteInput" type="text" name="NewNoteInput" placeholder="Enter new note!" ></textarea>
          <input type="submit" id="SubmitNewNote"  name="SubmitNewNote" value="Save Note"/>
          <div id="ClearNewNote">Clear</div>
        </form>';


    echo '</div>';
  //End Player Section


  //Start wrapper subcategory
echo "<div id='wrapperSubcategoryView'>";

    //Start Fisrt Subcatergory ALL type
      echo '<div class="SubcategoryNavigation">';
        echo '<h3 onclick="openSubcategory(\'SubCateg1\')"><i class="far fa-folder-open"></i>  All Type</h3>';

        $contor=0;
        //Start LeftListALL
          echo '<div class="leftListPlay" id="SubCateg1">';
              if ($countOfResults>0)
              {
                  echo "<table id='UserTablePost'>
                       <tr>
                         <th>...</th>
                         <th>Title</th>
                         <th>Category</th>
                         <th>Play</th>
                       </tr>";
                  while ($contor<$countOfResults)
                  {
                           echo "<tr>";
                                echo   "<td>".$arrayTypeLink[$contor]."</td>";
                                echo   "<td>".$arrayNameLink[$contor]."</td>";
                                echo   "<td>".$arraySubjectLink[$contor]."</td>";
                                echo   "<td>".$arrayButtonPlay[$contor]."</td>";
                          echo "</tr>";
                          $contor++;
                    }
                    echo "</table>";
              }else{
                echo "List is empty ... ";
              }
          echo '</div>';
          //End LeftListALL

    echo '</div>';
    //END First Subcategory



    //Start Second Subcategory
      echo '<div class="SubcategoryNavigation">';
        echo '<h3 onclick="openSubcategory(\'SubCateg2\')"> <i class="fas fa-file-pdf"></i> PDF | Documents</h3>';

        $contor=0;
        //Start LeftListALL
          echo '<div class="leftListPlay" id="SubCateg2">';
              if ($arrayTypeContor[2]>0)
              {
                  echo "<table id='UserTablePost'>
                       <tr>
                         <th>...</th>
                         <th>Title</th>
                         <th>Category</th>
                         <th>Play</th>
                       </tr>";
                  while ($contor<$countOfResults)
                  {
                          if ($arrayTypeTxt[$contor]=='pdf') {
                            echo "<tr>";
                                 echo   "<td>".$arrayTypeLink[$contor]."</td>";
                                 echo   "<td>".$arrayNameLink[$contor]."</td>";
                                 echo   "<td>".$arraySubjectLink[$contor]."</td>";
                                 echo   "<td>".$arrayButtonPlay[$contor]."</td>";
                           echo "</tr>";
                          }
                          $contor++;
                    }
                    echo "</table>";
              }else{
                echo "List is empty ... ";
              }
          echo '</div>';
          //End LeftListALL


      echo '</div>';
      //END Second Subcategory


      //Start Three Subcategory
        echo '<div class="SubcategoryNavigation">';
          echo '<h3 onclick="openSubcategory(\'SubCateg3\')"> <i class="fab fa-youtube"></i> Youtube Link </h3>';

          $contor=0;
          //Start LeftListALL
            echo '<div class="leftListPlay" id="SubCateg3">';
                if ($arrayTypeContor[0]>0)
                {
                    echo "<table id='UserTablePost'>
                         <tr>
                           <th>...</th>
                           <th>Title</th>
                           <th>Category</th>
                           <th>Play</th>
                         </tr>";
                    while ($contor<$countOfResults)
                    {
                          if ($arrayTypeTxt[$contor]=='youtube') {
                            echo "<tr>";
                                 echo   "<td>".$arrayTypeLink[$contor]."</td>";
                                 echo   "<td>".$arrayNameLink[$contor]."</td>";
                                 echo   "<td>".$arraySubjectLink[$contor]."</td>";
                                 echo   "<td>".$arrayButtonPlay[$contor]."</td>";
                           echo "</tr>";
                          }
                            $contor++;
                      }
                      echo "</table>";
                }else{
                  echo "List is empty ... ";
                }
            echo '</div>';
            //End LeftListALL



        echo '</div>';
        //END Three Subcategory





        //Start Three Subcategory
          echo '<div class="SubcategoryNavigation">';
            echo '<h3 onclick="openSubcategory(\'SubCateg4\')"> <i class="far fa-images"></i> Images Link </h3>';

            $contor=0;
            //Start LeftListALL
              echo '<div class="leftListPlay" id="SubCateg4">';
                  if ($arrayTypeContor[1]>0)
                  {
                      echo "<table id='UserTablePost'>
                           <tr>
                             <th>...</th>
                             <th>Title</th>
                             <th>Category</th>
                             <th>Play</th>
                           </tr>";
                      while ($contor<$countOfResults)
                      {
                            if ($arrayTypeTxt[$contor]=='images') {
                              echo "<tr>";
                                   echo   "<td>".$arrayTypeLink[$contor]."</td>";
                                   echo   "<td>".$arrayNameLink[$contor]."</td>";
                                   echo   "<td>".$arraySubjectLink[$contor]."</td>";
                                   echo   "<td>".$arrayButtonPlay[$contor]."</td>";
                             echo "</tr>";
                            }
                              $contor++;
                        }
                        echo "</table>";
                  }else{
                    echo "List is empty ... ";
                  }
              echo '</div>';
              //End LeftListALL



          echo '</div>';
          //END Four Subcategory



echo '</div>';
//End wrapp subcategory




   echo'</div>';
echo'</body>';



?>
