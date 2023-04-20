<?php

$ExternPath="../";
$RootPath="../index.php";
$PagePath="";


include $ExternPath.'include/header.php';
include $ExternPath.'include/db_connect.php';

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



mysqli_select_db($connect,'spiderlink');
$SQL="SELECT * FROM db_tab_link WHERE CATEGORY='$child' AND USER='$user' ORDER BY ID";
$result=mysqli_query($connect,$SQL);


$countOfResults=0;
$countOfFinishResult=0;
$arrayTypeLink = array();
$arrayTypeTxt = array();
$arrayNameLink = array();
$arrayPathLink = array();
$arraySubjectLink = array();
$arrayIDLink = array();
$arrayFinishLink=array();;

//  DETERMINATION ELEMENT FROM DB
    if (mysqli_num_rows($result)> 0)
     {
        while($row = mysqli_fetch_assoc($result))
             {
                 if($row['TYPE']=='youtube'){
                      $arrayTypeLink[$countOfResults]='<i class="ico-item fab fa-youtube"></i>';
                      $arrayTypeTxt[$countOfResults]='Youtube';
                  }else if($row['TYPE']=='images'){
                        $arrayTypeLink[$countOfResults]='<i class="ico-item fas fa-images"></i>';
                        $arrayTypeTxt[$countOfResults]='Images';
                  }else if($row['TYPE']=='pdf'){
                          $arrayTypeLink[$countOfResults]= '<i class="ico-item fas fa-file-pdf"></i>';
                          $arrayTypeTxt[$countOfResults]='pdf';
                  }else {
                        $arrayTypeLink[$countOfResults]= '<i class="ico-item fas fa-link"></i>';
                        $arrayTypeTxt[$countOfResults]='link';
                  }
				   if($row['FINISH']==1)
					   $countOfFinishResult++;

			 	        $arrayIDLink[$countOfResults]=$row['ID'];
				        $arrayFinishLink[$countOfResults]=$row['FINISH'];
                $arrayPathLink[$countOfResults] = $row['URL'];
                $arrayNameLink[$countOfResults]=$row['TITLE'];
                $arraySubjectLink[$countOfResults]=$row['SUBJECT'];
                $countOfResults++;
           }
        }
  #interogate db for category sort module
  $SQLs="SELECT * FROM db_tab_sort_link WHERE CATEGORY='$child' AND USER='$user' ORDER BY PRIORITY";
  $res=mysqli_query($connect,$SQLs);
  $countOfCategoryModuleResult=0;
  //  DETERMINATION ELEMENT FROM DB
  if (mysqli_num_rows($res)> 0)
  {
      while($row = mysqli_fetch_assoc($res))
      {
  			 	$arraySortModule[$countOfCategoryModuleResult]=$row['NUME'];
          $countOfCategoryModuleResult++;
      }
  }

  #create array with subject link and sort link in player
/*
 $moduleCategorySub=array();
  $cntArray=0;
 for ($i=0; $i <$countOfResults ; $i++)
 {
   $valid=1;
   if (empty($moduleCategorySub)) {
      $moduleCategorySub[$cntArray]=$arraySubjectLink[$i];
      $cntArray++;
   }else{
        for ($j=0; $j <$cntArray ; $j++)
         if ($moduleCategorySub[$j]==$arraySubjectLink[$i]) {
           $valid=0;
        }
      if ($valid) {
        $moduleCategorySub[$cntArray]=$arraySubjectLink[$i];
        $cntArray++;
      }
   }
 }
 */
 $countOfFinishResultForEachSubject=array();
 $countOfResultForEachSubject=array();

 for ($i=0; $i <$countOfCategoryModuleResult ; $i++) {
   $k=0;
   $t=0;
   for ($j=0; $j <$countOfResults ; $j++) {
       if ($arraySubjectLink[$j]==$arraySortModule[$i]) {
         $k++;
       }
       if ($arrayFinishLink[$j]==1 && $arraySubjectLink[$j]==$arraySortModule[$i]) {
         $t++;
       }
   }
   $countOfResultForEachSubject[$i]=$k;
   $countOfFinishResultForEachSubject[$i]=$t;
 }

