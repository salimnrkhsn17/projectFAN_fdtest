<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FANBook</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f0f4ff 0%, #e0e7ff 100%);
            min-height: 100vh;
        }

        .login-bg-blur {
            position: fixed;
            inset: 0;
            min-height: 100vh;
            z-index: -1;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .login-container {
            max-width: 360px;
            margin: 4.5rem auto 0 auto;
            padding: 2.2rem 1.5rem 1.7rem 1.5rem;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.10), 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1.5px solid #e0e7ff;
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .login-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: #22223b;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }

        .login-subtitle {
            text-align: center;
            font-size: 1.08rem;
            color: #4f5d75;
            margin-bottom: 1.5rem;
        }

        .login-form label {
            font-weight: 600;
            color: #22223b;
            display: block;
            margin-bottom: 0.3rem;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
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

        .login-form input[type="email"]:focus,
        .login-form input[type="password"]:focus {
            border: 1.5px solid #6366f1;
            outline: none;
        }

        .login-form button {
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
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
            transition: background 0.2s;
        }

        .login-form button:hover {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        }

        .login-extra {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 1rem;
        }

        .login-extra a {
            color: #6366f1;
            font-weight: 600;
            text-decoration: none;
        }

        .login-error,
        .login-status {
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.98rem;
        }

        .login-error {
            background: #fee2e2;
            color: #b91c1c;
        }

        .login-status {
            background: #d1fae5;
            color: #047857;
        }

        @media (max-width: 500px) {
            .login-container {
                max-width: 98vw;
                padding: 1.2rem 0.5rem 1.2rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-bg-blur"></div>
    <div class="login-container">
        <div class="login-title">Selamat Datang</div>
        <div class="login-subtitle">Silakan login untuk melanjutkan</div>

        {{-- Error & Status --}}
        @if ($errors->any())
            <div class="login-error">
                <ul style="margin:0; padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="login-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <label>Email</label>
            <input type="email" name="email" required value="{{ old('email') }}">

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

            
            @if (session('show_forgot'))
                <div style="text-align:center; margin-top: 1rem;">
                    <a href="{{ route('password.request') }}" style="color:#6366f1; font-weight:500;">
                        Lupa password?
                    </a>
                </div>
            @endif
        </form>

        <div class="login-extra">
            <span>Belum punya akun?</span>
            <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>
</body>

</html>