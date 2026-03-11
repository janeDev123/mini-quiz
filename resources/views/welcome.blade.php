<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Quiz System — Challenge Your Mind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0a0a0f;
            --cream: #f5f0e8;
            --gold: #e8c547;
            --coral: #ff6b4a;
            --muted: #9a9587;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--ink);
            color: var(--cream);
            overflow-x: hidden;
            min-height: 100vh;
        }

        h1, h2, h3, .display {
            font-family: 'Syne', sans-serif;
        }

        /* --- Noise Texture Overlay --- */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1000;
            opacity: 0.4;
        }

        /* --- Gradient Mesh Background --- */
        .mesh-bg {
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 20%, rgba(232,197,71,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 80% 80%, rgba(255,107,74,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 50% 50%, rgba(80,60,120,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* --- Grid Lines --- */
        .grid-lines {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(245,240,232,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(245,240,232,0.03) 1px, transparent 1px);
            background-size: 80px 80px;
            pointer-events: none;
        }

        /* --- Navigation --- */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            padding: 1.5rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(245,240,232,0.06);
            backdrop-filter: blur(12px);
            background: rgba(10,10,15,0.6);
        }

        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .logo-dot {
            width: 8px;
            height: 8px;
            background: var(--gold);
            border-radius: 50%;
            animation: blink 2s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-nav-ghost {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: rgba(245,240,232,0.65);
            padding: 0.55rem 1.2rem;
            border-radius: 50px;
            border: 1px solid rgba(245,240,232,0.12);
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.01em;
        }

        .btn-nav-ghost:hover {
            color: var(--cream);
            border-color: rgba(245,240,232,0.3);
            background: rgba(245,240,232,0.05);
        }

        .btn-nav-primary {
            font-family: 'Syne', sans-serif;
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--ink);
            background: var(--gold);
            padding: 0.55rem 1.4rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.25s ease;
            letter-spacing: 0.01em;
        }

        .btn-nav-primary:hover {
            background: #f0d060;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(232,197,71,0.3);
        }

        /* --- Hero Section --- */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 8rem 2.5rem 5rem;
            position: relative;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        /* --- Hero Text --- */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: fadeUp 0.7s ease forwards 0.1s;
        }

        .eyebrow-line {
            width: 24px;
            height: 1px;
            background: var(--gold);
        }

        .hero-title {
            font-family: 'Syne', sans-serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            font-weight: 800;
            line-height: 0.95;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: fadeUp 0.7s ease forwards 0.2s;
        }

        .title-accent {
            color: var(--gold);
            position: relative;
            display: inline-block;
        }

        .title-accent::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--coral);
            transform: scaleX(0);
            transform-origin: left;
            animation: underlineIn 0.6s ease forwards 0.9s;
        }

        @keyframes underlineIn {
            to { transform: scaleX(1); }
        }

        .hero-desc {
            font-size: 1.05rem;
            line-height: 1.7;
            color: rgba(245,240,232,0.55);
            max-width: 420px;
            margin-bottom: 2.5rem;
            opacity: 0;
            animation: fadeUp 0.7s ease forwards 0.35s;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0;
            animation: fadeUp 0.7s ease forwards 0.5s;
        }

        .btn-primary {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.02em;
            color: var(--ink);
            background: var(--gold);
            padding: 0.9rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s ease;
            box-shadow: 0 0 0 0 rgba(232,197,71,0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(232,197,71,0.35);
            background: #f0d060;
        }

        .btn-secondary {
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            color: rgba(245,240,232,0.7);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.2s ease;
            padding: 0.9rem 1.2rem;
            border-radius: 50px;
            border: 1px solid rgba(245,240,232,0.12);
        }

        .btn-secondary:hover {
            color: var(--cream);
            border-color: rgba(245,240,232,0.3);
            background: rgba(245,240,232,0.04);
        }

        /* --- Stats Strip --- */
        .hero-stats {
            display: flex;
            gap: 2.5rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(245,240,232,0.08);
            opacity: 0;
            animation: fadeUp 0.7s ease forwards 0.65s;
        }

        .stat-item .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--cream);
            line-height: 1;
        }

        .stat-item .stat-label {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 0.2rem;
            letter-spacing: 0.05em;
        }

        /* --- Feature Card (Right Side) --- */
        .feature-panel {
            position: relative;
            opacity: 0;
            animation: fadeLeft 0.8s ease forwards 0.4s;
        }

        @keyframes fadeLeft {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .panel-card {
            background: rgba(245,240,232,0.04);
            border: 1px solid rgba(245,240,232,0.09);
            border-radius: 24px;
            padding: 2rem;
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
        }

        .panel-card::before {
            content: '';
            position: absolute;
            top: -1px;
            left: 20%;
            right: 20%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(232,197,71,0.5), transparent);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.75rem;
        }

        .panel-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .live-badge {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #4ade80;
            background: rgba(74,222,128,0.1);
            border: 1px solid rgba(74,222,128,0.2);
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
        }

        .live-dot {
            width: 6px;
            height: 6px;
            background: #4ade80;
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }

        /* Feature Grid */
        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .feature-tile {
            background: rgba(245,240,232,0.03);
            border: 1px solid rgba(245,240,232,0.07);
            border-radius: 14px;
            padding: 1rem;
            transition: all 0.2s ease;
        }

        .feature-tile:hover {
            background: rgba(245,240,232,0.06);
            border-color: rgba(245,240,232,0.14);
            transform: translateY(-2px);
        }

        .tile-icon {
            font-size: 1.4rem;
            margin-bottom: 0.6rem;
            display: block;
        }

        .tile-name {
            font-family: 'Syne', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 0.2rem;
        }

        .tile-desc {
            font-size: 0.7rem;
            color: var(--muted);
            line-height: 1.4;
        }

        /* Progress bars */
        .progress-section {
            margin-bottom: 1.5rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.4rem;
        }

        .progress-name {
            font-size: 0.78rem;
            color: rgba(245,240,232,0.7);
        }

        .progress-pct {
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--gold);
        }

        .progress-bar {
            height: 4px;
            background: rgba(245,240,232,0.07);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transform: scaleX(0);
            transform-origin: left;
            animation: barFill 1s ease forwards;
        }

        @keyframes barFill {
            to { transform: scaleX(1); }
        }

        .fill-gold { background: var(--gold); animation-delay: 0.6s; }
        .fill-coral { background: var(--coral); animation-delay: 0.75s; }
        .fill-teal { background: #5eead4; animation-delay: 0.9s; }

        /* CTA inside panel */
        .panel-cta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
        }

        .panel-btn {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            text-align: center;
            padding: 0.75rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            letter-spacing: 0.02em;
        }

        .panel-btn-gold {
            background: var(--gold);
            color: var(--ink);
        }

        .panel-btn-gold:hover {
            background: #f0d060;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(232,197,71,0.3);
        }

        .panel-btn-outline {
            background: transparent;
            color: rgba(245,240,232,0.7);
            border: 1px solid rgba(245,240,232,0.12);
        }

        .panel-btn-outline:hover {
            background: rgba(245,240,232,0.05);
            color: var(--cream);
            border-color: rgba(245,240,232,0.25);
        }

        /* --- Floating elements decoration --- */
        .deco-circle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        /* --- Bottom ticker --- */
        .ticker-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background: rgba(10,10,15,0.85);
            border-top: 1px solid rgba(245,240,232,0.06);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            overflow: hidden;
            z-index: 40;
        }

        .ticker-inner {
            display: flex;
            gap: 4rem;
            animation: tickerScroll 30s linear infinite;
            white-space: nowrap;
            padding-left: 100%;
        }

        @keyframes tickerScroll {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        .ticker-item {
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(245,240,232,0.35);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ticker-sep {
            width: 4px;
            height: 4px;
            background: var(--gold);
            border-radius: 50%;
            opacity: 0.5;
        }

        /* --- Animations --- */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Responsive --- */
        @media (max-width: 900px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 3rem;
                padding-top: 1rem;
            }

            .feature-panel {
                animation-name: fadeUp;
            }

            nav {
                padding: 1.2rem 1.5rem;
            }

            .hero {
                padding: 7rem 1.5rem 5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links .btn-nav-ghost { display: none; }
            .hero-stats { gap: 1.5rem; }
            .feature-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

    <!-- Mesh + Grid -->
    <div class="mesh-bg"></div>
    <div class="grid-lines"></div>

    <!-- Decorative circles -->
    <div class="deco-circle" style="width:500px;height:500px;top:-150px;right:-100px;background:radial-gradient(circle,rgba(232,197,71,0.04),transparent 70%);"></div>
    <div class="deco-circle" style="width:400px;height:400px;bottom:0;left:-100px;background:radial-gradient(circle,rgba(255,107,74,0.05),transparent 70%);"></div>

    <!-- Navigation -->
    <nav>
        <div class="nav-logo">
            <div class="logo-dot"></div>
            MiniQuiz
        </div>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="btn-nav-ghost">Sign In</a>
            <a href="{{ route('register') }}" class="btn-nav-primary">Get Started →</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-inner">

            <!-- Left: Copy -->
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <span class="eyebrow-line"></span>
                    Challenge Your Mind
                </div>

                <h1 class="hero-title">
                    Test How Much<br>
                    You Really<br>
                    <span class="title-accent">Know.</span>
                </h1>

                <p class="hero-desc">
                    A fast, focused quiz platform across 10+ categories.
                    Pick a topic, set your difficulty, and find out where you really stand.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn-primary">
                        Start for Free
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary">
                        Sign In
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M10 8H3M6 5l-3 3 3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-num">10K+</div>
                        <div class="stat-label">Active users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">50K+</div>
                        <div class="stat-label">Quizzes taken</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">4.8 ★</div>
                        <div class="stat-label">User rating</div>
                    </div>
                </div>
            </div>

            <!-- Right: Feature Panel -->
            <div class="feature-panel">
                <div class="panel-card">
                    <div class="panel-header">
                        <span class="panel-title">What's Inside</span>
                        <span class="live-badge"><span class="live-dot"></span> Live</span>
                    </div>

                    <!-- Feature tiles -->
                    <div class="feature-grid">
                        <div class="feature-tile">
                            <span class="tile-icon">🎯</span>
                            <div class="tile-name">10+ Topics</div>
                            <div class="tile-desc">Science, History, Tech & more</div>
                        </div>
                        <div class="feature-tile">
                            <span class="tile-icon">⚡</span>
                            <div class="tile-name">Quick Rounds</div>
                            <div class="tile-desc">5 to 20 questions per quiz</div>
                        </div>
                        <div class="feature-tile">
                            <span class="tile-icon">📊</span>
                            <div class="tile-name">Instant Score</div>
                            <div class="tile-desc">Real-time results & feedback</div>
                        </div>
                        <div class="feature-tile">
                            <span class="tile-icon">🏆</span>
                            <div class="tile-name">Leaderboard</div>
                            <div class="tile-desc">See where you rank</div>
                        </div>
                    </div>

                    <!-- Progress / Category popularity -->
                    <div class="progress-section">
                        <div style="font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--muted);margin-bottom:0.75rem;font-weight:500;">Top Categories Today</div>
                        <div style="display:flex;flex-direction:column;gap:0.7rem;">
                            <div>
                                <div class="progress-label">
                                    <span class="progress-name">General Knowledge</span>
                                    <span class="progress-pct">78%</span>
                                </div>
                                <div class="progress-bar"><div class="progress-fill fill-gold" style="width:78%"></div></div>
                            </div>
                            <div>
                                <div class="progress-label">
                                    <span class="progress-name">Science</span>
                                    <span class="progress-pct">61%</span>
                                </div>
                                <div class="progress-bar"><div class="progress-fill fill-coral" style="width:61%"></div></div>
                            </div>
                            <div>
                                <div class="progress-label">
                                    <span class="progress-name">Technology</span>
                                    <span class="progress-pct">49%</span>
                                </div>
                                <div class="progress-bar"><div class="progress-fill fill-teal" style="width:49%"></div></div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA buttons -->
                    <div class="panel-cta">
                        <a href="{{ route('register') }}" class="panel-btn panel-btn-gold">Create Account</a>
                        <a href="{{ route('login') }}" class="panel-btn panel-btn-outline">Login</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Bottom Ticker -->
    <div class="ticker-bar">
        <div class="ticker-inner">
            @php
                $items = ['General Knowledge','Science','History','Technology','Mathematics','Pop Culture','Geography','Sports','Literature','Music','Film & TV','Art'];
                $doubled = array_merge($items,$items);
            @endphp
            @foreach($doubled as $item)
                <span class="ticker-item">
                    <span class="ticker-sep"></span>
                    {{ $item }}
                </span>
            @endforeach
        </div>
    </div>

</body>
</html>