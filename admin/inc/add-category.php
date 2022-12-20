<?php
$response = array();

if (isset($_POST['addCategory'])) {
    
    if (isset($_POST['cName'])) {
        $cName = $_POST['cName'];
        $cName = trim($cName);

        if (empty($cName)) {
            array_push($response, "Enter Category Name");
        }
        else{
            $data['name'] = $cName;
            $inc = $pos->insertCategory($data);
            array_push($response, $inc['msg']);
        }
    }
}

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Insert Category</h4>
        <form class="mt-4" action="" method="POST" >
            <?php if ($response) {
                foreach ($response as $key => $error) {
                    echo '<span class="display_error">'.$error.'</span>';
                }
            } ?>
            <div class="form-group">
                <input type="text" name="cName" class="form-control cName" placeholder="Name i.e Male">
            </div>
            <div class="form-group">
                <input type="submit" value="Add Category" name="addCategory" class="btn btn-success">
            </div>
        </form>
    </div>
    </div>
    </div>
</div>