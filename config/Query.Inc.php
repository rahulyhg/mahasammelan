<?php
session_start();


require_once('filenames.php');

class Query {

	function limit_text($text, $length) {
	   $length = abs((int)$length);
	   if(strlen($text) > $length) {
		  $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	   }
	   return($text);
	}


	function compress_image($source_url, $destination_url, $quality) { 

		$info = getimagesize($source_url); 

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source_url); 

		elseif ($info['mime'] == 'image/gif')

			$image = imagecreatefromgif($source_url); 

		elseif ($info['mime'] == 'image/png') 

			 $image = imagecreatefrompng($source_url); 

			 imagejpeg($image, $destination_url, $quality); 

			 return $destination_url; 

	} 





	function Redirect($Med){

	    return header("location:$Med");

	}

	

	// Function for slug

	function create_url_slug($string){

		

	   $string = strtolower($string);

	   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);

	   return $slug;

	}





	// Function for encryption

	function encrypt($data) {

		return base64_encode(base64_encode(base64_encode(strrev($data))));

	}



	// Function for decryption

	function decrypt($data) {

		return strrev(base64_decode(base64_decode(base64_decode($data))));

	}



	function httpGet($url){

		$ch = curl_init();  

		curl_setopt($ch,CURLOPT_URL,$url);

		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

		$output=curl_exec($ch);

		curl_close($ch);

		return $output;

	}



	function httpPost($url,$params){

	  $postData = '';

	   //create name value pairs seperated by &

	   foreach($params as $k => $v) 

	   { 

		  $postData .= $k . '='.$v.'&'; 

	   }

	   rtrim($postData, '&');

	 

		$ch = curl_init();  

	 

		curl_setopt($ch,CURLOPT_URL,$url);

		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

		curl_setopt($ch,CURLOPT_HEADER, false); 

		curl_setopt($ch, CURLOPT_POST, count($postData));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

	 

		$output=curl_exec($ch);

	 

		curl_close($ch);

		return $output;

	 

	}



	function httpPut($url,$params){

	  $postData = '';

	   //create name value pairs seperated by &

	   foreach($params as $k => $v) 

	   { 

		  $postData .= $k . '='.$v.'&'; 

	   }

	   rtrim($postData, '&');

	 

		$ch = curl_init();  

	 

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

		curl_setopt($ch,CURLOPT_URL,$url);

		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

		curl_setopt($ch,CURLOPT_HEADER, false); 

		curl_setopt($ch, CURLOPT_POST, count($postData));

			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

	 

		$output=curl_exec($ch);

	 

		curl_close($ch);

		return $output;

	 

	}





		



	function httpDelete($path){

	

		$url = $path;

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

		$result = curl_exec($ch);

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

	

		return $result;

	}



	// function for send push notification start here

	function send_notification($api_key, $registatoin_ids, $message, $extra_keys) {

        // Set POST variables

        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(

            'registration_ids' => $registatoin_ids,

            'data' => $message,

        );



        $headers = array(

            'Authorization: key='. $api_key,

            'Content-Type: application/json'

        );

		

        // Open connection

        $ch = curl_init();



        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post

        $result = curl_exec($ch);

        if ($result === FALSE) {

            die('Curl failed: ' . curl_error($ch));

        }

        curl_close($ch);

       return $result;

    }

	// function for send push notification end here

	

	

	function resize($source_image, $temp_name, $img_ext, $width, $height, $folder_path, $unique_id){

		/* Get original image x y*/

		list($w, $h) = getimagesize($temp_name);

		/* calculate new image size with ratio */

		$ratio = max($width/$w, $height/$h);

		$h = ceil($height / $ratio);

		$x = ($w - $width / $ratio) / 2;

		$w = ceil($width / $ratio);

		/* new file name */

		$path = $folder_path.$width.'x'.$height.'_'.$unique_id.$source_image;

		/* read binary data from image file */

		$imgString = file_get_contents($temp_name);

		/* create image from string */

		$image = imagecreatefromstring($imgString);

		$tmp = imagecreatetruecolor($width, $height);

		imagecopyresampled($tmp, $image,

		0, 0,

		$x, 0,

		$width, $height,

		$w, $h);

		/* Save image */

		switch ($img_ext) {

			case 'image/jpeg':

				imagejpeg($tmp, $path, 100);

				break;

			case 'image/png':

				imagepng($tmp, $path, 0);

				break;

			case 'image/gif':

				imagegif($tmp, $path);

				break;

			default:

				exit;

				break;

		}

		return $path;

		/* cleanup memory */

		imagedestroy($image);

		imagedestroy($tmp);

	}

	

	

	function Upload_Single_Image($FileName,$DestPath,$Product_Id)

	{

	

		$allowedExts = array("gif", "jpeg", "jpg", "png");

		

		if(!empty($FileName))

		{	

				$temp = explode(".", $FileName['name']);

				$extension = end($temp);

				if ((($FileName["type"] == "image/gif")

				|| ($FileName["type"] == "image/jpeg")

				|| ($FileName["type"] == "image/jpg")

				|| ($FileName["type"] == "image/pjpeg")

				|| ($FileName["type"] == "image/x-png")

				|| ($FileName["type"] == "image/png"))

				&& in_array($extension, $allowedExts))

				{

					  move_uploaded_file($FileName["tmp_name"],$DestPath .$Product_Id."-".$FileName["name"]);

	

				}

			

			

		}

		

	}



	function Upload_Image($FileName,$DestPath,$RandomNo)

	{

	

		$allowedExts = array("gif", "jpeg", "jpg", "png");

		

		if(!empty($FileName))

		{	

			

			for($i=0;$i<count($FileName); $i++)

			{



				$temp = explode(".", $FileName['name'][$i]);

				$extension = end($temp);

				if ((($FileName["type"][$i] == "image/gif")

				|| ($FileName["type"][$i] == "image/jpeg")

				|| ($FileName["type"][$i] == "image/jpg")

				|| ($FileName["type"][$i] == "image/pjpeg")

				|| ($FileName["type"][$i] == "image/x-png")

				|| ($FileName["type"][$i] == "image/png"))

				&& in_array($extension, $allowedExts))

				{

					  move_uploaded_file($FileName["tmp_name"][$i],$DestPath .$RandomNo."-".$FileName["name"][$i]);

	

				}

			

			}

		}

		

	}

	

	







	

	/* Validation Function */

	function CheckBlank($Message, $Value)

	{

		if(empty($Value))

			return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; " . $Message . " required...<br />";

	}



	function CheckPassLength($Message, $Value)

	{

		if(strlen($Value)<8 && strlen($Value)!="")

			return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; " . $Message . " should contain atleast 8 character......<br />";

	}

	

	function CheckPassCPass($Pass,$CPass)

	{

		if($CPass != $Pass && !empty($CPass))

			return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226;&nbsp;Password does not match...<br>";

	}







	function ShowError($Message)

	{

		if(!empty($Message))

			return '<div class="alert alert-danger display-hide" style="display:block"><button class="close" data-close="alert"></button><span>'.$Message.'</span></div>'; 

	}

	

	

	/* Validation Function */

	

	

