<?php
$day=0;
$curentMonthNumber=0;

echo "<div id='wrappOptionCalendar'>
    <button onclick='addNewTaskCalendar()'>New Task</button>
    </div>";


echo "


<div id='popupNewCalendarItem'>
          <div id='btnClosePopUpTask' onclick='closePopUpTask()'>X</div>

          <form action='../function/addEvent.php' method='post'>
          <div class='parallelogram' id='parallelogram'></div>
              <input id='monthEvent' name='monthEvent' type='text' hidden />
              <input id='dayEvent' name='dayEvent' type='text' hidden />
              <input id='yearEvent' name='yearEvent' type='text' hidden />

             <input id='titleEvent' name='titleEvent' type='text' placeholder='Enter Task/Event Title' required/>
             <textarea  rows='8' style='margin: 5px;width: 100%;' id='contentEvent' name='contentEvent' type='text' placeholder='Enter Task/Event Description' required></textarea>

             <input id='submitEvent' name='submitEvent' type='submit' value='Save This !'/>

          </form>

</div>";
?>
