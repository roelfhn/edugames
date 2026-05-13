const option1 = document.getElementById("option1"),  // Menangkap elemen dengan ID 'option1' untuk pilihan pertama
    option2 = document.getElementById("option2"),  // Menangkap elemen dengan ID 'option2' untuk pilihan kedua
    option3 = document.getElementById("option3"),  // Menangkap elemen dengan ID 'option3' untuk pilihan ketiga
    audioWrong = new Audio("./music/wrong.mp3"),  // Membuat objek Audio untuk suara salah
    audioCorrect = new Audio("./music/true.mp3"),  // Membuat objek Audio untuk suara benar
    alarmSound = new Audio("./music/notif.mp3"),  // Menambahkan suara alarm untuk waktu habis
    timeRemainingElement = document.getElementById("time-remaining");  // Menangkap elemen untuk menampilkan waktu yang tersisa

let points = 0;  // Menginisialisasi nilai awal poin pemain (dimulai dari 0)
let answer = 0;  // Menyimpan nilai jawaban yang benar dari soal saat ini
let questionCount = 0;  // Menginisialisasi jumlah soal yang sudah dijawab
const maxQuestions = 10;  // Menetapkan jumlah soal maksimum yang dapat dijawab
const kkm = 70;  // Menetapkan nilai Kriteria Kelulusan Minimum (KKM)
let timer;  // Variabel untuk menyimpan timer
let totalTime = 5 * 60;  // Total waktu permainan dalam detik (5 menit = 300 detik)

// Fungsi untuk memperbarui tampilan poin
function updatePoints() {
    document.querySelector(".points").textContent = `Points: ${points}`;  // Mengupdate elemen dengan class 'points' untuk menampilkan poin terkini
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
    const minutes = Math.floor(totalTime / 60);  // Menghitung jumlah menit yang tersisa
    const seconds = totalTime % 60;  // Menghitung sisa detik
    timeRemainingElement.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;  // Menampilkan waktu dalam format mm:ss
}

