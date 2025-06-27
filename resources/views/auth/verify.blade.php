<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | FANBook</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f0f4ff 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .verify-bg-blur {
            position: fixed;
            inset: 0;
            min-height: 100vh;
            z-index: -1;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .verify-container {
            max-width: 370px;
            margin: 4.5rem auto 0 auto;
            padding: 2.2rem 1.5rem 1.7rem 1.5rem;
            border-radius: 16px;
            background: rgba(255,255,255,0.85);
            box-shadow: 0 8px 32px rgba(99,102,241,0.10), 0 2px 8px rgba(0,0,0,0.04);
            border: 1.5px solid #e0e7ff;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .verify-title {
            text-align: center;
            font-size: 1.7rem;
            font-weight: 800;
            color: #22223b;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }
        .verify-subtitle {
            text-align: center;
            font-size: 1.02rem;
            color: #4f5d75;
            margin-bottom: 1.5rem;
        }
        .verify-message {
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.98rem;
            background: #d1fae5;
            color: #047857;
            text-align: center;
        }
        .verify-form button {
            width: 100%;
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border: none;
            padding: 0.8rem 0;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(99,102,241,0.10);
            transition: background 0.2s;
        }
        .verify-form button:hover {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        }
        .verify-extra {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 1rem;
        }
        .verify-extra a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }
        @media (max-width: 500px) {
            .verify-container {
                max-width: 98vw;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="verify-bg-blur"></div>
    <div class="verify-container">
        <div class="verify-title">Verifikasi Email Diperlukan</div>
        <div class="verify-subtitle">
            Sebelum melanjutkan, silakan cek email Anda untuk tautan verifikasi.<br>
            Jika belum menerima, Anda bisa kirim ulang:
        </div>

        @if (session('message'))
            <div class="verify-message">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="verify-form">
            @csrf
            <button type="submit">Kirim Ulang Email Verifikasi</button>
        </form>

        <div class="verify-extra">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>
</body>
</html>
