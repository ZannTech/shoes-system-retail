<?php if(!isset($_GET['subaction'])){ ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card">
    	<center><br><br><h3>CUSTOMER SERVICE</h3></center>
    <div class="card-body">

       <center>
       	 <a href="<?php echo $siteurl; ?>/dashboard/customer-service/new-service" class="btn btn-success mb-3 ml-3">New Service</a>
        <a href="<?php echo $siteurl; ?>/dashboard/customer-service/update-service" class="btn btn-success mb-3 ml-3">Update Service</a>

        <a href="<?php echo $siteurl; ?>/dashboard/customer-service/view-service" class="btn btn-success mb-3 ml-3">View Service</a>
       </center>
        
    </div>
    </div>
    </div>
</div>

<?php 
}else if($_GET['subaction'] == "new-service"){ 
include 'new-service.php';
}
else if($_GET['subaction'] == "update-service"){ 
include 'update-service.php';
}
else if($_GET['subaction'] == "view-service"){ 
include 'view-service.php';
}
else{
?>
<div class="row card align-items-center">
                        <div class="card-body">
                                <h3>No Action Found</h3>
                                <p>Invalid action!</p>
                        </div>
                        </div>
<?php
}
?>	
