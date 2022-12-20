<?php
$first_name = "";
$last_name = "";
$email = "";
$password = "";
$description = "";
$gender = "male";
$country = "US";
$profileImage = "";


$errors = array();

if (isset($_POST['addUser'])) {

    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['description']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['country'])){

                            	$first_name = trim($_POST['first_name']);
    	    		            $last_name = trim($_POST['last_name']);
    	    		            $description = trim($_POST['description']);
    	    		            $email = trim($_POST['email']);
    	    		            $password = trim($_POST['password']);

    	    		            $gender = $_POST['gender'];
    	    		            $country = $_POST['country'];
    	    		            
    	    		            if(empty($first_name))
    	    		            {
    	    			            array_push($errors, "First Name Required");
    	    		            }
    	    		            else if(empty($last_name))
    	    		            {
    	    			            array_push($errors, "Last Name Required");
    	    		            }
    	    		            else if(empty($email))
    	    		            {
    	    			            array_push($errors, "Email Required");
    	    		            }
    	    		            else if(empty($password))
    	    		            {
    	    			            array_push($errors, "Password Required");
    	    		            }
    	    		            else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    	    		            {
    	    			            array_push($errors, "Invalid Email address");
    	    		            }
    	    		            else if(empty($description))
    	    		            {
    	    			            array_push($errors, "Description Required");
    	    		            }
                                else if(empty($gender))
                                {
                                    array_push($errors, "Gender Required");
                                }
                                else if(empty($country))
                                {
                                    array_push($errors, "Country Required");
                                }
    	    		            else{
    	    		            	$data = array(
    	    		            		'first_name' => $first_name,
    	    		            		'last_name' => $last_name,
    	    		            		'description' => $description,
    	    		            		'country' => $country,
    	    		            		'gender' => $gender,
    	    		            		'email' => $email,
    	    		            		'capabilities' => 'admin',
    	    		            		'password' => $password,
    	    		            		'avatar' => 'default_avater.png'
    	    		            	);
    	    			            $inu = $usr->AddNew($data);
    	    			            array_push($errors, $inu['msg']);
    	    		            }
    }else{
        array_push($errors, "Fill all Required fields");
    }
}

?>

<div class="row">
    <div class="col-lg-12">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add New Admin User</h4>
        <div class="row " style="margin: 0 0 30px 0;">
        					 	<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
        					 		<form class="edit-form" method="post" action="">
        					 			<?php 
        					 			if($errors){ 
        					 				foreach ($errors as $key => $value) {
        					 			?>
        					 			<div class="row">
        					 			<span class="alert alert-danger"><?php echo $value; ?></span></div>
        					 		    <?php } } ?>
        					 		    <div class="form-group">
        					 		    	<label for="first_name">First Name*</label>
                                            <input type="text" class="form-control input-lg" id="first_name" value="<?php echo $first_name; ?>" name="first_name">
        					 		    </div>
        					 		    <div class="form-group">
        					 		    	<label for="last_name">Last Name*</label>
                                            <input type="text" class="form-control input-lg" id="last_name" value="<?php echo $last_name; ?>" name="last_name">
        					 		    </div>
        					 		    <div class="form-group">
        					 		    	<label for="email">Email*</label>
                                            <input type="email" class="form-control input-lg" id="email" value="<?php echo $email; ?>" name="email">
        					 		    </div>
        					 		    <div class="form-group">
        					 		    	<label for="password">Password*</label>
                                            <input type="password" class="form-control input-lg" id="password" value="<?php echo $password; ?>" name="password">
        					 		    </div>
        					 		    <div class="form-group">
        					 		    	<label for="countrypick">
                                            Counrty* 
                                            </label>
        					 		    	<div class="um-field-area bfh-selectbox bfh-countries" data-country="<?php echo $country; ?>" data-flags="true" id="countrypick">
        					 		    		
        					 		    	</div>
        					 		    </div>
        					 		    <div class="form-group">
        					 		    	<label for="description">Description*</label>
        					 		    	<textarea name="description" class="form-control" rows="3" placeholder="About yourself..."><?php echo $description; ?></textarea>
        					 		    </div>
        					 		    <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation1" name="gender" value="male" <?php if ($gender == 'male') { ?> checked="" <?php } ?>>
                                                <label class="custom-control-label" for="customControlValidation1">Male</label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="customControlValidation2" name="gender" value="female" <?php if ($gender == 'female') { ?> checked="" <?php } ?>>
                                                <label class="custom-control-label" for="customControlValidation2">Female</label>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                        	<button type="submit" name="addUser" class="btn btn-success">Add User</button>
                                        </div>

        					 		</form>
        					 	</div>
        					 </div>
    </div>
    </div>
    </div>
</div>