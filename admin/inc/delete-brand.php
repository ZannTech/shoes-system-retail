<?php
include '../../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
$type = "danger";
$msg = "";
if ($usr->getSession()) {

  if (isset($_GET['id'])) {

      if ($pos->getBrandById($_GET['id'])) {
        if ($pos->deleteBrand($_GET['id'])) {
          $type = "success";
          $msg = "Brand Deleted!";
        }
        else{
          $type = "danger";
        $msg = "Brand can not delete for now.";
        }
        
      }
      else
      {
        $type = "danger";
        $msg = "Invalid Brand ID";
      }
  }
  else
  {
    $type = "danger";
    $msg = "Invalid Brand ID";
  }

  $_SESSION['delerror'] = $msg;
  $_SESSION['errortype'] = $type;
  header("Location:".$siteurl."/dashboard/brands");

}
else
{
  $_SESSION['delerror'] = "Please Login to perform this action.";
  $_SESSION['errortype'] = $type;
  header("Location:".$siteurl."/dashboard/brands");
}
?>