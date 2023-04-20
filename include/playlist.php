<script>
function searchListPlaylist() {
    document.getElementById('section_search_playlist').style.display='block';
    document.getElementById('controlModulSection').style.display='none';
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("search_namePlaylist");
    var InputValue = document.getElementById('search_namePlaylist').value;
    if (InputValue.length == 0){
          document.getElementById('section_search_playlist').style.display='none';
    }
    filter = input.value.toUpperCase();
    ul = document.getElementById("myULPlaylistSearch");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        txtValue = li[i].textContent || li[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function openControlSection(){
  var valueStyle= document.getElementById('controlModulSection').style.display;
  if (valueStyle=="none"){
      var valueStyle= document.getElementById('controlModulSection').style.display="block";
  }else{
      var valueStyle= document.getElementById('controlModulSection').style.display="none";
  }
}

function clearSearch(){
  document.getElementById('section_search_playlist').style.display='none';
    document.getElementById('search_namePlaylist').value='';
}

function closeSearchPlaylist(){
	document.getElementById('section_search_playlist').style.width='0px';
	document.getElementById('SearchPlaylistCloseButton').style.display='none';

}


</script>
<?php
  $VarTypeModul="modul";
  $parent="";
  $rr=0;
  include $ExternPath.'include/db_connect.php';


   mysqli_select_db($connect,'spiderlink');
   $SQL="SELECT * FROM db_tab_playlist WHERE USER='$user'";
   $result=mysqli_query($connect,$SQL);
   $countOfResults=0;
   $arrayNamePlayList = array();
   $arrayImagePlayList = array();

//  DETERMINATION ELEMENT FROM DB
    if (mysqli_num_rows($result)> 0)
     {
       $rr=mysqli_num_rows($result);
        while($row = mysqli_fetch_assoc($result))
             {
				        $arrayNamePlayList[$countOfResults]=$row['TITLE'];
                $arrayImagePlayList[$countOfResults]=$row['IMAGE'];
                $countOfResults++;
           }
        }

  echo "
  <div id='playlistSection_btn'>

  <i onclick='openControlSection()' class='controlModul fas fa-bars'></i>
  <div id='controlModulSection'>
      <p >Lista de categori </p>
  </div>


  <i class='notifyMod far fa-bell'><div id='circleNotify'>3</div></i>
  <i title='Create new modul' class='addMods trigger_popup_fricc far fa-plus-square'></i>
  <!--Start Search Content-->

  <div id='dropdown_search'>
      <input type='text' placeholder='Enter keys word' onkeyup='searchListPlaylist()' id='search_namePlaylist' name='search_namePlaylist' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' />
          <i class='IcoSearch fas fa-search'></i>
          <i onclick='clearSearch() ' class='closeSearch far fa-times-circle'></i>

      <div id='section_search_playlist'>
          <div id='list_playlist_search'>
            <ul id='myULPlaylistSearch'>";

              for ($i=0; $i < $countOfResults; $i++)
                {
                  echo  "<a href='subcategory.php?playlist=".$arrayNamePlayList[$i]."'><li type='1' class='searchContentList' onclick='showPlaylist(),clear()'>".$arrayNamePlayList[$i]."</li></a>";
                }

        echo "</ul>
        </div>
      </div>
    </div>
    <!--End Search Content-->


    </div>";
#Add new module popup
echo "<div class='hover_bkgr_fricc'>
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
           <h3>Confirm Delete Modul</h3>
           <div class='closeBtnConfirmDeleteModule'>X</div>
         </div>";
         include "confirmDeleteModulForm.php";
 echo "</div>
     </div>";


	echo "<div id='scrollwrapper'>";

   //mysqli_select_db($connect,'spiderlink');
   //$SQL="SELECT * FROM db_tab_playlist WHERE USER='$user'";
   //$result = mysqli_query($connect, $SQL);
   //if($result){
      if($countOfResults > 0)
      {
            //echo "List:".$rr."-".mysqli_num_rows($result);
            //  $counterOfPlaylist=mysqli_num_rows($result);
              $i=0;$j=0;
              $playlistOnLine=5;
              $counter=0;
              while($counter<$countOfResults) //$row = mysqli_fetch_array($result)
              {
                    if ($i==0||$i==$playlistOnLine*$j)
                    {
                        echo "<div class='wrap-playlist'>";
                        $j++;
                    }
                    echo "<div class='item-playlist'>
                            <a href='subcategory.php?playlist=".$arrayNamePlayList[$counter]."'>
                                <img src='".$arrayImagePlayList[$counter]."'/>
                                <h3>".$arrayNamePlayList[$counter]."</h3>
                            </a>
							              <span onclick='confirmDeleteModule(\"".$arrayNamePlayList[$counter]."\")' id='btn_delete_playlist' title='Delete this playlist'><i class='far fa-trash-alt'></i></span>
							              <span id='btn_edit_playlist' title='Edit this playlist'><i class='far fa-edit'></i></span>
                          </div>";
                    if ($i==$playlistOnLine*$j-1) {
                      echo "</div>";
                    }
                $i++;
                $counter++;
              }
    		    if ($countOfResults<$playlistOnLine){
    				   echo "</div>";
    			  }
            mysqli_free_result($result);
        } else{
              echo "<h3 style='margin:10px'>No records matching your query were found.</h3>";
        }

    /*}else{
        echo "ERROR: Could not able to execute $SQL. " . mysqli_error($connect);
    }*/
    echo "</div>";
  // Close connection
  mysqli_close($connect);









?>
