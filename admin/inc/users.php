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

        <div class="table-responsive">
                <table class="table product-overview" id="zero_config">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Joined</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users = $usr->getAll();
                        if($users)
                        {
                            foreach ($users as $key => $row) {
                                $avatar = "default_avater.png";
                                if($usr->getusermeta($row['ID'],"avatar"))
                                {
                                  $avatar = $usr->getusermeta($row['ID'],"avatar");
                                }
                        ?>
                        <tr>
                            <td class="sorting_1">
                                <img src="<?php echo $siteurl.'/content/uploads/profiles/'.$avatar; ?>" alt="<?php echo $row['fullname']; ?>" class="rounded-circle" width="30">
                                <?php echo $row['fullname']; ?>
                            </td>
                            <td class="text-muted"><?php echo $row['username']; ?></td>
                            <td><?php echo ucfirst($usr->getusermeta($row['ID'],"gender")); ?></td>
                            <td class="text-muted">
                                <?php echo date_format(date_create($row['joined']), 'M d, Y'); ?>
                                
                            </td>
                            <td>
                                <span class="label label-success font-weight-100"><?php echo ucfirst($usr->getusermeta($row['ID'],"capabilities")); ?></span> 
                            </td>
                            <td>
                                <a href="<?php echo $siteurl.'/dashboard/delete_user.php?id='.$row['ID']; ?>" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
</div>