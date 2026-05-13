// Event listener untuk mendeteksi scroll di jendela (window)
window.addEventListener('scroll', () => {
  // Mencari elemen <nav> dan menambahkan atau menghapus kelas 'window-scroll' berdasarkan posisi scroll
  document
    .querySelector('nav') // Memilih elemen dengan tag <nav>
    .classList.toggle('window-scroll', window.scrollY > 100); // Menambahkan kelas 'window-scroll' jika posisi scroll lebih dari 100px
});

// Menampilkan dan menyembunyikan jawaban FAQ ketika diklik
const faqs = document.querySelectorAll('.faq'); // Memilih semua elemen dengan kelas 'faq'

faqs.forEach((faq) => { // Untuk setiap elemen dalam daftar FAQ
  faq.addEventListener('click', () => { // Menambahkan event listener untuk event 'click' pada setiap elemen FAQ
    faq.classList.toggle('open'); // Menambahkan atau menghapus kelas 'open' untuk menampilkan/menyembunyikan jawaban

    // Mengubah ikon ketika FAQ diklik
    const icon = faq.querySelector('.faq_icon i'); // Memilih elemen <i> di dalam elemen dengan kelas 'faq_icon'
    if (icon.className === 'uil uil-plus') { // Jika ikon adalah tanda plus
      icon.className = 'uil uil-minus'; // Ganti ikon menjadi tanda minus
    } else {
      icon.className = 'uil uil-plus'; // Jika tidak, ganti kembali ikon menjadi tanda plus
    }
  });
});
