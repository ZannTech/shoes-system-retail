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
        <a href="<?php echo $siteurl; ?>/dashboard/add-category" class="btn btn-success mb-3">Add Category</a>
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
                         $categories = $pos->getCategories(-1);
                         if ($categories) {
                             foreach ($categories as $key => $category) {
                                 ?>
                                 <tr>
                                     <td><?php echo $category['cat_id']; ?></td>
                                     <td><?php echo $category['name']; ?></td>
                                     <td><a href="<?php echo $siteurl."/admin/inc/delete-category.php?id=".$category['cat_id']; ?>" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a></td>
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