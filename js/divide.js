// Mendapatkan elemen HTML untuk setiap pilihan jawaban dan elemen lainnya
const option1 = document.getElementById("option1"), // Tombol pilihan 1
    option2 = document.getElementById("option2"), // Tombol pilihan 2
    option3 = document.getElementById("option3"),// Tombol pilihan 3
    audioWrong = new Audio("./music/wrong.mp3"),  // Membuat objek Audio untuk suara salah
    audioCorrect = new Audio("./music/true.mp3"),  // Membuat objek Audio untuk suara benar
    alarmSound = new Audio("./music/notif.mp3");  // Menambahkan suara alarm untuk waktu habis
    timeRemainingElement = document.getElementById("time-remaining");  // Elemen untuk menampilkan waktu yang tersisa

// Inisialisasi variabel untuk menyimpan poin, jawaban yang benar, dan jumlah pertanyaan yang sudah dijawab
let points = 0;  // Poin yang dimiliki pemain
let answer = 0;  // Menyimpan jawaban yang benar
let questionCount = 0;  // Menghitung jumlah pertanyaan yang telah dijawab
const maxQuestions = 10;  // Jumlah pertanyaan maksimum yang akan ditampilkan
const kkm = 70;  // Nilai kelulusan minimum
let timer;  // Variabel untuk menyimpan ID timer
let totalTime = 10 * 60;  // Total waktu yang tersedia (10 menit dalam detik)

// Fungsi untuk memperbarui tampilan poin di UI
function updatePoints() {
    document.querySelector(".points").textContent = `Points: ${points}`;  // Menampilkan poin saat ini pada elemen yang sesuai
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
    const minutes = Math.floor(totalTime / 60);  // Menghitung menit yang tersisa
    const seconds = totalTime % 60;  // Menghitung detik yang tersisa
    timeRemainingElement.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;  // Menampilkan waktu yang tersisa
}

// Fungsi untuk menampilkan hasil akhir dan status kelulusan
function showFinalScore(isTimeUp = false) {
    clearInterval(timer);  // Menghentikan timer

    const modal = document.getElementById("notification-modal");
    const modalBody = document.getElementById("modal-body");
    const status = points >= kkm ? "Lulus" : "Tidak Lulus";  // Menentukan status kelulusan berdasarkan poin
    const statusColor = points >= kkm ? "green" : "red";  // Menentukan warna berdasarkan status kelulusan
    const timeUpColor = isTimeUp ? "orange" : "orange";  // Menentukan warna jika waktu habis (dalam hal ini selalu orange)

    // Menampilkan pesan di modal sesuai status dan poin
    modalBody.innerHTML = `  
<h4 style="color: ${timeUpColor};">${isTimeUp ? "Time's Up!" : "Game Over!"}</h4>
<p>Final Score: <strong>${points}</strong></p>
<p>Status: <strong style="color: ${statusColor};">${status}</strong></p>
${
    points >= kkm
        ? '<p class="congratulations" style="color: orange;">Selamat! Anda telah menyelesaikan game matematika.</p>'
        : '<p class="try-again" style="color: red;">Cobalah lagi untuk mencapai skor minimum!</p>'
}
<div class="action-buttons">
    ${points >= kkm ? '<button id="finish" class="btn btn-success">Selesai</button>' : ''}
    ${points < kkm ? '<button id="try-again" class="btn btn-warning">Try Again</button>' : ''}
</div>
`;

    modal.style.display = "block"; // Pastikan modal ditampilkan

    // Pastikan tombol selesai muncul setelah modal ditampilkan dan tambahkan event listener
    const finishButton = document.getElementById("finish");
    if (finishButton) {
        finishButton.addEventListener("click", () => {  // Jika tombol selesai ditekan, tutup modal dan tampilkan pesan
            modal.style.display = "none";
            alert("Terima kasih telah bermain!");
        });
    }

    // Event listener untuk tombol restart (Try Again)
    const tryAgainButton = document.getElementById("try-again");
    if (tryAgainButton) {
        tryAgainButton.addEventListener("click", () => {  // Jika tombol coba lagi ditekan, reset permainan
            modal.style.display = "none";
            resetGame();
        });
    }

    // Event listener untuk menutup modal dengan klik
    document.getElementById("close-modal").onclick = function () {
        modal.style.display = "none";  // Menutup modal jika tombol close diklik
    };

    // Menutup modal jika mengklik di luar area modal
    window.onclick = function (event) {
        if (event.target == modal) {  // Jika klik di luar modal, modal akan ditutup
            modal.style.display = "none";
        }
    };
}