/* Start Substring Function for Description */

	function Current_Page($title)

	{

	

		$pagename = basename($_SERVER['REQUEST_URI']);

		if($pagename == ADMINMANAGECATEGORY || $pagename == ADMINADDCATEGORY){

			$cur ='Category';	

		}elseif($pagename == ADMINMANAGEPRODUCT || $pagename == ADMINADDPRODUCT){

			$cur ='course';	

		}elseif($pagename == 'manage_pages.php'){

			$cur ='page';

		}elseif($pagename == 'manage_achievment.php' || $pagename == 'add_achievment.php'){

			$cur ='achievment';

		}else{

			$cur ='setting';

		}

	

		if($cur == $title){

			return 'current';

		}else{

			return false;

		}

	

		

	}



	function SmallDesc($String, $Size)

	{

		$DescritionArray = explode(" ", $String);

		$Description = " ";

		if(count($DescritionArray) > $Size)

		{		

			for($i=0;$i<$Size;$i++)

			{

				$Description = $Description . " " . $DescritionArray[$i];		

			}

			

			$Description = trim($Description) . " ...";

		}

		else

		{

			$Description = $String;

		}

		return $Description;

	}

	

	function SmallCharDesc($String, $Size)

	{

		$Description = substr($String, 1, $Size);

		return $Description . " ...";

	}

/* End Substring Function for Description */



/*-- Start , function to fetch the master table values by ids and vice versa --*/

	

	//Get Master Value by MasterId And Master table name

    function MasterById($Id,$TableName,$FieldName)

	{    

		//echo $Id.",".$TableName;exit;

		$Result = $this->Select_Dynamic_Query($TableName,array($FieldName),array('Id'),array('='),array($Id)) ;

		return $Result[0][$FieldName] ;

	}

	function MasterByIdget($Id,$TableName)

	{    

		$Result = $this->Select_Dynamic_Query($TableName,array('UserName'),array('Id'),array('='),array($Id)) ;

		return $Result[0]['UserName'] ;

	}

	

    //Get Master Id by Master Value And Master table name

    function MasterByField($Value,$TableName,$FieldName)

	{

		$Result = $this->Select_Dynamic_Query($TableName,array('Id'),array($FieldName),array('='),array($Value)) ;

		return $Result[0]['Id'] ;

	}

/*-- End , function to fetch the master table values by ids and vice versa --*/



    //Get Master Id by Master Value And Master table name

    function MasterByName($Value,$TableName)

	{

		$Result = $this->Select_Dynamic_Query($TableName,array('Id'),array('Name'),array('='),array($Value)) ;

		return $Result[0]['Id'] ;

	}

