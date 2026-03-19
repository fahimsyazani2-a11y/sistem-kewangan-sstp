<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSTP JPN PERAK | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --soft-bg: #f4f7f9;
            --soft-slate: #475569;
            --mint: #10b981;
            --white: #ffffff;
        }

        body { 
            background-color: var(--soft-bg);
            min-height: 100vh; 
            display: flex; 
            flex-direction: column; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--soft-slate);
        }

        /* Hiasan bulatan lembut kat belakang */
        .decor {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, rgba(244, 247, 249, 0) 70%);
            z-index: -1;
        }

        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card { 
            border-radius: 24px; 
            background: var(--white); 
            padding: 40px; 
            width: 100%; 
            max-width: 420px; 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .login-logo {
            width: 70px;
            height: auto;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .header-title {
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.5px;
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .input-group {
            background: #f8fafc;
            border-radius: 14px;
            border: 1.5px solid #e2e8f0;
            padding: 5px;
            transition: 0.3s;
        }

        .input-group:focus-within {
            border-color: var(--mint);
            background: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-control {
            background: transparent;
            border: none;
            padding: 10px;
            font-size: 0.95rem;
            color: var(--soft-slate);
        }

        .form-control:focus { box-shadow: none; background: transparent; }

        .btn-login {
            background: #1e293b; /* Warna gelap rilek */
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-weight: 600;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: var(--mint);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
        }

        .footer-rilex {
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            background: white;
        }

        .mint-dot {
            height: 8px;
            width: 8px;
            background-color: var(--mint);
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="decor" style="top: -100px; right: -100px;"></div>
    <div class="decor" style="bottom: -100px; left: -100px;"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo_sstp.jpeg') }}" alt="Logo" class="login-logo">
                <h3 class="header-title">Sistem Waran Peruntukan</h3>
                <p class="text-muted small">Sektor Sumber Teknologi Pendidikan | JPN Perak  Sila log masuk</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">E-mel</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kata Laluan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 text-muted"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan kata laluan" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    Masuk Dashboard
                </button>
            </form>
            
            <div class="text-center mt-4">
                <a href="{{ route('warans.index') }}" class="text-decoration-none small fw-medium" style="color: #64748b;">
                    <i class="fas fa-long-arrow-alt-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center">
        <h6 class="fw-bold mb-1">WARAN PERUNTUKAN</h6>
        <p class="text-muted small mb-0">Sektor Sumber Teknologi Pendidikan (SSTP)</p>
        <p class="text-muted" style="font-size: 0.7rem;">JPN Perak &copy; {{ date('Y') }}</p>
    </div>
    </footer>

</body>
</html>