?>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="//d2qrdklrsxowl2.cloudfront.net/js/hapyak-iframe.js"></script>
<script>
    function addModulSort(){

    }

    function openFullscreen(){
        var elem = document.getElementById("playerFrame");
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
          } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
          }
      }
    function openPopUpFrame(whatPop){
       url = document.getElementById("playerFrame").src;
       if (whatPop=="addLesson") {
          document.getElementById('TitlePopUpFrame').innerHTML="Enter Information For New url !";
          document.getElementById('PopUp_AddNewLesson').style.display="block";
          document.getElementById('PopUp_AddNewNote').style.display="none";
          document.getElementById('PopUp_ViewLesson').style.display="none";
          document.getElementById('PopUp_ViewNote').style.display="none";
          document.getElementById('PopUp_AddSortLink').style.display="none";
          document.getElementById('PopUpFrame').style.height="470px";
       }else if (whatPop=="addNote") {
          document.getElementById('TitlePopUpFrame').innerHTML="ENTER NOTE FOR THIS MEDIA";
          document.getElementById('PopUp_AddNewLesson').style.display="none";
          document.getElementById('PopUp_AddNewNote').style.display="block";
          document.getElementById('PopUp_ViewLesson').style.display="none";
          document.getElementById('PopUp_ViewNote').style.display="none";
          document.getElementById('PopUp_AddSortLink').style.display="none"
          document.getElementById('PopUpFrame').style.height="290px";
       }else if (whatPop=="viewNote") {
           document.getElementById('PopUp_ViewNote').style.display="block";
           document.getElementById('PopUp_AddNewLesson').style.display="none";
           document.getElementById('PopUp_AddNewNote').style.display="none";
           document.getElementById('PopUp_ViewLesson').style.display="none";
           document.getElementById('PopUp_AddSortLink').style.display="none"
           document.getElementById('PopUp_ViewNote').style.height="250px";
           document.getElementById('TitlePopUpFrame').innerHTML="View all note ";
           document.getElementById('PopUpFrame').style.height="350px";
       }else if (whatPop=="playCenter") {
         document.getElementById('TitlePopUpFrame').innerHTML="View media";
         document.getElementById("playerViewCenter").src=url;
         document.getElementById('PopUp_AddNewLesson').style.display="none";
         document.getElementById('PopUp_AddNewNote').style.display="none";
         document.getElementById('PopUp_ViewLesson').style.display="block";
         document.getElementById('PopUp_AddSortLink').style.display="none"
           document.getElementById('PopUp_ViewNote').style.display="none";
         document.getElementById('PopUpFrame').style.height="620px";
         document.getElementById('PopUpFrame').style.top="5%";
         document.getElementById('PopUpFrame').style.width="60%";
         document.getElementById('PopUpFrame').style.left="calc(50% - 30%);";

       }else if(whatPop=="addSort"){
         document.getElementById('TitlePopUpFrame').innerHTML="Enter Information Sort Module !";
         document.getElementById('PopUp_AddNewLesson').style.display="none";
         document.getElementById('PopUp_AddNewNote').style.display="none";
         document.getElementById('PopUp_ViewLesson').style.display="none";
         document.getElementById('PopUp_ViewNote').style.display="none";
         document.getElementById('PopUp_AddSortLink').style.display="block";
         document.getElementById('PopUpFrame').style.height="200px";
         document.getElementById('PopUpFrame').style.width="40%";
         document.getElementById('PopUpFrame').style.left="calc(50% - 20%);";
       }

       document.getElementById("playerViewCenter").src=url; //dublicat linie
       document.getElementById("playerFrame").src="";
       document.getElementById('shadowPopUp').style.display="block";
       document.getElementById('PopUpFrame').style.display="block";
    }
    function closePopUpFrame(){
        document.getElementById('PopUpFrame').style.top="20%";
        document.getElementById('PopUpFrame').style.width="50%";
        document.getElementById('PopUpFrame').style.left="calc(50% - 25%);";

        document.getElementById('shadowPopUp').style.display="none";
        document.getElementById('PopUpFrame').style.display="none";
        document.getElementById("playerFrame").src=document.getElementById("playerViewCenter").src;
        document.getElementById("playerViewCenter").src="";
    }
    function search(){
          var bool =document.getElementById('dropdown_content').style.display;
          if (bool=='block')
          {
            document.getElementById('dropdown_content').style.display="none";
            document.getElementById('section_dropdown').style.background="transparent";
            document.getElementById('dropdown_btn').style.borderBottom="0px solid";
          }else{
            document.getElementById('section_dropdown').style.background="white";
            document.getElementById('dropdown_btn').style.borderBottom="1px solid gray";
            document.getElementById('dropdown_content').style.display='block';
            var input = document.getElementById('search_content');
            input.focus();
            input.select();
          }
      }

      function showModulContent(id){
          var bool =document.getElementById('course_list_body'+id).style.display;
          if (bool=='block')
          {
            document.getElementById('course_list_body'+id).style.display="none";
          }else{
            document.getElementById('course_list_body'+id).style.display='block';
          }
      }

    function play_fc(url,idLink){
       var elem= document.getElementById('playerFrame');
       elem.setAttribute('src', url);
       document.getElementById('LinkPlayerURL').value=url;
       document.getElementById('IdLinkToUncomplete').value=idLink;
       document.getElementById('IdLinkToComplete').value=idLink;

       document.cookie = "LinkPlay="+url;

       var idS = document.getElementById('section_confirm');
       btn = idS.getElementsByTagName("button");
        for (i = 0; i < btn.length; i++)
          btn[i].style.display="block";
    }

      function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
      }

      function updateImage(){
          $('#NoteArea').load('../function/showListNote.php?link='+getCookie('LinkPlay'), function(){
            setTimeout(updateImage, 3000);
          });
        };

    function searchList() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("search_content");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myULsearch");
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


