<?php
// Menyertakan file konfigurasi
include('includes/config.php');

// Menggunakan namespace untuk PHPMailer
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

// Memuat autoloader dari Composer
require 'vendor/autoload.php';

// Membuat instance PHPMailer
$mail = new PHPMailer;

// Mengecek apakah tombol 'send' ditekan
if(isset($_POST['send'])) {

    // Mengambil email yang dimasukkan pengguna
    $femail = $_POST['femail'];

    // Melakukan query untuk mencari pengguna berdasarkan email
    $row1 = mysqli_query($con, "SELECT email, password, fname FROM users WHERE email='$femail'");
    $row2 = mysqli_fetch_array($row1);

    if ($row2 > 0) {
        // Data ditemukan, mempersiapkan pengiriman email
        $toemail = $row2['email'];
        $fname = $row2['fname'];
        $subject = "Information about your password";
        $password = $row2['password'];
        $message = "Your password is " . $password;

        // Konfigurasi SMTP
        $mail->isSMTP();                            // Mengatur mailer untuk menggunakan SMTP
        $mail->Host = 'smtp.gmail.com';             // Server SMTP utama dan cadangan
        $mail->SMTPAuth = true;                     // Mengaktifkan otentikasi SMTP
        $mail->Username = 'your gmail id here';     // Username SMTP (ganti dengan email Anda)
        $mail->Password = 'your gmail password here'; // Password SMTP (ganti dengan password Anda)
        $mail->SMTPSecure = 'tls';                  // Mengaktifkan enkripsi TLS
        $mail->Port = 587;                          // Port TCP untuk koneksi SMTP

        // Mengatur pengirim dan penerima
        $mail->setFrom('your gmail id here', 'your name here'); // Alamat email pengirim
        $mail->addAddress($toemail);               // Alamat email penerima

        // Mengatur format email ke HTML
        $mail->isHTML(true);
        $bodyContent = 'Dear ' . $fname;
        $bodyContent .= '<p>' . $message . '</p>';
        $mail->Subject = $subject;
        $mail->Body = $bodyContent;

        // Mengirim email dan memberikan respon ke pengguna
        if (!$mail->send()) {
            echo "<script>alert('Message could not be sent');</script>";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('Your Password has been sent Successfully');</script>";
        }

    } else {
        // Jika email tidak ditemukan dalam database
        echo "<script>alert('Email not registered with us');</script>";
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
    <title>Password Reset | Registration and Login System</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h2 align="center">Registration and Login System</h2>
                                    <hr />
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter your email address and we will send you your password</div>
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="femail" type="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="login.php">Return to login</a>
                                            <button class="btn btn-primary" type="submit" name="send">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                    <div class="small"><a href="index.php">Back to Home</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include('includes/footer.php'); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