/*-- End , function to fetch the master table values by ids and vice versa --*/



	function MasterByUsername($Value,$TableName)

	{

		$Result = $this->Select_Dynamic_Query($TableName,array('Id'),array('Username'),array('='),array($Value)) ;

		return $Result[0]['Id'] ;

	}



/*-- Start , function to fetch the Parameter values by Parameter Name --*/



    function ParameterByName($TableName,$Name)

	{    

		$Result = $this->Select_Dynamic_Query($TableName,array('Id','Value'),array('Name'),array('='),array($Name)) ;

		return $Result[0]['Value'] ;

	}

	

/*-- End , function to fetch the Parameter values by Parameter Name --*/

	

	

/*-- Start function to get the extention of a file --*/

function GetExtension($str) 

{

	$i = strrpos($str,".");

	if (!$i) { return ""; }

	$l = strlen($str) - $i;

	$ext = substr($str,$i+1,$l);

	return $ext;

}

/*-- End function to get the extention of a file --*/



/* Function to Create Image Thumbnail Starts */

	

	function CreateThumb($source_img,$img_ext,$dest_img,$width=100,$height=100)

	{

		$max_width=$width; //$dest_img_width;

		$max_height=$height; //$dest_img_height;

		$image_path = $source_img ;

		$img_name=$dest_img;

		//echo $image_path; die();

		

		$img_ext = strtolower($img_ext);



        switch ($img_ext) 

        {

            case 'jpg':

                $new_img = imagecreatefromjpeg($source_img);

                break;

            case 'gif':

                $new_img = imagecreatefromgif($source_img);

                break;

            case 'png':

                $new_img = imagecreatefrompng($source_img);

                break;

            default:

                return false;

        }

		

		$width = imagesx($new_img);

	

		$height = imagesy($new_img);

		$scale = min($max_width/$width, $max_height/$height);

		if ($scale < 1) 

		{

			$new_width = floor($scale*$width);

			$new_height = floor($scale*$height);

			# Create a new temporary image

			if($ext == 'gif')

				$tmp_img = imagecreate($new_width, $new_height);

			else

				$tmp_img = imagecreatetruecolor($new_width, $new_height);

			# Copy and resize old image into new image

			imagecopyresized($tmp_img, $new_img, 0, 0, 0, 0,$new_width, $new_height, $width, $height);

			$imnewBig = imagecreate ($new_width*2, $new_height*2);

			imagecopyresized($imnewBig,$new_img,0,0,0,0, $new_width*2, $new_height*2,$width,$height);

			// for images crossing max limit

			if($new_width*3 < $width||$new_height*3 < $height)

			{

				$imnewbig = imagecreate ($new_width*3, $new_height*3);

				imagecopyresized($imnewbig,$new_img,0,0,0,0, $new_width*3, $new_height*3,$width,$height);

				switch ($img_ext)

				{

					case 'jpg':

						@imagejpeg($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

						break;

					case 'gif':

						@imagegif($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

						break;

					case 'png':

						@imagepng($imnewbig,$img_name); //100 is the quality settings, values range from 0-100.

						break;

				}

			}

			else

			{

				switch ($img_ext)

				{

					case 'jpg':

						@imagejpeg($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

						break;

					case 'gif':

						@imagegif($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

						break;

					case 'png':

						@imagepng($imnewbig,$img_name); //100 is the quality settings, values range from 0-100.

						break;

				}

			}

			imagedestroy($new_img);

			$new_img = $tmp_img; 

		}

		switch ($img_ext)

		{

			case 'jpg':

				@imagejpeg($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

				@imagejpeg($new_img,$img_name,100);

				break;

			case 'gif':

				@imagegif($imnewbig,$img_name,100); //100 is the quality settings, values range from 0-100.

				@imagegif($new_img,$img_name,100);

				break;

			case 'png':

				@imagepng($imnewbig,$img_name); //100 is the quality settings, values range from 0-100.

				@imagepng($new_img,$img_name);

				break;

		}

	}

	

/* Function to Create Image Thumbnail Ends */



	

	

	

/*--Start , Function to Create Bredcrum forCategory--*/	



    function BredCrum($Qstring,$Id)

	{

	    $ParentId = $Id ;

		global $BaseUrl ;

		while($ParentId != 0)

		{

			$sql = "select * from `category` where `Id` = '$ParentId'" ; 

			//echo $sql ;

			$result = $this->Select($sql) ;

			$CategoryName[] = $result[0]['Name'] ;  

			$CategoryUrl[] = $result[0]['CategoryUrl'] ;

			$CategoryId[] = $result[0]['Id'] ; 

			$PId[] = $result[0]['ParentId'] ;

			$ParentId = $result[0]['ParentId'] ;

            

		}

		$CountCategoryId = count($CategoryId) ;

		for($i = $CountCategoryId - 1 ; $i >= 0 ; $i--)

		{

		    if($PId[$i] == 0)

			{

				$PageUrl = 'Category.php' ;

			}

			else

			{

				$PageUrl = 'LowCategory.php' ;

			}

		    echo " &raquo; " ;

?>

			

			<a href="<?php echo $BaseUrl ; ?><?php echo $this->GetPathNew($CategoryId[$i]) . $Qstring ; ?>" class="BredCrum"><?php echo $CategoryName[$i] ; ?></a>

			

<?php

		}



	}

	

/*--End , Function to Create Bredcrum forCategory--*/		







/*---- Start fuction to upload an image -----*/

	function ImageUpload($FileArray,$DestPath,$NewName)

	{

		$ImageName = $FileArray['name'] ;

		$SrcPath = $FileArray['tmp_name'] ;

		//echo $SrcPath . "<br>";

		$DotPos = strpos($ImageName,".") ;

		$Ext = substr($ImageName , $DotPos+1) ;

		

		

		$NewImageName = $NewName . "." . $Ext ;

		//echo $NewImageName ;

		

		if(!@move_uploaded_file($SrcPath,$DestPath . $NewImageName))

		{

			die("Your directory '$DestPath' is writable") ;

		}

		else

		{

			echo "error" ;

		}

		return($NewImageName);

	}

/*---- End function to upload an Image ------*/









/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/



	function CreateList($TableName,$ListName,$FieldsToSelect='',$OnChangeEvent='',$LabelField = '',$IsDisable="",$BlankLabel="")

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

			if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }



		$sql = "select * from $TableName ORDER BY `Name`" ;

		$ResultArray = $this->Select($sql) ;

	    $List = "<select name='" . $ListName . "[]' onChange='$OnChangeEvent' multiple='multiple' $Disable>" ;

		if($BlankLabel != "")

		{

			$List .= "<option value=''>$BlankLabel</option>" ;

		}



		for($i=0;$i<count($ResultArray);$i++)

		{

			$List .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if(strstr($FieldsToSelect,$ResultArray[$i]['Id']))

			{ 

				$List .=" Selected" ;

			}

			$List .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		$List .= "</select>" ;

		return $List ;

	}







/*------------- END A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/





/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/

	function CreateCombo($TableName,$ComboName,$FieldToSelect='',$OnChangeEvent='',$LabelField = '',$IsDisable="",$BlankLabel="")

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from $TableName ORDER BY `Name`" ;

		$ResultArray = $this->Select($sql) ;

	    $Combo = "<select name='$ComboName' onChange='$OnChangeEvent' $Disable required>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		

		$Combo .= "</select>" ;

		return $Combo ;

	}



/*------------- END A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/



/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE WITH ORDER BY FIELD ----------------*/

	function CreateOrderCombo($TableName,$ComboName,$FieldToSelect='',$OnChangeEvent='',$LabelField = '',$IsDisable="",$BlankLabel="",$OrderBy)

	{		

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from $TableName ORDER BY `$OrderBy`" ;

		//echo $sql;exit;

		$ResultArray = $this->Select($sql) ;

	    $Combo = "<select name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		

		$Combo .= "</select>" ;

		return $Combo ;

	}



/*------------- END A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE WITH ORDER BY FIELD ----------------*/



/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE WITH STYLE CLASS ----------------*/



	function CreateClassCombo($TableName,$ComboName,$FieldToSelect='',$OnChangeEvent='',$LabelField = '',$IsDisable="",$BlankLabel="",$Class)

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from $TableName ORDER BY `$Label`" ;

		$ResultArray = $this->Select($sql) ;

	    $Combo = "<select class='$Class' id='$ComboName' name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i]['Name'] . "</option>" ;		

		}

		

		$Combo .= "</select>" ;

		return $Combo ;

	}



/*------------- END A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE WITH STYLE CLASS ----------------*/



/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/



	function CreateConditionCombo($TableName,$ComboName,$Condition,$FieldToSelect='',$OnChangeEvent='',$LabelField = '',$IsDisable="",$BlankLabel="")

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from $TableName where $Condition ORDER BY `Name`" ;

		$ResultArray = $this->Select($sql) ;

	    $Combo = "<select name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		

		$Combo .= "</select>" ;

		return $Combo ;

	}

	

	

	

/*------------- START A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/



	function CreateConditionClassCombo($TableName,$ComboName,$Condition,$FieldToSelect='',$OnChangeEvent="",$LabelField = '',$IsDisable="",$BlankLabel="",$Class)

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from `$TableName` " ;

		if($Condition=='')

		{

			$sql .= "ORDER BY `$Label`";

		}

		else

		{

			$sql .= "where $Condition ORDER BY `$Label`";

		}

		$ResultArray = $this->Select($sql) ;

	    $Combo = "<select class='$Class' name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		$Combo .= "</select>" ;

		return $Combo ;

	}

	

	function CreateFullConditionClassCombo($TableName,$ComboName,$Condition,$FieldToSelect='',$OnChangeEvent="",$LabelField = '',$IsDisable="",$BlankLabel="",$Class)

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		

		$sql = "select * from `$TableName` $Condition ORDER BY `$Label`" ;

		$ResultArray = $this->Select($sql) ;

		

	    $Combo = "<select class='$Class' name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i][$Label] . "</option>" ;		

		}

		$Combo .= "</select>" ;

		return $Combo ;

	}



/*------------- END A FUNCTION TO PRINT A LIST BOX FROM THE DATA BASE ----------------*/



/*------------- START A FUNCTION TO PRINT Cobmo box LIST FROM THE DATA BASE ----------------*/



	function CreateConditionClassComboId($TableName,$ComboName,$Condition,$FieldToSelect='',$OnChangeEvent="",$LabelField = '',$IsDisable="",$BlankLabel="",$Class)

	{

		if($LabelField == '') { $Label = 'Name' ; } else { $Label = $LabelField ; }

		if($IsDisable != '') { $Disable = "disabled" ; } else  { $Disable = "" ; }

		

		if($Condition=="")

		{

			$tag="";

		}



		else

		{

			$tag="where";

		}

		$sql = "select * from `$TableName` ".$tag." $Condition ORDER BY `$Label`" ;

		$ResultArray = $this->Select($sql) ;



	    $Combo = "<select class='$Class' name='$ComboName' onChange='$OnChangeEvent' $Disable>" ;

		if($BlankLabel != "")

		{

			$Combo .= "<option value=''>$BlankLabel</option>" ;

		}

		

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<option value='" . $ResultArray[$i]['Id'] . "' " ;

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .=" Selected" ;

			}

			$Combo .= ">" . $ResultArray[$i]['Name'] . "</option>" ;		

		}

		$Combo .= "</select>" ;

		return $Combo ;

	}



