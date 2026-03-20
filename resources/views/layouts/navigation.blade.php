@php
    $isDashboard = request()->routeIs('admin.dashboard');
    $isUsers     = request()->routeIs('admin.users.*');
@endphp

<style>
    .nav-pill {
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        padding: 6px 18px;
        border-radius: 100px;
        transition: all .2s;
        color: #888;
        background: transparent;
    }
    .nav-pill:hover {
        color: #f0f0f0;
    }
    .nav-pill.nav-active {
        color: #000;
        background: #c8ff00;
        font-weight: 600;
    }
    .nav-dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #111;
        border: 1px solid rgba(255,255,255,0.07);
        color: #f0f0f0;
        padding: 6px 14px 6px 8px;
        border-radius: 100px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
    }
    .nav-dropdown-toggle:hover {
        border-color: rgba(255,255,255,0.14);
    }
</style>

<nav style="position:fixed;top:0;left:0;right:0;z-index:200;height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 40px;background:rgba(8,8,8,0.9);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.07);">

    <a href="{{ url('/') }}" style="font-family:'Syne',sans-serif;font-weight:800;font-size:20px;color:#f0f0f0;text-decoration:none;letter-spacing:-0.3px;">
        G1<span style="color:#c8ff00;">.</span>
    </a>

    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
        style="background:none;border:1px solid rgba(255,255,255,0.1);color:#f0f0f0;padding:6px 10px;border-radius:8px;">
        <i class="bi bi-list"></i>
    </button>

    <div class="collapse navbar-collapse" id="navMain" style="flex-grow:0;">
        <div style="display:flex;align-items:center;gap:4px;background:#111;border:1px solid rgba(255,255,255,0.07);padding:4px;border-radius:100px;">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-pill {{ $isDashboard ? 'nav-active' : '' }}">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-pill {{ $isUsers ? 'nav-active' : '' }}">
                        <i class="bi bi-people me-1"></i>Users
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div style="display:flex;align-items:center;gap:8px;">
        @guest
            <a href="{{ route('login') }}"
                style="font-size:13px;font-weight:500;color:#888;text-decoration:none;padding:7px 18px;border-radius:100px;border:1px solid rgba(255,255,255,0.07);transition:all .2s;">
                Login
            </a>
            <a href="{{ route('register') }}"
                style="font-size:13px;font-weight:600;color:#000;text-decoration:none;padding:7px 18px;border-radius:100px;background:#c8ff00;">
                Register
            </a>
        @else
            <div class="dropdown">
                <button class="nav-dropdown-toggle" data-bs-toggle="dropdown">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            style="width:28px;height:28px;border-radius:50%;object-fit:cover;border:2px solid #c8ff00;">
                    @else
                        <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#c8ff00,rgba(200,255,0,0.3));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#000;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                    @endif
                    {{ Auth::user()->name }}
                    <i class="bi bi-chevron-down" style="font-size:10px;opacity:.5;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end"
                    style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:6px;margin-top:8px;min-width:160px;">
                    <li>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item"
                            style="color:#ccc;font-size:13px;border-radius:8px;padding:8px 14px;">
                            <i class="bi bi-person me-2"></i>Profile
                        </a>
                    </li>
                    <li><hr style="border-color:rgba(255,255,255,0.07);margin:4px 0;"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"
                                style="color:#ff6b6b;font-size:13px;border-radius:8px;padding:8px 14px;width:100%;text-align:left;background:none;border:none;cursor:pointer;">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endguest
    </div>

</nav>