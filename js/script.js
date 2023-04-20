$(document).ready(function() {
  $("#closebtn").click(function(){
    $('#left-sidebar').css('width', '70px');
    $('#container').css('margin-left', '70px');
    $('#container').css('width', 'calc(100% - 70px)');
    $('#closebtn').css('display', 'none');
    $('#openbtn').css('display', 'block');
    $('#logo-platform').css('margin', '3px');
    $('#logo-platform').css('height', '20px');
    $('#logo-platform').css('width', '60px');
    $('#logo-platform').css('margin-top', '40px');
    $('a.item-nav').css('height', '44px');
    $('a.item-nav').css('margin-top', '5px');
    $('a.item-nav').css('text-align', 'center');
    $('a.item-nav').css('line-height', '20px');
    $('#user-details').css('padding', '5px');
    $('#user-images').css('left', '0px');
    $('#user-images').css('top', '20px');
    $('#user-images').css('width', '60px');
    $('#user-images').css('position', 'relative');
    $('#user-account').css('display', 'none');
    $('#user-email').css('display', 'none');
    //$('fieldset#newPlaylist').css('width', 'calc(100% - 90px)');
    //$('.wrap-playlist').css('width', 'calc(100% - 90px)');
  });
  $("#openbtn").click(function(){
    $('#left-sidebar').css('width', '250px');
    $('#container').css('margin-left', '250px');
    $('#container').css('width', 'calc(100% - 250px)');
    $('#closebtn').css('display', 'block');
    $('#openbtn').css('display', 'none');

    $('#logo-platform').css('margin', '15px');
    $('#logo-platform').css('height', '60px');
    $('#logo-platform').css('width', '215px');
    $('#logo-platform').css('margin-top', '30px');

    $('a.item-nav').css('height', '40px');
    $('a.item-nav').css('margin-top', '0px');
    $('a.item-nav').css('text-align', 'left');
    $('a.item-nav').css('line-height', '40px');
    $('#user-details').css('padding', '15px');
    $('#user-images').css('left', 'calc(50% - 30px)');
    $('#user-images').css('position', 'absolute');
    $('#user-images').css('top', '-10px');
    $('#user-images').css('width', '100px');
    $('#user-account').css('display', 'block');
    $('#user-email').css('display', 'block');
    //$('fieldset#newPlaylist').css('width', 'calc(100% - 0px)');
    //$('.wrap-playlist').css('width', 'calc(100% - 90px)');
  });
  $("#CloseNotificationPop").click(function(){
      $('#PopUpNotification').css('display', 'none');
  });

  $(".closeBtnConfirmDeleteModule").click(function(){
      $('#formConfirmDeleteModule').css('display', 'none');
  });

  /*Popup Jyuiry*/
  $(".trigger_popup_fricc").click(function(){
     $('.hover_bkgr_fricc').show();
  });
  $(".deletePopupConfirm").click(function(){
     $('.formDeleteConfirm').show();
  });
  $('.popupCloseButton').click(function(){
      $('.hover_bkgr_fricc').hide();
      $('.formDeleteConfirm').hide();
  });
  /*end popup*/

  /*New inser link from view page*/
  $("#newLinkInsertID").click(function(){
     $('.hover_bkgr_fricc1').show();
  });
  $('.popupCloseButton1').click(function(){
      $('.hover_bkgr_fricc1').hide();
  });
});
function play_fc(url,title){
 var elem= document.getElementById('player');
 document.getElementById('FullBTN').setAttribute('style', 'display:block;');
 document.getElementById('newNoteBTN').setAttribute('style', 'display:block;');

 elem.setAttribute('style', 'display:block;');
 elem.setAttribute('src', url);

 document.getElementById('TitlePlayerURL').innerHTML=title;
 document.getElementById('LinkPlayerURL').value=url;

 document.cookie = "LinkPlay="+url;
}
function createNewNote(){
 var elem= document.getElementById('Area_AddNewNote');
 if (elem.style.display == "none") {
   elem.setAttribute('style', 'display:block;');
 }else {
   elem.setAttribute('style', 'display:none;');
 }
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
function openNewTab(){
    var url=document.getElementById('player').src;
    window.open(url, '_blank');
}
function validateForm(){
  var type=getCookie('TypeModulImage');
  if(type=="upload")
  {
	   var result=document.getElementById('StatusPhotoUP').innerHTML;
	   if(result=="OK"){
		   document.getElementById('subitNewModul').style.display="block";
	   }else{
		   document.getElementById('subitNewModul').style.display="none";
	   }
  }
   else if(type=="arhive")
  {
	   var img=document.getElementById('imageModul').src;
	   var tit=document.getElementById('imageModul').src;

	   if(img!=""){
		   document.getElementById('subitNewModul').style.display="block";
	   }else{
		   document.getElementById('subitNewModul').style.display="none";
	   }
  }

  /*Test valid create PlayList*/

  /*var title = document.getElementById('titlePLS').value;
  var back=document.getElementById('backgroundImg').value;
  if (title== "") {
   alert("Error! Title is empty. ");
   return false;
 }else if (back== "") {
   alert("Error! You must select an image.");
   return false;
  }else{
    return true;
  }
  */
}
function addNewTaskCalendar(year,month,day){

  var monthEvent =  month;
  var yearEvent =  year;
  var dayEvent =  day;
    document.getElementById('monthEvent').value=monthEvent;
    document.getElementById('dayEvent').value=dayEvent;
    document.getElementById('yearEvent').value=yearEvent;
    document.getElementById('parallelogram').innerHTML='Add new event to : ' + dayEvent+'/'+monthEvent+'/'+yearEvent;

    document.getElementById('popupNewCalendarItem').style.width=500+"px";
    document.getElementById('popupNewCalendarItem').style.height=350+"px";
    document.getElementById('btnClosePopUpTask').style.display="block";
    document.getElementById('shadowPopUp').style.display="block";
    document.getElementById('popupNewCalendarItem').style.visibility="visible";
    document.getElementById('popupNewCalendarItem').style.opacity=1;
}
function closePopUpTaskSubcategory(){
    document.getElementById('subcategoryPopup').style.display='none';
}
function UploadClick() {
  document.getElementById("PhotoUP").click(); // Click on the checkbox
}
function closePopUpTask(){
    document.getElementById('btnClosePopUpTask').style.display="none";
    document.getElementById('popupNewCalendarItem').style.width=0+"px";
    document.getElementById('popupNewCalendarItem').style.height=0+"px";
    document.getElementById('popupNewCalendarItem').style.visibility="hidden";
    document.getElementById('popupNewCalendarItem').style.opacity=0;
      document.getElementById('shadowPopUp').style.display="none";
}
/*sigupFunc*/
function sigupFunc(number){
  if (number==1) {
    document.getElementById('log-input').style.display="none";
    document.getElementById('register-input').style.display="block";
  }else if (number==2) {
    document.getElementById('log-input').style.display="block";
    document.getElementById('register-input').style.display="none";
  }
}
/*Function select image in module from arhive to create modules/submodules */
function sendToCreate(src,elem){
    document.getElementById('imageModul').value=src;
    var arr = document.getElementsByClassName("selectBackground");
    var id="bgnp";
    var ok="ok_ic";
    document.getElementById(id+elem).style.opacity="1";
    document.getElementById(id+elem).style.filter="brightness(100%)";
    document.getElementById(ok+elem).style.opacity="1";

    for (var i = 1; i <=arr.length; i++) {
      if (elem!=i) {
        id=id+i;
        ok=ok+i;
        document.getElementById(ok).style.opacity="0";
        document.getElementById(id).style.filter="brightness(50%)";
        document.getElementById(id).style.opacity="0.7";
        id="bgnp";
        ok="ok_ic";
      }
   }//alert(arr.length);
  }
function newSubcategoryPopup(srrc){
     document.getElementById('subcategoryPopup').style.display="block";
     //document.getElementById('shadowPopUp').style.display="block";
}
function validation(x){
      var elem=document.getElementById('PhotoUP').files[0];
      var parents = document.getElementById('AreaUploadPhoto');
      var rm = document.getElementById('ig');
      var imag = document.createElement('img');

      var atrr = document.createAttribute('class');
      atrr.value="imgt";
      imag.setAttributeNode(atrr);

      var atrr = document.createAttribute('id');
      atrr.value="ig";
      imag.setAttributeNode(atrr);

        var atrr = document.createAttribute('onload');
        atrr.value="shower(x)";
        imag.setAttributeNode(atrr);



      imag.src=window.URL.createObjectURL(elem);
      parents.removeChild(rm);
      parents.appendChild(imag);
      document.getElementById('SizePhotoUP').innerHTML=(elem.size/1024).toFixed(1)+'KB';

    return false;
  }

  function openSubcategory(Id){
    var visib=document.getElementById(Id).style.display;
      if (visib=='block') {
        document.getElementById(Id).style.display='none';
      }else{
        document.getElementById(Id).style.display='block';
      }
}
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function changeImageModeSelect(type){
	if(type==1){
		 document.getElementById("wrap-back-newPlaylist").style.display='none';
		 document.getElementById("wrap-upload-newPlaylist").style.display='none';
		 document.getElementById("wrap-url-newPlaylist").style.display='block';
		 setCookie('TypeModulImage','URL',7) //in 7 zile expira cookie
	}
	else if(type==2)
	{
		 document.getElementById("wrap-back-newPlaylist").style.display='none';
		 document.getElementById("wrap-upload-newPlaylist").style.display='block';
		 document.getElementById("wrap-url-newPlaylist").style.display='none';
		 setCookie('TypeModulImage','upload',7) //in 7 zile expira cookie
	}else if(type==3){
		 document.getElementById("wrap-back-newPlaylist").style.display='block';
		 document.getElementById("wrap-upload-newPlaylist").style.display='none';
		 document.getElementById("wrap-url-newPlaylist").style.display='none';
		 setCookie('TypeModulImage','arhive',7) //in 7 zile expira cookie
	}


}
function shower(x){//x=playlist or subplaylist
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

	/*if(x==1)
     oktoSendDB('btnUploadImgPlaylist');
	else if(x==2)
	 oktoSendDB('btnSaveNewSubcategory');
	 */
    document.getElementsByClassName('imgt')[0].style.height=55+'px';
    document.getElementsByClassName('imgt')[0].style.width=100+'px';
    document.getElementsByClassName('imgt')[0].style.borderRadius="4px";
    document.getElementById('TablePhotoUP').style.display="block";
    validateForm();
}
function checkURL(url) {
    return (url.match(/\.(jpeg|jpg|gif|png)$/) != null);
} //verif url is image
function testDimensionImageURL(){
   var url = document.getElementById('imageModulURL').value;
   document.getElementById('refresPHP').value="<?php include '../function/checkSizeImageURL.php';?>";
   setCookie('URLImageModul',url,1); // 1 day
   if (getCookie('validURL')=="OK" && checkURL(url)){
     document.getElementById('subitNewModul').style.display="block";
   }else{
     document.getElementById('subitNewModul').style.display="none";
   }
}

function confirmDeleteModule(modul){
    document.getElementById('formConfirmDeleteModule').style.display="block";
    document.getElementById('toDelete').value=modul;
    document.getElementById('titleToDeleteModule').innerHTML=modul;
}


/* function oktoSendDB(who){
    var result=document.getElementById('StatusPhotoUP').innerHTML;
    if (result=='OK'){
      document.getElementById(who).style.display="block";
    }else{
      document.getElementById(who).style.display="none";
    }
} */

/*circle*/
// change the value below from 80 to whichever percentage you want
perCirc($('#sellPerCirc'), 80);

function perCirc($el, end, i) {
	if (end < 0)
		end = 0;
	else if (end > 100)
		end = 100;
	if (typeof i === 'undefined')
		i = 0;
	var curr = (100 * i) / 360;
	$el.find(".perCircStat").html(Math.round(curr) + "%");
	if (i <= 180) {
		$el.css('background-image', 'linear-gradient(' + (90 + i) + 'deg, transparent 50%, #ccc 50%),linear-gradient(90deg, #ccc 50%, transparent 50%)');
	} else {
		$el.css('background-image', 'linear-gradient(' + (i - 90) + 'deg, transparent 50%, #00cc00 50%),linear-gradient(90deg, #ccc 50%, transparent 50%)');
	}
	if (curr < end) {
		setTimeout(function () {
			perCirc($el, end, ++i);
		}, 1);
	}
}

function saveDiaryText() {
  var x = result=document.getElementById('originalSourceDiary').innerHTML;
  document.getElementById('contentDiaryPage').value=x;
  return true;
}

function showDiaryPage(str){
  alert(str);
}