/*------------- End A FUNCTION TO PRINT Cobmo box LIST FROM THE DATA BASE ----------------*/



/*------------- START A FUNCTION TO PRINT RADIO BUTTON LIST FROM THE DATA BASE ----------------*/



	function CreateRadio($TableName,$RadioName,$FieldToSelect='')

	{

		if(empty($FieldToSelect))

		{

			$FieldToSelect = "1";

		}

				

		$sql = "select * from `$TableName`" ;

		$ResultArray = $this->Select($sql) ;

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<input name=" . $RadioName . " type='radio' value=" . $ResultArray[$i]['Id'];

			

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .= " checked='checked'";

			}

			$Combo .= " />&nbsp;&nbsp;" .  $ResultArray[$i]['Name']  ;	

		}

		return $Combo ;

	}

	

	

	/*------------- START A FUNCTION TO PRINT RADIO BUTTON LIST FROM THE DATA BASE ----------------*/



	function CreateConditionRadio($TableName,$RadioName,$FieldToSelect='',$Condition)

	{

		if(empty($FieldToSelect))

		{

			$FieldToSelect = "1";

		}

		if($Condition=="")

		{

			$tag="";

		}

		else

		{

			$tag="where".$Condition;

		}		

		$sql = "select * from `$TableName` $tag " ;

		$ResultArray = $this->Select($sql) ;

		for($i=0;$i<count($ResultArray);$i++)

		{

			$Combo .= "<input name=" . $RadioName . " type='radio' value=" . $ResultArray[$i]['Id'];

			

			if($ResultArray[$i]['Id'] == $FieldToSelect)

			{ 

				$Combo .= " checked='checked'";

			}

			$Combo .= " />&nbsp;&nbsp;" .  $ResultArray[$i]['Name'] ."<br><br>" ;	

		}

		return $Combo ;

	}

	



