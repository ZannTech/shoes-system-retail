<?php
include '../../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
$type = "danger";
$msg = "";
if ($usr->getSession()) {

	if($usr->isAdmin($usr->getSession())){

	if (isset($_GET['id'])) {
		 if ($usr->isUserId($_GET['id'])) {
		 	if ($usr->deleteById($_GET['id'])) {
		 		$usr->deletemetaById($_GET['id']);
		 		$type = "success";
		 		$msg = "Deleted!";
		 	}
		 	else
		 	{
		 		$type = "danger";
		 		$msg = "Can't Delete User.";
		 	}
		 }
		 else
		 {
		 	$type = "danger";
		 	$msg = "Invalid User ID";
		 }
	}
	else
	{
		$type = "danger";
		$msg = "Invalid User ID";
	}

	$_SESSION['delerror'] = $msg;
	$_SESSION['errortype'] = $type;
	header("Location:".$siteurl."/dashboard/users");
}
else
{
	$_SESSION['delerror'] = "Don't have permission to perform this action.";
	$_SESSION['errortype'] = $type;
	header("Location:".$siteurl."/dashboard/users");
}

}
else
{
	$_SESSION['delerror'] = "Please Login to perform this action.";
	$_SESSION['errortype'] = $type;
	header("Location:".$siteurl."/dashboard/users");
}
?>