</script>
<style>
    body{
      margin: 0px;
      padding: 0px;
    }
    *{
          box-sizing: inherit;
    }
    #shadowPopUp{
      position: fixed;
      z-index: 1;
      height: 100%;
      width: 100%;
      opacity: 0.95;
      background: #000;
      display: none;
    }
    #PopUpFrame{

      background: rgba(255, 255, 255, 0.9);
      display: none;
      height: 470px;
      position: fixed;
      top: 20%;
      width: 50%;
      z-index: 10000;
      left: calc(50% - 25%);
      transition: .25s ease-in;
      box-shadow: 1px 1px 10px 1px rgba(0,0,0,.35);
    }
    #PopUpFrame h3{
        width: 93%;
        margin: 30px auto 5px;
        text-align: center;
        color: #06ca06;
        text-transform: uppercase;
        letter-spacing: 4px;
    }
    #ClosePopUpFrame{
          position: absolute;
          right: 10px;
          top:10px;
    }
    #ClosePopUpFrame:hover{
      font-size: 20px;
      cursor: pointer;
    }
    #PopUp_ViewNote li {
        display: flex;
    }
    #PopUp_ViewNote{
      overflow-y: auto;
    }
    #PopUp_ViewNote h4,#PopUp_ViewNote i{
      margin: 5px;
      line-height: 15px;
    }

    #PopUp_AddNewLesson,#PopUp_AddNewNote,#PopUp_ViewLesson,#PopUp_ViewNote,#PopUp_AddSortLink{
      top: 10px;
      position: relative;
      width: 93%;
      margin: 0px auto;
    }
    #PopUp_ViewLesson iframe{
       height: 520px;
        width: 100%;
        border: 0px;
    }
    #PopUp_AddNewLesson label,#PopUp_AddNewNote label,#PopUp_AddSortLink label{
      color: #0d0c63;
      font-weight: bold;
    }


    #PopUp_AddNewLesson #submitPopUpNewLink,#PopUp_AddNewNote #submitNote,#PopUp_AddSortLink #submitSort{
      width: 100px;
      position: absolute;
      right: 0px;
      background: #dd1700;
      color: white;
      bottom:-55px;
      border: 1px solid black;
      cursor: pointer;
    }
    #PopUp_AddNewNote textarea{
        min-height: 130px;
        max-width: 700px;
        margin: 10px auto;
        display: block;
        line-height: 20px;
        width: calc(100% - 12px);
        padding-left: 10px;
        font-weight: bold;
        font-size: 12px;
        border-radius: 4px 0px 4px 0px;
        color: #777777;
        outline: none;
        border: 1px solid gray;
        border-top: 2px solid #11c637;
    }
    #PopUp_AddNewLesson input,#PopUp_AddNewLesson select,#PopUp_AddNewNote input,#PopUp_AddSortLink input{
       margin-bottom: 15px;
        margin-top: 5px;
        width: calc(100% - 12px);
        padding-left: 10px;
        font-weight: bold;
        font-size: 12px;
        height: 30px;
        line-height: 30px;
        border-radius: 4px 0px 4px 0px;
        color: #777777;
        outline: none;
        border: 1px solid gray;
        border-top: 2px solid #11c637;
    }

    #course_player{
      display: flex;
      position: relative;
      flex-wrap: nowrap;
      width: 100%;
      overflow: hidden;
      background-color: #F2F3F5;
      color: #36394D;
      height: 100vh;
      margin: 0px;
    }
    #course_left{
      position: relative;
      width: 26rem;
      background-color: #F2F3F5;
      display: flex;
      flex-direction: column;
      height: 100%;
      overflow-y: auto;
    }

    #course_left::-webkit-scrollbar {
        width: 0.7em;
    }

    #course_left::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }

    #course_left::-webkit-scrollbar-thumb {
      background-color: darkgrey;
      outline: 1px solid slategrey;
    }


    #course_progress_container{
      padding-top: 1rem;
    }
    #course_progress{
        width: 23rem;
        transition: .25s ease-in;
        margin: 0 auto;
        background: white;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.35);
    }
    #course_title{
        display: block;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background-color: #434343;
        text-align: center;
        font-size: 20px;
        padding: 15px;
        color: white;
    }
    #course_control {
        padding: 10px 10px 0px 10px;
    }
    #course_progress_status {
        padding: 0px 10px;
        padding-bottom: 10px;
    }
    #course_progress_status h3{
      font-size: 25px;
      margin: 15px 0px 0px;
    }
    #course_progress_status hr{
      height: 4px;
      border-radius: 5px;
      background: #434343;
    }
    #course_progress_status p {
            margin: 3px 0px;
    color: #68bd45;
    font-size: 16px;
    font-weight: bold;
    }
    #section_dropdown{
      width: 23rem;
      transition: .25s ease-in;
      margin: 0 auto;
      border: 1px solid gray;
      margin-top: 15px;
      background: transparent;
      border-radius: 4px;
    }
    #dropdown_btn{
      display: flex;
      justify-content: space-between;
      padding: 3px;
      cursor: pointer;
    }
    #dropdown_btn:hover{
      background: white;
    }
    #dropdown_btn span{
        margin: 0px;
        height: 28px;
        line-height: 28px;
        margin-left: 10px;
        color: #36394D;
        display: block;
        overflow-x: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-size: 17px;
    }
    #dropdown_btn i {
        height: 28px;
        line-height: 28px;
        margin-right: 10px;
    }
    #course_content{
      display: flex;
      position: relative;
      flex: 1 1 0;
      padding: 1rem 1rem 1rem 1rem;
      transition: padding .2s ease-in-out;
      background-color: white;
      margin: 20px;
      box-shadow: 0 4px 10px 2px rgba(0,0,0,.16)
    }
    #dropdown_searchPlayer {
        background: white;
        position: relative;
        height: 30px;
        line-height: 30px;
        margin: 10px;
        border-radius: 3px;
        border: 1px solid gray;
    }
    #dropdown_content{
      display:none;
    }
    #search_content::-webkit-search-cancel-button{
        position:relative;
        right:7px;
        font-size:15px;
        border-radius:10px;
    	cursor:pointer;

    }




    #dropdown_list::-webkit-scrollbar {
        width: 0.7em;
    }

    #dropdown_list::-webkit-scrollbar-thumb {
        background-color: darkgrey;
        outline: 1px solid slategrey;
    }
    #dropdown_list::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }



    #dropdown_searchPlayer input{
      position: absolute;
      left: 35px;
      box-sizing: border-box;
      height: 30px;
      border: 0px;
      line-height: 30px;
        font-size: 13px;
        padding-right: 10px;
        font-weight: bold;

      outline: none;
      width: calc(100% - 35px);
    }
  #dropdown_searchPlayer i {
    position: absolute;
    left: 0;
    border: 0px;
    border-right: 1px solid;
    background: white;
    margin: 0px 20px 0px 5px;
    height: 30px;
    width: 30px;
    line-height: 30px;
  }
    #dropdown_list{
      margin: 10px;
      height: 300px;
      overflow: auto;
        padding-right: 10px;
    }
    #course_list_content {
        transition: .25s ease-in;
        width: 23em;
        margin: 10px auto;

    }

    #course_control a{
        text-decoration: none;
        color: black;
    }
    #course_list_head{
      height: 45px;
      font-size: 17px;
      display: flex;
      cursor:pointer;
      justify-content: space-between;
    }
    #course_list_body0 , #course_list_body1,  #course_list_body2,  #course_list_body3,  #course_list_body4,  #course_list_body5,  #course_list_body6,  #course_list_body7  #course_list_body8  #course_list_body9,  #course_list_body10{
    	display:none;
    }
    #right_item{
      display: flex;
      justify-content: space-around;
      width: 70px;
    }
    #course_list_head h3{
      margin: 0px;
      font-size: 20px;
      font-weight: bold;
    }
    .list_item_course{
      display: flex;
      position: relative;
      flex-wrap: nowrap;
      width: calc(100% - 10px);
      overflow: hidden;
      color: #36394D;
      padding: 10px 5px;
      cursor: pointer;
          border-bottom: 1px dashed green;
    }
    .list_item_course:hover{
      background: white;
    }
    .left_item_icon{
      position: relative;
      width: 37px;
    }
    .icon_item {
        left: 10px;
        position: absolute;
        top: 20px;
        width: 4px;
        background: #434343;
        height: 60%;
    }
    .left_item_icon i{
        position:relative;
        left: 5px;
    }
    .right_item_wrap {
      display: flex;
      position: relative;
      flex: 1 1 0;
    }
    .right_item_content h3 {
        margin: 0px 0px 5px;
        color: #434343;
        font-size: 16px;
    }
    #course_content_wrap{
      display: block;
    }
    #course_frame{
       margin: 30px auto 0px;
        /*width: 1025px;
        height: 572px;*/
        width: 890px;
        height: 500px;
        border: 1px solid;
      }
      #course_tool{
        margin: 0px 0px 10px 0px;
        width: 100%;
        height: 40px;
        background: #434343;
        line-height: 40px;
        border-bottom: 1px solid;
        top: 0px;
        position: absolute;
        left: 0;
      }
      #course_tool i{
        color: #00ea27;
        font-size: 20px;
        line-height: 40px;
        width: 30px;
        text-align: center;
        margin-left: 15px;
        cursor: pointer;
      }
      #course_tool i:hover{
        color: white;
      }
      #course_frame{
          border-radius: 4px;
      }
    #course_frame iframe{
        width: 100%;
        height: 100%;
        border: 1px solid gray;
        border-radius: 4px;
    }
    #section_confirm{
      height: 40px;
      width: 100%;
      margin: 40px auto;
      text-align: center;
    }
    button#unconfirm,button#confirmView {
        background: #fafafa;
        border: 1px solid gray;
        color: black;
        border-radius: 4px;
        height: 30px;
        padding: 0px 30px;
    	margin:5px;
    }
    #section_confirm form {
        width: 175px;
        display: inline-grid;
        margin: 0px auto;
    }
    .finishlinkclass{
    	background:#d8dad8;
    }
    ul#myULsearch{
        margin: 10px 0px;
        padding: 0px;
    	    list-style-type: none;
    }
    .searchContentList{
    	margin:10px 0px;
    	cursor:pointer;
    }
    #myULsearch li {
          border-bottom: 1px solid #ddd;
        margin-top: -1px;
        padding: 7px;
        text-decoration: none;
        font-size: 13px;
        color: #da4040;
        display: block;
        font-weight: bold;
    }
    #myULsearch li:hover {
        font-size: 15px;
        color: green;
    }

    #section_confirm button{
    	display:none;
    }
