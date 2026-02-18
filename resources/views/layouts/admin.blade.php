<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHRONOS | Command Center</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --obsidian: #050505;
            --charcoal: #0f0f0f;
            --gold-gradient: linear-gradient(135deg, #bf953f 0%, #fcf6ba 45%, #b38728 70%, #fbf5b7 100%);
            --gold-flat: #d4af37;
            --border-glass: rgba(255, 255, 255, 0.08);
        }

        body {
            background-color: var(--obsidian);
            color: #ffffff;
            font-family: 'Montserrat', sans-serif;
            background-image: radial-gradient(circle at 80% 0%, #1a1a1a 0%, #050505 100%);
            min-height: 100vh;
        }

        /* --- TEXT VISIBILITY FIX --- */
        small, .small, .text-muted {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        .text-gold { color: var(--gold-flat) !important; }

        /* --- TYPOGRAPHY --- */
        h1, h2, h3, h4, .serif-font, .navbar-brand {
            font-family: 'Cinzel', serif;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .text-gold-gradient {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        /* --- SIDEBAR NAVIGATION --- */
        .sidebar {
            background: rgba(10, 10, 10, 0.95);
            border-right: 1px solid var(--border-glass);
            min-height: 100vh;
            padding-top: 2rem;
        }

        .nav-link {
            color: #ffffff !important;
            padding: 1rem 2rem;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 2px;
            border-left: 3px solid transparent;
            transition: 0.3s;
            opacity: 0.7;
        }

        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
            opacity: 1;
            background: rgba(212, 175, 55, 0.1);
            border-left-color: var(--gold-flat);
            text-shadow: 0 0 10px rgba(255,255,255,0.2);
        }

        .nav-link i { margin-right: 10px; font-size: 1.1rem; }

        /* --- CARDS & PANELS --- */
        .admin-card {
            background: var(--charcoal);
            border: 1px solid var(--border-glass);
            padding: 2rem;
            transition: 0.4s;
        }

        .admin-card:hover {
            border-color: var(--gold-flat);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        /* --- BUTTONS --- */
        .btn-luxury {
            background: transparent;
            border: 1px solid var(--gold-flat);
            color: var(--gold-flat);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.7rem;
            padding: 10px 25px;
            border-radius: 0;
            transition: 0.4s;
        }

        .btn-luxury:hover {
            background: var(--gold-flat);
            color: #000;
        }

        /* --- TABLES --- */
        .table-dark {
            --bs-table-bg: transparent;
            --bs-table-border-color: var(--border-glass);
            color: #ffffff;
        }
        
        thead th {
            font-family: 'Cinzel', serif;
            color: var(--gold-flat);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            border-bottom: 1px solid var(--gold-flat) !important;
            padding-bottom: 1rem !important;
        }
        
        tbody td {
            vertical-align: middle;
            color: #ffffff !important;
            font-weight: 300;
            padding: 1.2rem 0.5rem !important;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
            <div class="position-sticky">
                <div class="px-4 mb-5">
                    <h3 class="text-gold-gradient fs-4">CHRONOS</h3>
                    <small class="text-white text-uppercase ls-2" style="font-size: 0.6rem; opacity: 0.8;">Command Center</small>
                </div>

                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.watches.*') ? 'active' : '' }}" href="{{ route('admin.watches.index') }}">
                            <i class="bi bi-watch"></i> Timepieces
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-tags"></i> Classifications
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                            <i class="bi bi-clipboard-data"></i> Orders
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4 pt-4 border-top border-secondary border-opacity-25">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i> Live Site
                        </a>
                    </li>
                </ul>

                <div class="mt-5 px-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light w-100 text-uppercase" style="font-size: 0.7rem; letter-spacing: 2px; opacity: 0.7;">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-5">
            @if(session('success'))
                <div class="alert alert-dark border-warning text-warning mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-dark border-danger text-danger mb-4" role="alert" style="background: rgba(220, 53, 69, 0.1);">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>