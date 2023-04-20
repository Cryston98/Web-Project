<?php
if ($day<10) {
  $dayList='0'.$day;
}

if ($curentMonthNumber<10) {
  $monthList='0'.$curentMonthNumber;
}

$dataEvent =$year.'-'.$monthList.'-'.$dayList;

echo "<div id='wrapperToDoListCalendar'>

<div id='titleToDoListCalendar'>List With Task For ".$dayList.'/'.$monthList.'/'.$year." </div>";
include '../function/showListEvent.php';




echo "
  <div id='ControlEvent'>
      <span class='btnEventListNext' id='nextEvent'>Next</span>
      <span class='btnEventListPrev' id='prevEvent'>Prev</span>
      <span class='btnEventList' id='finishEvent'>Finalize!</span>

  </div>
</div>";

?>
