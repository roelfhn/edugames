<?php 
// Memulai sesi untuk melacak status pengguna (apakah pengguna sedang login atau tidak)
session_start(); 

// Menyertakan file konfigurasi yang berisi pengaturan penting seperti koneksi database atau pengaturan lainnya
include_once('includes/config.php'); 

// Mengecek apakah session 'id' kosong atau tidak diset
// Jika kosong (misalnya pengguna belum login), arahkan ke halaman logout.php
if (strlen($_SESSION['id']==0)) { 
    // Pengguna tidak memiliki session ID yang valid, maka diarahkan ke logout.php
    header('location:logout.php'); 
} else { 
    // Jika session 'id' ada, berarti pengguna sudah login dan dapat melanjutkan
    // Proses pembaruan password jika pengguna mengirimkan form
    if(isset($_POST['update'])) 
    {
        // Mendapatkan nilai dari form yang dikirimkan
        $oldpassword = $_POST['currentpassword']; 
        $newpassword = $_POST['newpassword']; 

        // Mengecek apakah password lama sesuai dengan yang ada di database
        $sql = mysqli_query($con, "SELECT password FROM users WHERE password='$oldpassword'");
        $num = mysqli_fetch_array($sql); 

        // Jika password lama ditemukan (benar)
        if($num > 0) 
        {
            // Mendapatkan ID pengguna dari session untuk memperbarui password
            $userid = $_SESSION['id']; 
            // Melakukan pembaruan password di database
            $ret = mysqli_query($con, "UPDATE users SET password='$newpassword' WHERE id='$userid'"); 

            // Menampilkan pesan sukses dan mengarahkan kembali ke halaman perubahan password
            echo "<script>alert('Password Changed Successfully !!');</script>"; 
            echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>"; 
        }
        else 
        {
            // Jika password lama tidak cocok, menampilkan pesan kesalahan
            echo "<script>alert('Old Password not match !!');</script>"; 
            echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>"; 
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
        <title>Change password | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script language="javascript" type="text/javascript">
        function valid()
        {
            if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match  !!");
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }
        </script>
        <style>
            /* Background Styling */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Montserrat', sans-serif;
                background: linear-gradient(to right, #141e3e,rgb(6, 39, 92));
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

            .table th, .table td {
                padding: 15px;
                text-align: left;
            }

            a {
                color: #2563eb;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
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
                        <h1 class="mt-4">Change Password</h1>
                        <div class="card mb-4">
                            <form method="post" name="changepassword" onSubmit="return valid();">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Current Password</th>
                                            <td><input class="form-control" id="currentpassword" name="currentpassword" type="password" value="" required /></td>
                                        </tr>
                                        <tr>
                                            <th>New Password</th>
                                            <td><input class="form-control" id="newpassword" name="newpassword" type="password" value="" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Confirm Password</th>
                                            <td colspan="3"><input class="form-control" id="confirmpassword" name="confirmpassword" type="password" required /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align:center;">
                                                <button type="submit" class="btn btn-primary btn-block" name="update">Change</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
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