/*------------- END A FUNCTION TO PRINT RADIO BUTTON LIST FROM THE DATA BASE ----------------*/



/*------------------------------------------------------------------------------------

Start function to count the number of row in a query passed as function parameter

-------------------------------------------------------------------------------------*/

	function Count_Row($Sql)

	{

		$result = $this->Select($Sql) ;

		$CountResult = count($result) ;

		return $CountResult;

	}

	

/*------------------------------------------------------------------------------------

Start function to count the number of row in a query passed as function parameter

-------------------------------------------------------------------------------------*/











	

/*-------------------------------------------------------------------------------

Start , Query for Select Record from table

-------------------------------------------------------------------------------*/	

//This Function Has Three Parameters 

//1. The Table Name from which data to be fetched	

//2. SelectFieldArray array of the Values to be fetched if blank then all field are fetched	

//3. WhereFieldArray array of the field name based on them , the Record is fetched 

//4. WhereSignArray Array of the comparision operator sign based on them the Record is fetched

//5. WherevalueArray Array of the Values needed for where clause based on them the Record is fetched

//6. LogicalArray Array of the Logical Operators placed b/w the conditions in Where clause

//7. OrderByFieldArray Array of the field name of the table based on them the record is sorted 

//8. OrderByArray Array has 'asc' or 'desc' for each field based on them the the record is sorted

