<?php 

$timeExecution=0;

function someThing($i){
	if($i%1000==0)
		echo "<br>\n";
	echo "<i>".$i." </i<";
}

for($i=0;$i<10000;$i++)
{
	someThing($i);
	$timeExecution++;
}

echo "<b>Time:".$timeExecution."</b>"; #I want to update and display var $timeExecution every time when this is modified in function 
?>