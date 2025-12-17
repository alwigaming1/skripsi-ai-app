<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkripsiAI - Asisten Penulisan Akademik Cerdas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e1f20; /* Dark Charcoal (Match Sidebar) */
            --accent-color: #4285f4; /* Google Blue */
            --text-main: #1f1f1f;
            --text-muted: #5f6368;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        .navbar {
            padding: 20px 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar-brand { font-weight: 800; font-size: 1.35rem; color: var(--primary-color) !important; letter-spacing: -0.5px; }
        .nav-link { font-weight: 500; color: var(--text-muted) !important; transition: 0.2s; font-size: 0.95rem; }
        .nav-link:hover { color: var(--primary-color) !important; }
        .btn-nav-cta {
            background: var(--primary-color); color: white; border-radius: 50px;
            padding: 10px 24px; font-weight: 600; font-size: 0.9rem; transition: 0.2s;
        }
        .btn-nav-cta:hover { background: #333; color: white; transform: translateY(-1px); }

        /* --- HERO SECTION --- */
        .hero-section {
            padding: 100px 0 80px;
            background: radial-gradient(circle at 50% 0%, #f0f4ff 0%, transparent 70%);
            text-align: center;
        }
        .hero-badge {
            background: #eef2ff; color: var(--accent-color); font-weight: 600; font-size: 0.8rem;
            padding: 6px 16px; border-radius: 50px; display: inline-block; margin-bottom: 24px;
            border: 1px solid rgba(66, 133, 244, 0.2);
        }
        .hero-title {
            font-size: 4rem; font-weight: 800; letter-spacing: -2px; line-height: 1.1; margin-bottom: 24px;
            background: linear-gradient(135deg, #1e1f20 0%, #5f6368 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .hero-desc { font-size: 1.25rem; color: var(--text-muted); max-width: 650px; margin: 0 auto 40px; line-height: 1.6; }
        .btn-hero {
            padding: 16px 40px; font-size: 1.1rem; border-radius: 50px; font-weight: 600;
            box-shadow: 0 10px 30px -10px rgba(66, 133, 244, 0.4); transition: 0.3s; border: none;
        }
        .btn-hero-primary { background: var(--accent-color); color: white; }
        .btn-hero-primary:hover { background: #3367d6; color: white; transform: translateY(-3px); }
        
        /* --- FEATURES --- */
        .feature-icon-box {
            width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; margin-bottom: 20px;
        }
        .feature-card {
            padding: 30px; border-radius: 20px; background: white; border: 1px solid #f0f0f0;
            transition: 0.3s; height: 100%;
        }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px -5px rgba(0,0,0,0.05); border-color: #e0e0e0; }

        /* --- STEPS --- */
        .step-number {
            font-size: 4rem; font-weight: 900; color: #f3f4f6; position: absolute; top: -20px; left: 20px; z-index: 0;
        }
        .step-content { position: relative; z-index: 1; }

        /* --- FOOTER --- */
        footer { border-top: 1px solid #eee; padding: 60px 0 30px; background: #fff; margin-top: 100px; }
        .footer-logo { font-weight: 800; font-size: 1.2rem; color: var(--primary-color); text-decoration: none; }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.8rem; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-brain text-primary me-2"></i>SkripsiAI
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cara-kerja">Cara Kerja</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                </ul>
                <div class="d-flex gap-2">
                    @auth
                        <a href="{{ route('app.create') }}" class="btn btn-nav-cta">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-dark fw-bold me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-nav-cta">Daftar Gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="hero-badge"><i class="fas fa-sparkles me-2"></i>Powered by Gemini AI Pro</div>
            <h1 class="hero-title">Selesaikan Skripsi<br>Lebih Cepat & Cerdas.</h1>
            <p class="hero-desc">
                Asisten penulisan akademik #1 yang membantu Anda mencari judul, menemukan jurnal relevan, hingga menyusun Bab 1-5 dengan format standar kampus.
            </p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="{{ route('register') }}" class="btn btn-hero btn-hero-primary">Mulai Sekarang <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="#demo" class="btn btn-hero btn-light border" style="background: white;">Lihat Demo</a>
            </div>

            <div class="mt-5 pt-4">
                <div class="rounded-4 shadow-lg overflow-hidden border mx-auto" style="max-width: 1000px;">
                    <div class="bg-light border-bottom px-4 py-2 d-flex gap-2 align-items-center">
                        <div class="rounded-circle bg-danger" style="width:10px;height:10px;"></div>
                        <div class="rounded-circle bg-warning" style="width:10px;height:10px;"></div>
                        <div class="rounded-circle bg-success" style="width:10px;height:10px;"></div>
                    </div>
                    <div class="bg-white p-5 text-center text-muted" style="min-height: 400px; background: url('https://placehold.co/1200x800/f8fafc/e2e8f0?text=Dashboard+Preview') center/cover;">
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary fw-bold text-uppercase ls-1">Fitur Unggulan</h6>
                <h2 class="fw-bold display-6">Semua yang Anda Butuhkan</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Generator Bab 1-5</h4>
                        <p class="text-muted">Tulis latar belakang, tinjauan pustaka, hingga kesimpulan secara otomatis. AI memahami konteks akademik dan metodologi.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-success bg-opacity-10 text-success">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Pencari Jurnal Valid</h4>
                        <p class="text-muted">Cari referensi jurnal nasional & internasional (2019-2024). Dilengkapi tombol akses langsung ke PDF/Google Scholar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Ide Judul Skripsi</h4>
                        <p class="text-muted">Buntu ide? Dapatkan 10 rekomendasi judul skripsi yang *fresh* dan relevan sesuai dengan jurusan dan minat Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-info bg-opacity-10 text-info">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Sitasi & Daftar Pustaka</h4>
                        <p class="text-muted">Tidak perlu pusing format APA Style. AI otomatis menyisipkan sitasi dalam teks dan menyusun daftar pustaka.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-danger bg-opacity-10 text-danger">
                            <i class="fas fa-file-word"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Export Word & PDF</h4>
                        <p class="text-muted">Unduh hasil pekerjaan Anda ke format .docx yang siap diedit atau .pdf siap cetak. Format rapi dan standar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon-box bg-dark bg-opacity-10 text-dark">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Privasi & API Key</h4>
                        <p class="text-muted">Gunakan API Key Gemini pribadi Anda untuk akses tanpa batas. Data skripsi Anda aman dan tersimpan di akun sendiri.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-5 bg-light">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <h2 class="fw-bold display-6 mb-4">Langkah Mudah Menuju Wisuda.</h2>
                    <p class="text-muted mb-4">Sistem kami dirancang agar se-intuitif mungkin. Anda fokus pada substansi, biarkan AI menangani struktur dan penulisan.</p>
                    <a href="{{ route('register') }}" class="btn btn-dark rounded-pill px-4 py-2">Coba Gratis</a>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4 mt-4 mt-lg-0">
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-4 shadow-sm position-relative overflow-hidden h-100">
                                <div class="step-number">1</div>
                                <div class="step-content pt-3">
                                    <h5 class="fw-bold">Input Judul</h5>
                                    <p class="text-muted small">Masukkan judul skripsi, program studi, dan metode penelitian Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-4 shadow-sm position-relative overflow-hidden h-100">
                                <div class="step-number">2</div>
                                <div class="step-content pt-3">
                                    <h5 class="fw-bold">Generate Bab</h5>
                                    <p class="text-muted small">AI akan menyusun kerangka dan isi Bab 1-5 lengkap dengan referensi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-4 shadow-sm position-relative overflow-hidden h-100">
                                <div class="step-number">3</div>
                                <div class="step-content pt-3">
                                    <h5 class="fw-bold">Review & Edit</h5>
                                    <p class="text-muted small">Baca hasil tulisan AI, sesuaikan dengan data lapangan Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-white p-4 rounded-4 shadow-sm position-relative overflow-hidden h-100">
                                <div class="step-number">4</div>
                                <div class="step-content pt-3">
                                    <h5 class="fw-bold">Download</h5>
                                    <p class="text-muted small">Unduh dokumen Word, rapikan format akhir, dan siap bimbingan!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="py-5">
        <div class="container py-5 max-width-800">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pertanyaan Umum</h2>
            </div>
            <div class="accordion" id="accordionExample" style="max-width: 800px; margin: 0 auto;">
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Apakah aplikasi ini gratis?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-muted">
                            Ya, Anda mendapatkan token gratis saat mendaftar. Anda juga bisa mendapatkan token tambahan melalui misi harian atau menggunakan API Key pribadi Anda untuk akses gratis tanpa batas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Apakah hasil tulisan AI bebas plagiasi?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-muted">
                            AI menghasilkan tulisan unik setiap saat. Namun, kami sangat menyarankan Anda untuk tetap melakukan pengecekan (paraphrasing) dan validasi data agar hasil skripsi benar-benar orisinal dan sesuai kaidah kampus.
                        </div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            Bagaimana cara mendapatkan API Key Gemini?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-muted">
                            Anda bisa mendapatkannya secara gratis di Google AI Studio. Kami menyediakan panduan dan link langsung di dalam dashboard aplikasi.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a href="#" class="footer-logo"><i class="fas fa-brain me-2"></i>SkripsiAI</a>
                    <p class="text-muted mt-3 small">
                        Platform cerdas untuk membantu mahasiswa Indonesia menyelesaikan tugas akhir dengan lebih efisien dan berkualitas.
                    </p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Produk</h6>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-muted">Generator</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Cari Jurnal</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Ide Judul</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="fw-bold mb-3">Legal</h6>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-2">
                        <li><a href="#" class="text-decoration-none text-muted">Ketentuan</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Privasi</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <p class="text-muted small">support@skripsiai.com</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 mt-4 border-top">
                <small class="text-muted">&copy; 2025 SkripsiAI. Developed By Muh Alwi Syahrir.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>