//9. LimitArray Array has 'two' element 'startposition' and 'pagesize' for limit 

//10. ReturnWhat is the variable that hold two value if ReturnWhat = rr then return whole array 

//and if ReturnWhat == nr then return number of rows in Array record



	function Select_Dynamic_Query($TableName,$SelectFieldArray = "",$WhereFieldArray = "",$WhereSignArray = "",$WherevalueArray = "",$LogicalArray = "",$OrderByFieldArray = "",$OrderByArray = "",$LimitArray = "",$ReturnWhat = "rr")

	{

	    $CountSelectField = count($SelectFieldArray);

	    $CountWhereField = count($WhereFieldArray);

	    $CountWhereSign = count($WhereSignArray);

	    $CountWherevalue = count($WherevalueArray);

		if($LogicalArray != "")

		{

			$CountLogical = count($LogicalArray);    

		}

		else

		{

			$CountLogical = 0 ;

		}

		$CountLimit = count($LimitArray);

		$CountOrderByField = count($OrderByFieldArray);

		$CountOrderBy = count($OrderByArray);	 

	 

/*-------Start , Select and From Clause -------*/

	 	if($SelectFieldArray == "")

		{

			$sql = "Select * from `$TableName`" ;

		}

		else

		{

		    $sql = "Select" ;

		    for($si=0;$si<$CountSelectField;$si++)

			{

			    if($si < $CountSelectField - 1)

				{

					$sql .= " `" . $SelectFieldArray[$si] . "` ," ;

				}

				else

				{

					$sql .= " `" . $SelectFieldArray[$si] ."`" ;

				}

			}

		    $sql .= " from `" . $TableName ."`" ;

		} 

	

/*-------End , Select and From Clause -------*/

		

	

/*-------Start , Where Clause if Where Related Array is not Empty-------*/		

		if(($WhereFieldArray != "") && ($WhereSignArray != "") && ($WherevalueArray != ""))

		{

		    if(($CountWhereField == $CountWhereSign) && ($CountWhereField == $CountWherevalue) && (($CountWhereField - 1) == $CountLogical))

			{ 

			    $sql .= " where" ;

			    for($wi=0;$wi<$CountWhereField;$wi++)

				{

				    if($wi < $CountWhereField - 1)

					{

						$sql .= " `" . $WhereFieldArray[$wi] . "` " . $WhereSignArray[$wi] . " '" . $WherevalueArray[$wi] . "' " . $LogicalArray[$wi] ;	

					}

					else

					{

						$sql .= " `" . $WhereFieldArray[$wi] . "` " . $WhereSignArray[$wi] . " '" . $WherevalueArray[$wi] . "'" ;

					}

				}	

			}

			else

			{

			    die("Error in Where related Array Argument of Select_Dynamic Function on Page") ;

			}

		}

	

/*-------End , Where Clause if Where Related Array is not Empty-------*/





/*-------Start , Limit if OrderByFieldArray and OrderByArray is Not Empty-------*/

		if(($OrderByFieldArray != "") && ($OrderByArray != ""))

		{

		    if($CountOrderByField == $CountOrderBy)

			{

			    $sql .= " order by" ;

			    for($oi=0;$oi<$CountOrderBy;$oi++)

				{

				   if($oi < $CountOrderBy - 1)

				   {

					   $sql .= " `" . $OrderByFieldArray[$oi] . "` " . $OrderByArray[$oi] . "," ;

				   }

				   else

				   {

					   $sql .= " `" . $OrderByFieldArray[$oi] . "` " . $OrderByArray[$oi] ; 

				   }

				}

			}

			else

			{

			    die("Error in Order By Related Array ") ;

			}

		}

	

/*-------End , Limit if OrderByFieldArray and OrderByArray is Not Empty-------*/

	

/*-------Start , Limit if LimitArray is Not Empty-------*/

		if($LimitArray != "")

		{

		    $sql .= " limit " . $LimitArray[0] . "," . $LimitArray[1] ;

		

		}

/*-------End , Limit if LimitArray is Not Empty-------*/

		//echo "<br>" . $sql . "<br>" ;

		$result = $this->Select($sql);

		if(!empty($result))

		{

			$CountRows = count($result) ;

		}

		else

		{

			$CountRows = 0 ;

		}

		

		if($ReturnWhat == 'rr')

		{

			return $result;

		}

		else

		{

			return $CountRows;

		}

	

	

	}

	

	

/*-------------------------------------------------------------------------------

End , Query for select record from a table

-------------------------------------------------------------------------------*/













	

/*-------------------------------------------------------------------------------

Start , Query for Updating data into Table By Id

-------------------------------------------------------------------------------*/	

//This Function Has Three Parameters 

//1. The Table Name in which data to be inserted	

//2. the array of the values to be inserted	

//3. The array of the field name in the table in 

