<?php
$response = array();

$nPassword = "";
$vnPassword = "";
$cUsername = "";

if (isset($_POST['update'])) {
	if (isset($_POST['cUsername']) && isset($_POST['nPassword']) && isset($_POST['vnPassword'])) {

		$nPassword = $_POST['nPassword'];
		$vnPassword = $_POST['vnPassword'];
		$cUsername = $_POST['cUsername'];

		if (empty($cUsername)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a Username";
		}
		else if (empty($nPassword)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a New Password";
		}else if (empty($vnPassword)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a Verify Password";
		}
		else if (!$usr->isUser($cUsername)) {
			$response['type'] = "alert-danger";
			$response['message'] = "Enter a Valid Username";
		}
		else if ($nPassword != $vnPassword) {
			$response['type'] = "alert-danger";
		    $response['message'] = "Both Passwords not matched";
		    $nPassword = "";
		    $vnPassword = "";
		}
		else
		{
			if ($usr->UpdatePassword($nPassword,$usr->display_column_by_username("ID",$cUsername)['ID'])) {
				 	$response['type'] = "alert-success";
		            $response['message'] = "Password Changed Successfuly";
		            $nPassword = "";
		            $cPassword = "";
		            $vnPassword = "";
				 }
				 else
				 {
				 	$response['type'] = "alert-danger";
		            $response['message'] = "Something went wrong";
				 } 
		}


	}
	else
	{
		$response['type'] = "alert-danger";
		$response['message'] = "Enter Details";
	}
}

?>
<div class="row">
    <div class="col-12">
        <div class="card">
                <form method="POST" action="">
                    <div class="card-body">
                    	<h2>Update Password</h2>
                    	<?php 
                    	if ($response) {
                    		echo '<div class="col-md-4 col-xs-12 mb-4 mt-3"><span class="alert '.$response["type"].'">'.$response["message"].'</span></div>';
                    	}
                    	?>
                    	<div class="col-md-4 col-xs-12">
                    	   	  	 <div class="form-group mb-4 mt-3">
                                    <label for="cUsername">Username</label>
                                    <input type="text" class="form-control input-lg" id="cUsername" name="cUsername" value="<?php echo $cUsername; ?>">
                            </div>
                        </div>
                         
                        <div class="col-md-4 col-xs-12">
                    	   	  	 <div class="form-group mb-4 mt-3">
                                    <label for="nPassword">New Password</label>
                                    <input type="password" class="form-control input-lg" id="nPassword" name="nPassword" value="<?php echo $nPassword; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                    	   	  	 <div class="form-group mb-4 mt-3">
                                    <label for="vnPassword">Verify Password</label>
                                    <input type="password" class="form-control input-lg" id="vnPassword" name="vnPassword" value="<?php echo $vnPassword; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                        	<div class="form-group mb-4 mt-3">
                        		<center><button type="submit" class="btn btn-success" name="update">Update</button></center>
                        	</div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>