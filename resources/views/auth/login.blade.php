<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SkripsiAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .card-auth {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .btn-primary-ai {
            background: #1e1f20; color: white; border: none; padding: 12px;
            border-radius: 50px; font-weight: 600; width: 100%; transition: 0.2s;
        }
        .btn-primary-ai:hover { background: #333; transform: translateY(-2px); }
        .form-control {
            background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 12px;
        }
        .form-control:focus { border-color: #1e1f20; box-shadow: none; background: white; }
        .brand-logo { font-size: 1.5rem; font-weight: 800; color: #1e1f20; text-decoration: none; display: block; text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="card-auth">
        <a href="{{ route('home') }}" class="brand-logo"><i class="fas fa-brain text-primary me-2"></i>SkripsiAI</a>
        <p class="text-center text-muted mb-4">Selamat datang kembali!</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 rounded-end-3" placeholder="nama@email.com" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" class="form-control border-start-0 rounded-end-3" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn-primary-ai mb-3">Masuk Sekarang</button>
            <div class="text-center">
                <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-dark">Daftar Gratis</a></small>
            </div>
        </form>
    </div>
</body>
</html>