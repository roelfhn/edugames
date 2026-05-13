<?php 
// Memulai sesi untuk melacak status pengguna
session_start();

// Menyertakan file konfigurasi untuk pengaturan yang diperlukan (misalnya koneksi database)
require_once('includes/config.php');

// Proses Registrasi Pengguna
if(isset($_POST['submit'])) 
{
    // Mengambil data yang dikirimkan melalui form
    $fname = $_POST['fname']; // Nama depan pengguna
    $lname = $_POST['lname']; // Nama belakang pengguna
    $email = $_POST['email']; // Email pengguna
    $password = $_POST['password']; // Password pengguna
    $contact = $_POST['contact']; // Nomor kontak pengguna

    // Mengecek apakah email sudah terdaftar di database
    $sql = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
    $row = mysqli_num_rows($sql); // Menghitung jumlah baris hasil query

    // Jika email sudah ada, tampilkan pesan kesalahan
    if($row > 0) 
    {
        echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
    } 
    else 
    {
        // Jika email belum terdaftar, masukkan data pengguna ke dalam database
        $msg = mysqli_query($con, "INSERT INTO users(fname, lname, email, password, contactno) VALUES('$fname', '$lname', '$email', '$password', '$contact')");

        // Jika berhasil memasukkan data, tampilkan pesan sukses dan arahkan pengguna ke halaman login
        if($msg) 
        {
            echo "<script>alert('Registered successfully');</script>";
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
        }
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
        <title>User Signup | Registration and Login System</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            /* Background Styling */
            body {
                margin: 0;
                padding: 0;
                font-family: 'Montserrat', sans-serif;
                background: linear-gradient(to right, #141e3e,rgb(49, 47, 181));
                color: #fff;
                min-height: 100vh;
            }

            .container {
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
                background-color: #141e3e;
                color: #fff;
                text-align: center;
                padding: 20px;
            }

            .btn-primary {
                background-color: #141e3e;
                border: none;
            }

            .btn-primary:hover {
                background-color: #141e3e;
            }
        </style>
        <script type="text/javascript">
            function checkpass() {
                if (document.signup.password.value != document.signup.confirmpassword.value) {
                    alert('Password and Confirm Password field does not match');
                    document.signup.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <b><h2 align="center">Daftar Sekarang</h2></b>
                                       </div>
                                    <div class="card-body">
                                        <form method="post" name="signup" onsubmit="return checkpass();">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="fname" name="fname" type="text" placeholder="Enter your first name" required />
                                                        <label for="fname">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="lname" name="lname" type="text" placeholder="Enter your last name" required />
                                                        <label for="lname">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" name="email" type="email" placeholder="edugames@gmail.com" required />
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="contact" name="contact" type="text" placeholder="1234567890" required pattern="[0-9]{10}" title="10 numeric characters only" maxlength="10" />
                                                <label for="contact">Parent Number</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                <input 
                                                    class="form-control" 
                                                    id="password" 
                                                    name="password" 
                                                    type="password" 
                                                    placeholder="Create a password" 
                                                    required 
                                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" 
                                                    title="Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character." 
                                                />
                                                <label for="password">Password</label>
                                            </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm password" required />
                                                        <label for="confirmpassword">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block" name="submit">Create Account</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                        <div class="small"><a href="index.php">Back to Home</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
