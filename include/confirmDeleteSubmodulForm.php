<?php

echo '<form class="confirmDeleteModulForm" action="../function/deleteSubmodul.php" method="get">
			   <p>You are sure you want to delete the <span id="titleToDeleteModule" style="color:red;font-widht:bold;"></span> module?</p>
				 <input style="visibility: hidden;height: 0px;margin: 0px;padding: 0px;border: 0px;" name="toDelete" id="toDelete" type="text"/>
         <input type="submit" id="confirmDeleteModule" name="confirmDeleteForm" value="Confirm!">
      </form>';
?>
