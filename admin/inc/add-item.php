<?php

$response = array();


if (isset($_POST['addItem'])) {
    
    if (isset($_POST['ProductID']) && isset($_POST['color']) && isset($_POST['price']) && isset($_POST['brand']) && isset($_POST['category']) && isset($_POST['dateofentry']) && isset($_POST['size']) ) {
        
        $ProductID = $_POST['ProductID'];
        $color = $_POST['color'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $dateofentry = $_POST['dateofentry'];
        $size = $_POST['size'];

        if (empty($ProductID) || empty($color) || empty($price) || empty($brand) || empty($category) || empty($dateofentry) || empty($size)) {
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
            $ini = $pos->insertSupply($data);
            if (!$ini['error']) {
                array_push($response, "Item added to database");
            }
            else{
                array_push($response, $ini['msg']);
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
                                    <h4 class="card-title">Add Your New Item</h4>
                                    <?php if ($response) {
                                        foreach ($response as $key => $res) {
                                            echo $res.'<br><br>';
                                        }
                                    } ?>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="pid" class="col-sm-3 text-right control-label col-form-label">Product ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="ProductID" id="pid" placeholder="BT1345">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="color" class="col-sm-3 text-right control-label col-form-label">Color</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select mr-sm-2" id="color" name="color">
                                                        <option selected="" value="black">Black</option>
                                                        <option value="red">Red</option>
                                                        <option value="green">Green</option>
                                                        <option value="yellow">Yellow</option>
                                                        <option value="gray">Gray</option>
                                                        <option value="orange">Orange</option>
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
                                                    <input type="number" class="form-control" id="uname1" placeholder="Price" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="brand" class="col-sm-3 text-right control-label col-form-label">Brand</label>
                                                <div class="col-sm-9">
                                                 <select class="custom-select mr-sm-2" id="brand" name="brand">
                                                        <option selected="" value="none">--- Select Brand ---</option>
                                                        <?php $brands = $pos->getBrands(-1); 
                                                        if ($brands) {
                                                            foreach ($brands as $key => $brand) {
                                                                
                                                        ?>
                                                        <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['name']; ?></option>
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
                                                        <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['name']; ?></option>
                                                    <?php } } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group row">
                                                <label for="date" class="col-sm-3 text-right control-label col-form-label">Date of Entry</label>
                                                 <div class="col-sm-9">
                                                    <input type="date" class="form-control" name="dateofentry" id="date">
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
                                                        <option selected="" value="40">40</option>
                                                        <option value="30">30</option>
                                                        <option value="20">20</option>
                                                        <option value="15">15</option>
                                                        <option value="10">10</option>
                                                         
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    </div>
                                    

                                </div>
                                
                                <hr>
                                <div class="card-body">
                                    <div class="form-group mb-0 text-right">
                                        <button type="submit" name="addItem" class="btn btn-info waves-effect waves-light">Add Item</button>
                                    </div>
                                </div>
                            </form>

    </div>
    </div>
    </div>
</div>