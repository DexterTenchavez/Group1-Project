<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'G1 Group') }} — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #080808;
            --surface: #111;
            --surface-2: #181818;
            --border: rgba(255,255,255,0.07);
            --t1: #f0f0f0;
            --t2: #888;
            --t3: #444;
            --accent: #c8ff00;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--t1);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.35;
        }
        .login-container {
            width: 100%;
            max-width: 480px;
            margin: 20px;
            position: relative;
            z-index: 1;
        }
        .login-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 48px 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
        }
        .brand {
            text-align: center;
            margin-bottom: 32px;
        }
        .brand h1 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 42px;
            letter-spacing: -2px;
            color: var(--t1);
            line-height: 1;
        }
        .brand span {
            color: var(--accent);
        }
        .brand p {
            font-size: 13px;
            color: var(--t2);
            margin-top: 8px;
            font-weight: 300;
        }
        .login-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 26px;
            letter-spacing: -0.5px;
            color: var(--t1);
            margin-bottom: 6px;
            text-align: center;
        }
        .login-sub {
            font-size: 13px;
            color: var(--t2);
            margin-bottom: 32px;
            text-align: center;
        }
        .field {
            margin-bottom: 20px;
        }
        .field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--t2);
            margin-bottom: 8px;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--t3);
            font-size: 15px;
            pointer-events: none;
        }
        .field input {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--t1);
            border-radius: 12px;
            padding: 12px 14px 12px 42px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
            outline: none;
        }
        .field input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(200,255,0,0.08);
        }
        .field input::placeholder {
            color: var(--t3);
        }
        .field input.is-invalid {
            border-color: #ff5c5c;
        }
        .field-error {
            font-size: 12px;
            color: #ff5c5c;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .btn-login {
            width: 100%;
            background: var(--accent);
            color: #000;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            letter-spacing: 0.01em;
            margin-top: 8px;
        }
        .btn-login:hover {
            background: #d4ff26;
            transform: translateY(-2px);
        }
        .divider {
            text-align: center;
            font-size: 12px;
            color: var(--t3);
            margin: 28px 0 24px;
            position: relative;
        }
        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: var(--border);
        }
        .divider::before {
            left: 0;
        }
        .divider::after {
            right: 0;
        }
        .register-link {
            text-align: center;
            font-size: 13px;
            color: var(--t2);
        }
        .register-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .alert-success {
            background: rgba(77,255,155,0.07);
            border: 1px solid rgba(77,255,155,0.2);
            color: #4dff9b;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        @media (max-width: 520px) {
            .login-card {
                padding: 36px 24px;
            }
            .brand h1 {
                font-size: 34px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            

            <h1 class="login-title">Login Page</h1>
            <p class="login-sub">Sign in to your account to continue.</p>

            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email" required autofocus autocomplete="username" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                    </div>
                    @error('email')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="password" required autocomplete="current-password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                    </div>
                    @error('password')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</button>
            </form>

            <div class="divider">or</div>
            <div class="register-link">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>