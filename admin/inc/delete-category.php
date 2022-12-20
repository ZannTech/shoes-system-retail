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

      if ($pos->getCategoryById($_GET['id'])) {
        if ($pos->deleteCategory($_GET['id'])) {
          $type = "success";
          $msg = "Category Deleted!";
        }
        else{
          $type = "danger";
        $msg = "Category can not delete for now.";
        }
        
      }
      else
      {
        $type = "danger";
        $msg = "Invalid Category ID";
      }
  }
  else
  {
    $type = "danger";
    $msg = "Invalid Category ID";
  }

  $_SESSION['delerror'] = $msg;
  $_SESSION['errortype'] = $type;
  header("Location:".$siteurl."/dashboard/categories");

}
else
{
  $_SESSION['delerror'] = "Please Login to perform this action.";
  $_SESSION['errortype'] = $type;
  header("Location:".$siteurl."/dashboard/categories");
}
?>