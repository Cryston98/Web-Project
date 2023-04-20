<script>
/*
function shower()
{
    var el=document.getElementsByClassName('imgt')[0];
    document.getElementById('NamePhotoUP').innerHTML='<?php echo $user; ?>'+'.png';
    document.getElementById('HeightPhotoUP').innerHTML=el.height+'px';
    document.getElementById('WidthPhotoUP').innerHTML=el.width+'px';

    if(el.height==200 &&el.width==400){
          document.getElementById('StatusPhotoUP').innerHTML="OK";
          document.getElementById('StatusPhotoUP').style.color="green";
    }else{
          document.getElementById('StatusPhotoUP').innerHTML="Invalid Image. Choise Other!";
          document.getElementById('StatusPhotoUP').style.color="red";

    }
    oktoSendDB();
    document.getElementsByClassName('imgt')[0].style.height=55+'px';
    document.getElementsByClassName('imgt')[0].style.width=100+'px';
    document.getElementsByClassName('imgt')[0].style.borderRadius="4px";
    document.getElementById('TablePhotoUP').style.display="block";

}

function oktoSendDB(){
    var result=document.getElementById('StatusPhotoUP').innerHTML;
    if (result=='OK'){
      document.getElementById('btnSaveNewSubcategory').style.display="block";
    }else{
      document.getElementById('btnSaveNewSubcategory').style.display="none";
    }
}
*/
</script>

<?php


$VarTypeModul="submodul";

  include $ExternPath.'include/db_connect.php';


  $parent="";

  if(isset($_GET["playlist"])){
    $parent = $_GET["playlist"];
  }else{
    header('Location:../index.php?result%20error=NoSelectPlaylist');
  }


//Popup Subcategory
echo "
  <div class='hover_bkgr_fricc'>
    <span class='helper'></span>
    <div><div id='HeadPopUpNewPlaylist'>
      <h3>Add PlayList</h3>
        <div class='popupCloseButton'>X</div></div>";



        include "modulForm.php";

    echo "</div>
</div>";

#Confirm Delete PopUP
echo "<div id='formConfirmDeleteModule'>
       <div>
         <div id='HeadConfirmDeleteModule'>
           <h3>Confirm Delete Submodul</h3>
           <div class='closeBtnConfirmDeleteModule'>X</div>
         </div>";
         include "confirmDeleteSubmodulForm.php";
 echo "</div>
     </div>";



/*BUTTON NEW SUBCATEGORY*/
echo '<button id="btn_newSubcategory" class="trigger_popup_fricc" >
          <i class="fas fa-plus-square"></i><h4>New Subcategory</h4>
      </button>';


echo "<div id='wrapperSubcategory'>";
    echo "<i class=' icoNameLocation fas fa-bookmark'></i><h3 id='nameLocation'><a href='../page/playlistPage.php'>Home</a><i class='fas fa-angle-right'></i><a href=''>".$_GET['playlist']."</a></h3>";


// PHP SCRIPT FINDIND IN DATABASE AND SHOW FORM
$imageArray = array();
$titleArray = array();
$parentArray = array();
$counterOfSubcategory=0;

mysqli_select_db($connect,'spiderlink');
$SQL="SELECT * FROM db_tab_subcategory WHERE USER='$user' AND PARENT='$parent'  ORDER BY ID";

   if($result = mysqli_query($connect, $SQL)){
       if(mysqli_num_rows($result) > 0){

           $counterOfSubcategory=mysqli_num_rows($result);
           $i=0;
           while($row = mysqli_fetch_array($result))
           {
              $imageArray[$i]=$row['IMAGE'];
              $titleArray[$i]=$row['TITLE'];
              $i++;
           }
           mysqli_free_result($result);
       }else{
           echo "<h3 style='margin:10px'>No records matching your query were found.</h3>";
       }
 }else{
     echo "ERROR: Could not able to execute $SQL. " . mysqli_error($connect);
 }




 $j=0;
 while ($j<$counterOfSubcategory)
 {
     	if(isset($titleArray[$j]))
     	{
         /* Subcategory Area */
         echo "<div class='wrapBlockSubcategory'>";
           echo "<img id='imageSubcategory1' class='imageSubcategory' src='".$imageArray[$j]."' />";
           echo "<h2>".$titleArray[$j]."</h2>";
           echo "<a href='player.php?playlist=$parent&subcategory=$titleArray[$j]'><button class='btSubcategory' onclick='sendToPlay(\"".$titleArray[$j]."\");'>Deschide</button></a>";
           echo "<span  onclick='confirmDeleteModule(\"".$titleArray[$j]."\")' id='btn_delete_playlist' title='Delete this playlist'><i class='far fa-trash-alt'></i></span>";
         echo "</div>";
         /* End Subcategory Area */
       }
     $j++;
 }




echo "</div>";//End wrapperSubcategory

?>
