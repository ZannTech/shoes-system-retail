<?php
$response = array();

if (isset($_POST['addBrand'])) {
    
    if (isset($_POST['bName'])) {
        $bName = $_POST['bName'];
        $bName = trim($bName);

        if (empty($bName)) {
            array_push($response, "Enter Brand Name");
        }
        else{
            $data['name'] = $bName;
            $inc = $pos->insertBrand($data);
            array_push($response, $inc['msg']);
        }
    }
}

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Insert Brand</h4>
        <form class="mt-4" action="" method="POST" >
            <?php if ($response) {
                foreach ($response as $key => $error) {
                    echo '<span class="display_error">'.$error.'</span>';
                }
            } ?>
            <div class="form-group">
                <input type="text" name="bName" class="form-control bName" placeholder="Name i.e Bata">
            </div>
            <div class="form-group">
                <input type="submit" value="Add Brand" name="addBrand" class="btn btn-success">
            </div>
        </form>
    </div>
    </div>
    </div>
</div>