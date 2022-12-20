<div class="row">
    <div class="col-lg-12">
    <div class="card">
         <div class="card-body">
            
            <?php 
        if (isset($_SESSION['delerror'])) { ?>
        <span class="alert alert-<?php echo $_SESSION['errortype']; ?>"><?php echo $_SESSION['delerror']; ?></span>
        <?php
        unset($_SESSION['delerror']);
        unset($_SESSION['errortype']);
        }
        ?>
        </div>
    <div class="card-body">
        <a href="<?php echo $siteurl; ?>/dashboard/add-brand" class="btn btn-success mb-3">Add Brand</a>
        <div class="table-responsive">
                <table class="table product-overview" id="zero_config">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                         $brands = $pos->getBrands(-1);
                         if ($brands) {
                             foreach ($brands as $key => $brand) {
                                 ?>
                                 <tr>
                                     <td><?php echo $brand['brand_id']; ?></td>
                                     <td><?php echo $brand['name']; ?></td>
                                     <td><a href="<?php echo $siteurl."/admin/inc/delete-brand.php?id=".$brand['brand_id']; ?>" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
                                 </tr>
                                 <?php
                             }
                         }
                         ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</div>