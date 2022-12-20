<?php
include '../../config.php';
$response = array();

if($usr->getSession())
{
   if (isset($_FILES['avatar'])) {
   	  if ($_FILES["avatar"]["error"] != 4)
   	  {
   	  	$filename = $_FILES['avatar']['name'];
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = array("png","jpg","jpeg");
        list($width, $height) = getimagesize($_FILES['avatar']['tmp_name']);
        if (in_array($file_ext, $allowed) && $width <= 800 && $height <= 800) {

        	$oldname = pathinfo($filename)['filename'];
            $filename = $oldname."_".$usr->getSession().".".$file_ext; 
            $sourcePath = $_FILES['avatar']['tmp_name'];
            $targetPath = "../../content/uploads/profiles/".$filename;
            if (!move_uploaded_file($sourcePath,$targetPath))
            {
                $response['error'] = true;
   	            $response['type'] = "invalidimage";
   	            $response['message'] = "Error while processing image upload";
   	            echo json_encode($response);
            }
            else
            {
            	$prev_avatar = "";

            	if ($usr->avatar()) {
            		$prev_avatar = $usr->avatar();
            	}
                if ($usr->updateAvatar($filename)) {
                	 if ($prev_avatar != "default_avater.png") {
            			unlink("../../content/uploads/profiles/".$prev_avatar);
            		 }
                	   $response['error'] = false;
   	                 $response['type'] = "success";
   	                 $response['message'] = $siteurl."/content/uploads/profiles/".$filename;
   	                 echo json_encode($response);
                }
                else
                {
                	unlink("../../content/uploads/profiles/".$filename);
                	$response['error'] = true;
   	                $response['type'] = "invalidimage";
   	                $response['message'] = "Error while processing image upload";
   	                echo json_encode($response);
                }
            }
        }
        else if(!in_array($file_ext, $allowed))
        {
        	$response['error'] = true;
   	        $response['type'] = "invalidimagetype";
   	        $response['message'] = "Please upload an image";
   	        echo json_encode($response);
        }
        else
        {
           $response['error'] = true;
            $response['type'] = "InvalidImageSize";
            $response['message'] = "Please upload an 800 X 800 image";
            echo json_encode($response);
        }
   	  }
   	  else
   	  {
            $response['error'] = true;
   	        $response['type'] = "avaterrequired";
   	        $response['message'] = "Please upload an image";
   	        echo json_encode($response);
   	  }
   }
   else
   {
   	  $response['error'] = true;
   	  $response['type'] = "avaterrequired";
   	  $response['message'] = "Please upload an image";
   	  echo json_encode($response);
   	}
}
else
{
      $response['error'] = true;
   	  $response['type'] = "loginRequired";
   	  $response['message'] = "Please upload an image";
   	  echo json_encode($response);
}