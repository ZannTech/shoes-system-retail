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
  	$sale = $pos->getSaleByID($_POST['id']);
  	if ($sale) {
      sleep(2);
  		$insr = $pos->insertSaleReceipt($_POST['id']);
  		if (!$insr['error']) {
  			$lastsr_id = $insr['msg'];
  			$getReceipt = $pos->getSaleReceiptByID($lastsr_id);
  			if ($getReceipt) {
  					$getReceipt = $getReceipt[0];
            $output = '';
            $output .= '<div class="row" style="margin-left:5px;"><br>';
            $output .= '<center>EFSI Purchasing Receipt<br>15/12, New Market, Faisalabad<br>Cell: +923084090617 / +923126200617</center>';
            
            $output .= '<div class="container"><div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">PRODUCT ID</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["product_ID"].'</div>';
            $output .= "</div>";

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">PRICE (BDT) </div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["price"].'</div>';
            $output .= "</div>";

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">COLOR</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.ucfirst($getReceipt["color"]).'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">SIZE</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["size"].'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">CATEGORY</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$pos->getCategoryById($getReceipt["category"])["name"].'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">BRAND</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$pos->getBrandById($getReceipt["brand"])["name"].'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">PURCHASED</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$formats->formatTimeStamp('m/d/Y h:m A',$getReceipt["dateofpurchase"]).'</div>';
            $output .= "</div></div>"; 


            $output .= '<br>=========================================<br><p>THANK YOU FOR PURCHASING !!!</p><br></div>';
            $response['error'] = false;
            $response['msg'] = $output;
  			}
  			else{
  				$response['error'] = true;
				$response['msg'] = "No Sale Receipt";
  			}

  		}
  		else{
  			$response['error'] = true;
			$response['msg'] = $insr['msg'];
  		}
  		 
  	}
  	else{
  		$response['error'] = true;
		$response['msg'] = "Sale not found against this product";
  	}
  }else{
    $response['error'] = true;
    $response['msg'] = "ID NOT SET";
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