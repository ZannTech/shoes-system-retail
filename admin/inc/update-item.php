
<?php

$response = array();

if (isset($_POST['updateItem']) && !isset($_POST['searchItem'])) {
    
    if (isset($_POST['ProductID']) && isset($_POST['ppid']) && isset($_POST['color']) && isset($_POST['price']) && isset($_POST['brand']) && isset($_POST['category']) && isset($_POST['dateofentry']) && isset($_POST['size']) ) {
        
        $ProductID = $_POST['ProductID'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $dateofentry = $_POST['dateofentry'];
        $size = $_POST['size'];
        $ppid = $_POST['ppid'];

        if (empty($ProductID) || empty($color) || empty($price) || empty($brand) || empty($category) || empty($dateofentry) || empty($size) || empty($ppid)) {
            array_push($response, "Please fill all fields");
        }
        else{
            $data['pid'] = $ProductID;
            $data['color'] = $color;
            $data['price'] = $price;
            $data['brand'] = $brand;
            $data['category'] = $category;
            $data['dateofentry'] = $dateofentry;
            $data['size'] = $size;
            $data['ppid'] = $ppid;
            $upi = $pos->updateSupply($data);
            if (!$upi['error']) {
                array_push($response, "Item updated in database");
            }
            else{
                array_push($response, $upi['msg']);
            }

        }
    }
    else{
        array_push($response, "Fill all the fields");
    }
}

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
         
         <form class="form-horizontal" action="" method="POST">
            <div class="card-body">
                <h4 class="card-title">Update Your Item</h4>
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
         if (!isset($_POST['searchItem']) && isset($_POST['updateItem'])) { 
            if ($response) {
                foreach ($response as $key => $value) {
                    echo $value . '<br><br>';
                }
            }
         }
         if (isset($_POST['searchItem']) && !isset($_POST['updateItem'])) { 

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
                $supply = $pos->getSupplyByPID($_POST['pid']);
                $supply = $supply[0];
         ?>

         <form class="form-horizontal"  action="" method="POST">
                                <div class="card-body">
                                     
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="pid" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="pid" placeholder="BT1345" value="<?php echo $supply['product_ID']; ?>" name="ProductID" >
                                                    <input type="text" class="form-control" id="upid" value="<?php echo $supply['product_ID']; ?>" name="ppid" hidden="" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="color" class="col-sm-3 text-right control-label col-form-label">Color</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select mr-sm-2" id="color" name="color">
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="uname1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="uname1" placeholder="Price" value="<?php echo $supply['price']; ?>" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="brand" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                                                <div class="col-sm-9">
                                                 <select class="custom-select mr-sm-2" id="brand" name="brand">
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
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="category" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                                <div class="col-sm-9">
                                                 <select class="custom-select mr-sm-2" id="category" name="category">
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
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 text-right control-label col-form-label">Date of Entry</label>
                                                 <div class="col-sm-9">
                                                    <input type="text" class="form-control" disabled="" name="d" id="date" value="<?php echo $formats->formatTimeStamp('D , M , d, Y',$supply['dateofentery']); ?>">
                                                    <input hidden="" type="text" class="form-control" name="dateofentry" id="date" value="<?php echo $supply['dateofentery']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="size" class="col-sm-3 text-right control-label col-form-label">Size</label>
                                                 <div class="col-sm-9">
                                                    <select class="custom-select mr-sm-2" id="size" name="size">
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
                                         
                                    </div>
                                    

                                </div>
                                
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="updateItem" class="btn btn-info waves-effect waves-light">Update Item</button>
                                    </div>
                                </div>
                            </form>
                        <?php } } ?>

    </div>
    </div>
    </div>
</div>