// Fungsi untuk menghasilkan soal matematika secara acak
function generate_equation() {
    if (questionCount >= maxQuestions) {  // Jika sudah mencapai jumlah pertanyaan maksimum, tampilkan hasil akhir
        showFinalScore();
        return;
    }

    // Membuat dua angka acak untuk soal matematika
    const num1 = Math.floor(Math.random() * 5) + 1;
    const num2 = Math.floor(Math.random() * 5) + 1;
    const dummyAnswer1 = Math.floor(Math.random() * 20) + 1;
    const dummyAnswer2 = Math.floor(Math.random() * 20) + 1;

    const divisor = num1 * num2;  // Menghitung hasil perkalian untuk soal
    answer = num1;  // Menyimpan jawaban yang benar
    document.getElementById("num1").innerHTML = divisor;  // Menampilkan angka pertama (divisor)
    document.getElementById("num2").innerHTML = num2;  // Menampilkan angka kedua (divisor)

    // Membuat array berisi jawaban yang benar dan jawaban palsu, kemudian mengacak urutannya
    const allAnswers = [answer, dummyAnswer1, dummyAnswer2];
    const shuffledAnswers = allAnswers.sort(() => Math.random() - 0.5);

    // Menampilkan pilihan jawaban yang teracak
    option1.innerHTML = shuffledAnswers[0];
    option2.innerHTML = shuffledAnswers[1];
    option3.innerHTML = shuffledAnswers[2];
}

// Fungsi untuk menangani klik pada pilihan jawaban
function handleAnswer(selectedOption) {
    if (questionCount >= maxQuestions) return;

    if (parseInt(selectedOption.innerHTML) === answer) {  // Jika jawaban benar
        points += 10;  // Menambah poin
        audioCorrect.play();  // Memutar suara benar
    } else {  // Jika jawaban salah
        audioWrong.play();  // Memutar suara salah
    }

    questionCount++;  // Menambah jumlah pertanyaan yang sudah dijawab
    updatePoints();  // Memperbarui tampilan poin

    if (questionCount >= maxQuestions) {  // Jika sudah mencapai jumlah pertanyaan maksimum, tampilkan hasil akhir
        showFinalScore();
    } else {
        generate_equation();  // Jika belum, buat soal baru
    }
}

// Event listeners untuk setiap pilihan jawaban
option1.addEventListener("click", function () {
    handleAnswer(option1);
});
option2.addEventListener("click", function () {
    handleAnswer(option2);
});
option3.addEventListener("click", function () {
    handleAnswer(option3);
});

// Fungsi untuk mereset permainan
function resetGame() {
    clearInterval(timer);  // Menghentikan timer
    points = 0;  // Reset poin
    questionCount = 0;  // Reset jumlah pertanyaan
    totalTime = 10 * 60;  // Reset waktu
    updatePoints();  // Memperbarui tampilan poin
    updateTimerDisplay();  // Memperbarui tampilan timer
    startTimer();  // Memulai timer kembali
    generate_equation();  // Menghasilkan soal baru
}

// Memulai permainan
updatePoints();  // Memperbarui tampilan poin
startTimer();  // Memulai timer
generate_equation();  // Menghasilkan soal pertama