//   which the value is to be inserted



	function Update_Dynamic_Query($TableName,$FieldArray,$ValueArray,$FieldName,$FieldValue,$Print = 0)

	{	

	    $CountField = count($FieldArray);

	    $CountValue = count($ValueArray);

		if($CountField == $CountValue)	

		{

		    $sql = "update `$TableName` set ";

			

		    for($fi=0;$fi<$CountField;$fi++)

			{

			    if($fi == $CountField-1)

				{

					$sql .= "`" . $FieldArray[$fi] . "` = ";

					$sql .= "'" . trim($ValueArray[$fi]) . "'";	

				}

				else

				{

					$sql .= "`" . $FieldArray[$fi] . "` = ";

					$sql .= "'" . trim($ValueArray[$fi]) . "',";	

				}

			}

			

		    $sql .= " where `$FieldName` = '$FieldValue'";

			if($Print == 1) 

			{ 

			 	echo "<br>" . $sql . "<br>" ; die;

			}



			$result = $this->Update($sql);

			return $result;

		}

		else

		{

			return false;

		}

	}

/*-------------------------------------------------------------------------------

End , Query for Updating data into Table By Id

-------------------------------------------------------------------------------*/	





/*-------------------------------------------------------------------------------

Start , Query for Updating data into Table By Condition

-------------------------------------------------------------------------------*/	

//This Function Has Three Parameters 

//1. The Table Name in which data to be inserted	

//2. the array of the values to be inserted	

//3. The array of the field name in the table in 

//   which the value is to be inserted



	function Update_Condition_Query($TableName,$FieldArray,$ValueArray,$Condition,$Print)

	{

	    $CountField = count($FieldArray);

	    $CountValue = count($ValueArray);

		if($CountField == $CountValue)	

		{

		    $sql = "update `$TableName` set ";

			

		    for($fi=0;$fi<$CountField;$fi++)

			{

			    if($fi == $CountField-1)

				{

					$sql .= "`" . $FieldArray[$fi] . "` = ";

					$sql .= "'" . trim($ValueArray[$fi]) . "'";	

				}

				else

				{

					$sql .= "`" . $FieldArray[$fi] . "` = ";

					$sql .= "'" . trim($ValueArray[$fi]) . "',";	

				}

			}

			

		    $sql .= " where $Condition";

			if($Print == '1'){

			

			echo "<br>" . $sql . "<br>" ;die;

			}

			$result = $this->Update($sql);

			return $result;

		}

		else

		{

			return false;

		}

	}

/*-------------------------------------------------------------------------------

End , Query for Updating data into Table By Id

-------------------------------------------------------------------------------*/	







/*-------------------------------------------------------------------------------

Start , Query for Insertig data into Table

-------------------------------------------------------------------------------*/	

//This Function Has Three Parameters 

//1. The Table Name in which data to be inserted	

//2. the array of the values to be inserted	

//3. The array of the field name in the table in 

//   which the value is to be inserted





	function Insert_Dynamic_Query($TableName,$FieldArray,$ValueArray,$Print)

	{

	    $CountField = count($FieldArray);

	    $CountValue = count($ValueArray);

		//echo "<br>Value Count " . $CountValue ."<br>";

		//echo "<br>Field Count " . $CountField ."<br>";

		if($CountField == $CountValue)	

		{

		    $sql = "insert into `$TableName` (";

			

		    for($fi=0;$fi<$CountField;$fi++)

			{

			    if($fi == $CountField-1)

				{

					$sql .= "`" . $FieldArray[$fi] . "`";	

				}

				else

				{

					$sql .= "`" . $FieldArray[$fi] . "`,";

				}

			}

			

		    $sql .= ") values (";

			

		    for($i=0;$i<$CountValue;$i++)

			{

			    if($i == $CountValue-1)

				{

					$sql .= "'" . trim($ValueArray[$i]) . "'";	

				}

				else

				{

					$sql .= "'" . trim($ValueArray[$i]) . "',";

				}

			}

		    $sql .= ")";

			if($Print == '1'){

				echo "<br>" . $sql . "<br>" ;

				die;

			}

			$result = $this->Insert($sql);

			return $result;

		}

		else

		{

			return false;

		}

	}

/*-------------------------------------------------------------------------------

End , Query for Insertig data into Table

-------------------------------------------------------------------------------*/	







/*-------------------------------------------------------------------------------

Start , Function for Counting number of rows by a query

-------------------------------------------------------------------------------*/



	function CountRows($sql="")

	{

		if(isset($sql) && (!empty($sql)))

		{

			$ResultArray = $this->Select($sql) ;

			if(!empty($ResultArray))

			{

				$CountRow = count($ResultArray) ;

				return $CountRow ;

			}

			else

			{

				return 0 ;

			}

		}

		else

		{

			die("Bad parameter for CountRows functions in Query.Inc.php") ;

		}

	}

