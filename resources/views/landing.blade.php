<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G1 Group</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg:        #080808;
            --surface:   #111111;
            --surface-2: #181818;
            --border:    rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.15);
            --text-1:    #f0f0f0;
            --text-2:    #888888;
            --text-3:    #555555;
            --accent:    #c8ff00;
            --accent-dim: rgba(200,255,0,0.08);
            --glow:      rgba(200,255,0,0.15);
            --radius:    18px;
        }

        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-1);
            overflow-x: hidden;
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }

        /* ── Noise overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }

        /* ── Nav ── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 200;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            background: rgba(8,8,8,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 20px;
            color: var(--text-1);
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .logo span { color: var(--accent); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 4px;
            border-radius: 100px;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-2);
            text-decoration: none;
            padding: 6px 20px;
            border-radius: 100px;
            transition: all 0.2s ease;
            letter-spacing: 0.02em;
        }

        .nav-links a:hover { color: var(--text-1); }

        .nav-links a.active {
            background: var(--accent);
            color: #000;
            font-weight: 600;
        }

        /* ── Hero ── */
        #home {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 60px;
            position: relative;
            overflow: hidden;
        }

        /* grid lines bg */
        #home::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 50%, black 30%, transparent 100%);
            pointer-events: none;
        }

        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(200,255,0,0.06) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 0 20px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 6px 14px 6px 8px;
            border-radius: 100px;
            margin-bottom: 36px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-2);
            letter-spacing: 0.04em;
        }

        .hero-badge-dot {
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--accent);
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(0.8); }
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(60px, 10vw, 110px);
            line-height: 0.95;
            letter-spacing: -3px;
            color: var(--text-1);
            margin-bottom: 8px;
        }

        .hero-title .accent-line {
            display: block;
            color: var(--accent);
        }

        .hero-sub {
            font-size: 16px;
            font-weight: 300;
            color: var(--text-2);
            margin-top: 24px;
            letter-spacing: 0.03em;
        }

        .scroll-hint {
            position: absolute;
            bottom: 36px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--text-3);
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .scroll-line {
            width: 1px;
            height: 40px;
            background: linear-gradient(to bottom, var(--text-3), transparent);
            animation: scrollDrop 1.8s ease infinite;
        }

        @keyframes scrollDrop {
            0%   { transform: scaleY(0); transform-origin: top; opacity: 0; }
            50%  { transform: scaleY(1); transform-origin: top; opacity: 1; }
            100% { transform: scaleY(1); transform-origin: bottom; opacity: 0; }
        }

        /* ── Members ── */
        #members {
            min-height: 100vh;
            padding: 120px 24px 100px;
            background: var(--bg);
        }

        .section-head {
            max-width: 1080px;
            margin: 0 auto 56px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
        }

        .section-eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 10px;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: clamp(32px, 5vw, 52px);
            letter-spacing: -1.5px;
            color: var(--text-1);
            line-height: 1;
        }

        .member-count {
            font-family: 'Syne', sans-serif;
            font-size: clamp(48px, 6vw, 72px);
            font-weight: 800;
            color: var(--surface-2);
            letter-spacing: -2px;
            line-height: 1;
            user-select: none;
        }

        /* ── Grid ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 16px;
            max-width: 1080px;
            margin: 0 auto;
        }

        /* ── Card ── */
        .member-card {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            animation: riseUp 0.5s ease both;
        }

        .member-card:nth-child(1) { animation-delay: 0.05s; }
        .member-card:nth-child(2) { animation-delay: 0.10s; }
        .member-card:nth-child(3) { animation-delay: 0.15s; }
        .member-card:nth-child(4) { animation-delay: 0.20s; }
        .member-card:nth-child(5) { animation-delay: 0.25s; }
        .member-card:nth-child(6) { animation-delay: 0.30s; }

        @keyframes riseUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* top accent line on hover */
        .member-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .member-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.04);
        }

        .member-card:hover::before { opacity: 1; }

        /* inner glow on hover */
        .member-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 50% at 50% 0%, var(--glow), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .member-card:hover::after { opacity: 1; }

        /* ── Avatar ── */
        .avatar-wrap {
            position: relative;
            margin-bottom: 20px;
        }

        .avatar-ring {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            padding: 2px;
            background: linear-gradient(135deg, var(--accent), rgba(200,255,0,0.2));
        }

        .avatar-ring-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: var(--surface-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 26px;
            color: var(--text-1);
            border: 2px solid var(--surface);
        }

        .avatar-ring-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* ── Card content ── */
        .card-name {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 19px;
            letter-spacing: -0.4px;
            color: var(--text-1);
            margin-bottom: 4px;
        }

        .card-email {
            font-size: 12px;
            font-weight: 400;
            color: var(--text-3);
            margin-bottom: 20px;
            letter-spacing: 0.01em;
        }

        .card-divider {
            width: 100%;
            height: 1px;
            background: var(--border);
            margin-bottom: 16px;
        }

        .card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text-2);
            font-size: 11px;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 100px;
            letter-spacing: 0.02em;
            transition: border-color 0.2s, color 0.2s;
        }

        .member-card:hover .tag {
            border-color: rgba(255,255,255,0.1);
            color: var(--text-1);
        }

        .card-motto {
            width: 100%;
            font-size: 12px;
            font-weight: 300;
            font-style: italic;
            color: var(--text-2);
            line-height: 1.7;
            padding-top: 16px;
            margin-top: 16px;
            border-top: 1px solid var(--border);
            letter-spacing: 0.01em;
        }

        /* ── Footer ── */
        .footer {
            text-align: center;
            padding: 32px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            color: var(--text-3);
            letter-spacing: 0.04em;
        }

        /* ── Responsive ── */
        @media (max-width: 640px) {
            nav { padding: 0 20px; }
            .hero-title { font-size: 52px; letter-spacing: -2px; }
            .cards-grid { grid-template-columns: 1fr; }
            #members { padding: 100px 16px 60px; }
            .section-head { flex-direction: column; align-items: flex-start; gap: 8px; }
        }
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo">G1<span>.</span></a>
        <div class="nav-links">
            <a href="#home" id="homeLink">Home</a>
            <a href="#members" id="membersLink">Members</a>
        </div>
    </nav>

    <!-- Hero -->
    <div id="home" class="section">
        <div class="hero-glow"></div>
        <div class="hero-inner">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                2nd Semester · 2026
            </div>
            <h1 class="hero-title">
                Welcome to
                <span class="accent-line">G1 Group</span>
            </h1>
            <p class="hero-sub">A team built different.</p>
        </div>
        <div class="scroll-hint">
            <div class="scroll-line"></div>
            Scroll
        </div>
    </div>

    <!-- Members -->
    <div id="members" class="section">
        <div class="section-head">
            <div>
                <p class="section-eyebrow">The Team</p>
                <h2 class="section-title">Group Members</h2>
            </div>
            <div class="member-count">0{{ $members->count() }}</div>
        </div>

        <div class="cards-grid">
            @foreach($members as $member)
            <div class="member-card">
                <div class="avatar-wrap">
                    <div class="avatar-ring">
                        <div class="avatar-ring-inner">
                            @if($member->profile_photo)
                                <img src="{{ asset('storage/' . $member->profile_photo) }}"
                                     alt="{{ $member->name }}">
                            @else
                                {{ strtoupper(substr($member->name, 0, 2)) }}
                            @endif
                        </div>
                    </div>
                </div>

                <p class="card-name">{{ $member->name }}</p>
                <p class="card-email">{{ $member->email }}</p>

                @if($member->age || $member->sex || $member->address)
                <div class="card-divider"></div>
                <div class="card-tags">
                    @if($member->age)
                        <span class="tag">🎂 {{ $member->age }} yrs</span>
                    @endif
                    @if($member->sex)
                        <span class="tag">⚥ {{ ucfirst($member->sex) }}</span>
                    @endif
                    @if($member->address)
                        <span class="tag">📍 {{ $member->address }}</span>
                    @endif
                </div>
                @endif

                @if($member->motto)
                <p class="card-motto">"{{ $member->motto }}"</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <div class="footer">G1 Group · 2026</div>

    <script>
        const homeLink       = document.getElementById('homeLink');
        const membersLink    = document.getElementById('membersLink');
        const homeSection    = document.getElementById('home');
        const membersSection = document.getElementById('members');

        function updateActiveLink() {
            const hp = Math.abs(homeSection.getBoundingClientRect().top);
            const mp = Math.abs(membersSection.getBoundingClientRect().top);
            if (hp <= mp) {
                homeLink.classList.add('active');
                membersLink.classList.remove('active');
            } else {
                membersLink.classList.add('active');
                homeLink.classList.remove('active');
            }
        }

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                document.querySelector(link.getAttribute('href'))
                    .scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        window.addEventListener('scroll', updateActiveLink);
        updateActiveLink();
    </script>
</body>
</html>