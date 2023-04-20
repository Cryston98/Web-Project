<?php


echo '<form  enctype="multipart/form-data" onsubmit="return validateForm()" class="insert_wrap1" action="../function/newModul.php" method="post">
				<div id="alig-inl">
					  <input type="text" onchange="validateForm()" name="titleModul" title="You must enter a title!" id="titlePLS" autocomplete="off" value="" placeholder="Enter title ..." required />

					   <div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Image
						<ul class="dropdown-menu">

						  <li onclick="changeImageModeSelect(1)"><a href="#">Url link</a><i class="fas fa-link"></i></li>
						  <li onclick="changeImageModeSelect(2)"><a href="#">Upload Image </a><i class="fas fa-upload"></i></li>
						  <li onclick="changeImageModeSelect(3)"><a href="#">From my archive</a><i class="fas fa-archive"></i></li>
						</ul>
					  </div>
			   </div>
					  <br>';

						include '../include/arhiveForm.php';

				echo	'<div id="wrap-upload-newPlaylist">
						     <div id="btnUploadImgPlaylist" onclick="UploadClick()">UPLOAD IMAGE !</div>
						     <label for="PhotoUP">
							  <input type="file" hidden accept="image/*" name="PhotoUP" id="PhotoUP" onchange="validation(1);"/>
							</label>

							<table id="TablePhotoUP">
							  <tr>
								<th>Image</th>
								<th>Name</th>
								<th>Size</th>
								<th>Height</th>
								<th>Wight</th>
								<th>Status</th>
							  </tr>
							  <tr>
								<td><div id="AreaUploadPhoto"><img id="ig" src=""/></div></td>
								<td><p id="NamePhotoUP"></p></td>
								<td><p id="SizePhotoUP"></p></td>
								<td><p id="HeightPhotoUP"></p></td>
								<td><p id="WidthPhotoUP"></p></td>
								<td><p id="StatusPhotoUP"></p></td>
							  </tr>
							</table>
						</div>
						<div id="wrap-url-newPlaylist">
						     <input onchange="testDimensionImageURL()" type="url" name="imageModulURL" id="imageModulURL" autocomplete="off" value="" placeholder="URL Image.Only PNG & JPG" pattern="https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)(.jpg|.png|.gif)" />
								 <input style="visibility: hidden;height: 0px;margin: 0px;padding: 0px;border: 0px;" name="refresPHP" id="refresPHP" type="text">

							 </div>

					  <br>
					  <img src="" style="visibility: hidden;margin:0px;padding:0px;display:none;" id="LoadImgToURL" />

					  <input style="visibility: hidden;height: 0px;margin: 0px;padding: 0px;border: 0px;" name="typeModul" id="typeModul" type="text" value="'.$VarTypeModul.'">
					  <input style="visibility: hidden;height: 0px;margin: 0px;padding: 0px;border: 0px;" name="parentModul" id="parentModul" type="text" value="'.$parent.'">
					  <input style="visibility: hidden;height: 0px;margin: 0px;padding: 0px;border: 0px;" name="imageModul" id="imageModul" type="text" value="">
					  <input  type="submit" name="subitNewModul" id="subitNewModul" value="Create Playlist ! " />

			  </form>';

      ?>
