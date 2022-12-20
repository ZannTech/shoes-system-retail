<?php
include '../../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
$response = array();
sleep(1);
if ($usr->getSession() && $usr->isStaff($usr->getSession())) {

  if (isset($_POST['id'])) {
  	$response['error'] = false;
  	$response['msg'] = "";
  }
  else{
  		$response['error'] = true;
		$response['msg'] = "Sale ID Not found";
  	}
}else if (!$usr->isStaff($usr->getSession())) {
	$response['error'] = true;
	$response['msg'] = "Permission denied!";
}
else{
	$response['error'] = true;
	$response['msg'] = "Permission denied! Login Required.";
}

echo json_encode($response);

?>