</style>


<div id='course_player'>
   <div id='course_left'>

      <!--Start Dashboard-->
      <div id='course_progress_container'>
      <div id='course_progress'>
         <div id='course_title'><?php echo $parent ?></div>
         <div id='course_control'><a href='../page/subcategory.php?playlist=<?php echo $parent;?>'> <i class="fas fa-arrow-circle-left"></i> Panou de Control</a></div>
         <div id='course_progress_status'>
           <h3><?php echo $child ?></h3>
           <hr align="left" style='width:<?php  if($countOfFinishResult!=0) echo intval($countOfFinishResult/$countOfResults*100); else echo "0"; echo "%;"; ?>'>
           <p><span id='course_progress_value'><?php if($countOfFinishResult!=0) echo intval($countOfFinishResult/$countOfResults*100); else echo 0; echo "%"; ?></span>   terminat</p>
         </div>
      </div>
    </div>
        <!--End Dashboard-->

    <!--Start DropDown Content-->
        <div id='section_dropdown'>
               <div id='dropdown_btn' onclick="search()">
                  <span>Cauta dupa titlu</span>
                  <i class="fas fa-angle-down"></i>
               </div>
               <div id='dropdown_content'>
                    <div id='dropdown_searchPlayer'>
                        <input type="search" onkeyup="searchList()" id='search_content' name='search_content' autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />

                        <i class="fas fa-search"></i>
                    </div>
                    <div id='dropdown_list'>

				  <ul id="myULsearch" >
					<?php
						for ($i=0; $i < $countOfResults; $i++)
							{
								echo  "<li class='searchContentList' onclick='play_fc(\"".$arrayPathLink[$i]."\",".$arrayIDLink[$i]."),search()'>".$arrayNameLink[$i]."</li>";
							}
					?>
					</ul>
                 </div>
               </div>
        </div>
      <!--End DropDown Content-->

      <!--
      for ($i=0; $i <$cntArray ; $i++) {
        echo $moduleCategorySub[$i];
      }
    -->

       <!--Start Content List-->
     <?php
       for ($j=0; $j <$countOfCategoryModuleResult ; $j++) {
         $cntLink=0;
        echo "<div id='course_list_content'>
                 <div onclick='showModulContent($j);' id='course_list_head'>
                  <h3>";
                        if ($countOfFinishResultForEachSubject[$j]==$countOfResultForEachSubject[$j]) {
                          echo "<i style='color:green;' class='fas fa-check-circle'></i>  ";
                        }else {
                          echo "<i style='color:red;' class='far fa-circle'></i>  ";
                        }
                  echo "$arraySortModule[$j]</h3>
                  <div id='right_item'>
                    <span><span id='no_finish_lesson'> $countOfFinishResultForEachSubject[$j]</span> / <span id='no_lesson'>$countOfResultForEachSubject[$j]</span></span>
                    <i class='fas fa-angle-down'></i>
                  </div>
                </div>
                <hr style='margin:0px;'>
                <div id='course_list_body$j'>";

                   for ($i=0; $i < $countOfResults; $i++)
      		         	{

                      if ($arraySubjectLink[$i]==$arraySortModule[$j]){
                        $cntLink++;
                					if($arrayFinishLink[$i]==1){
                						echo "<li class='list_item_course ' onclick='play_fc(\"".$arrayPathLink[$i]."\",".$arrayIDLink[$i].");'>
                						      <div class='left_item_icon'>
                								<i style='color:green;' class='fas fa-check-circle'></i>
                								<div class='icon_item'></div>
                							</div>";#add class 'finishlinkclass' to <li> tag
                					}else{
                						echo  "<li class='list_item_course' onclick='play_fc(\"".$arrayPathLink[$i]."\",".$arrayIDLink[$i].");'>
                						       <div class='left_item_icon'>
                								 <i style='color:red;' class='far fa-circle'></i>
                								<div class='icon_item'></div>
                							</div>";
                					}

                        echo "<div class='right_item_wrap'>
                                <div class='right_item_content'>
                                  <h3>$arrayNameLink[$i]</h3>
                                  <div id='typeContent'>$arrayTypeLink[$i]";

                                  if($arrayFinishLink[$i]==1){
                                      echo "<span style='color:green;'>Finished </span>";
                                  }else{
                                    echo "<span style='color:red;'>Unfinished </span>";
                                  }



                              echo "</div>
                                </div>
                                <span style='position:absolute;right:5px;bottom:0px'>";
                                    echo ($cntLink)."/".$countOfResultForEachSubject[$j];
                                  echo "</span>
                            </div>
                        </li>";
                    }
                  }

              echo "</div>
              </div>";
            }
        ?>
      <!--End Content List-->


   </div>

