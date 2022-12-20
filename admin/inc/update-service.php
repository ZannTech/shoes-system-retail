
<?php

$response = array();

if (isset($_POST['updateService']) && !isset($_POST['searchItem'])) {
   if (isset($_POST['customerPhone']) && isset($_POST['returndate']) && isset($_POST['serviceId'])) {
        if (empty($_POST['customerPhone']) && empty($_POST['returndate'])) {
            array_push($response, "Please fill updating boxs");
        }
        else{
            $data = array();
            $data['customerPhone'] = $_POST['customerPhone'];
            $data['returndate'] = $_POST['returndate'];
            $data['serviceId'] = $_POST['serviceId'];
            if ($pos->updateService($data)) {
                array_push($response, "Service Updated Successfully!");
            }else{
                array_push($response, "Error: can not update service!!");
            }
        }
   }
}

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
         
         <form class="form-horizontal" method="POST" action="">
            <div class="card-body">
                <center><h4 class="card-title">UPDATE CUSTOMER SERVICE</h4></center>
                <br>
                <br>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="pid" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="pid" placeholder="BT1346" name="pid">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group mb-0 text-right">
                                                <button type="submit" name="searchItem" class="btn btn-info waves-effect waves-light">Search</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
         </form>
         <?php 
         if (!isset($_POST['searchItem']) && isset($_POST['updateService'])) { 
            if ($response) {
                foreach ($response as $key => $value) {
                    echo $value . '<br><br>';
                }
            }
         }
         if (isset($_POST['searchItem']) && !isset($_POST['updateService'])) { 

              if (!isset($_POST['pid'])) {
                echo 'Enter a PRODUCT ID';
              }
              else if (empty($_POST['pid'])) {
                echo 'Please enter PID';
              }
              else if (!$pos->getSupplyByPID($_POST['pid'])) {
                  echo $_POST['pid']." not exist in Database";
              }
              else{
                $supply = $pos->getServiceBySalePID($_POST['pid']);
                if (!$supply) {
                    echo "No Service Found";
                }else{
                $supply = $supply[0];
         ?>

         <form class="form-horizontal" method="POST" action="">
                                <input type="text" name="serviceId" value="<?php echo $supply['service_id']; ?>" hidden="">
                                <div class="card-body">
                               
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="pid" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="ppid" placeholder="BT1345"  disabled="" value="<?php echo $supply['product_ID']; ?>" name="ProductID" >
                                                    <input type="text" class="form-control" id="pid" placeholder="BT1345"  hidden="" value="<?php echo $supply['product_ID']; ?>" name="ProductID" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="color" class="col-sm-3 text-right control-label col-form-label">Color</label>
                                                <div class="col-sm-9">
                                                    <select disabled="" class="custom-select mr-sm-2" id="color" name="color">
                                                        <option <?php if ($supply['color'] == "black") {
                                                            echo 'selected=""'; } ?> value="black">Black</option>
                                                        <option <?php if ($supply['color'] == "red") {
                                                            echo 'selected=""'; } ?> value="red">Red</option>
                                                        <option <?php if ($supply['color'] == "green") {
                                                            echo 'selected=""'; } ?> value="green">Green</option>
                                                        <option <?php if ($supply['color'] == "yellow") {
                                                            echo 'selected=""'; } ?> value="yellow">Yellow</option>
                                                        <option <?php if ($supply['color'] == "gray") {
                                                            echo 'selected=""'; } ?> value="gray">Gray</option>
                                                        <option <?php if ($supply['color'] == "orange") {
                                                            echo 'selected=""'; } ?> value="orange">Orange</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                                <div class="col-sm-9">
                                                    <input  disabled="" type="number" class="form-control" id="uname1" placeholder="Price" value="<?php echo $supply['price']; ?>" name="price">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="brand" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                                                <div class="col-sm-9">
                                                 <select  disabled="" class="custom-select mr-sm-2" id="brand" name="brand">
                                                        <option value="none">--- Select Brand ---</option>
                                                        <?php $brands = $pos->getBrands(-1); 
                                                        if ($brands) {
                                                            foreach ($brands as $key => $brand) {
                                                                
                                                        ?>
                                                        <option <?php if ($supply['brand'] == $brand['brand_id']) {
                                                            echo 'selected=""'; } ?> value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['name']; ?></option>
                                                    <?php } } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label for="category" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                                <div class="col-sm-9">
                                                 <select  disabled="" class="custom-select mr-sm-2" id="category" name="category">
                                                        <option selected="" value="none">-- SELECT --</option>
                                                        <?php $categories = $pos->getCategories(-1); 
                                                        if ($categories) {
                                                            foreach ($categories as $key => $category) {
                                                                
                                                        ?>
                                                        <option <?php if ($supply['category'] == $category['cat_id']) {
                                                            echo 'selected=""'; } ?> value="<?php echo $category['cat_id']; ?>"><?php echo $category['name']; ?></option>
                                                    <?php } } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="size" class="col-sm-3 text-right control-label col-form-label">Size</label>
                                                 <div class="col-sm-9">
                                                    <select  disabled="" class="custom-select mr-sm-2" id="size" name="size">
                                                        <option <?php if ($supply['size'] == 40) {
                                                            echo 'selected=""'; } ?> value="40">40</option>
                                                        <option <?php if ($supply['size'] == 30) {
                                                            echo 'selected=""'; } ?>  value="30">30</option>
                                                        <option <?php if ($supply['size'] == 20) {
                                                            echo 'selected=""'; } ?>  value="20">20</option>
                                                        <option <?php if ($supply['size'] == 15) {
                                                            echo 'selected=""'; } ?>  value="15">15</option>
                                                        <option <?php if ($supply['size'] == 10) {
                                                            echo 'selected=""'; } ?>  value="10">10</option>
                                                         
                                                    </select>
                                                </div>
                                            </div>




                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="cname" class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" disabled="" id="cname" name="customerName" value="<?php echo $supply['customer_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="text" class="form-control" disabled="" id="address" name="customerAddress" value="<?php echo $supply['customer_address']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="tel" class="form-control" id="phone" name="customerPhone" value="<?php echo $supply['customer_phone']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 text-right control-label col-form-label">Purchased Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="text" class="form-control" disabled="" name="d" id="date" value="<?php echo $formats->formatTimeStamp('D , M , d, Y',$supply['dateofpurchase']); ?>">
                                                </div>
                                            </div>
 
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 text-right control-label col-form-label">Service Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="text" class="form-control" disabled="" name="sd" id="date" value="<?php echo $formats->formatTimeStamp('D , M , d, Y',$supply['service_date']); ?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="returndate" class="col-sm-3 text-right control-label col-form-label">Return Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="returndate" id="returndate" value="<?php echo $formats->formatTimeStamp('Y-m-d',$supply['return_date']); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="charges" class="col-sm-3 text-right control-label col-form-label">Service Charges</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="number" class="form-control" disabled="" id="charges" name="serviceCharges" value="<?php echo $supply['service_charges']; ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                    <div class="mt-5"></div> 

                                </div>
                                
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <a class="btn btn-info waves-effect waves-light" href="<?php echo $siteurl.'/dashboard/customer-service'; ?>" >BACK</a>
                                        <input class="btn btn-info waves-effect waves-light ml-5" type="submit" name="updateService" value="Update Service">
                                    </div> 
                                </div>
                            </form>
                        <?php  } } } ?>

    </div>
    </div>
    </div>
</div>