// Fungsi untuk menampilkan hasil akhir
function showFinalScore(isTimeUp = false) {
    clearInterval(timer);  // Menghentikan timer saat permainan selesai

    const modal = document.getElementById("notification-modal");  // Menangkap elemen modal
    const modalBody = document.getElementById("modal-body");  // Menangkap elemen isi modal
    const status = points >= kkm ? "Lulus" : "Tidak Lulus";  // Menentukan status kelulusan berdasarkan jumlah poin
    const statusColor = points >= kkm ? "green" : "red";  // Menentukan warna untuk status kelulusan
    const timeUpColor = isTimeUp ? "orange" : "orange";  // Menentukan warna jika waktu habis

    // Mengisi modal dengan pesan hasil akhir
    modalBody.innerHTML = `
        <h4 style="color: ${timeUpColor};">${isTimeUp ? "Time's Up!" : "Game Over!"}</h4>
        <p>Final Score: <strong>${points}</strong></p>
        <p>Status: <strong style="color: ${statusColor};">${status}</strong></p>
        <div class="action-buttons">
            ${
                points >= kkm
                    ? '<button id="next-level" class="btn btn-success">Next Level 2</button>'  // Tombol
                    : '<button id="retry" class="btn btn-danger">Try Again</button>'  // Tombol untuk mencoba lagi jika gagal
                }
            </div>
        `;
    
        modal.style.display = "block";  // Menampilkan modal hasil akhir
    
        // Event listener untuk tombol "Lanjut ke Level 2" jika lulus
        if (points >= kkm) {
            document.getElementById("next-level").addEventListener("click", () => {
                window.location.href = "subtract.html";  // Arahkan ke level berikutnya
            });
        } else {
            // Event listener untuk tombol "Coba Lagi" jika gagal
            document.getElementById("retry").addEventListener("click", () => {
                modal.style.display = "none";  // Menyembunyikan modal
                resetGame();  // Mengatur ulang permainan
            });
        }
    
        // Menutup modal jika pengguna mengklik di luar modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";  // Menyembunyikan modal jika klik di luar modal
            }
        };
    }
    
    // Fungsi untuk menghasilkan soal penjumlahan
    function generate_equation() {
        if (questionCount >= maxQuestions) {  // Jika sudah mencapai jumlah soal maksimum
            showFinalScore();  // Tampilkan hasil akhir
            return;  // Keluar dari fungsi
        }
    
        const num1 = Math.floor(Math.random() * 10);  // Menghasilkan angka acak antara 0 dan 9 untuk num1
        const num2 = Math.floor(Math.random() * 10);  // Menghasilkan angka acak antara 0 dan 9 untuk num2
        const dummyAnswer1 = Math.floor(Math.random() * 10);  // Menghasilkan jawaban palsu pertama
        const dummyAnswer2 = Math.floor(Math.random() * 10);  // Menghasilkan jawaban palsu kedua
    
        answer = num1 + num2;  // Menetapkan jawaban benar sebagai hasil dari penjumlahan num1 dan num2
        document.getElementById("num1").innerHTML = num1;  // Menampilkan angka pertama pada elemen dengan ID 'num1'
        document.getElementById("num2").innerHTML = num2;  // Menampilkan angka kedua pada elemen dengan ID 'num2'
    
        const allAnswers = [answer, dummyAnswer1, dummyAnswer2];  // Menyusun jawaban benar dan palsu ke dalam array
        const shuffledAnswers = allAnswers.sort(() => Math.random() - 0.5);  // Mengacak urutan jawaban
    
        // Memperbarui opsi jawaban yang ditampilkan pada elemen HTML
        option1.innerHTML = shuffledAnswers[0];
        option2.innerHTML = shuffledAnswers[1];
        option3.innerHTML = shuffledAnswers[2];
    }
    
    // Fungsi untuk menangani jawaban yang dipilih
    function handleAnswer(selectedOption) {
        if (questionCount >= maxQuestions) return;  // Jika jumlah soal sudah mencapai maksimum, tidak lakukan apa-apa
    
        // Jika jawaban yang dipilih benar, tambahkan 10 poin dan putar suara benar
        if (parseInt(selectedOption.innerHTML) === answer) {
            points += 10;  // Menambah poin jika jawabannya benar
            audioCorrect.play();  // Memutar suara benar
        } else {
            audioWrong.play();  // Memutar suara salah jika jawabannya salah
        }
    
        questionCount++;  // Menambah jumlah soal yang sudah dijawab
        updatePoints();  // Memperbarui tampilan poin
    
        // Jika sudah mencapai jumlah soal maksimum, tampilkan hasil akhir
        if (questionCount >= maxQuestions) {
            showFinalScore();
        } else {
            generate_equation();  // Jika belum mencapai batas soal, buat soal baru
        }
    }
    
    // Event listeners untuk setiap pilihan jawaban
    option1.addEventListener("click", function () {
        handleAnswer(option1);  // Menangani jika opsi 1 dipilih
    });
    option2.addEventListener("click", function () {
        handleAnswer(option2);  // Menangani jika opsi 2 dipilih
    });
    option3.addEventListener("click", function () {
        handleAnswer(option3);  // Menangani jika opsi 3 dipilih
    });
    
    // Fungsi untuk mereset permainan
    function resetGame() {
        clearInterval(timer);  // Hentikan timer sebelumnya
        points = 0;  // Reset poin ke 0
        questionCount = 0;  // Reset jumlah soal ke 0
        totalTime = 5 * 60;  // Reset waktu menjadi 5 menit
        totalTime = 5 * 60;  // Reset waktu menjadi 5 menit (300 detik)
        updatePoints();  // Memperbarui tampilan poin
        updateTimerDisplay();  // Memperbarui tampilan waktu
        startTimer();  // Mulai timer baru
        generate_equation();  // Membuat soal baru
    }
    
    // Fungsi untuk menampilkan peringatan jika level 1 belum selesai
    function showWarning() {
        const modal = document.getElementById('notification-modal');  // Mengambil elemen modal untuk peringatan
        const modalBody = document.getElementById('modal-body');  // Mengambil elemen isi modal
        modal.style.display = 'block';  // Menampilkan modal
        modalBody.innerHTML = `<p>Anda harus menyelesaikan Level 1 terlebih dahulu!</p>`;  // Menampilkan pesan peringatan
    }
    
    // Event listener untuk menutup modal jika pengguna mengklik di luar modal
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('notification-modal');
        if (event.target === modal) {
            modal.style.display = 'none';  // Menyembunyikan modal jika pengguna klik di luar modal
        }
    });
    
    // Memperbarui tampilan poin dan memulai timer saat permainan dimulai
    updatePoints();  // Memperbarui tampilan poin pertama kali
    startTimer();  // Memulai timer permainan
    generate_equation();  // Menghasilkan soal pertama