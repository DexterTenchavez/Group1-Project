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
        :root{--bg:#080808;--surface:#111;--surface-2:#181818;--border:rgba(255,255,255,0.07);--t1:#f0f0f0;--t2:#888;--t3:#444;--accent:#c8ff00;}
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh;display:flex;align-items:center;justify-content:center;}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:.35;}
        .login-grid{display:grid;grid-template-columns:1fr 420px;min-height:100vh;width:100%;position:relative;z-index:1;}
        .login-left{background:linear-gradient(135deg,#0a0a0a,#0f0f0f);border-right:1px solid var(--border);display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px;position:relative;overflow:hidden;}
        .login-left::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.025) 1px,transparent 1px);background-size:50px 50px;mask-image:radial-gradient(ellipse 80% 80% at 50% 50%,black 30%,transparent 100%);}
        .glow-orb{position:absolute;width:500px;height:500px;background:radial-gradient(circle,rgba(200,255,0,0.05) 0%,transparent 70%);top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none;}
        .left-content{position:relative;z-index:1;text-align:center;}
        .brand{font-family:'Syne',sans-serif;font-weight:800;font-size:52px;letter-spacing:-2px;color:var(--t1);line-height:1;}
        .brand span{color:var(--accent);}
        .brand-sub{font-size:15px;color:var(--t2);margin-top:12px;font-weight:300;}
        .login-right{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:60px 48px;background:var(--bg);}
        .login-box{width:100%;max-width:360px;}
        .login-title{font-family:'Syne',sans-serif;font-weight:800;font-size:26px;letter-spacing:-.5px;color:var(--t1);margin-bottom:6px;}
        .login-sub{font-size:13px;color:var(--t2);margin-bottom:36px;}
        .field{margin-bottom:20px;}
        .field label{display:block;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--t2);margin-bottom:8px;}
        .input-wrap{position:relative;}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--t3);font-size:15px;pointer-events:none;}
        .field input{width:100%;background:var(--surface);border:1px solid var(--border);color:var(--t1);border-radius:10px;padding:11px 14px 11px 40px;font-size:14px;font-family:'DM Sans',sans-serif;transition:border-color .2s,box-shadow .2s;outline:none;}
        .field input:focus{border-color:rgba(200,255,0,.4);box-shadow:0 0 0 3px rgba(200,255,0,.08);}
        .field input::placeholder{color:var(--t3);}
        .field input.is-invalid{border-color:#ff5c5c;}
        .field-error{font-size:12px;color:#ff5c5c;margin-top:6px;display:flex;align-items:center;gap:5px;}
        .field-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;}
        .remember{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--t2);}
        .remember input[type=checkbox]{accent-color:var(--accent);width:15px;height:15px;}
        .forgot{font-size:13px;color:var(--accent);text-decoration:none;}
        .forgot:hover{text-decoration:underline;}
        .btn-login{width:100%;background:var(--accent);color:#000;border:none;border-radius:10px;padding:13px;font-size:14px;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .2s;letter-spacing:.01em;}
        .btn-login:hover{background:#d4ff26;transform:translateY(-1px);}
        .divider{text-align:center;font-size:12px;color:var(--t3);margin:24px 0;position:relative;}
        .divider::before,.divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:var(--border);}
        .divider::before{left:0;}.divider::after{right:0;}
        .register-link{text-align:center;font-size:13px;color:var(--t2);}
        .register-link a{color:var(--accent);text-decoration:none;font-weight:600;}
        .register-link a:hover{text-decoration:underline;}
        .alert-success{background:rgba(77,255,155,.07);border:1px solid rgba(77,255,155,.2);color:#4dff9b;border-radius:10px;padding:12px 16px;font-size:13px;margin-bottom:20px;}
        @media(max-width:768px){.login-grid{grid-template-columns:1fr;}.login-left{display:none;}.login-right{padding:40px 28px;}}
    </style>
</head>
<body>
    <div class="login-grid">
        <div class="login-left">
            <div class="glow-orb"></div>
            <div class="left-content">
                <div class="brand">G1<span>.</span></div>
                <p class="brand-sub">2nd Semester · 2026</p>
            </div>
        </div>
        <div class="login-right">
            <div class="login-box">
                <h1 class="login-title">Welcome back</h1>
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
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus autocomplete="username" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                        </div>
                        @error('email')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                        </div>
                        @error('password')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="field-row">
                        <label class="remember">
                            <input type="checkbox" name="remember" id="remember_me">
                            Remember me
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In</button>
                </form>

                <div class="divider">or</div>
                <div class="register-link">Don't have an account? <a href="{{ route('register') }}">Sign up</a></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>