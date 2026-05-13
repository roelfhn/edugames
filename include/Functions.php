<?php 
// Awal tag PHP untuk memulai penulisan skrip PHP

function Redirect_to($new_location) {
    // Deklarasi sebuah fungsi bernama Redirect_to yang menerima satu parameter ($new_location).
    // Fungsi ini digunakan untuk mengarahkan pengguna ke URL atau lokasi baru.
    
    header("Location:".$new_location);
    // Fungsi header() mengirimkan header HTTP ke browser.
    // Di sini digunakan untuk mengatur header "Location" agar browser mengarahkan pengguna ke lokasi yang diberikan dalam parameter $new_location.
    // Operator penggabungan (.) digunakan untuk menambahkan nilai $new_location ke "Location:".

    exit;
    // Fungsi exit() digunakan untuk menghentikan eksekusi skrip setelah pengalihan dilakukan.
    // Hal ini mencegah kode berikutnya di file dieksekusi setelah pengalihan.
}
?>
// Akhir tag PHP untuk menutup skrip PHP.
