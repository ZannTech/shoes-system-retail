<?php
include '../../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
$response = array();
sleep(1);
if ($usr->getSession() && $usr->isStaff($usr->getSession())) {

  if (isset($_POST['saleid']) && isset($_POST['customerName'])  && isset($_POST['customerAddress'])  && isset($_POST['customerPhone'])  && isset($_POST['serviceDate']) && isset($_POST['returndate']) && isset($_POST['serviceCharges']) ) {

  	if (empty($_POST['customerName'])  || empty($_POST['customerAddress']) || empty($_POST['customerPhone'])  || empty($_POST['serviceDate']) || empty($_POST['returndate']) || empty($_POST['serviceCharges'])) {
  		$response['error'] = true;
  		$response['msg'] = "Fill the required Customer or Service Details";
  	}
    else
    {
  	  $getReceipt = $pos->getServiceBySaleID($_POST['saleid']);
  	  if ($getReceipt) { 
            $getReceipt = $getReceipt[0];
            $serin = $pos->insertServiceReceipt($getReceipt['service_id']);
            if (!$serin['error']) { 
            $output = '';
            $output .= '<div class="row" style="margin-left:5px;"><br>';
            $output .= '<center>EFSI Service Receipt<br>15/12, New Market, Faisalabad<br>Cell: +923084090617 / +923126200617</center>';
            
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
            $output .= '<div class="col-sm-12 col-lg-3">Customer Name</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["customer_name"].'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">ADDRESS</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["customer_address"].'</div>';
            $output .= "</div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">PHONE</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["customer_phone"].'</div>';
            $output .= "</div>"; 

            

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">PURCHASED</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$formats->formatTimeStamp('m/d/Y h:m A',$getReceipt["dateofpurchase"]).'</div>';
            $output .= "</div></div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">SERVICE</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$formats->formatTimeStamp('m/d/Y h:m A',$getReceipt["service_date"]).'</div>';
            $output .= "</div></div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">RETURN</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$formats->formatTimeStamp('m/d/Y h:m A',$getReceipt["return_date"]).'</div>';
            $output .= "</div></div>"; 

            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12 col-lg-3">CHARGE (BDT)</div>';
            $output .= '<div class="col-sm-12 col-lg-7">'.$getReceipt["service_charges"].'</div>';
            $output .= "</div></div>"; 


            $output .= '<br>=========================================<br><p>WE ARE GLAD TO SERVICE YOU !!!</p><p>FOR FUTURE REFERENCE KINDLY PROVIDE THE RECEIPT</p></div>';
            $response['error'] = false;
            $response['msg'] = $output;
            }
            else{
              $response['error'] = true;
              $response['msg'] = "Error while inserting service Receipt";
            }    
  	  }
      else{
  		      $response['error'] = true;
		        $response['msg'] = "Sale not found against this product";
  	  }

  	}

  }else{
  		$response['error'] = true;
		$response['msg'] = "Some information missing";
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