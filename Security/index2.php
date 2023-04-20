
<link rel='icon' href='favicon.png' type='image/x-icon'/>
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/>
<link rel = 'stylesheet' type = 'text/css' href = 'css/theme.css' />
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type='javascript'>
	function play(url){
		document.getElementById('player').src = url;
	}

  function updateImage(){
      $('#textProg').load('loadFile.php', function(){
        setTimeout(updateImage, 1000);
      });
    };

</script>

<?php


if(isset($_POST['submit1']))
 {
	if(isset($_POST['toStartInput']) && isset($_POST['toEndInput']) && isset($_POST['nameFile']))
	{
			getVideo($_POST['toStartInput'],$_POST['toEndInput'],$_POST['nameFile']);
	}
 }

function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}


function getVideo($start,$end,$nameFile)
{
	$word=array();
	$word[0]="daniela";
	$word[1]="Daniela";
	$word[2]="Nica";
	$word[3]="Mindfullness";
	$word[4]="meditatie";
	$word[5]="Meditatie";
	$word[6]="mindfullness";
	$len=7;
		$handle=fopen('Storage/'.$nameFile.'.ini','a+');
		$url="https://player.vimeo.com/video/".$start;
		echo get_http_response_code($url);
		
		if(get_http_response_code($url) == "200")
		{
			$page = file_get_contents($url);
			$title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $matches) ? $matches[1] : null;
			
					
			for($i=0;$i<$len;$i++)
			if (strpos(htmlentities($title), $word[$i]) !== false) 
			{
				$data_scraped="Title : ".htmlentities($title)." -- URL : ".$url .PHP_EOL;
				fwrite($handle,$data_scraped);
				break;
			}else{
				fwrite($handle,"no".PHP_EOL);
			}
		}
		getVideo($start+1,$end,$nameFile);
}




/*
Salut!Am o variabila php ,care vreau sa o utilizez pe post de contor sa vad cat la suta dintr-un loop /functie-aceast functie are un timp de raspuns lung, s-a executat .Aceasta variablia este afisata in pagin.
Problema este ca variabila nu se actualizeaza decat dupa ce ciclul sau functia  s-a incheieat .Cum pot sa actualizez variabila in timp ce functia se executa sau sunt in ciclul?

 */








 /*------------------*/

 echo "<div id='wrapper-menu'>
		<div id='control-menu' >
		<form method='post'>
			<button onclick='updateImage()' name='submit1' type='submit' id='bt1'>Start</button>


			<div id='error' src='error.png'><h3 id='error_val'></h3></div>
			<div id='progress-bar1'>

					<input id='toStartInput' name='toStartInput' type='text' placeholder='Enter start number' required/>
					<input id='toEndInput' name='toEndInput' type='text' placeholder='Enter start number' required/>
					<input id='nameFile' name='nameFile' type='text' placeholder='Enter Name file' required/>

				</form>
			</div>
			<div id='progress-bar2'><div id='barProg'><hr id='statusProg'></div><span id='textProg'></span></div>
		</div>
		</div>";

echo "<div id='wrapper-history'></div>";

 echo "<div id='wrapper-file'>

			<form id='newSubscriber' action='saveEmail.php' method='POST'>
				<input type='email' name='EMAIL' id='EMAIL' placeholder='Enter email ... ' required/>

				<button id='btnsendEmail' type='submit' >Upload</button>
				<select name='SUBJECT'  id='SUBJECT'>
                  <option selected value='Dezvoltare Personala'>Dezvoltare Personala</option>
				  <option value='Web Development'> Web Development</option>
                </select>

				<select name='COME_TO'  id='COME_TO'>
                  <option selected value='Daniela Nica'>Daniela Nica</option>
				  <option value='Grup Facebook'> Grup Facebook</option>
                </select>
			</form>

			<div id='LinkListID'>".$allText."</div>
		</div>";




?>

</body>
</html>
