# Laporan UTS — Virtual Lab (EduPortal)

## Ringkasan Proyek

File yang dianalisis: `index.html` (folder proyek frontend_edu).

EduPortal adalah halaman web demo yang menampilkan daftar kursus, detail kursus, serta dua elemen interaktif utama: sebuah animasi kanvas simulasi proyektil pada kursus Physics dan sebuah kuis drag-and-drop pada kursus Thinking Computationally. Struktur view utama: `#homeView` (Hero + Course Grid) dan `#courseDetailView` (detail + `#interactiveContent`).

## Kontrak Singkat

- Input: aksi pengguna melalui klik (card, tombol), drag & drop, tombol launch/reset pada canvas.
- Output: perubahan view (tampil detail), animasi kanvas, hasil kuis & penilaian, navigasi halaman.
- Mode error: elemen interaktif tidak responsif pada perangkat kecil, gagal load canvas (no 2D context), drag/drop yang tidak kompatibel dengan touch tanpa polyfill.
- Sukses: interaksi berjalan dengan mulus di browser modern, konten responsif dan dapat diakses.

## Kebutuhan Fungsional (Functional Requirements)

1. Menampilkan daftar kursus dengan ringkasan.
   - Sumber: elemen `.course-grid` di `#courseGrid` yang diisi oleh fungsi `generateCourseCards()`.
   - Fitur inti: judul, ikon, deskripsi singkat, tombol "Learn More".

2. Melihat detail kursus ketika kursus dipilih.
   - Sumber: fungsi `showCourseDetail(course)` yang menyembunyikan `#homeView` dan menampilkan `#courseDetailView`.
   - Menampilkan `course.fullDescription` di `#detailContent` dan judul di `#detailTitle`.

3. Interaksi khusus kursus:
   - Physics: menyediakan kanvas simulasi (`#physicsCanvas`) dengan tombol Launch dan Reset.
   - Computing: menyediakan kuis drag & drop untuk mencocokkan istilah dengan definisi.

4. Navigasi dasar: Home, Courses, About melalui anchor dengan id `navHome`, `navCourses`, `navAbout`.

5. Kembali ke daftar kursus: tombol `#backButton`.

## Kebutuhan Non-Fungsional (Non-Functional Requirements)

1. Responsif
   - Halaman harus tampil baik pada lebar berbeda (media queries sudah ada untuk max-width 768px dan 480px).

2. Performa
   - Animasi kanvas harus berjalan lancar; penggunaan requestAnimationFrame pada fungsi `animate()` sudah diterapkan untuk efisiensi.

3. Keamanan
   - Tidak ada backend; input user lokal (drag/drop) aman. Namun hindari eksekusi kode berbasis string.

4. Maintainability
   - Struktur file monolitik (HTML + CSS + JS inline). Untuk proyek nyata, pisahkan file CSS/JS.

5. Aksesibilitas
   - Saat ini ada beberapa perbaikan yang diperlukan: fokus keyboard untuk elemen draggable, atribut ARIA, dan kontras warna teks/latarnya.

## System Thinking (Penerapan System Thinking)

Analisis arsitektur komponen dan keterkaitannya:

- Layer Presentasi (UI)
  - Header/Nav (`header`, `.nav-links`) — memicu fungsi untuk berpindah view.
  - Main Views (`#homeView`, `#courseDetailView`) — menampung card dan konten detail.

- Layer Interaksi (JS)
  - Data model `courses` (array) — single source of truth untuk konten kursus.
  - Renderer `generateCourseCards()` — mengubah data menjadi DOM.
  - Router/view manager: `showHomeView()` dan `showCourseDetail(course)` — menukar state view.

- Subsystem Interaktif
  - Physics Canvas: kanvas 2D, loop animasi, tombol kontrol; bergantung pada DOM injection `createPhysicsCanvas()`.
  - Drag & Drop Quiz: data kuis (`quizData`, `definitions`) dan handler drag/drop yang merespon event DOM.

Interkoneksi utama:
- Perubahan state pada model `courses` -> merender ulang kartu melalui `generateCourseCards()`.
- Klik card -> `showCourseDetail` -> memanggil `createPhysicsCanvas` atau `createDragDropQuiz` yang menyisipkan elemen DOM pada `#interactiveContent` dan mendaftarkan event listener.

Dengan pendekatan ini, komponen sumber data (courses) terpisah dari renderer dan handler interaksi, memudahkan penggantian data (mis. ambil dari API).

## Design Thinking & User-Centered Design (UCD)

Asumsi pengguna:
- Target: pelajar SMA/mahasiswa yang mencari materi pembelajaran interaktif.
- Perilaku: cepat memindai daftar kursus, membuka yang menarik, mencoba interaksi singkat (simulasi/kuis).

Langkah design thinking yang diaplikasikan (yang dapat ditelusuri di kode):
1. Empathize
   - Layout hero yang jelas (headline + subheadline) memenuhi kebutuhan orientasi pengguna.
2. Define
   - Kebutuhan utama: akses cepat ke ringkasan kursus dan interaksi praktis.
3. Ideate
   - Menyertakan interactive canvas untuk Physics dan kuis drag/drop untuk computing.
4. Prototype
   - Halaman ini bertindak sebagai prototype interaktif (single-page demo) dengan animasi.
5. Test (direkomendasikan)
   - Lakukan usability testing sederhana: observasi pengguna membuka kursus, menemukan tombol Learn More, dan mencoba interaksi.

Personas singkat (contoh):
- "Rina" (16 th): ingin melihat simulasi fisika yang visual.
- "Budi" (18 th): belajar pemrograman dan suka kuis singkat.

Uji hipotesis: desain ini memudahkan pemindaian (scanability), namun perlu perbaikan akses keyboard dan label ARIA untuk pengguna dengan disabilitas.

