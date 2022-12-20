<div class="row">
    <div class="col-lg-12">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
        			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

        				<!-- Card -->
        				<div class="card">
        					<img class="card-img-top img-responsive rounded-circle useravatar" src="<?php if(!empty($usr->avatar())){ echo $siteurl."/content/uploads/profiles/".$usr->avatar(); }else {echo $siteurl."/content/uploads/profiles/default_avater.png"; } ?>">
        					<div class="card-body">
                                    <span id="avatar-error" style="display: none;"></span>
        							<form class="uploadavater" method="POST" action="<?php echo $siteurl; ?>/admin/inc/uploadavater.php">
        								 <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input avatar" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Upload</label>
                                        </div>
                                    </div>
        							</form>
        					</div>
        				</div>
        				<!-- Card -->

        			</div>
        			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        				<?php if (!isset($_GET['subaction'])) { ?>
        					<div  class="linked" style="display: inline-block;">
        						<a href="<?php echo $siteurl; ?>/dashboard/profile/edit" style="color: #27ae60;">Edit</a>
        					</div>
        					<h1><?php echo $usr->display_name(); ?></h1>

        					<?php if (!empty($usr->joineddate())) { ?>
        						<div>
        							<span>Joined <?php echo date_format(date_create($usr->joineddate()), 'M d, Y'); ?></span>
        							</div>
        					<?php } ?>
        					 
        					<?php if ($usr->getusermeta($usr->getSession(),'gender')) { ?>
        						<h3>Gender</h3>
        						<?php 
        						echo ucfirst($usr->getusermeta($usr->getSession(),'gender')); }
        						?> 
        					 


        				<?php } else if ($_GET['subaction'] == 'edit')
        				{ 
        					$errors = array();
    	    	            $first_name = $usr->getusermeta($usr->getSession(),'first_name');
    	    	            $last_name = $usr->getusermeta($usr->getSession(),'last_name');
                            $gender = $usr->getusermeta($usr->getSession(),'gender');

                            if (isset($_POST['update-profile'])) {

                                if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['gender'])){

                            	$first_name = trim($_POST['first_name']);
    	    		            $last_name = trim($_POST['last_name']);
    	    		            $gender = $_POST['gender'];
    	    		            
    	    		            if(empty($first_name))
    	    		            {
    	    			            array_push($errors, "First Name Required");
    	    		            }
    	    		            else if(empty($last_name))
    	    		            {
    	    			            array_push($errors, "Last Name Required");
    	    		            }
                                else if(empty($gender))
                                {
                                    array_push($errors, "Gender Required");
                                }
    	    		            else{
    	    		            	$data = array(
    	    		            		'first_name' => $first_name,
    	    		            		'last_name' => $last_name,
    	    		            		'gender' => $gender
    	    		            	);
    	    			            if($usr->updateProfile($data))
    	    			            {
    	    				            header("Location:../profile");
    	    			            }
    	    			            else
    	    			            {
    	    				            array_push($errors, "Login Required");
    	    			            }
    	    		            }
                            }else{
                                array_push($errors, "Fill all Required fields");
                            }
                        }
        				?>
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
                                        	<button type="submit" name="update-profile" class="btn btn-success">Update</button>
                                        </div>

        					 		</form>
        					 	</div>
        					 </div>
        				<?php } ?>
        				
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</div>