<?php 
// Memulai sesi PHP
session_start();

// Menyertakan file konfigurasi database
include_once('includes/config.php');

// Mengecek apakah sesi pengguna aktif atau tidak
if (strlen($_SESSION['id']==0)) {
    // Jika sesi tidak aktif, pengguna akan diarahkan ke halaman logout
    header('location:logout.php');
} else {

// Logika untuk memperbarui profil pengguna
if(isset($_POST['update'])) // Mengecek apakah tombol update telah ditekan
{
    $fname=$_POST['fname']; // Menangkap data nama depan
    $lname=$_POST['lname']; // Menangkap data nama belakang
    $contact=$_POST['contact']; // Menangkap data kontak
    $userid=$_SESSION['id']; // Mendapatkan ID pengguna dari sesi

    // Query untuk memperbarui data pengguna di database
    $msg=mysqli_query($con,"update users set fname='$fname',lname='$lname',contactno='$contact' where id='$userid'");

    // Jika query berhasil dijalankan
    if($msg) {
        echo "<script>alert('Profil berhasil diperbarui');</script>"; // Menampilkan notifikasi
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>"; // Mengarahkan ulang ke halaman profil
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Metadata dasar untuk HTML -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <!-- Judul halaman -->
        <title>Edit Profil | Sistem Registrasi dan Login</title>

        <!-- Menyertakan CSS eksternal -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

        <!-- Menyertakan ikon FontAwesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <style>
            /* Gaya latar belakang */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Montserrat', sans-serif;
                background: linear-gradient(to right, #141e3e,rgb(4, 46, 116));
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
        <!-- Menyertakan navbar dari file eksternal -->
        <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
            <!-- Menyertakan sidebar dari file eksternal -->
            <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
<?php 
// Mendapatkan data pengguna berdasarkan ID sesi
$userid=$_SESSION['id'];
$query=mysqli_query($con,"select * from users where id='$userid'");
while($result=mysqli_fetch_array($query))
{?>
                        <!-- Menampilkan nama pengguna di header halaman -->
                        <h1 class="mt-4">Profil <?php echo $result['fname'];?> </h1>
                        <div class="card mb-4">
                            <form method="post"> <!-- Form untuk memperbarui profil -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama Depan</th>
                                            <td><input class="form-control" id="fname" name="fname" type="text" value="<?php echo $result['fname'];?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Nama Belakang</th>
                                            <td><input class="form-control" id="lname" name="lname" type="text" value="<?php echo $result['lname'];?>" required /></td>
                                        </tr>
                                        <tr>
                                            <th>No. Kontak</th>
                                            <td colspan="3"><input class="form-control" id="contact" name="contact" type="text" value="<?php echo $result['contactno'];?>" pattern="[0-9]{10}" title="10 karakter numerik saja" maxlength="10" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td colspan="3"><?php echo $result['email'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Registrasi</th>
                                            <td colspan="3"><?php echo $result['posting_date'];?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align:center;">
                                                <button type="submit" class="btn btn-primary btn-block" name="update">Perbarui</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
<?php } ?>
                    </div>
                </main>
            </div>
        </div>
        <!-- Menyertakan skrip JavaScript eksternal -->
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
