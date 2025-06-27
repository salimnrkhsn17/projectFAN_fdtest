<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FANBook</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f0f4ff 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .register-bg-blur {
            position: fixed;
            inset: 0;
            min-height: 100vh;
            z-index: -1;
            background: linear-gradient(120deg, #f0f4ff 0%, #e0e7ff 100%);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .register-container {
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
        .register-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: #22223b;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }
        .register-subtitle {
            text-align: center;
            font-size: 1.08rem;
            color: #4f5d75;
            margin-bottom: 1.5rem;
        }
        .register-form label {
            font-weight: 600;
            color: #22223b;
            display: block;
            margin-bottom: 0.3rem;
        }
        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 0.7rem 1rem;
            border: 1.5px solid #c7d2fe;
            border-radius: 10px;
            font-size: 1rem;
            background: #f8fafc;
            margin-bottom: 1.1rem;
            transition: border 0.2s;
        }
        .register-form input:focus {
            border: 1.5px solid #6366f1;
            outline: none;
        }
        .register-form button {
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
        .register-form button:hover {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        }
        .register-extra {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 1rem;
        }
        .register-extra a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }
        .register-error {
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.98rem;
            background: #fee2e2;
            color: #b91c1c;
        }
        @media (max-width: 500px) {
            .register-container {
                max-width: 98vw;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-bg-blur"></div>
    <div class="register-container">
        <div class="register-title">Daftar Akun</div>
        <div class="register-subtitle">Buat akun baru untuk melanjutkan</div>

        @if ($errors->any())
            <div class="register-error">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <label>Nama</label>
            <input type="text" name="name" required value="{{ old('name') }}">

            <label>Email</label>
            <input type="email" name="email" required value="{{ old('email') }}">

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Register</button>
        </form>

        <div class="register-extra">
            <span>Sudah punya akun?</span>
            <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</body>
</html>
