<?php
include '../config.php';
if(!$usr->getSession())
{
   header("Location:".$siteurl."/login");
}
 $pageName = "Dashboard";
if($usr->isAdmin($usr->getSession())){ $pageName = "Welcome to Admin Panel";}
if($usr->isStaff($usr->getSession())){ $pageName = "Welcome to User Panel You are logged in as ".$usr->display_name();}


 if (isset($_GET['action'])) {
        $action = $_GET['action'];
     if ($action == "categories") {
         $pageName = "Categories";
     }else if ($action == "brands") {
         $pageName = "Brands";
     }else if ($action == "users") {
         $pageName = "Users";
     }else if ($action == "update-password") {
         $pageName = "Update Password";
     }else if ($action == "add-category") {
            $pageName = "Insert Category";
        }else if ($action == "add-brand") {
            $pageName = "Insert Brand";
        }else if ($action == "add-user") {
            $pageName = "Create New User";
        }
        else if ($action == "profile") {
            $pageName = "Manage Profile";
        }
        else if ($action == "staff-registration") {
           $pageName = "Staff Registration";
        }
        else if ($action == "add-item") {
           $pageName = "Add Your New Item";
        }
        else if ($action == "upddate-item") {
           $pageName = "Update Your New Item";
        }
        else if ($action == "delete-item") {
           $pageName = "Delete Your New Item";
        }
        else if ($action == "stock-report") {
           $pageName = "EFSI STOCK REPORT";
        }
        else if ($action == "sales-report") {
            $pageName = "EFSI SALES REPORT";
        }else if ($action == "reports") {
            $pageName = "REPORTS MENU";
        }else if ($action == "new-sales") {
            $pageName = "NEW SALES";
        }else if ($action == "customer-service") {
            $pageName = "CUSTOMER SERVICE";
        }
 }
           
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $favicon; ?>">
    <title><?PHP echo $pageName; ?></title>
    
    <!-- needed css -->
    <link href="<?php echo $siteurl; ?>/assets/panel/css/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo $siteurl; ?>/assets/panel/css/steps.css" rel="stylesheet">

    <link href="<?php echo $siteurl; ?>/assets/panel/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?php echo $siteurl; ?>/assets/panel/css/summernote-bs4.css" rel="stylesheet">
    <link href="<?php echo $siteurl; ?>/assets/panel/css/style.min.css" rel="stylesheet">
    <link href="<?php echo $siteurl; ?>/assets/panel/css/bootstrap-formhelpers.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header border-right">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="<?php echo $siteurl; ?>/dashboard">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo $favicon; ?>" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo $favicon; ?>" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                         
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-18"></i></a></li> 
                         
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php if(!empty($usr->avatar())){ echo $siteurl."/content/uploads/profiles/".$usr->avatar(); }else {echo $siteurl."/content/uploads/profiles/avatar.png"; } ?>" class="rounded-circle" width="36">
                                <span class="ml-2 font-medium"><?php echo $usr->display_name(); ?></span><span class="fas fa-angle-down ml-2"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="<?php if(!empty($usr->avatar())){ echo $siteurl."/content/uploads/profiles/".$usr->avatar(); }else {echo $siteurl."/content/uploads/profiles/avatar.png"; } ?>" alt="<?php echo $usr->display_name(); ?>" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0"><?php echo $usr->display_name(); ?></h4>
                                        <a href="<?php echo $siteurl; ?>/dashboard/profile" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="<?php echo $siteurl; ?>/dashboard/profile/edit"><i class="ti-user mr-1 ml-1"></i>Edit Profile</a>
                                 
                                <?php if($usr->isAdmin($usr->getSession())){ ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $siteurl; ?>/dashboard/update-password"><i class="icon-lock-open mr-1 ml-1"></i>Update Password</a>
                                <?php } ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $siteurl; ?>/logout"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard" aria-expanded="false">
                                <i class="mdi mdi-av-timer"></i>
                                <span class="hide-menu">Dashboard</span> 
                            </a>
                        </li>
                        <?php if($usr->isAdmin($usr->getSession())){ ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <i class="mdi mdi-content-copy"></i>
                                <span class="hide-menu">Manage Stock</span> 
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/add-item" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu">Add Item</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/update-item" class="sidebar-link">
                                        <i class="mdi mdi-calendar"></i>
                                        <span class="hide-menu">Update Item</span>
                                    </a>
                                </li>
                                
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/delete-item" class="sidebar-link">
                                        <i class="mdi mdi-calendar"></i>
                                        <span class="hide-menu">Delete Item</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/stock-report" class="sidebar-link">
                                        <i class="mdi mdi-calendar"></i>
                                        <span class="hide-menu">Stock Report</span>
                                    </a>
                                </li> 
                                 
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard/categories" aria-expanded="false">
                                <i class="mdi mdi-buffer"></i>
                                <span class="hide-menu">Category</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/categories" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu">All Categories</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/add-category" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu">Add Category </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard/brands" aria-expanded="false">
                                <i class="mdi mdi-arrange-bring-forward"></i>
                                <span class="hide-menu">Brands</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/brands" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu">All Brands </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="<?php echo $siteurl; ?>/dashboard/add-brand" class="sidebar-link">
                                        <i class="mdi mdi-comment-processing-outline"></i>
                                        <span class="hide-menu">Add Brand </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard/sales-report" aria-expanded="false">
                                <i class="mdi mdi-bulletin-board"></i>
                                <span class="hide-menu">Sales Report</span>
                            </a>
                             
                        </li>
                         
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard/staff-registration" aria-expanded="false">
                               <i class="icon-user"></i>
                                <span class="hide-menu">Staff Registration</span>
                            </a>
                             
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="<?php echo $siteurl; ?>/dashboard/users" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">Users</span>
                            </a>
                             
                        </li>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siteurl; ?>/dashboard/update-password" aria-expanded="false">
                                <i class="icon-lock-open mr-1 ml-1"></i>
                                <span class="hide-menu">Update Password</span>
                            </a>
                        </li>
                          <?php } ?>
                          <?php if ($usr->isStaff($usr->getSession())) { ?>

                            <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siteurl; ?>/dashboard/new-sales" aria-expanded="false">
                               <i class="ti-shopping-cart"></i>
                                <span class="hide-menu">New Sales</span>
                            </a>
                            </li>
                            <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siteurl; ?>/dashboard/customer-service" aria-expanded="false">
                                <i class="ti-headphone-alt mr-1 ml-1"></i>
                                <span class="hide-menu">Customer Service</span>
                            </a>
                            </li>
                            <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siteurl; ?>/dashboard/reports" aria-expanded="false">
                                <i class="mdi mdi-bulletin-board"></i>
                                <span class="hide-menu">Reports</span>
                            </a>
                            </li>

                          <?php } ?>
                        <div class="devider"></div>
                        
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo $siteurl; ?>/logout" aria-expanded="false">
                                <i class="fa fa-power-off mr-1 ml-1"></i>
                                <span class="hide-menu">Log Out</span>
                            </a>
                        </li>
                         
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <?php if (isset($_GET['action'])) {
                ?>

            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0"><?php echo $pageName; ?></h5>
                    </div>
                     
                </div>
            </div>
             
            <div class="page-content container-fluid">
                 
            <?php   }
            else{ ?>

            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0"><?php echo $pageName; ?></h5>
                    </div>
                     
                </div>
            </div>
             
            <div class="page-content container-fluid">
            <?php } ?>
                <?php if (!isset($_GET['action'])) { ?>
                 <?php include 'inc/dash.php'; ?>

                 <!-- APPS OPERATIONS -->
                 <?php }else {

                    if($usr->isAdmin($usr->getSession())){

                if($_GET['action'] == "add-item"){ ?>
                    <?php include 'inc/add-item.php'; ?>
                <?php }else if($_GET['action'] == "update-item"){ ?>
                    <?php include 'inc/update-item.php'; ?>
                <?php }else if($_GET['action'] == "delete-item"){ ?>
                    <?php include 'inc/delete-item.php'; ?>
                <?php }else if($_GET['action'] == "stock-report"){ ?>
                    <?php include 'inc/stock-report.php'; ?>
                <?php }else if($_GET['action'] == "sales-report"){ ?>
                    <?php include 'inc/sales-report.php'; ?>
                <?php }else if($_GET['action'] == "add-version-variants"){ ?>
                    <?php include 'inc/add-version-variants.php'; ?>
                <?php }else if($_GET['action'] == "add-version-variant"){ ?>
                    <?php include 'inc/add-version-variant.php'; ?>


                <!-- END APPS OPERATIONS -->


                <?php }else if($_GET['action'] == "categories"){ ?>
                    <?php include 'inc/categories.php'; ?>
                <?php }else if($_GET['action'] == "staff-registration"){ ?>
                    <?php include 'inc/staff-registration.php'; ?>
                <?php }else if($_GET['action'] == "add-category"){ ?>
                    <?php include 'inc/add-category.php'; ?>
                <?php }else if($_GET['action'] == "update-password"){ 
                 include 'inc/update-password.php'; 
                ?>


                <!-- END CATEGORIES OPERATIONS -->
                <?php }else if($_GET['action'] == "brands"){ ?>
                    <?php include 'inc/brands.php'; ?>
                <?php }else if($_GET['action'] == "add-brand"){ ?>
                    <?php include 'inc/add-brand.php'; ?>

                <!-- END DEV OPERATIONS -->

                <?php }else if($_GET['action'] == "users"){ 
                    if(!isset($_GET['subaction'])){
                ?>
                    <?php include 'inc/users.php'; }else if($_GET['subaction'] == "add-new"){ include 'inc/add-new-user.php'; } ?>

                <?php }else if($_GET['action'] != "update-password" && $_GET['action'] != "profile"){ ?>
                    <div class="row card align-items-center">
                        <div class="card-body">
                                <h3>No Action Found</h3>
                                <p>Please select an correct action</p>
                        </div>
                    </div>
                <?php } ?>


                <!-- Staff Controls -->

                <?php }elseif ($usr->isStaff($usr->getSession())) { ?>

                    <?php if ($_GET['action'] == "new-sales") { 
                        include 'inc/new-sales.php';
                    }elseif ($_GET['action'] == "customer-service") {
                        include 'inc/customer-service.php';
                    }elseif ($_GET['action'] == "reports") {
                        include 'inc/reports.php';
                    }else if($action != "profile"){ ?>
                        <div class="row card align-items-center">
                        <div class="card-body">
                                <h3>No Action Found</h3>
                                <p>Invalid action!</p>
                        </div>
                        </div>
                    <?php } ?>
                     
                <?php }else if($_GET['action'] != "profile"){ ?>
                    <div class="row card align-items-center">
                        <div class="card-body">
                                <h3>No Permissions</h3>
                                <p>You don't have permissions for this action</p>
                        </div>
                    </div>
                <?php  }  ?>

                <?php 
                if($_GET['action'] == "profile"){ 
                 include 'inc/profile.php';
                } ?>

                <?php } ?>


            <?php 
            if (isset($_GET['action'])) {
                  
            ?>   
            </div>
            <?php  }else{
                ?>
            </div>
                <?php
            } ?>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                <?php echo $sitename." ".date("Y"); ?>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    
     <script src="<?php echo $siteurl; ?>/assets/panel/js/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/popper.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/bootstrap.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/bootstrap-formhelpers.min.js"></script>
    <!-- apps -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/app.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/app.init.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/sparkline.js"></script>
    <!--Wave Effects -->
     <script src="<?php echo $siteurl; ?>/assets/panel/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/datatable-basic.init.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo $siteurl; ?>/assets/panel/js/custom.min.js"></script>
    <script src="<?php echo $siteurl; ?>/assets/panel/js/form-actions.js"></script>
     
</body>

</html>
