<?php if(!isset($_GET['subaction'])){ ?>
<div class="row">
    <div class="col-lg-12">
    <div class="card">
    	<center><br><br><h3>REPORTS MENU</h3></center>
    <div class="card-body">

       <center>
       	 <a href="<?php echo $siteurl; ?>/dashboard/reports/sales-report" class="btn btn-success mb-3 ml-3">Sales Report</a>
        <a href="<?php echo $siteurl; ?>/dashboard/reports/service-report" class="btn btn-success mb-3 ml-3">Service Report</a>

        <a href="<?php echo $siteurl; ?>/dashboard/reports/stock-report" class="btn btn-success mb-3 ml-3">Stock Report</a>
       </center>
        
    </div>
    </div>
    </div>
</div>

<?php 
}else if($_GET['subaction'] == "sales-report"){ 
include 'sales-report.php';
}
else if($_GET['subaction'] == "service-report"){ 
include 'service-report.php';
}
else if($_GET['subaction'] == "stock-report"){ 
include 'stock-report.php';
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
