<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard AI - SkripsiAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
   
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        :root { --sidebar-bg: #1e1f20; --main-bg: #ffffff; --text-primary: #1f1f1f; --text-secondary: #5f6368; --accent: #4285f4; --input-bg: #f0f4f9; }
        body { font-family: 'Inter', sans-serif; background-color: var(--main-bg); color: var(--text-primary); overflow: hidden; }
        .sidebar { width: 280px; height: 100vh; background: var(--sidebar-bg); color: #e3e3e3; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; padding: 20px 15px; z-index: 1050; transition: transform 0.3s ease; }
        .btn-new-chat { background: #282a2c; color: #e3e3e3; border-radius: 50px; padding: 12px 20px; font-weight: 500; cursor: pointer; display: flex; align-items: center; gap: 12px; margin-bottom: 25px; transition: 0.2s; }
        .btn-new-chat:hover { background: #37393b; color: white; }
        .history-item { display: block; padding: 10px 15px; border-radius: 50px; color: #e3e3e3; text-decoration: none; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px; }
        .history-item:hover { background: #282a2c; }
        .main-content { margin-left: 280px; height: 100vh; overflow-y: auto; position: relative; transition: margin-left 0.3s ease; }
        .top-nav { padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); z-index: 50; }
        .profile-btn { background: #f0f4f9; border: none; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-weight: 600; color: var(--text-primary); }
        .mobile-toggle { display: none; border: none; background: none; font-size: 1.5rem; color: var(--text-secondary); }
        
        .welcome-area { max-width: 1000px; margin: 0 auto; padding: 40px 20px; text-align: center; min-height: 80vh; display: flex; flex-direction: column; justify-content: center; }
        .greeting { font-size: 3rem; font-weight: 500; letter-spacing: -1px; background: linear-gradient(90deg, #4285f4, #d96570); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 10px; }
        
        /* CARD MENU DIPERBARUI */
        .option-card { background: #f0f4f9; border-radius: 16px; padding: 20px; cursor: pointer; height: 160px; transition: all 0.3s ease; display: flex; flex-direction: column; justify-content: space-between; text-align: left; border: none; }
        .option-card:hover { background: #e2e7eb; transform: translateY(-3px); }
        .card-icon { width: 35px; height: 35px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        
        .workspace-container { padding: 30px; max-width: 1000px; margin: 0 auto; width: 100%; display: none; animation: fadeIn 0.3s ease; }
        .project-header { background: #f8fafc; border-radius: 16px; padding: 25px; margin-bottom: 30px; border: 1px solid #e2e8f0; }
        .panel-card { background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 25px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        .result-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 15px 20px; margin-bottom: 10px; transition: all 0.2s; display: flex; justify-content: space-between; align-items: center; }
        .result-card:hover { border-color: var(--accent); box-shadow: 0 4px 12px rgba(0,0,0,0.05); transform: translateY(-2px); }
        .form-control-custom { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; font-size: 0.95rem; }
        .form-control-custom:focus { background: white; border-color: var(--accent); outline: none; box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1); }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Chat Floating (Tetap) */
        .btn-chat-float { position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; background: linear-gradient(135deg, #4285f4, #2b549b); color: white; border: none; border-radius: 50%; box-shadow: 0 4px 15px rgba(66, 133, 244, 0.4); z-index: 1060; transition: transform 0.2s; display: flex; align-items: center; justify-content: center; }
        .chat-window { position: fixed; bottom: 100px; right: 30px; width: 350px; height: 500px; background: white; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); z-index: 1060; display: none; flex-direction: column; border: 1px solid #e9ecef; }
        .chat-header { background: linear-gradient(135deg, #4285f4, #34a853); padding: 15px; color: white; display: flex; justify-content: space-between; align-items: center; }
        .chat-body { flex: 1; padding: 15px; overflow-y: auto; background: #f8f9fa; display: flex; flex-direction: column; gap: 10px; }
        .chat-footer { padding: 15px; background: white; border-top: 1px solid #eee; }
        .chat-bubble { max-width: 80%; padding: 10px 14px; border-radius: 12px; font-size: 0.9rem; line-height: 1.4; }
        .ai-bubble { background: white; border: 1px solid #e9ecef; align-self: flex-start; }
        .user-bubble { background: #eef2ff; border: 1px solid #c7d2fe; align-self: flex-end; }

        /* STYLE KHUSUS TANYA JAWAB (SOLVER) */
        .chat-container-solver { height: 450px; overflow-y: auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; gap: 15px; margin-bottom: 15px; }
        .bubble-solver { padding: 12px 16px; border-radius: 10px; max-width: 85%; font-size: 0.95rem; line-height: 1.5; }
        .bubble-user-solver { align-self: flex-end; background: #eef2ff; border: 1px solid #c7d2fe; color: #1e1b4b; }
        .bubble-ai-solver { align-self: flex-start; background: #f8f9fa; border: 1px solid #e9ecef; color: #374151; }
        .img-preview-box { display: none; width: 60px; height: 60px; border-radius: 8px; border: 1px dashed #ccc; margin-right: 10px; background-size: cover; background-position: center; position: relative; }
        .img-preview-close { position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); } .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; } 
            .mobile-toggle { display: block; }
            .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; } .sidebar-overlay.active { display: block; }
            .chat-window { width: 90%; right: 5%; bottom: 100px; height: 60vh; }
        }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebar">
    <div class="d-flex align-items-center justify-content-between mb-4 px-2">
        <a href="{{ route('home') }}" class="text-white text-decoration-none fw-bold fs-5">SkripsiAI</a>
        <button class="btn text-white d-md-none" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
    </div>
    <div class="btn-new-chat" onclick="showHome(); toggleSidebar()">
        <i class="fas fa-plus text-primary"></i> <span>Proyek Baru</span>
    </div>
    <div class="text-uppercase small text-muted fw-bold px-3 mb-2" style="font-size: 0.7rem;">Riwayat</div>
    <div style="flex-grow: 1; overflow-y: auto;">
        @foreach($history as $h)
            <a href="{{ route('app.index', ['id' => $h->id]) }}" class="history-item" title="{{ $h->judul }}">
                <i class="far fa-file-alt me-2"></i> {{ Str::limit($h->judul, 20) }}
            </a>
        @endforeach
    </div>
    <div class="mt-3 pt-3 border-top border-secondary">
        <form action="{{ route('logout') }}" method="POST">@csrf <button class="history-item w-100 text-start border-0 bg-transparent text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button></form>
    </div>
</div>

<div class="main-content">
    
    <div class="top-nav">
        <button class="mobile-toggle d-md-none" onclick="toggleSidebar()"><i class="fas fa-bars fa-lg"></i></button>
        
        <div class="d-flex align-items-center ms-auto gap-3">
            <div class="d-none d-md-flex align-items-center bg-light rounded-pill px-3 py-1 border">
                <i class="fas fa-robot text-primary me-2"></i>
                <select id="globalAiModel" class="border-0 bg-transparent fw-bold text-secondary" style="outline:none; cursor:pointer; font-size: 0.85rem;">
                    <option value="gemini" selected>Gemini 2.5</option>
                    <option value="groq">Groq (Ultra Fast)</option>
                </select>
            </div>
            <div class="bg-light px-3 py-1 rounded-pill border d-flex align-items-center gap-2">
                <i class="fas fa-coins text-warning"></i>
                <span class="fw-bold text-dark" id="creditDisplay">{{ Auth::user()->credits }}</span>
            </div>
            <div class="dropdown">
                <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">{{ substr(Auth::user()->name, 0, 1) }}</button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-3 p-3" style="width: 280px;">
                    <li class="text-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 50px; height: 50px; font-size: 1.2rem;">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <h6 class="fw-bold mb-0">{{ Auth::user()->name }}</h6>
                    </li>
                    <li class="d-md-none mb-3 px-3">
                        <select class="form-select form-select-sm" onchange="document.getElementById('globalAiModel').value = this.value">
                            <option value="gemini">Gemini 2.5</option>
                            <option value="groq">Groq</option>
                        </select>
                    </li>
                    <li><button class="dropdown-item py-2 gap-2 d-flex" data-bs-toggle="modal" data-bs-target="#modalMission"><i class="fas fa-gift text-success"></i> Misi & Rewards</button></li>
                    <li><button class="dropdown-item py-2 gap-2 d-flex" data-bs-toggle="modal" data-bs-target="#modalApiKey"><i class="fas fa-key text-info"></i> Atur API Key</button></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><form action="{{ route('logout') }}" method="POST">@csrf <button class="dropdown-item text-danger py-2 gap-2 d-flex"><i class="fas fa-power-off"></i> Logout</button></form></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="welcomeScreen" class="welcome-area">
        <div class="text-start mb-5">
            <h1 class="greeting">Halo, {{ explode(' ', Auth::user()->name)[0] }}</h1>
            <h3 class="text-secondary fw-light">Apa yang ingin kita kerjakan?</h3>
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="option-card h-100" onclick="showScreen('formScreen')">
                    <div><div class="card-icon text-primary"><i class="fas fa-magic"></i></div><h5 class="text-dark fs-6">Generate Skripsi</h5></div><p class="text-secondary small">Bab 1-5 otomatis.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="option-card h-100" onclick="showScreen('titleScreen')">
                    <div><div class="card-icon text-success"><i class="far fa-lightbulb"></i></div><h5 class="text-dark fs-6">Ide Judul</h5></div><p class="text-secondary small">Rekomendasi topik.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="option-card h-100" onclick="showScreen('journalScreen')">
                    <div><div class="card-icon text-warning"><i class="fas fa-book-reader"></i></div><h5 class="text-dark fs-6">Cari Jurnal</h5></div><p class="text-secondary small">Referensi 2020-2024.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="option-card h-100" onclick="showScreen('solverScreen')">
                    <div><div class="card-icon text-info"><i class="fas fa-graduation-cap"></i></div><h5 class="text-dark fs-6">Tanya Jawab</h5></div><p class="text-secondary small">Soal & Gambar.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="formScreen" class="workspace-container">
        <div class="project-header d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-primary bg-opacity-10 text-primary mb-2">Langkah 1</span>
                <h2 class="fw-bold text-dark mb-0">Detail Skripsi</h2>
                <small class="text-muted">Isi data dasar untuk memulai proyek.</small>
            </div>
        </div>
        <div class="panel-card">
            <form action="{{ route('project.start') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="fw-bold small text-secondary text-uppercase mb-2">Judul Skripsi <span class="text-danger">*</span></label>
                    <textarea name="judul" class="form-control form-control-custom" rows="2" placeholder="Contoh: Implementasi Deep Learning..." required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold small text-secondary text-uppercase mb-2">Program Studi <span class="text-danger">*</span></label>
                        <input type="text" name="prodi" class="form-control form-control-custom" placeholder="Cth: Teknik Informatika" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold small text-secondary text-uppercase mb-2">Metode Penelitian <span class="text-danger">*</span></label>
                        <select name="metode_penelitian" class="form-select form-control-custom" required>
                            <option value="" disabled selected>Pilih Metode...</option>
                            <option value="Kuantitatif (Eksperimen)">Kuantitatif - Eksperimen</option>
                            <option value="Kuantitatif (Survei)">Kuantitatif - Survei</option>
                            <option value="R&D (Waterfall)">R&D - Waterfall</option>
                            <option value="R&D (Agile)">R&D - Agile/Scrum</option>
                            <option value="R&D (Prototype)">R&D - Prototype</option>
                            <option value="Kualitatif (Deskriptif)">Kualitatif - Deskriptif</option>
                            <option value="Mixed Methods">Mixed Methods</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold small text-secondary text-uppercase mb-2">Topik / Variabel</label>
                        <input type="text" name="variabel_penelitian" class="form-control form-control-custom" placeholder="Cth: Fokus penelitian...">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="fw-bold small text-secondary text-uppercase mb-2">Sumber Data</label>
                        <input type="text" name="sumber_data" class="form-control form-control-custom" placeholder="Cth: Data Kaggle, UU, Siswa...">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fas fa-rocket me-2"></i> Buat Proyek & Masuk Workspace
                </button>
            </form>
        </div>
    </div>

    <div id="titleScreen" class="workspace-container">
        <div class="project-header d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-success bg-opacity-10 text-success mb-2">AI Tool</span>
                <h2 class="fw-bold text-dark mb-0">Generator Judul</h2>
                <small class="text-muted">Dapatkan inspirasi topik skripsi instan.</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel-card h-100">
                    <div class="mb-3">
                        <label class="fw-bold small text-secondary mb-1">Jurusan / Prodi</label>
                        <input id="inputProdi" class="form-control form-control-custom" placeholder="Cth: Hukum">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small text-secondary mb-1">Minat / Topik</label>
                        <input id="inputTopik" class="form-control form-control-custom" placeholder="Cth: Pidana Korupsi">
                    </div>
                    <button class="btn btn-dark w-100 rounded-pill fw-bold" onclick="generateTitles()">
                        <i class="fas fa-magic me-2"></i> Generate Judul
                    </button>
                </div>
            </div>
            <div class="col-md-8">
                <div id="titleResults">
                    <div class="text-center py-5 text-muted bg-light rounded-4 border border-dashed">
                        <i class="far fa-lightbulb fa-2x mb-3 text-secondary opacity-50"></i>
                        <p class="small mb-0">Hasil ide judul akan muncul di sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="journalScreen" class="workspace-container">
        <div class="project-header d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-warning bg-opacity-10 text-warning text-dark mb-2">Referensi</span>
                <h2 class="fw-bold text-dark mb-0">Pencari Jurnal</h2>
                <small class="text-muted">Cari referensi ilmiah 2020-2024.</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="panel-card d-flex gap-2 align-items-center">
                    <div class="flex-grow-1">
                        <input id="inputJournalKeyword" class="form-control form-control-custom border-0 bg-light" placeholder="Masukkan topik jurnal (Cth: Sistem Pakar Diagnosa)...">
                    </div>
                    <button class="btn btn-warning text-dark fw-bold rounded-pill px-4" onclick="findJournals()">
                        <i class="fas fa-search me-2"></i> Cari Jurnal 
                    </button>
                </div>
            </div>
            <div class="col-md-12">
                <div id="journalResults">
                    <div class="text-center py-5 text-muted bg-light rounded-4 border border-dashed">
                        <i class="fas fa-book-reader fa-2x mb-3 text-secondary opacity-50"></i>
                        <p class="small mb-0">Daftar jurnal akan muncul di sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="solverScreen" class="workspace-container">
        <div class="project-header d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-info bg-opacity-10 text-info text-dark mb-2">AI Tutor</span>
                <h2 class="fw-bold text-dark mb-0">Tanya Jawab & Soal</h2>
                <small class="text-muted">Upload foto soal atau ketik pertanyaan apapun.</small>
            </div>
        </div>

        <div class="panel-card">
            <div class="chat-container-solver" id="solverChatBody">
                <div class="bubble-solver bubble-ai-solver">
                    👋 Halo! Silakan foto soal tugas/ujian Anda (Matematika, Koding, Teori) atau ketik pertanyaan. Saya akan bantu jawab!
                </div>
            </div>

            <div class="d-flex align-items-end gap-2 bg-light p-2 rounded-3 border">
                <div id="solverImgPreview" class="img-preview-box">
                    <div class="img-preview-close" onclick="clearSolverImage()"><i class="fas fa-times"></i></div>
                </div>

                <input type="file" id="solverFileInput" accept="image/*" style="display: none;" onchange="handleSolverFile(this)">
                
                <button class="btn btn-light border text-secondary rounded-circle" style="width: 40px; height: 40px;" onclick="document.getElementById('solverFileInput').click()" title="Upload Gambar">
                    <i class="fas fa-camera"></i>
                </button>

                <textarea id="solverInput" class="form-control border-0 bg-transparent" rows="1" placeholder="Ketik pertanyaan..." style="resize: none;"></textarea>

                <button class="btn btn-primary rounded-circle" style="width: 40px; height: 40px;" onclick="sendSolver()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <small class="text-muted mt-2 d-block px-1">*Support gambar soal matematika, fisika, dll. Gunakan Gemini untuk fitur gambar.</small>
        </div>
    </div>

</div>

<button class="btn-chat-float" onclick="toggleChat()"><i class="fas fa-robot fa-lg"></i></button>
<div class="chat-window" id="chatWindow">
    <div class="chat-header"><div class="d-flex align-items-center gap-2"><i class="fas fa-brain text-white"></i><h6 class="mb-0 fw-bold">Dosen AI</h6></div><button class="btn btn-sm text-white" onclick="toggleChat()"><i class="fas fa-times"></i></button></div>
    <div class="chat-body" id="chatBody"><div class="chat-bubble ai-bubble">Halo! Saya asisten skripsi virtual Anda.</div></div>
    <div class="chat-footer"><form id="chatForm" onsubmit="event.preventDefault(); sendChat();"><div class="input-group"><input type="text" id="chatInput" class="form-control rounded-pill" placeholder="Tanya sesuatu..." autocomplete="off"><button class="btn btn-primary rounded-circle ms-2" type="submit"><i class="fas fa-paper-plane"></i></button></div></form></div>
</div>

<div class="modal fade" id="modalApiKey" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content shadow"><div class="modal-header border-0"><h5 class="fw-bold">🔑 API Key</h5><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><div class="row g-4"><div class="col-md-5 border-end"><h6 class="fw-bold mb-3 text-secondary">Tambah Key</h6><ul class="nav nav-pills mb-3" id="pills-tab"><li class="nav-item"><button class="nav-link active btn-sm rounded-pill" id="pills-gemini-tab" data-bs-toggle="pill" data-bs-target="#pills-gemini">Gemini</button></li><li class="nav-item"><button class="nav-link btn-sm rounded-pill" id="pills-groq-tab" data-bs-toggle="pill" data-bs-target="#pills-groq">Groq</button></li></ul><div class="tab-content"><div class="tab-pane fade show active" id="pills-gemini"><form action="{{ route('api.key.add') }}" method="POST">@csrf <input type="hidden" name="provider" value="gemini"><div class="mb-3"><input type="text" name="key" class="form-control bg-light" placeholder="Key..." required></div><button class="btn btn-primary w-100 rounded-pill">Simpan</button></form></div><div class="tab-pane fade" id="pills-groq"><form action="{{ route('api.key.add') }}" method="POST">@csrf <input type="hidden" name="provider" value="groq"><div class="mb-3"><input type="text" name="key" class="form-control bg-light" placeholder="Key..." required></div><button class="btn btn-danger w-100 rounded-pill">Simpan</button></form></div></div></div><div class="col-md-7"><h6 class="fw-bold mb-3 text-secondary">Daftar Key</h6><div style="max-height: 250px; overflow-y: auto;">@forelse($apiKeys as $k)<div class="card border-0 shadow-sm mb-2"><div class="card-body p-2 d-flex justify-content-between align-items-center"><div class="d-flex align-items-center">@if($k->provider == 'groq') <span class="badge bg-danger rounded-pill me-2">GROQ</span> @else <span class="badge bg-primary rounded-pill me-2">GEMINI</span> @endif <div><div class="fw-bold small">{{ Str::limit($k->key, 12) }}****</div></div></div><form action="{{ route('api.key.delete', $k->id) }}" method="POST" onsubmit="return confirm('Hapus?');">@csrf @method('DELETE')<button class="btn btn-light btn-sm text-danger border"><i class="fas fa-trash"></i></button></form></div></div>@empty <div class="text-muted small">Kosong</div> @endforelse</div></div></div></div></div></div></div>
<div class="modal fade" id="modalMission" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content shadow"><div class="modal-header border-0"><h5 class="fw-bold">🎁 Misi</h5><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body p-4"><div class="card border-0 bg-light mb-3"><div class="card-body d-flex justify-content-between align-items-center"><div><h6 class="fw-bold mb-0">Login Harian</h6><small>+2 Token</small></div><button class="btn btn-sm btn-primary rounded-pill" onclick="claimReward('login')">Klaim</button></div></div><div class="card border-0 bg-light"><div class="card-body d-flex justify-content-between align-items-center"><div><h6 class="fw-bold mb-0">Nonton Iklan</h6><small>+5 Token</small></div><button class="btn btn-sm btn-warning rounded-pill" onclick="claimReward('ads')">Watch</button></div></div></div></div></div></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

<script>
    function showScreen(id){document.querySelectorAll('.workspace-container, .welcome-area').forEach(e=>e.style.display='none');document.getElementById(id).style.display='block';}
    function showHome(){showScreen('welcomeScreen');document.getElementById('titleResults').innerHTML='<div class="text-center py-5 text-muted bg-light rounded-4 border border-dashed"><i class="far fa-lightbulb fa-2x mb-3 text-secondary opacity-50"></i><p class="small mb-0">Hasil akan muncul di sini.</p></div>';document.getElementById('journalResults').innerHTML='<div class="text-center py-5 text-muted bg-light rounded-4 border border-dashed"><i class="fas fa-book-reader fa-2x mb-3 text-secondary opacity-50"></i><p class="small mb-0">Daftar jurnal akan muncul di sini.</p></div>';}
    function toggleSidebar(){document.getElementById('sidebar').classList.toggle('active');document.getElementById('sidebarOverlay').classList.toggle('active');}
    
    @if(session('success')) Swal.fire({icon:'success',title:'Berhasil!',text:"{{ session('success') }}",timer:1500,showConfirmButton:false}); @endif
    @if(session('error')) Swal.fire({icon:'error',title:'Gagal!',text:"{{ session('error') }}"}); @endif
    
    // FUNCTION UTAMA (TITLE, JOURNAL, REWARD)
    function generateTitles() {
        let p=document.getElementById('inputProdi').value, t=document.getElementById('inputTopik').value, m=document.getElementById('globalAiModel').value;
        if(!p||!t) return Swal.fire('Info','Isi data dulu','warning');
        document.getElementById('titleResults').innerHTML='<div class="text-center py-5 text-primary"><div class="spinner-border mb-2"></div><br>AI sedang berpikir...</div>';
        
        fetch("{{ route('tools.titles') }}", {method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({prodi:p,topik:t,model:m})})
        .then(r=>r.json()).then(res=>{
            if(res.status==='success'){
                let h=''; res.data.forEach(x=>{h+=`<div class="result-card"><div><span class="fw-bold text-dark">${x}</span></div><button class="btn btn-light btn-sm border ms-2" onclick="navigator.clipboard.writeText('${x}');Swal.fire({toast:true,position:'top-end',icon:'success',title:'Copied',showConfirmButton:false,timer:1000})"><i class="far fa-copy"></i></button></div>`;});
                document.getElementById('titleResults').innerHTML=h;
                document.getElementById('creditDisplay').innerText = res.new_credits;
            } else { Swal.fire('Error', res.message, 'error'); document.getElementById('titleResults').innerHTML=''; }
        });
    }

    function findJournals() {
        let k=document.getElementById('inputJournalKeyword').value, m=document.getElementById('globalAiModel').value;
        if(!k) return Swal.fire('Info','Isi topik dulu','warning');
        document.getElementById('journalResults').innerHTML='<div class="text-center py-5 text-warning"><div class="spinner-border mb-2"></div><br>Mencari referensi...</div>';
        
        fetch("{{ route('tools.journals') }}", {method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({keyword:k,model:m})})
        .then(r=>r.json()).then(res=>{
            if(res.status==='success'){
                let h=''; res.data.forEach(j=>{
                    let l=`https://www.google.com/search?q=${encodeURIComponent(j.title + ' filetype:pdf')}`;
                    h+=`<div class="result-card"><div class="d-flex align-items-center gap-3"><div class="rounded-circle bg-light p-3 text-secondary"><i class="fas fa-file-pdf"></i></div><div><h6 class="fw-bold mb-0 text-dark">${j.title}</h6><small class="text-muted">${j.author} • ${j.year}</small></div></div><a href="${l}" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">PDF</a></div>`;
                });
                document.getElementById('journalResults').innerHTML=h;
                document.getElementById('creditDisplay').innerText = res.new_credits;
            } else { Swal.fire('Error', res.message, 'error'); document.getElementById('journalResults').innerHTML=''; }
        });
    }

    function claimReward(t){
        if(t==='ads'){
            let l="https://adsterra.com"; window.open(l,'_blank'); 
            Swal.fire({title:'Verifikasi Iklan...',html:'Tunggu <b id="timer">10</b> detik...',allowOutsideClick:false,showConfirmButton:false,didOpen:()=>{Swal.showLoading();let b=Swal.getHtmlContainer().querySelector('#timer');let i=setInterval(()=>{b.textContent=parseInt(b.textContent)-1},1000);setTimeout(()=>{clearInterval(i);proc(t)},10000)}});
        }else{proc(t)}
    }
    function proc(t){fetch("{{ route('reward.claim') }}", {method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({type:t})}).then(r=>r.json()).then(d=>{if(d.status==='success'){document.getElementById('creditDisplay').innerText=d.new_credits;Swal.fire('Sukses',d.message,'success')}})}

    function toggleChat(){ let w=document.getElementById('chatWindow'); w.style.display=w.style.display==='flex'?'none':'flex'; }
    function sendChat(){
        let i=document.getElementById('chatInput'), m=i.value, mod=document.getElementById('globalAiModel').value; if(!m)return;
        let b=document.getElementById('chatBody'); b.innerHTML+=`<div class="chat-bubble user-bubble">${m}</div>`; i.value=''; b.scrollTop=b.scrollHeight;
        fetch("{{ route('chat.ask') }}", {method:"POST",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content},body:JSON.stringify({message:m,model:mod})})
        .then(r=>r.json()).then(d=>{ b.innerHTML+=`<div class="chat-bubble ai-bubble">${d.reply}</div>`; b.scrollTop=b.scrollHeight; });
    }

    // === NEW: LOGIC FOR SOLVER (TANYA JAWAB) ===
    let solverImageBase64 = null;

    function handleSolverFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                solverImageBase64 = e.target.result;
                let preview = document.getElementById('solverImgPreview');
                preview.style.backgroundImage = `url(${solverImageBase64})`;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearSolverImage() {
        solverImageBase64 = null;
        document.getElementById('solverFileInput').value = "";
        document.getElementById('solverImgPreview').style.display = 'none';
    }

    function sendSolver() {
        let txt = document.getElementById('solverInput').value;
        let model = document.getElementById('globalAiModel').value;
        let bodyChat = document.getElementById('solverChatBody');

        if (!txt && !solverImageBase64) return Swal.fire('Info','Ketik sesuatu atau upload gambar','warning');

        // Tampilkan User Bubble
        let userHtml = `<div class="bubble-solver bubble-user-solver">`;
        if (solverImageBase64) userHtml += `<img src="${solverImageBase64}" style="max-height:100px; border-radius:5px; display:block; margin-bottom:5px;">`;
        userHtml += `${txt}</div>`;
        
        bodyChat.innerHTML += userHtml;
        bodyChat.scrollTop = bodyChat.scrollHeight;

        // Loading Bubble
        let loadingId = 'load-' + Date.now();
        bodyChat.innerHTML += `<div id="${loadingId}" class="bubble-solver bubble-ai-solver"><i class="fas fa-spinner fa-spin"></i> Sedang berpikir...</div>`;
        bodyChat.scrollTop = bodyChat.scrollHeight;

        // Prep Data
        let imgToSend = solverImageBase64;
        document.getElementById('solverInput').value = '';
        clearSolverImage();

        fetch("{{ route('tools.solve') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ question: txt || "Jelaskan gambar ini", image: imgToSend, model: model })
        })
        .then(r => r.json())
        .then(res => {
            document.getElementById(loadingId).remove();
            if(res.status === 'success') {
                // Parse Markdown (requires marked.js)
                let cleanAnswer = marked.parse(res.answer);
                bodyChat.innerHTML += `<div class="bubble-solver bubble-ai-solver">${cleanAnswer}</div>`;
                document.getElementById('creditDisplay').innerText = res.new_credits;
                
                // Render Math (if any)
                if(window.MathJax) MathJax.typesetPromise([bodyChat]);
            } else {
                bodyChat.innerHTML += `<div class="bubble-solver bubble-ai-solver text-danger">Error: ${res.message}</div>`;
            }
            bodyChat.scrollTop = bodyChat.scrollHeight;
        })
        .catch(err => {
            document.getElementById(loadingId).remove();
            Swal.fire('Error', 'Gagal terhubung ke server', 'error');
        });
    }
</script>
</body>
</html>