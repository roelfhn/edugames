<?php 
session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard | Daftar dan Login</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            /* Background Styling */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Montserrat', sans-serif;
                background: linear-gradient(to right, #141e3e,rgb(37, 50, 194));
                color: #fff;
                min-height: 100vh;
            }

            .container-fluid {
                margin-top: 50px;
                margin-bottom: 50px;
            }

            .card {
                background: rgba(255, 255, 255, 0.9);
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                color: #000;
            }

            .card-header {
                background-color: #2563eb;
                color: #fff;
                text-align: center;
                padding: 20px;
            }

            .btn-primary {
                background-color: #2563eb;
                border: none;
            }

            .btn-primary:hover {
                background-color: #1e40af;
            }

            .breadcrumb {
                background: none;
                color: #fff;
            }

            .breadcrumb-item a {
                color: #fff;
            }

            .breadcrumb-item.active {
                color: #2563eb;
            }

            /* Style for the "Welcome Back" container */
            .welcome-card {
                width: 100%;
                max-width: 500px;
                margin: 0 auto; /* Centering the card */
                border-radius: 15px;
                background-color:rgb(255, 255, 255);
                color: #000;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .welcome-card .card-body {
                text-align: center;
                padding: 30px;
                font-size: 18px;
            }

            .welcome-card .card-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                background-color: #2563eb;
            }

            .welcome-card .card-footer a {
                color: #fff;
                text-decoration: none;
                font-weight: bold;
            }

            .welcome-card .card-footer a:hover {
                color: #e0e0e0;
            }

        </style>
    </head>
    <body class="sb-nav-fixed">
        <?php include_once('includes/navbar.php'); ?>
        <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <hr />
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <?php 
                        $userid=$_SESSION['id'];
                        $query=mysqli_query($con,"select * from users where id='$userid'");
                        while($result=mysqli_fetch_array($query)) {?>                        
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="card welcome-card mb-4">
                                        <div class="card-body">
                                            Welcome Back <?php echo $result['fname']." ".$result['lname']; ?>
                                        </div>
                                        <div class="card-footer">
                                            <a class="small text-white stretched-link" href="profile.php">View Profile</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
