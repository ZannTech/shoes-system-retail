<?php
include '../../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
$response = array();

if ($usr->getSession() && $usr->isStaff($usr->getSession())) {

  if (isset($_GET['id'])) {
  	$sale = $pos->getSaleByID($_GET['id']);
  	if ($sale) {

  		
  		 
  	}
  	else{
  		$response['error'] = true;
		$response['msg'] = "Sale not found against this product";
  	}
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