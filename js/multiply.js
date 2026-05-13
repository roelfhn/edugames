// Select elements from the DOM
const option1 = document.getElementById("option1"), // Mengambil elemen dengan ID 'option1' (jawaban pilihan pertama)
    option2 = document.getElementById("option2"), // Mengambil elemen dengan ID 'option2' (jawaban pilihan kedua)
    option3 = document.getElementById("option3"), // Mengambil elemen dengan ID 'option3' (jawaban pilihan ketiga)
    audioWrong = new Audio("./music/wrong.mp3"),  // Membuat objek Audio untuk suara salah
    audioCorrect = new Audio("./music/true.mp3"),  // Membuat objek Audio untuk suara benar
    alarmSound = new Audio("./music/notif.mp3");  // Menambahkan suara alarm untuk waktu habis
    timeRemainingElement = document.getElementById("time-remaining"), // Mengambil elemen dengan ID 'time-remaining' untuk menampilkan waktu yang tersisa
    resultContainer = document.querySelector(".result-container"), // Mengambil elemen pertama dengan kelas 'result-container' untuk menampilkan hasil
    modal = document.getElementById("notification-modal"), // Mengambil elemen dengan ID 'notification-modal' untuk menampilkan modal
    modalBody = document.getElementById("modal-body"); // Mengambil elemen dengan ID 'modal-body' untuk menampilkan isi dari modal

let points = 0; // Menyimpan skor yang dimiliki pemain, dimulai dari 0
let answer = 0; // Menyimpan jawaban yang benar untuk soal yang sedang ditampilkan
let questionCount = 0; // Menyimpan jumlah soal yang telah dijawab
const maxQuestions = 10; // Menetapkan jumlah soal yang akan muncul (maksimum 10 soal)
const kkm = 70; // Menetapkan skor kelulusan (KKM)
let timer; // Variabel untuk menyimpan referensi ke timer
let totalTime = 5 * 60; // Total waktu permainan dalam detik (5 menit = 300 detik)

// Update points display
function updatePoints() {
    document.querySelector(".points").textContent = `Points: ${points}`; // Memperbarui elemen dengan kelas 'points' untuk menampilkan skor terbaru
}

// Start the timer
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

