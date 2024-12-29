<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gamer Fest - Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&family=Press+Start+2P&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root {
                --dynamic-color: #c43cc6;
            }

            body {
                background: linear-gradient(to bottom, #0d0d0d, #1a1a1a);
                color: #fff;
                font-family: 'League Spartan', sans-serif;
            }
            .navbar {
                background-color: #0d0d0d;
                border-bottom: 3px solid var(--dynamic-color);
                position: sticky;
                top: 0;
                z-index: 1000;
            }
            .navbar .nav-link {
                color: #fff;
                font-size: 0.9rem;
                text-transform: uppercase;
            }
            .navbar .nav-link.active {
                color: var(--dynamic-color);
                border-bottom: 2px solid var(--dynamic-color);
                padding-bottom: 5px;
            }
            .btn-register-fixed {
                position: absolute;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background-color: var(--dynamic-color);
                color: #fff;
                border-radius: 20px;
                padding: 0.5rem 1.5rem;
                border: 2px solid var(--dynamic-color);
                font-size: 0.9rem;
                z-index: 1000;
                transition: background-color 0.3s, color 0.3s;
                display: block;
            }
            .btn-register-fixed:hover {
                background-color: transparent;
                color: var(--dynamic-color);
            }
            .btn-register-fixed.hidden {
                display: none;
            }
            .hero {
                display: flex;
                align-items: center;
                justify-content: space-between;
                background-color: #000;
                padding: 3rem;
                border-top: 3px solid var(--dynamic-color);
            }
            .hero h1 {
                color: var(--dynamic-color);
                text-transform: uppercase;
                font-size: 2rem;
                text-shadow: 0px 0px 8px var(--dynamic-color);
                font-family: 'Press Start 2P', cursive;
            }
            .hero p {
                margin-top: 1rem;
                font-size: 0.9rem;
            }
            .hero img {
                max-width: 400px;
                height: auto;
                border-radius: 10px;
                box-shadow: 0px 0px 15px var(--dynamic-color);
            }
            .cards {
                background-color: #000;
                display: flex;
                justify-content: center;
                gap: 1rem;
                padding: 2rem;
            }
            .section-title {
                background-color: #000;
                text-align: center;
                font-family: 'Press Start 2P', cursive;
                color: var(--dynamic-color);
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-shadow: 0px 0px 8px var(--dynamic-color);
            }
            .card {
                background-color: #000;
                border: 2px solid var(--dynamic-color);
                border-radius: 15px;
                text-align: center;
                padding: 1.5rem;
                box-shadow: 0px 0px 10px var(--dynamic-color);
                transition: transform 0.3s, box-shadow 0.3s;
            }
            .card:hover {
                transform: scale(1.05);
                box-shadow: 0px 0px 20px var(--dynamic-color);
            }
            .card h3 {
                color: var(--dynamic-color);
                margin-bottom: 1rem;
                font-size: 1rem;
                font-family: 'Press Start 2P', cursive;
            }
            .card p {
                font-size: 0.8rem;
                color: #fff;
            }
            .games-section {
                padding: 2rem;
                background-color: #000;
            }
            .games-section h2 {
                text-align: center;
                font-family: 'Press Start 2P', cursive;
                color: var(--dynamic-color);
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-shadow: 0px 0px 8px var(--dynamic-color);
            }
            .games-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            .games-grid img {
                width: 100%;
                height: auto;
                border-radius: 10px;
                box-shadow: 0px 0px 10px var(--dynamic-color);
                transition: transform 0.3s;
            }
            .games-grid img:hover {
                transform: scale(1.05);
            }
            .games-grid p {
                text-align: center;
                margin-top: 0.5rem;
                font-size: 0.9rem;
                color: #fff;
            }
            .sponsors-section {
                background-color: #000;
                padding: 2rem;
                border-top: 3px solid var(--dynamic-color);
            }
            .sponsors-section h2 {
                text-align: center;
                font-family: 'Press Start 2P', cursive;
                color: var(--dynamic-color);
                font-size: 1.5rem;
                margin-bottom: 1rem;
                text-shadow: 0px 0px 8px var(--dynamic-color);
            }
            .sponsors-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 2rem;
                justify-items: center;
                align-items: center;
            }
            .sponsors-grid img {
                max-width: 120px;
                height: auto;
                filter: grayscale(100%);
                transition: filter 0.3s;
            }
            .sponsors-grid img:hover {
                filter: grayscale(0%);
            }
            footer {
                background-color: #000;
                color: #fff;
                text-align: center;
                padding: 1rem;
                font-size: 0.8rem;
                border-top: 3px solid var(--dynamic-color);
            }
            .btn-register-fixed {
                position: static;
                transform: none;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="/images/logo.jpg" alt="Logo" style="height: 50px; margin-right: 10px;">
                    <span style="color: #fff; font-size: 1.2rem; font-family: 'Press Start 2P', cursive;">Gamer Fest</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#games-section">Juegos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Iniciar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero">
            <div style="flex: 1; padding-right: 1rem;">
                <h1>
                    Bienvenido a Gamer Fest
                </h1>
                <p>
                    Torneo universitario organizado por estudiantes de la UNIVERSIDAD ESPE sede LATACUNGA
                </p>
                <a class="btn-register-fixed" id="register-button" href="/register">
                    Inscríbete Ya!
                </a>
            </div>
            <div style="flex: 1; text-align: center;">
                <img src="/images/logo.jpg" alt="Gamer Fest Visual">
            </div>
        </section>

        <!-- Cards Section -->
        <section>
            <h2 class="section-title">¿Qué es Gamer Fest?</h2>
            <div class="cards">
                <div class="card">
                    <h3>Torneos, competencias</h3>
                    <p>Únete a torneos hechos a medida y juega de una manera diferente a tus juegos favoritos.</p>
                </div>
                <div class="card">
                    <h3>Premios</h3>
                    <p>Gana grandes premios por demostrar tu habilidad.</p>
                </div>
                <div class="card">
                    <h3>Juegos</h3>
                    <p>Tenemos juegos grupales e individuales para la mejor diversión.</p>
                </div>
            </div>
        </section>

        <!-- Games Section -->
        <section class="games-section" id="games-section">
            <h2>Nuestros Juegos</h2>
            <div class="games-grid">
                @foreach($juegos as $juego)
                    <div>
                        <img src="{{ asset('storage/' . $juego->ImagenJuego) }}" alt="{{ $juego->NombreJuego }}">
                        <p>{{ $juego->NombreJuego }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Sponsors Section -->
        <section class="sponsors-section">
            <h2>Confían en nosotros</h2>
            <div class="sponsors-grid">
                <img src="/images/activision.png" alt="Activision">
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 Gamer Fest. Todos los derechos reservados.</p>
        </footer>

        <!-- Bootstrap Script -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Hide register button on scroll
            const registerButton = document.getElementById('register-button');
            let lastScroll = 0;

            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                if (currentScroll > lastScroll && currentScroll > 100) {
                    registerButton.classList.add('hidden');
                } else {
                    registerButton.classList.remove('hidden');
                }
                lastScroll = currentScroll;
            });

            // Dynamic color animation
            let hue = 0;
            const root = document.documentElement;

            function changeColor() {
                hue = (hue + 0.3 )% 360;
                root.style.setProperty('--dynamic-color', `hsl(${hue}, 100%, 50%)`);
                requestAnimationFrame(changeColor);
            }

            changeColor();
        </script>
    </body>
</html>