<!--START POP <section-->
<div id='shadowPopUp'></div>
  <div id="PopUpFrame">
    <span id="ClosePopUpFrame" onclick="closePopUpFrame();" title="Exit"><i class="far fa-window-close"></i></span>
        <h3 id='TitlePopUpFrame'>Enter Information For New URL! </h3>
        <hr>
        <div id="PopUp_AddNewLesson">
          <form action='../function/insertScript.php' method="post">
                <label for="titleNewLesson">Title
                  <input type="text" id="titleNewLesson" name="titleNewLesson" placeholder="Enter title ..." required autocomplete="off" maxlength="100"/>
                </label>

                <label for="urlNewLesson">Url
                  <input  onchange="getTime();" type="text" id="urlNewLesson" name="urlNewLesson" placeholder="http://" required autocomplete="off" maxlength="300"/>
                </label>


                <label for="typeURLNewLesson">Type URL
                    <select name="typeURLNewLesson" id="typeURLNewLesson">
                      <option value="youtube">Link Youtube</option>
                      <option value="pdf">Link PDF</option>
                      <option value="video">Link Video</option>
                      <option value="images">Link Imagine</option>
                      <option value="article">Link Articol</option>
                    </select>
                  </label>
                  <?php if ($countOfCategoryModuleResult==0) { ?>
                    <label for="subjectNewLesson">Subject
                      <input type="text" id="subjectNewLesson" name="subjectNewLesson" placeholder="Ex:Relaxing,Dance,Music..." required autocomplete="off" maxlength="100"/>
                    </label>
                  <?php } else{
                  echo '<label for="subjectNewLesson">Type URL
                        <select name="subjectNewLesson" id="subjectNewLesson">';
                        for ($i=0; $i<$countOfCategoryModuleResult;$i++){
                          echo '<option value="'.$arraySortModule[$i].'">'.$arraySortModule[$i].'</option>';
                        }
                        echo '</select>
                      </label>';
                  }?>



                  <input type="text" style="height:0px;visibility:hidden;margin:0px" id="playlist" name="playlist" value="<?php echo $child; ?>"/>
				  <input type="text" style="height:0px;visibility:hidden;margin:0px" id="locationPageNew" name="locationPageNew" value="<?php echo $CurentPath; ?>"/>

                  <input type="submit" name="submitPopUpNewLink" id="submitPopUpNewLink" value="Save ! "/><!--submit_value-->
              </form>

        </div>
        <div id="PopUp_AddNewNote">
          <form action='../function/createNewNote.php' method="post">
            <input type="hidden" id="LinkPlayerURL" name="LinkPlayerURL"/>
            <input type="hidden" id="LocationCall" name="LocationCall" />
            <textarea type="text" id="noteText" name="noteText" placeholder="Enter your note to save!" required autocomplete="off" ></textarea>
            <input type="submit" name="submitNote" id="submitNote" value="Save Note"/>
          </form>
        </div>
        <div id="PopUp_ViewLesson">
          <iframe id='playerViewCenter' frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"  allowfullscreen src=""></iframe>
        </div>
        <div id="PopUp_ViewNote">
          <div id="NoteArea">';
            <script>updateImage();</script>
          </div>
        </div>
        <div id="PopUp_AddSortLink">
          <form action='../function/createModulSortLink.php' method="post">
            <input type="hidden" id="idCategoryLink" name="idCategoryLink" value="<?php echo $child;?>"/>
            <input type="hidden" id="priorityCategory" name="priorityCategory" value="<?php echo $countOfCategoryModuleResult;?>"/>
            <input type="hidden" id="user" name="user" />
            <label for="nameSort">Name Module
            <input type="text" id="nameSort" name="nameSort" placeholder="Enter name module to sort ..."/>
            </label>
            <input type="text" style="height:0px;visibility:hidden;margin:0px" id="locationPageNew" name="locationPageNew" value="<?php echo $CurentPath; ?>"/>

            <input type="submit" name="submitSort" id="submitSort" value="Save Sort"/>
          </form>
        </div>
  </div>
