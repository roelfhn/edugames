// Mengambil elemen-elemen DOM untuk opsi jawaban dan audio
const option1 = document.getElementById("option1"),
      option2 = document.getElementById("option2"),
      option3 = document.getElementById("option3"),
      audioWrong = new Audio("./music/wrong.mp3"),  // Membuat objek Audio untuk suara salah
    audioCorrect = new Audio("./music/true.mp3"),  // Membuat objek Audio untuk suara benar
      alarmSound = new Audio("./music/notif.mp3");  // Menambahkan suara alarm untuk waktu habis
      timeRemainingElement = document.getElementById("time-remaining"); // Elemen untuk menampilkan waktu yang tersisa

let points = 0; // Variabel untuk menyimpan poin pemain
let answer = 0; // Variabel untuk menyimpan jawaban yang benar
let questionCount = 0; // Variabel untuk menghitung jumlah pertanyaan yang telah dijawab
const maxQuestions = 10; // Maksimal jumlah pertanyaan per game
const kkm = 70; // Nilai ambang batas kelulusan (KKM)
let timer; // Variabel untuk menyimpan timer interval
let totalTime = 5 * 60; // Total waktu permainan dalam detik (5 menit)

// Fungsi untuk memperbarui tampilan poin
function updatePoints() {
    document.querySelector(".points").textContent = `Points: ${points}`; // Menampilkan poin saat ini
}

// Fungsi untuk memulai timer  
function startTimer() {
    updateTimerDisplay();  // Memperbarui tampilan waktu sebelum timer mulai
    timer = setInterval(() => {  // Menjalankan interval setiap 1 detik
        totalTime--;  // Mengurangi total waktu setiap detik
        if (totalTime <= 0) {  // Jika waktu habis
            clearInterval(timer);  // Menghentikan timer
            alarmSound.play();  // Memainkan alarm saat waktu habis
            showFinalScore(true);  // Menampilkan hasil akhir dengan indikator waktu habis
        }
        updateTimerDisplay();  // Memperbarui tampilan waktu setiap detik
    }, 1000);  // Interval 1 detik
}

