<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Coordinador</title>
    <style>
        /* General */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: white;
            background-color: #1a1a1a;
            overflow-x: hidden;
        }

        .dashboard {
            display: flex;
            height: 100vh;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .dashboard {
                flex-direction: row;
            }
        }

        /* Menú lateral */
        .sidebar {
            position: fixed;
            top: 0;
            transform: translateX(-100%); /* Oculto inicialmente */
            height: 100%;
            width: 300px;
            background: linear-gradient(180deg, #004D40, #00796B, #009688);
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .sidebar.active {
            transform: translateX(0); /* Visible al activarse */
        }

        .main-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #222;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-panel.expanded {
            margin-left: 300px;
        }

        /* Botón de apertura/cierre */
        .toggle-btn {
            display: block;
            position: fixed;
            top: 20px;
            left: 20px;
            background: #00796B;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            z-index: 1100;
            transition: background 0.3s ease-in-out;
        }

        .toggle-btn:hover {
            background: #009688;
        }

        .close-btn {
            display: block;
            align-self: flex-end;
            margin: 10px 20px 0;
            background: #009688;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .close-btn:hover {
            background: #00BFA5;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0 0 25px #FFC107, 0 0 50px #FFC107;
        }

        .logo-text {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            color: #FFC107;
            text-shadow: 0 0 10px #FFC107, 0 0 20px #FFC107;
        }

        .menu {
            width: 100%;
            padding: 0 20px;
        }

        .section h3 {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #00E676;
            text-shadow: 0 0 10px #00E676, 0 0 20px #00E676;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 5px;
        }

        .section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .section ul li {
            margin: 15px 0;
        }

        .section ul li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .section ul li a img {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            filter: drop-shadow(0 0 5px #FFF);
            object-fit: contain;
        }

        .section ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FFC107;
            transform: translateX(10px) scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        /* Panel principal */
        .header {
            background: linear-gradient(to right, #004D40, #00796B, #009688);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content {
            padding: 20px;
            background-color: #1a1a1a;
            color: white;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .content h3 {
            margin-top: 0;
            font-size: 24px;
            color: #FFC107;
            text-shadow: 0 0 10px #FFC107, 0 0 20px #FFC107;
        }

        .content p {
            margin: 10px 0;
            font-size: 16px;
        }

        /* Notificaciones */
        .notifications {
            margin-top: 20px;
            background: #333;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .notifications h4 {
            color: #00E676;
            text-shadow: 0 0 10px #00E676;
        }

        .notifications p {
            font-size: 14px;
            color: #CCC;
        }

        /* Responsividad */
        @media (max-width: 1024px) {
            .main-panel {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }

            .close-btn {
                display: block;
            }

            .sidebar {
                width: 100%;
            }
        }

        @media (min-width: 1024px) {
            .toggle-btn {
                display: none; /* Ocultar en pantallas grandes */
            }

            .sidebar {
                transform: translateX(0);
                width: 300px;
            }

            .main-panel {
                margin-left: 300px;
            }
        }

        @media (max-width: 768px) {
            .header {
                font-size: 18px;
                padding: 15px;
            }

            .content {
                margin: 10px;
                padding: 15px;
            }

            .section ul li a {
                font-size: 14px;
                padding: 8px 15px;
            }

            .logo-text {
                font-size: 18px;
            }
        }

        /* Estilo para el foco */
        a:focus, button:focus {
            outline: 2px solid #FFC107;
            outline-offset: 2px;
        }

    </style>
</head>
<body>
    <button class="toggle-btn" aria-label="Abrir/Cerrar menú" role="button" onclick="toggleSidebar()">☰ Menú</button>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar" role="complementary">
            <div class="logo">
                <img src="/images/logov2.png" alt="Coordinador Logo" class="logo-img" loading="lazy">
                <h1 class="logo-text">COORDINADOR</h1>
            </div>
            <nav class="menu">
                <div class="section">
                    <h3>Juegos Asignados</h3>
                    <ul>
                        <li><a href="#" onclick="showGameDetails('Juego 1')">Juego 1</a></li>
                        <li><a href="#" onclick="showGameDetails('Juego 2')">Juego 2</a></li>
                        <li><a href="#" onclick="showGameDetails('Juego 3')">Juego 3</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="main-panel expanded" id="main-panel">
            <header class="header" role="banner">
                <h2>DASHBOARD COORDINADOR</h2>
                <p>Bienvenido, {{ $user->name }}.</p>
            </header>
            <div class="content" id="content">
                <h3>Vista Previa</h3>
                <p>Aquí encontrarás información sobre tus juegos asignados y notificaciones importantes.</p>
                <div class="notifications">
                    <h4>Notificaciones</h4>
                    <p>- Te toca coordinar el "Juego 1" el 10 de enero a las 14:00.</p>
                    <p>- El "Juego 3" ha sido reprogramado para el 12 de enero.</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const mainPanel = document.querySelector('.main-panel');
        const content = document.getElementById('content');

        function toggleSidebar() {
            const isExpanded = sidebar.classList.toggle('active');
            mainPanel.classList.toggle('expanded', isExpanded);
            document.body.style.overflow = isExpanded ? 'hidden' : 'auto';
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.add('active');
                mainPanel.classList.add('expanded');
                document.body.style.overflow = 'auto';
            } else {
                sidebar.classList.remove('active');
                mainPanel.classList.remove('expanded');
                document.body.style.overflow = 'auto';
            }
        });

        function showGameDetails(gameName) {
            content.innerHTML = `<h3>Detalles del ${gameName}</h3><p>Aquí se mostrará la información detallada del ${gameName}.</p>`;
        }
    </script>
</body>
</html>
