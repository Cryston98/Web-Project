<?php

  $curentMonthNumber=date('n'); //Numarul luni din an

  $day=date('j');
  $year=date('Y');
  $month_text= ['Ianuari','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'];

 if (isset($_GET['month'])){
    if($_GET['month']<=12){
          $monthChange=$_GET['month'];
    }else {
            $monthChange=1;
    }
 }
 else{
    $monthChange=$curentMonthNumber;
 }


//echo $monthChange."-change<br>".$curentMonthNumber."-curent<br>";



$month=date('l',mktime(0,0,0,$monthChange,1,$year)); //Prima zi din luna

switch ($month) {
  case 'Monday':
        $firstDayOfMonth=1;
        break;
  case 'Tuesday':
        $firstDayOfMonth=2;
        break;
  case 'Wednesday':
        $firstDayOfMonth=3;
        break;
  case 'Thursday':
        $firstDayOfMonth=4;
        break;
  case 'Friday':
        $firstDayOfMonth=5;
        break;
  case 'Saturday':
        $firstDayOfMonth=6;
        break;
  case 'Sunday':
        $firstDayOfMonth=7;
        break;
}

$daysOf_Month=date('t',mktime(0,0,0,$monthChange,25,$year));
$daysOf_Month_old=date('t',mktime(0,0,0,$monthChange-1,25,$year));

//echo "First".$firstDayOfMonth."<br>";
//echo "Count days of month: ".$daysOf_Month."<br>";
//echo "Count days of month old: ".$daysOf_Month_old;




?>



<div id="wrap-calendar">

  <div class="month">
    <ul>
      <a href="calendarPage.php?month=<?php if ($monthChange==12) {echo 1;} elseif($monthChange<$curentMonthNumber){echo $monthChange+1;}else{echo $monthChange+1;}?>"
         class="prev">&#10094;</a>
      <a href="calendarPage.php?month=<?php if ($monthChange==1) {echo 12;} elseif($monthChange<$curentMonthNumber){echo $monthChange-1;}else{echo $monthChange-1;}?>" class="next">&#10095;</a>


    <li id="ctm">
      <?php echo $month_text[$monthChange-1]; ?><br>
      <span style="font-size:18px"><?php echo $year; ?></span>
    </li>
  </ul>
</div>

<ul class="weekdays">
  <li>Lun</li>
  <li>Mar</li>
  <li>Mie</li>
  <li>Joi</li>
  <li>Vin</li>
  <li>Sam</li>
  <li>Dum</li>
</ul>

<ul class="days">
<?php


 if ($firstDayOfMonth==1) {
  $i=1;
  while($i<=$daysOf_Month)
  {

    if($i==$day && $curentMonthNumber==$monthChange)
    {
       echo '<li onclick="addNewTaskCalendar('.$year.','.$monthChange.','.$i.')"><span class="active">'.$i.'</span></li>';
    }
    else {
      echo '<li onclick="addNewTaskCalendar('.$year.','.$monthChange.','.$i.')">'.$i.'</li>';
    }
    $i++;
  }
}else{
  for ($j=$daysOf_Month_old-$firstDayOfMonth+1;$j<$daysOf_Month_old; $j++) {
     echo '<li onclick="addNewTaskCalendar('.$year.','.$monthChange.','.$j.')" ><span class="old_day">'.$j.'</span><div id="wrap-notyDate'.$j.'" class="wrap-notyDate"><div class="triangle-down"></div></div></li>';
  }
  $i=1;
  while($i<=$daysOf_Month)
  {
    if($i==$day  && $curentMonthNumber==$monthChange)
    {
       echo '<li onclick="addNewTaskCalendar('.$year.','.$monthChange.','.$i.')"><span class="active">'.$i.'</span></li>';
    }
    else {
      echo '<li onclick="addNewTaskCalendar('.$year.','.$monthChange.','.$i.')">'.$i.'</li>';
    }
    $i++;
  }

}
?>
</ul>


</div>