// Fungsi untuk memperbarui tampilan timer
function updateTimerDisplay() {
    const minutes = Math.floor(totalTime / 60); // Menghitung menit
    const seconds = totalTime % 60; // Menghitung detik
    timeRemainingElement.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`; // Menampilkan waktu dalam format MM:SS
}

// Fungsi untuk menampilkan skor akhir dan status kelulusan
function showFinalScore(isTimeUp = false) {
    clearInterval(timer); // Hentikan timer setelah permainan selesai

    const modal = document.getElementById("notification-modal"); // Modal untuk menampilkan skor akhir
    const modalBody = document.getElementById("modal-body"); // Bagian dalam modal untuk menampilkan pesan
    const status = points >= kkm ? "Lulus" : "Tidak Lulus"; // Menentukan status kelulusan
    const statusColor = points >= kkm ? "green" : "red"; // Menentukan warna status kelulusan
    const timeUpColor = isTimeUp ? "orange" : "orange"; // Menentukan warna jika waktu habis (meskipun sama di sini)

    // Mengatur konten dalam modal
    modalBody.innerHTML = `
        <h4 style="color: ${timeUpColor};">${isTimeUp ? "Time's Up!" : "Game Over!"}</h4> <!-- Pesan ketika waktu habis atau permainan selesai -->
        <p>Final Score: <strong>${points}</strong></p> <!-- Menampilkan skor akhir -->
        <p>Status: <strong style="color: ${statusColor};">${status}</strong></p> <!-- Menampilkan status kelulusan -->
        <div class="action-buttons">
            ${
                points >= kkm
                    ? '<button id="next-level" class="btn btn-success">Next Level 3</button>' // Tombol untuk melanjutkan ke level 3 jika lulus
                    : '<button id="retry" class="btn btn-danger">Try Again</button>' // Tombol untuk mencoba lagi jika tidak lulus
            }
        </div>
    `;

    // Menampilkan modal
    modal.style.display = "block";

    // Menambahkan event listener untuk tombol di dalam modal
    if (points >= kkm) {
        document.getElementById("next-level").addEventListener("click", () => {
            window.location.href = "multiply.html"; // Arahkan ke halaman level 3 jika lulus
        });
    } else {
        document.getElementById("retry").addEventListener("click", () => {
            modal.style.display = "none"; // Menyembunyikan modal
            resetGame(); // Reset permainan jika memilih coba lagi
        });
    }

// Event untuk menutup modal saat tombol close diklik
    document.getElementById("close-modal").onclick = function () {
        modal.style.display = "none"; // Menyembunyikan modal
    };

    // Menutup modal jika mengklik area luar modal
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Menyembunyikan modal jika klik di luar modal
        }
    };
}

// Fungsi untuk menghasilkan soal pengurangan
function generate_equation() {
    if (questionCount >= maxQuestions) { // Jika jumlah pertanyaan sudah mencapai batas
        showFinalScore(); // Tampilkan skor akhir
        return;
    }

    const num1 = Math.floor(Math.random() * 13), // Angka pertama 
          num2 = Math.floor(Math.random() * 9), // Angka kedua 
          dummyAnswer1 = Math.floor(Math.random() * 20), // Jawaban palsu pertama
          dummyAnswer2 = Math.floor(Math.random() * 20), // Jawaban palsu kedua
          allAnswers = [], // Array untuk menampung semua jawaban
          switchAnswers = []; // Array untuk menyusun ulang jawaban

    // Menghitung jawaban pengurangan
    answer = num1 - num2;
    // Menampilkan angka di halaman
    document.getElementById("num1").innerHTML = num1;
    document.getElementById("num2").innerHTML = num2;

    allAnswers.push(answer, dummyAnswer1, dummyAnswer2); // Menambahkan jawaban yang benar dan palsu ke array

    // Mengacak urutan jawaban
    for (let i = allAnswers.length; i--;) {
        switchAnswers.push(allAnswers.splice(Math.floor(Math.random() * (i + 1)), 1)[0]);
    }

// Memperbarui opsi jawaban yang ditampilkan di halaman dengan mengisi elemen jawaban (option1, option2, option3) 
option1.innerHTML = switchAnswers[0]; // Mengatur opsi pertama dengan jawaban acak pertama
option2.innerHTML = switchAnswers[1]; // Mengatur opsi kedua dengan jawaban acak kedua
option3.innerHTML = switchAnswers[2]; // Mengatur opsi ketiga dengan jawaban acak ketiga
}

// Fungsi untuk menangani pilihan jawaban
function handleAnswer(selectedOption) {
    if (questionCount >= maxQuestions) return; // Jika jumlah pertanyaan sudah mencapai batas, keluar

    if (parseInt(selectedOption.innerHTML) === answer) { // Jika jawaban yang dipilih benar
        points += 10; // Tambah poin
        audioCorrect.play(); // Putar audio jawaban benar
    } else {
        audioWrong.play(); // Putar audio jawaban salah
    }
    
    questionCount++; // Tambah jumlah pertanyaan yang telah dijawab
    updatePoints(); // Memperbarui tampilan poin

    if (questionCount >= maxQuestions) { // Jika sudah mencapai jumlah pertanyaan maksimal
        showFinalScore(); // Tampilkan skor akhir
    } else {
        generate_equation(); // Jika belum, generate soal berikutnya
    }
}

// Menambahkan event listener untuk opsi jawaban
option1.addEventListener("click", function () {
    handleAnswer(option1); // Menangani jawaban ketika opsi 1 dipilih
});
option2.addEventListener("click", function () {
    handleAnswer(option2); // Menangani jawaban ketika opsi 2 dipilih
});
option3.addEventListener("click", function () {
    handleAnswer(option3); // Menangani jawaban ketika opsi 3 dipilih
});

// Fungsi untuk mereset permainan
function resetGame() {
    clearInterval(timer); // Hentikan timer yang sedang berjalan
    points = 0; // Reset poin
    questionCount = 0; // Reset jumlah pertanyaan
    totalTime = 5 * 60; // Reset waktu ke 5 menit
    updatePoints(); // Memperbarui tampilan poin
    updateTimerDisplay(); // Memperbarui tampilan timer
    startTimer(); // Memulai timer baru
    generate_equation(); // Menghasilkan soal pertama
}

// Fungsi untuk menampilkan modal peringatan
function showWarning() {
    const modal = document.getElementById('notification-modal'); // Modal peringatan
    const modalBody = document.getElementById('modal-body'); // Bagian dalam modal
    modal.style.display = 'block'; // Menampilkan modal
    modalBody.innerHTML = `<p>Anda harus menyelesaikan Level 2 terlebih dahulu!</p>`; // Pesan dalam modal
}


// Menutup modal jika klik di luar modal
window.addEventListener('click', function (event) {
    const modal = document.getElementById('notification-modal');
    if (event.target === modal) {
        modal.style.display = 'none'; // Menyembunyikan modal jika klik di luar modal
    }
});

// Menginisialisasi permainan
updatePoints(); // Memperbarui tampilan poin
startTimer(); // Memulai timer saat permainan dimulai
generate_equation(); // Menghasilkan soal pertama
