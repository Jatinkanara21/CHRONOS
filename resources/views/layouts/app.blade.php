<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHRONOS | Haute Horlogerie</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Montserrat:wght@200;300;400;500&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* --- THE LUXURY PALETTE --- */
            --obsidian-deep: #020202; /* Purest black */
            --obsidian-surface: #0a0a0a; /* Slightly lighter black for cards */
            --gold-metallic: linear-gradient(135deg, #bf953f 0%, #fcf6ba 25%, #b38728 50%, #fbf5b7 75%, #aa771c 100%); /* Realistic metal look */
            --gold-flat: #d4af37; /* Fallback flat gold */
            --glass-border: rgba(212, 175, 55, 0.15); /* Subtle gold border */
        }

        body {
            background-color: var(--obsidian-deep);
            color: #e0e0e0;
            font-family: 'Montserrat', sans-serif;
            /* Subtle radial gradient gives depth to the darkness */
            background-image: radial-gradient(circle at 60% -20%, #1a1a1a 0%, #020202 70%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- TYPOGRAPHY --- */
        h1, h2, h3, h4, h5, .navbar-brand, .serif-font {
            font-family: 'Cinzel', serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Text that looks like real gold metal */
        .text-gold-gradient {
            background: var(--gold-metallic);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }
        .text-gold-flat { color: var(--gold-flat) !important; }

        /* Utility for wide letter spacing (crucial for luxury feel) */
        .ls-3 { letter-spacing: 3px; }
        .ls-5 { letter-spacing: 5px; }

        /* --- PREMIUM NAVIGATION --- */
        .navbar {
            background: rgba(2, 2, 2, 0.85); /* Semi-transparent black */
            backdrop-filter: blur(20px); /* Frosted glass effect */
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 0;
            transition: all 0.4s ease;
        }

        .navbar-brand {
            font-size: 1.8rem;
            letter-spacing: 5px;
            font-weight: 700;
        }

        .nav-link {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: rgba(255,255,255,0.6) !important;
            transition: 0.3s;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px; left: 50%; width: 0; height: 1px;
            background: var(--gold-metallic);
            transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            transform: translateX(-50%);
        }

        .nav-link:hover, .nav-link.active { color: #fff !important; }
        .nav-link:hover::after, .nav-link.active::after { width: 80%; }

        /* --- LUXURY BUTTONS --- */
        .btn-gold {
            background: transparent;
            border: 1px solid var(--gold-flat);
            color: var(--gold-flat);
            padding: 15px 45px;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 0.7rem;
            position: relative;
            overflow: hidden;
            transition: all 0.5s;
            border-radius: 0; /* Sharp corners act more premium */
            z-index: 1;
        }

        .btn-gold::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 0; height: 100%;
            background: var(--gold-metallic);
            transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
            z-index: -1;
        }

        .btn-gold:hover { color: #000; border-color: transparent; box-shadow: 0 0 30px rgba(212, 175, 55, 0.3); }
        .btn-gold:hover::before { width: 100%; }

        /* --- PRODUCT CARDS --- */
        .luxury-card {
            background: var(--obsidian-surface);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
            overflow: hidden;
            height: 100%;
        }

        .luxury-card:hover {
            border-color: var(--gold-flat);
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.8);
        }

        .img-zoom-container {
            overflow: hidden;
            height: 400px;
            position: relative;
        }
        
        .img-zoom-container::after {
             /* Subtle dark overlay on images */
            content: ''; position: absolute; top:0; left:0; width:100%; height:100%;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        .img-zoom-container img {
            transition: transform 1.5s cubic-bezier(0.19, 1, 0.22, 1);
            width: 100%; height: 100%; object-fit: cover;
        }

        .luxury-card:hover .img-zoom-container img { transform: scale(1.1); }

        /* --- LAYOUT FIXES --- */
        main {
            /* Pushes content down so the fixed navbar doesn't cover it */
            padding-top: 90px;
            flex: 1;
        }

        footer {
            background: #000;
            border-top: 1px solid var(--glass-border);
            padding: 5rem 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
    <div class="container">
        <a class="navbar-brand text-gold-gradient" href="{{ route('home') }}">CHRONOS</a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('watches.index') }}">Timepieces</a></li>
                
            </ul>
            
            <ul class="navbar-nav align-items-center gap-4">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Sign In</a></li>
                @else
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-handbag fs-5"></i>
                            @php $count = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity'); @endphp
                            @if($count > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-warning text-dark" style="font-size: 0.6rem;">{{ $count }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-secondary shadow-lg">
                            <li><a class="dropdown-item text-light small ls-3" href="{{ route('orders.history') }}">ORDERS</a></li>
                            @if(Auth::user()->is_admin)
                            <li><a class="dropdown-item text-warning small ls-3" href="{{ route('admin.dashboard') }}">ADMIN</a></li>
                            @endif
                            <li><hr class="dropdown-divider bg-secondary"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">@csrf<button class="dropdown-item text-danger small ls-3">LOGOUT</button></form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <div class="container text-center">
        <h2 class="text-gold-gradient fs-3 mb-4">CHRONOS</h2>
        <p class="text-muted small ls-3 opacity-50">GENEVA &bull; LONDON &bull; DUBAI</p>
        <div class="mt-5 pt-4 border-top border-secondary opacity-25">
            <p class="small">&copy; {{ date('Y') }} Haute Horlogerie. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>