// Update the timer display
function updateTimerDisplay() {
    const minutes = Math.floor(totalTime / 60); // Menghitung menit dengan membagi total waktu dengan 60
    const seconds = totalTime % 60; // Menghitung sisa detik dengan modulus 60
    timeRemainingElement.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`; // Memperbarui elemen dengan ID 'time-remaining' dengan format mm:ss
}

// Show the final score
function showFinalScore(isTimeUp = false) {
    clearInterval(timer); // Memastikan timer dihentikan

    const status = points >= kkm ? "Lulus" : "Tidak Lulus"; // Menentukan status kelulusan berdasarkan skor
    const statusColor = points >= kkm ? "green" : "red"; // Menentukan warna status berdasarkan apakah lulus atau tidak
    const timeUpMessage = isTimeUp ? "Time's Up!" : "Game Over!"; // Pesan yang ditampilkan jika waktu habis atau permainan selesai
    const timeUpColor = isTimeUp ? "orange" : "orange";  // Menentukan warna jika waktu habis

    // Memperbarui konten modal dengan hasil akhir permainan
    // Memperbarui konten modal dengan hasil akhir permainan
modalBody.innerHTML = `
    <h4 style="color: orange;">${timeUpMessage}</h4> <!--Menampilkan pesan waktu habis atau game over dengan warna oranye-->
    <p>Final Score: <strong>${points}</strong></p> <!--Menampilkan skor akhir pemain, dengan nilai 'points' ditampilkan dalam elemen <strong> untuk menonjolkan-->
    <p>Status: <strong style="color: ${statusColor};">${status}</strong></p> <!--Menampilkan status kelulusan pemain (lulus atau tidak), dengan warna status ditentukan dari variabel 'statusColor'-->
    <div class="action-buttons"> <!--Membuat div untuk menampung tombol aksi berikutnya-->
        ${points >= kkm ? '<button id="next-level" class="btn btn-success">Lanjut ke Level 4</button>' : '<button id="retry" class="btn btn-danger">Coba Lagi</button>'} 
        <!--Jika skor pemain >= nilai kelulusan (kkm), tampilkan tombol "Lanjut ke Level 4", jika tidak tampilkan tombol "Coba Lagi"-->
    </div>
`

    modal.style.display = "block"; // Menampilkan modal

    // Event listener untuk tombol 'Lanjut ke Level 4' jika lulus
    if (points >= kkm) {
        document.getElementById("next-level").addEventListener("click", () => {
            window.location.href = "divide.html"; // Mengarahkan pengguna ke halaman Level 4
        });
    } else {
        document.getElementById("retry").addEventListener("click", () => {
            modal.style.display = "none"; // Menutup modal jika tombol 'Coba Lagi' diklik
            resetGame(); // Mereset permainan jika tombol 'Coba Lagi' diklik
        });
    }

    // Menutup modal jika tombol close diklik
    document.getElementById("close-modal").onclick = () => (modal.style.display = "none");
    // Menutup modal jika area luar modal diklik
    window.onclick = (event) => {
        if (event.target == modal) modal.style.display = "none";
    };
}

// Generate multiplication equation
function generate_equation() {
    if (questionCount >= maxQuestions) { // Jika jumlah soal sudah mencapai maksimum
        showFinalScore(); // Tampilkan hasil akhir
        return;
    }

    const num1 = Math.floor(Math.random() * 10); // Angka pertama soal, acak antara 0 hingga 12
    const num2 = Math.floor(Math.random() * 5); // Angka kedua soal, acak antara 0 hingga 12
    const dummyAnswer1 = Math.floor(Math.random() * 10); // Jawaban palsu pertama, acak antara 0 hingga 9
    const dummyAnswer2 = Math.floor(Math.random() * 10); // Jawaban palsu kedua, acak antara 0 hingga 9

    answer = num1 * num2; // Menentukan jawaban yang benar

    // Menampilkan angka-angka soal pada elemen dengan ID 'num1' dan 'num2'
    document.getElementById("num1").textContent = num1;
    document.getElementById("num2").textContent = num2;

    // Mengacak urutan jawaban dengan menggunakan metode sort dan fungsi acak
    const allAnswers = [answer, dummyAnswer1, dummyAnswer2]; // Gabungkan jawaban benar dan jawaban palsu
    const shuffledAnswers = allAnswers.sort(() => Math.random() - 0.5); // Mengacak urutan jawaban

    // Menampilkan jawaban yang sudah diacak pada elemen dengan ID 'option1', 'option2', dan 'option3'
    option1.textContent = shuffledAnswers[0]; // Menampilkan jawaban yang sudah diacak pada elemen pada option1
    option2.textContent = shuffledAnswers[1]; // Menampilkan jawaban yang sudah diacak pada elemen pada option2
    option3.textContent = shuffledAnswers[2]; // Menampilkan jawaban yang sudah diacak pada elemen pada option3
}

// Handle answer selection
function handleAnswer(selectedOption) {
    if (questionCount >= maxQuestions) return; // Jika sudah mencapai jumlah soal maksimum, hentikan permainan

    if (parseInt(selectedOption.textContent) === answer) { // Jika jawaban yang dipilih benar
        points += 10; // Menambahkan 10 poin pada skor
        audioCorrect.play(); // Memainkan suara jawaban benar
    } else {
        audioWrong.play(); // Memainkan suara jawaban salah
    }

    questionCount++; // Menambah jumlah soal yang sudah dijawab
    updatePoints(); // Memperbarui tampilan skor setelah menjawab

    if (questionCount >= maxQuestions) { // Jika sudah mencapai jumlah soal maksimum
        showFinalScore(); // Tampilkan hasil akhir permainan
    } else {
        generate_equation(); // Buat soal baru untuk pemain
    }
}

// Menambahkan event listeners untuk setiap opsi jawaban
option1.addEventListener("click", () => handleAnswer(option1));
option2.addEventListener("click", () => handleAnswer(option2));
option3.addEventListener("click", () => handleAnswer(option3));

// Reset the game
function resetGame() {
    clearInterval(timer); // Hentikan timer
    points = 0; // Reset skor kembali ke 0
    questionCount = 0; // Reset jumlah soal yang telah dijawab
    totalTime = 5 * 60; // Reset waktu total kembali ke 5 menit (300 detik)
    updatePoints(); // Memperbarui tampilan skor
    startTimer(); // Mulai timer baru
    generate_equation(); // Membuat soal pertama setelah reset
}

// Show warning modal
function showWarning() {
    const modal = document.getElementById('notification-modal'); // Mengambil elemen modal
    const modalBody = document.getElementById('modal-body'); // Mengambil elemen tubuh modal
    modal.style.display = 'block'; // Menampilkan modal peringatan
    modalBody.innerHTML = `<p>Anda harus menyelesaikan Level 3 terlebih dahulu!</p>`; // Menampilkan pesan peringatan dalam modal
}


// Tutup modal jika pengguna mengklik di luar konten modal
window.addEventListener('click', function (event) {
    const modal = document.getElementById('notification-modal');
    if (event.target === modal) {
        modal.style.display = 'none'; // Menutup modal jika area luar modal diklik
    }
});

// Initialize the game
updatePoints(); // Memperbarui tampilan skor pada awal permainan
startTimer(); // Memulai timer pada awal permainan
generate_equation(); // Menampilkan soal pertama pada awal permainan
