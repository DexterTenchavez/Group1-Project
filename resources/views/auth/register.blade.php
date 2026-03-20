<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'G1 Group') }} — Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--bg:#080808;--surface:#111;--surface-2:#181818;--border:rgba(255,255,255,0.07);--t1:#f0f0f0;--t2:#888;--t3:#444;--accent:#c8ff00;}
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--t1);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:40px 20px;}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:0;opacity:.35;}
        .register-wrap{position:relative;z-index:1;width:100%;max-width:480px;}
        .brand-top{text-align:center;margin-bottom:32px;}
        .brand-top a{font-family:'Syne',sans-serif;font-weight:800;font-size:28px;letter-spacing:-1px;color:var(--t1);text-decoration:none;}
        .brand-top a span{color:var(--accent);}
        .register-box{background:var(--surface);border:1px solid var(--border);border-radius:20px;padding:40px;}
        .reg-title{font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:var(--t1);margin-bottom:4px;}
        .reg-sub{font-size:13px;color:var(--t2);margin-bottom:30px;}
        .field{margin-bottom:18px;}
        .field label{display:block;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--t2);margin-bottom:8px;}
        .input-wrap{position:relative;}
        .input-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--t3);font-size:15px;pointer-events:none;}
        .field input{width:100%;background:var(--surface-2);border:1px solid var(--border);color:var(--t1);border-radius:10px;padding:11px 14px 11px 40px;font-size:14px;font-family:'DM Sans',sans-serif;transition:border-color .2s,box-shadow .2s;outline:none;}
        .field input:focus{border-color:rgba(200,255,0,.4);box-shadow:0 0 0 3px rgba(200,255,0,.08);}
        .field input::placeholder{color:var(--t3);}
        .field input.is-invalid{border-color:#ff5c5c;}
        .field-error{font-size:12px;color:#ff5c5c;margin-top:6px;}
        .btn-register{width:100%;background:var(--accent);color:#000;border:none;border-radius:10px;padding:13px;font-size:14px;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .2s;margin-top:8px;}
        .btn-register:hover{background:#d4ff26;transform:translateY(-1px);}
        .login-link{text-align:center;font-size:13px;color:var(--t2);margin-top:24px;}
        .login-link a{color:var(--accent);text-decoration:none;font-weight:600;}
        .login-link a:hover{text-decoration:underline;}
    </style>
</head>
<body>
    <div class="register-wrap">
        <div class="brand-top"><a href="/">G1<span>.</span></a></div>
        <div class="register-box">
            <h1 class="reg-title">Create an account</h1>
            <p class="reg-sub">Join G1 Group today.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Full Name</label>
                    <div class="input-wrap">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your full name" required autofocus autocomplete="name" class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                    </div>
                    @error('name')<div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username" class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                    </div>
                    @error('email')<div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="Min. 8 characters" required autocomplete="new-password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                    </div>
                    @error('password')<div class="field-error"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat password" required autocomplete="new-password">
                    </div>
                </div>

                <button type="submit" class="btn-register"><i class="bi bi-person-plus me-2"></i>Create Account</button>
            </form>

            <div class="login-link">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>