## Bukti Bahwa Desain & Pengembangan Berfokus pada Kebutuhan Pengguna

- Interaktifitas langsung pada halaman detail kursus (pengguna tidak perlu berpindah ke halaman lain).
- Konten ringkas pada kartu (ikon, judul, deskripsi) mendukung pemindaian cepat.
- Visual yang kuat (hero gradient, card glassmorphism) membantu hirarki visual.
- Kontrol eksplisit (Launch / Reset / Check Answers) memberi pengguna kendali penuh terhadap interaksi.

Contoh rujukan ke kode:
- `generateCourseCards()` membuat pengalaman penjelajahan kursus (pengguna dapat klik card mana saja).
- `showCourseDetail(course)` menampilkan `course.fullDescription` dan meng-inject komponen interaktif.

## UI / UX Design

1. Struktur & Informasi (IA)
   - Top navigation -> Hero -> Courses -> Footer: urutan logis bagi pengguna baru.
   - Course detail memisahkan judul (`#detailTitle`), deskripsi (`#detailContent`), dan area interaktif (`#interactiveContent`).

2. Visual & Aturan Tipografi
   - Font: Poppins (Google Fonts) digunakan untuk konsistensi.
   - Hierarki tipografi: H1 besar di hero, H2 untuk section titles, card titles lebih kecil.

3. Warna & Kontras
   - Palet modern dengan primary blue dan accent orange/green. Perlu cek kontras teks pada elemen berbackground-transparan.

4. Interaksi & Feedback
   - Hover efek pada card dan tombol memberi feedback visual.
   - Animasi transisi (fadeInUp, fadeInDown) meningkatkan pengalaman saat konten muncul.

5. Aksesibilitas (catatan perbaikan)
   - Tambahkan role, tabindex, dan atribut ARIA pada elemen interaktif (card clickable > role="button" tabindex="0").
   - Pastikan drag & drop bekerja pada perangkat touch (pointer events / touch handlers) atau sediakan alternatif (select + match).

## Responsif, Tipografi, dan Elemen Interaktif

- Responsif: ada media queries untuk 768px dan 480px, penyesuaian ukuran font dan grid.
- Tipografi: Poppins dengan bobot yang berbeda; ukuran font disesuaikan pada breakpoints.
- Elemen interaktif yang perlu diuji di berbagai perangkat:
  - Canvas (`#physicsCanvas`): ukur ulang canvas berdasarkan devicePixelRatio untuk ketajaman.
  - Drag & Drop quiz: periksa dukungan untuk touch dan keyboard.

## Rencana Pengujian & Quality Gates

1. Build: tidak ada build step (project static). PASS (tidak perlu bundler untuk demo ini).
2. Lint/Typecheck: JavaScript inline — jalankan ESLint jika dipisah ke file. Rekomendasi: pindahkan script ke `app.js` dan jalankan ESLint.
3. Tests: buat 2 tes kecil manual/otomatis:
   - Unit test: `generateCourseCards()` menghasilkan DOM nodes sesuai jumlah courses.
   - E2E (manual/puppeteer): klik kartu Physics -> muncul `#physicsCanvas` dan tombol launch.

## Kekurangan / Rekomendasi Perbaikan (Prioritas)

1. Pisahkan CSS dan JS ke file terpisah (`styles.css`, `app.js`) untuk maintainability.
2. Tambahkan ARIA & tabindex pada elemen interaktif (card, tombol) untuk akses keyboard.
3. Perbaiki drag & drop untuk touch: tambahkan pointer events atau fallback controls.
4. Lakukan optimasi canvas:
   - Resize canvas dengan devicePixelRatio.
   - Debounce resize event.
5. Tambahkan small automated tests (jest + jsdom) untuk fungsi DOM renderer.

## Langkah Implementasi Singkat untuk Peningkatan

1. Accessibility quick fixes:
   - Pada pembuatan card di `generateCourseCards()`: tambahkan `role="button" tabindex="0" aria-label="Open details for ${course.title}"`.
   - Tangani `keydown` (Enter / Space) pada card untuk memicu `showCourseDetail()`.

2. Drag & Drop fallback:
   - Sediakan dropdown select untuk setiap definisi sehingga pengguna touch bisa memilih jawaban.

3. Struktur proyek (saran):
   - `index.html` — markup minimal
   - `css/styles.css` — semua CSS
   - `js/app.js` — logika interaksi
   - `tests/` — unit/e2e tests

## Cara Menjalankan / Memverifikasi (Try it)

- Buka `index.html` di browser modern (Chrome/Firefox/Edge):

  1. Klik salah satu card kursus.
  2. Untuk Physics: tekan "Launch" lalu perhatikan gerakan bola/trajectory di kanvas.
  3. Untuk Computing: lakukan drag & drop dan tekan "Check Answers" untuk melihat hasil.

## Kesimpulan

Halaman EduPortal adalah prototype SPA sederhana yang menunjukkan pendekatan UCD dan beberapa elemen interaktif edukatif. Untuk pengumpulan tugas UTS, laporan ini telah mengidentifikasi kebutuhan fungsional & non-fungsional, menerapkan pandangan system thinking, menjabarkan aspek design thinking & UCD, menyajikan bukti fokus pada pengguna, dan memberikan rekomendasi teknis dan usability.

---

Jika Anda mau, saya bisa:
- Memecah `index.html` menjadi `index.html`, `css/styles.css`, `js/app.js` dan menerapkan perbaikan aksesibilitas kecil, atau
- Menambahkan unit tests sederhana untuk `generateCourseCards()` dan `showCourseDetail()`.

Pilih salah satu dan saya akan kerjakan langkah selanjutnya.
