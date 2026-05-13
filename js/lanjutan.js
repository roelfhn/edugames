function selectOption(option) {
    // Fungsi ini menerima parameter "option" yang mewakili pilihan pengguna.
    // Berdasarkan pilihan yang diterima, sistem akan mengeksekusi tindakan berbeda.

    // Gunakan switch-case untuk menangani berbagai opsi yang dipilih pengguna
    switch (option) {
        case 'vokal-suku':
            // Jika pengguna memilih 'vokal-suku', tampilkan pesan alert
            alert("Anda memilih 1 Vokal + 1 Suku Kata");
            // Alert ini bisa diganti dengan tindakan lain, seperti mengarahkan pengguna ke halaman tertentu
            break;
        case 'suku-vokal':
            // Jika pengguna memilih 'suku-vokal', tampilkan pesan alert yang berbeda
            alert("Anda memilih 1 Suku Kata + 1 Vokal");
            break;
        case 'dua-suku':
            // Jika pengguna memilih 'dua-suku', tampilkan pesan alert yang sesuai
            alert("Anda memilih Membaca 2 Suku Kata");
            break;
        default:
            // Bagian default akan dijalankan jika pilihan yang diberikan tidak sesuai dengan kasus yang ada
            break;
    }
}