/*-------------------------------------------------------------------------------

End , Function for Counting number of rows by a query

-------------------------------------------------------------------------------*/







/*-------------------------------------------------------------------------------

Start , Function for Deleting a Record from a table

-------------------------------------------------------------------------------*/

//Parameters are 

//1. The Table Name from which the Field to be deleted

//2. The id of the field which is to be deleted



	function Delete_By_Id($TableName,$field,$value)

	{

		$sql = "delete from `$TableName` where `$field` = '$value'";

		//echo $sql; die;

		$result = $this->Delete($sql);

		return $result;

	}

/*-------------------------------------------------------------------------------

End , Function for Deleting a Recoprd from a table

-------------------------------------------------------------------------------*/



/*-------------------------------------------------------------------------------

Start , Function for Deleting a Record from a table

-------------------------------------------------------------------------------*/

//Parameters are 

//1. The Table Name from which the Field to be deleted

//2. The where Condition



	function Delete_By_Condition($TableName,$Condition)

	{

		$sql = "delete from `$TableName` where " . $Condition;

		//echo $sql;

		$result = $this->Delete($sql);

		return $result;

	}

/*-------------------------------------------------------------------------------

End , Function for Deleting a Record from a table

-------------------------------------------------------------------------------*/

	

	

/*-------------------------------------------------------------------------------

Start , Function checking if the provided string is empty

-------------------------------------------------------------------------------*/

//Parameters are 

//1. The name for which empty string has to be checked

//2. The string to be checked	

	function isEmpty($name,$string)

	{

		if(empty($string))

	    return "&#8226 &nbsp;".$name." required<br>";

	} 

/*-------------------------------------------------------------------------------

End , Function checking if the provided string is empty

-------------------------------------------------------------------------------*/		



/*-------------------------------------------------------------------------------

Start , Function checking if the 2 strings are same

-------------------------------------------------------------------------------*/

// about strcmp() function

// Returns < 0 if str1 is less than str2 

// Returns > 0 if str1 is greater than str2

// Returns 0 if they are equal

	function isSame($name1,$string1,$name2,$string2)

	{

		if(strcmp($string1,$string2)==0)

		{

	    	return "&#8226 &nbsp;".$name1." and ".$name2." should be same<br>";

		}

	} 

/*-------------------------------------------------------------------------------

End , Function checking if the 2 strings are same

-------------------------------------------------------------------------------*/		

	

/*-------------------------------------------------------------------------------

Start , Function checking if the string contain alphabets only

-------------------------------------------------------------------------------*/



	function containAlphabetsOnly($name,$string) 

	{

		$regExp = "/^[A-Za-z]$/";

		if($string != null && $string != "")

		{

		  for($i = 0; $i <$string.length; $i++)

		  { 

			if(!preg_match($regExp,substr($string,$i,1)))

			{

			  return "&#8226 &nbsp;".$name." should contain alphabets only<br>";

			}

		  }

		}

	}

/*-------------------------------------------------------------------------------

End , Function checking if the string contain alphabets only

-------------------------------------------------------------------------------*/	

	

/*-------------------------------------------------------------------------------

Start , Function checking if the string is a valid phone number

-------------------------------------------------------------------------------*/

	

	function isValidPhoneNumber($name,$string) 

	{

		$exp="/^[0-9]+[123456789-]+[0-9]$/";

		if(!preg_match($exp,$string))

		{

			return "&#8226 &nbsp;".$name." is not a valid phone number<br>";

		}

	}

/*-------------------------------------------------------------------------------

End , Function checking if the string is a valid phone number

-------------------------------------------------------------------------------*/

	

	

/*-------------------------------------------------------------------------------

Start , Function checking if the string is a valid salary

-------------------------------------------------------------------------------*/

	

	function isValidSalary($name,$string) 

	{

		if(!is_numeric($string))

		{

			return "&#8226 &nbsp;".$name." is not valid <br>";

		}

	}

/*-------------------------------------------------------------------------------

End , Function checking if the string is a valid salary

-------------------------------------------------------------------------------*/	

	

/*-------------------------------------------------------------------------------

Start , Function checking if the string is a valid post code

-------------------------------------------------------------------------------*/

	

	function isValidZipcode($name,$string)

	{

		if(!preg_match("/^([0-9]{5})(-[0-9]{4})?$/i",$string))

		{

			return "&#8226 &nbsp;".$name." is not valid <br>";

		}

	}

/*-------------------------------------------------------------------------------

Start , Function checking if the string is a valid post code

-------------------------------------------------------------------------------*/

	

	

	

/*-------------------------------------------------------------------------------

Start , Function checking if the string is a valid email

-------------------------------------------------------------------------------*/

	function is_valid_email($string) 

	{

	  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $string)) 

	  {

		return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226 Email is Invalid...<br>";

	  }

	}

/*-------------------------------------------------------------------------------

End , Function checking if the string is valid email

-------------------------------------------------------------------------------*/

	

}//End of Class

?>
