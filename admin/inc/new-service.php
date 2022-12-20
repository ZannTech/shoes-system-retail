
<?php

$response = array();

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
         
         <form class="form-horizontal" method="POST" action="">
            <div class="card-body">
                <center><h4 class="card-title">NEW SERVICE</h4></center>
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
         if (!isset($_POST['searchItem']) && isset($_POST['deleteItem'])) { 
            if ($response) {
                foreach ($response as $key => $value) {
                    echo $value . '<br><br>';
                }
            }
         }
         if (isset($_POST['searchItem']) && !isset($_POST['deleteItem'])) { 

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
                $supply = $pos->getSalesByID($_POST['pid']);
                $supply = $supply[0];
         ?>

         <div class="form-horizontal">
                                <div class="card-body">
                                    <form class="ServiceForm" method="POST" action="">
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
                                                    
                                                    <input type="text" class="form-control" id="cname" name="customerName" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="text" class="form-control" id="address" name="customerAddress" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="tel" class="form-control" id="phone" name="customerPhone" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 text-right control-label col-form-label">Purchased Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="text" class="form-control" disabled="" name="d" id="date" value="<?php echo $formats->formatTimeStamp('D , M , d, Y',$supply['DOP']); ?>">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="Sdate" class="col-sm-3 text-right control-label col-form-label">Service Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="serviceDate" id="Sdate">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="returndate" class="col-sm-3 text-right control-label col-form-label">Return Date</label>
                                                 <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="returndate" id="returndate">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="charges" class="col-sm-3 text-right control-label col-form-label">Service Charges</label>
                                                <div class="col-sm-9">
                                                    
                                                    <input type="number" class="form-control" id="charges" name="serviceCharges" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </form>


                                    <div class="mt-5"></div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-9">
                                        	<div style="height: 300px;overflow-x: scroll;">
                                        		<div class="serviceReceipt">
                                        			
                                        		</div>
                                        	</div>
                                        </div>
                                        <div class="col-sm-12 col-lg-3">
                                        	<span class="display_error"></span>
                                        	<div class="form-group mb-3 text-right">
                                        		<form class="showService" action="<?php echo $siteurl.'/admin/inc/generate-service-receipt.php'; ?>" method="GET">
                                        			<input type="text" name="id" id="saleid" hidden="" value="<?php echo $supply['sale_id']; ?>">
                                        			<button type="submit" name="showService" class="btn btn-info waves-effect waves-light" id="showService">Show Service</button>
                                        		</form>
                                    		</div>
                                    		<div class="form-group mb-3 text-right">
                                    			<form class="newService" action="<?php echo $siteurl.'/admin/inc/clear-service-receipt.php'; ?>" method="GET">
                                        			<input type="text" name="id" hidden="" value="<?php echo $supply['sale_id']; ?>">
                                        		<button type="submit" name="newService" class="btn btn-info waves-effect waves-light" id="newService">New Service</button>
                                        		</form>
                                    		</div>
                                    		<div class="form-group mb-3 text-right">
                                    			<form class="addService" action="<?php echo $siteurl.'/admin/inc/add-service.php'; ?>" method="POST">
                                        			<input type="text" name="id" hidden="" value="<?php echo $supply['sale_id']; ?>">
                                        		<button type="submit" name="addService" class="btn btn-info waves-effect waves-light" id="addService">Add Service</button>
                                        		</form>
                                    		</div>

                                    		<div class="form-group mb-3 text-right">
                                    			<form class="saveService" action="<?php echo $siteurl.'/admin/inc/save-service-receipt.php'; ?>" method="POST">
                                        			<input type="text" name="id" hidden="" value="<?php echo $supply['sale_id']; ?>">
                                        			<button type="submit" name="saveService" class="btn btn-info waves-effect waves-light" id="saveService">Save</button>
                                        		</form>
                                    		</div>
                                        </div>

                                    </div>
                                    

                                </div>
                                
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <a class="btn btn-info waves-effect waves-light" href="<?php echo $siteurl.'/dashboard/customer-service'; ?>" >Cancel</a>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>

    </div>
    </div>
    </div>
</div>