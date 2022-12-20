<?php
$response = array();

$nPassword = "";
$vnPassword = "";
$cUsername = "";
$cRole = "";

if (isset($_POST['register'])) {
	if (isset($_POST['cUsername']) && isset($_POST['nPassword']) && isset($_POST['vnPassword']) && isset($_POST['cRole'])) {

		$nPassword = $_POST['nPassword'];
		$vnPassword = $_POST['vnPassword'];
		$cUsername = $_POST['cUsername'];
		$cRole = $_POST['cRole'];

		if (empty($cUsername)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a Username";
		}
		else if (empty($nPassword)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a Password";
		}else if (empty($vnPassword)) {
			$response['type'] = "alert-danger";
		$response['message'] = "Enter a Verify Password";
		}
		else if (empty($cRole) || $cRole == "none") {
			$response['type'] = "alert-danger";
			$response['message'] = "Please select a user role";
		}
		else if ($usr->isUser($cUsername)) {
			$response['type'] = "alert-danger";
			$response['message'] = "Already have username in system";
		}
		else if ($nPassword != $vnPassword) {
			$response['type'] = "alert-danger";
		    $response['message'] = "Both Passwords not matched";
		    $nPassword = "";
		    $vnPassword = "";
		}
		else
		{
			$data['username'] = $cUsername; 
			$data['password'] = $nPassword; 
			$data['avatar'] = "default_avater.png"; 
			$data['gender'] = "male"; 
			$data['capabilities'] = $cRole; 
			$ruser = $usr->AddNew($data);
			if ($ruser) {
				$response['type'] = "alert-success";
		    	$response['message'] = "User Registered successfully!";
			}
			else{
				$response['type'] = "alert-danger";
		    	$response['message'] = $ruser['msg'];
			}
			
			 
		}


	}
	else
	{
		$response['type'] = "alert-danger";
		$response['message'] = "Enter required details";
	}
}

?>
<div class="row">
    <div class="col-12">
        <div class="card">
                <form method="POST" action="">
                    <div class="card-body">
                    	<h2>Registration Form</h2>
                    	<?php 
                    	if ($response) {
                    		echo '<div class="col-md-4 col-xs-12 mb-4 mt-3"><span class="alert '.$response["type"].'">'.$response["message"].'</span></div>';
                    	}
                    	?>
                    	<div class="col-md-4 col-xs-12">
                    	   	  	 <div class="form-group mb-4 mt-3">
                                    <label for="cUsername">Username*</label>
                                    <input type="text" class="form-control input-lg" id="cUsername" name="cUsername" value="<?php echo $cUsername; ?>">
                            </div>
                        </div>
                         
                        <div class="col-md-4 col-xs-12">
                    	   	  	 <div class="form-group mb-4 mt-3">
                                    <label for="nPassword">Password*</label>
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
                                    <label for="cRole">Role*</label>
                                    
                                    <select class="custom-select mr-sm-2" id="cRole" name="cRole">
                                            <option selected="" value="none">Choose Role...</option>
                                            <option value="staff">Staff</option>
                                            <option value="admin">Admin</option>
                                        </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                        	<div class="form-group mb-4 mt-3">
                        		<center><button type="submit" class="btn btn-success" name="register">Register</button></center>
                        	</div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>