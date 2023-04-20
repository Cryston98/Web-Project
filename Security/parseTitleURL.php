
<?php
echo "
<style>
#titleDiv{
border: 1px solid #000;
    height: 35px;
    padding: 5px;
    font-size: 12px;
    display: inline-table;
    margin: 5px;
	}

h2{
	margin:0px;
}

#player{
		float: right;
    width: 500px;
    margin: 50px;
    height: 350px;
    border-radius: 4px;
    border: 1px solid #000;
	}

</style>
<script type='javascript'>

function play(url){
	document.getElementById('player').src = url;
}

</script>
";
$start=286200000;


function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}
$toStart=0;
$toEnd=100;
$timm=0;
function getVideo($toStart, $toEnd)
{	
		$handle=fopen('dataLinkStore5.ini','a+');
		for($i=$toStart;$i<$toEnd;$i++)
		{
			$url="https://player.vimeo.com/video/".$i ;	
			if(get_http_response_code($url) != "200"){
			}else{
				$page = file_get_contents($url);
				$title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $matches) ? $matches[1] : null;
				
				$data_scraped="Title : ".htmlentities($title)." -- URL : ".$url .PHP_EOL;
				
				 fwrite($handle,$data_scraped);
				 $timm=$i;
				/*echo "<div id='titleDiv'>".htmlentities($title)."
						<h2>Url:<a href='".$url."'>".$url."</a></h2>
						</div><br>";
				*/
			}
			
		}
			echo "<h1 style='color:green;'>Success</h1>";
		 fclose($handle);
		
}
 echo "Scaning: ".$timm;
 echo "<iframe id='player' src='http://faceboook.com'></iframe>";
 
 
 echo "<form action='' method='post'>
		<input type='text' placeholder='Start From : ' name='Start'/>
		<input type='text' placeholder='To End :' name='Ending'>
		<input id='submit1' name='submit1' type='submit'>
		</form>";
		
		
 getVideo(286288674,286300000);
 
 
 /*if(isset($_POST['submit1']))
 {  
     	getVideo($_POST['Start'], $_POST['Ending']); 
		
		//Memorize history
		$fil=fopen('history.cfg','a+');
		$data_history="ID START: ".$_POST['Start']." -- ID STOP : ".$_POST['Ending'].PHP_EOL;
		fwrite($fil,$data_history);
		fclose($fil);
		
		$myfile = fopen("history.cfg", "r") or die("Unable to open file!");
		echo fread($myfile,filesize("history.cfg"));
		fclose($myfile);
		
 }
 */

?>