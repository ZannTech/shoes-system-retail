<?php
session_start();
ob_start();
ini_set('max_execution_time', '0');
include 'includes/classes.php';
$siteurl = "http://localhost/pos";
$favicon = $siteurl."/assets/images/favicon.png";
$logo = $siteurl."/assets/images/logo.png";
$login_bg = $siteurl."/assets/images/auth-bg.jpg";
$sitename = "POS DB";
$app_icon = $siteurl."/content/uploads/";

$formats = new Formats();
$usr = new User();
$pos = new POS($formats);

if ($usr->getSession()) {
	$usr->setData($usr->getSession());
}

$ip_address = $_SERVER['REMOTE_ADDR'];

//var_dump($pos->getSalePurchaseByID(2));
//var_dump($pos->getSaleReceiptByID(1));

//var_dump($site->getTopDownloadsMonth(10));

//var_dump($pos->getServiceBySaleID(4));


