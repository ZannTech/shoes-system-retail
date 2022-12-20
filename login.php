<?php
include 'config.php';

if($usr->getSession())
{
   header("Location:dashboard");
}

$errors = array();
 
if (isset($_POST['loginUser'])) {
  
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = trim($username);
    $password = trim($password);

    if (empty($username)) {
        array_push($errors, "Enter a username");
    }
    else if (empty($password)) {
        array_push($errors, "Enter a Password");

    }
    else if (!$usr->isUser($username)) {
        array_push($errors, "Invalid Username");
    }
    else{
            $log = $usr->Login($username,$password);
            if($log)
            {
                header("Location:dashboard");
            }
            else{
                array_push($errors, "Invalid Username or Password");
            }
    }
   
}
else{
    array_push($errors, "Username or Password Empty");
}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $favicon; ?>">
    <title>Login</title>
    
    
    <link href="<?php echo $siteurl; ?>/assets/panel/css/style.min.css" rel="stylesheet">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo $login_bg; ?>) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="<?php echo $logo; ?>" alt="logo" /></span>
                        <h5 class="font-medium mb-3">Sign In Account</h5>
                    </div>
                    <?php if ($errors) { 
                                foreach ($errors as $key => $error) {
                                    ?> 
                                    <?php echo "* ".$error; ?>
                                     
                                    <?php
                                } }
                            ?>
                    <div class="row">
                        <div class="col-12">
                            
                            <form class="form-horizontal mt-3" id="loginform" action="" method="POST">



                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="Username or E-mail" name="username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit" name="loginUser">Log In</button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
         
    </div>
 
     <script src="<?php echo $siteurl; ?>/assets/panel/js/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/popper.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/bootstrap.min.js"></script>
    
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    
    </script>
</body>

</html>