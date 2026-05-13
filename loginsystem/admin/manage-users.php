<?php 
session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
} else{
    // for deleting user
    if(isset($_GET['id'])){
        $adminid=$_GET['id'];
        $msg=mysqli_query($con,"delete from users where id='$adminid'");
        if($msg){
            echo "<script>alert('Data deleted');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manage Users | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            /* Styling for background */
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background: linear-gradient(to right, #141e3e, #3b82f6);
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

            .btn-view-details {
                background-color: #2563eb;
                border: none;
                padding: 8px 16px;
                color: white;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
            }

            .btn-view-details:hover {
                background-color: #1e40af;
                text-decoration: none;
            }

            .table th, .table td {
                padding: 15px;
                text-align: left;
            }

            .table-bordered {
                border: 1px solid #ddd;
                border-radius: 5px;
                width: 100%;
                margin-top: 20px;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Users</li>
                        </ol>
            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Registered User Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Id</th>
                                            <th>Contact no.</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Id</th>
                                            <th>Contact no.</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        $ret=mysqli_query($con,"select * from users");
                                        $cnt=1;
                                        while($row=mysqli_fetch_array($ret)){
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo $row['fname'];?></td>
                                            <td><?php echo $row['lname'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['contactno'];?></td>
                                            <td><?php echo $row['posting_date'];?></td>
                                            <td>
                                                <a href="user-profile.php?uid=<?php echo $row['id'];?>"> 
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="manage-users.php?id=<?php echo $row['id'];?>" onClick="return confirm('Do you really want to delete');">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $cnt=$cnt+1; 
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
