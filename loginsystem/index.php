<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Registration and Login</title>

    <!-- ICONSCOUT Icons -->
    <link
        rel="stylesheet"
        href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />

    <style>
        /* General Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #141e3e;
            color: #fff;
        }

        /* Navbar Styling */
        nav {
            background-color: #424890;
            padding: 10px 0;
        }
        .nav_container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .nav_container h4 {
            color: #fff;
        }
        .nav_menu {
            list-style: none;
            display: flex;
            gap: 15px;
        }
        .nav_menu li a {
            color: #fff;
            text-decoration: none;
        }

        /* Content Styling */
        .content {
            text-align: center;
            padding: 50px 20px;
        }

        .content h1 {
            font-size: 40px;
            margin-bottom: 40px;
            color: #ffffff;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-item {
            background-color: #1e293b;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            cursor: pointer;
            text-align: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 500px;
        }

        .menu-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        .menu-item .icon {
            width: 100%;
            height: 250px;
            background-color: #1a1b47;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .menu-item .icon img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .menu-item h3 {
            font-size: 24px;
            color: #ffffff;
            margin: 15px 0;
        }

        .menu-item p {
            font-size: 16px;
            color: #d1d5db;
            margin: 0 20px 20px;
        }

        .menu-item .play-button {
            padding: 10px 20px;
            background-color: #1a1b47;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 10px;
            display: inline-block;
            transition: background-color 0.3s;
            margin-top: auto;
        }

        .menu-item .play-button:hover {
            background-color: #3b82f6;
        }

        /* Footer Styling */
        .footer {
            background-color: #2e3267;
            color: #fff;
            padding: 40px 20px;
            text-align: center;
            margin-top: 50px;
        }

        .footer h4 {
            margin-bottom: 10px;
        }

        .footer p, .footer a {
            color: #ccc;
            text-decoration: none;
        }

        /* Footer Layout */
        .footer_container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer_1, .footer_2, .footer_3, .footer_4 {
            flex: 1 1 200px;
            padding: 10px;
            text-align: left;
        }

        .footer_1 h4, .footer_2 h4, .footer_3 h4, .footer_4 h4 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .footer_2 ul, .footer_3 ul {
            list-style: none;
            padding: 0;
        }

        .footer_2 ul li, .footer_3 ul li {
            margin-bottom: 10px;
        }

        .footer_3 ul li a, .footer_2 ul li p {
            color: #ccc;
            text-decoration: none;
        }

        .footer_socials {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 15px;
            justify-content: left;
        }

        .footer_socials li a {
            color: #ccc;
            font-size: 20px;
            text-decoration: none;
        }

        .footer_socials li a:hover {
            color: #3b82f6;
        }

        .footer_copyrights {
            margin-top: 20px;
            font-size: 14px;
            color: #ccc;
        }

        /* Responsive Footer */
        @media (max-width: 768px) {
            .footer_container {
                flex-direction: column;
                align-items: center;
            }

            .footer_1, .footer_2, .footer_3, .footer_4 {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<!-- Background Music -->
<audio autoplay loop>
    <source src="./music/doodle.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>

    <!-- Main Content -->
    <div class="content">
        <h1>PILIH MENU</h1>
        <div class="menu-container">
            <!-- Registrasi Section -->
            <div class="menu-item">
                <div class="icon">
                    
                </div>
                <h3>Registrasi</h3>
                <p>Buat akun baru dan mulailah petualangan belajar Anda.</p>
                <a href="signup.php" class="play-button">Daftar</a>
            </div>

            <!-- Login Section -->
            <div class="menu-item">
                <div class="icon">
                    
                </div>
                <h3>Login</h3>
                <p>Masuk ke akun Anda dan lanjutkan perjalanan edukasi Anda.</p>
                <a href="login.php" class="play-button">Masuk</a>
            </div>

            <!-- Admin Section -->
            <div class="menu-item">
                <div class="icon">
                    
                </div>
                <h3>Admin</h3>
                <p>Kelola pengguna dan data dengan panel admin yang kuat.</p>
                <a href="admin/index.php" class="play-button">Admin Panel</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer_container">
            <div class="footer_1">
                <a href="index.html" class="footer_logo"><h4>EDUGAMES</h4></a>
                <p>Belajar dan bermain bersama EduGames, solusi edukasi interaktif untuk anak-anak!</p>
            </div>

            <div class="footer_2">
                <h4>Team</h4>
                <ul class="premalinks">
                    <li>Adetya Priatna Putra</li>
                    <li>Ayumi Febrianty</li>
                    <li>Salwa Aulia</li>
                    <li>Salma Nurkamila</li>
                    <li>Syahrul Fahrudin</li>
                </ul>
            </div>

            <div class="footer_3">
                <h4>Shortcut</h4>
                <ul class="privacy">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer_4">
                <h4>Contact Us</h4>
                <div>
                    <p>0857-9551-7549</p>
                    <p>EduGames@gmail.com</p>
                </div>
                <ul class="footer_socials">
                    <li><a href="#"><i class="uil uil-facebook-f"></i></a></li>
                    <li><a href="#"><i class="uil uil-instagram-alt"></i></a></li>
                    <li><a href="#"><i class="uil uil-twitter"></i></a></li>
                    <li><a href="#"><i class="uil uil-linkedin-alt"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="footer_copyrights">
            <small>Copyrights &copy; EduGames</small>
        </div>
    </footer>

    <script src="js/scripts.js"></script>
</body>
</html>
