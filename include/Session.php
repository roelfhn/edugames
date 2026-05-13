<?php 
// Awal tag PHP untuk memulai penulisan skrip PHP.

session_start();
// Memulai sesi untuk memungkinkan penggunaan variabel sesi.
// Ini wajib dipanggil sebelum penggunaan variabel $_SESSION.

function AdminAreaAccess() {
    // Fungsi untuk memeriksa apakah pengguna memiliki akses ke area admin.
    // Jika pengguna belum login (tidak ada 'uid' dalam $_SESSION), mereka akan dialihkan ke halaman login.
    
    if (!isset($_SESSION['uid'])) {
        // Mengecek apakah $_SESSION['uid'] belum diatur, yang berarti pengguna belum login.
        
        header('location: ../login.php');
        // Mengarahkan pengguna ke halaman login jika tidak ada 'uid'.
    }
}

function ErrorMessage() {
    // Fungsi untuk menampilkan pesan error yang disimpan dalam sesi.
    // Pesan ini sering digunakan untuk menampilkan notifikasi kesalahan di antarmuka pengguna.

    if (isset($_SESSION['ErrorMessage'])) {
        // Mengecek apakah ada pesan error yang disimpan di $_SESSION['ErrorMessage'].

        $Output = "<div class=\"alert alert-danger\">";
        // Membuka elemen HTML untuk menampilkan pesan error dengan gaya "alert-danger" (biasanya dari Bootstrap).

        $Output .= htmlentities($_SESSION['ErrorMessage']);
        // Menambahkan isi dari pesan error. htmlentities() digunakan untuk mencegah XSS dengan mengonversi karakter khusus menjadi entitas HTML.

        $Output .= "</div>";
        // Menutup elemen div.

        $_SESSION['ErrorMessage'] = null;
        // Menghapus pesan error dari $_SESSION setelah ditampilkan, untuk mencegah pesan ditampilkan kembali di refresh berikutnya.

        return $Output;
        // Mengembalikan elemen HTML lengkap untuk ditampilkan di antarmuka pengguna.
    }
}

function SuccessMessage() {
    // Fungsi untuk menampilkan pesan sukses yang disimpan dalam sesi.
    // Pesan ini sering digunakan untuk notifikasi keberhasilan proses tertentu.

    if (isset($_SESSION['SuccessMessage'])) {
        // Mengecek apakah ada pesan sukses yang disimpan di $_SESSION['SuccessMessage'].

        $Output = "<div class=\"alert alert-success\">";
        // Membuka elemen HTML untuk menampilkan pesan sukses dengan gaya "alert-success" (biasanya dari Bootstrap).

        $Output .= htmlentities($_SESSION['SuccessMessage']);
        // Menambahkan isi dari pesan sukses. htmlentities() digunakan untuk mencegah XSS dengan mengonversi karakter khusus menjadi entitas HTML.

        $Output .= "</div>";
        // Menutup elemen div.

        $_SESSION['SuccessMessage'] = null;
        // Menghapus pesan sukses dari $_SESSION setelah ditampilkan, untuk mencegah pesan ditampilkan kembali di refresh berikutnya.

        return $Output;
        // Mengembalikan elemen HTML lengkap untuk ditampilkan di antarmuka pengguna.
    }
}
?>
// Akhir tag PHP untuk menutup skrip PHP.