<!--END POP section>-->

   <!--Start Main Section-->
   <div id='course_content'>
     <div id="course_content_wrap">
          <div id='course_tool'>
              <a href='../index.php'><i class="fas fa-home" title="Home"></i></a>
              <i class="fas fa-comment-medical" onclick="openPopUpFrame('addNote')" title="Add new note!"></i>
              <i class="far fa-lightbulb" onclick="openPopUpFrame('playCenter')" title="Turn off light"></i>
              <i class="far fa-plus-square" onclick="openPopUpFrame('addLesson')" title="Add new lesson"></i>
              <i class="fas fa-sign-out-alt" title="Open in new page"></i>
              <i class="far fa-eye" onclick="openPopUpFrame('viewNote')" title="View all note"></i>
              <i class="fas fa-compress" onclick="openFullscreen();"title="View full scren"></i>
              <i class="fas fa-folder-plus" onclick="openPopUpFrame('addSort')" title="Add modul"></i>
              <a href="#?accesID=Cryston"><i type="submit"  class="fas fa-share-alt" title="Share Modul"></i></a>
          </div>
          <div id='course_frame'>
              <iframe id="playerFrame" src="<?php if(!empty($arrayPathLink[0])) echo $arrayPathLink[0];?>" allow="autoplay; encrypted-media" allowfullscreen="" ></iframe>
          </div>
          <div id='section_confirm'>

			<form action='../function/unfinishLink.php' method='post'>
			     <input type="hidden" id="IdLinkToUncomplete" name="IdLinkToUncomplete" />
			     <input type="hidden" id="LocationPath1" name="LocationPath1" value="<?php echo $CurentPath;?>"/>
				  <button id='unconfirm'>Marcaj incomplet</button>
			</form>

			<form action='../function/finishLink.php?' method='post'>
				<input type="hidden" id="IdLinkToComplete" name="IdLinkToComplete" value="none"/>
				<input type="hidden" id="LocationPath2" name="LocationPath2" value="<?php echo $CurentPath;?>"/>
				<button id='confirmView'>Continua</button>
			</form>
          </div>
     </div>
   </div>
   <!--End Main Section-->
</div>
