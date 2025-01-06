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
        }

        .dashboard {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Menú lateral */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 300px;
            background: linear-gradient(180deg, #004D40, #00796B, #009688);
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }

        .sidebar.visible {
            transform: translateX(0);
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
        .main-panel {
            flex: 1;
            margin-left: 0;
            display: flex;
            flex-direction: column;
            background-color: #222;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-panel.shifted {
            margin-left: 300px;
        }

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

        .toggle-sidebar-btn {
            background: #FFC107;
            color: #222;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
        }

        .toggle-sidebar-btn:hover {
            background: #FFD54F;
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

        /* Usuario en cabecera */
        .user-menu {
            display: flex;
            align-items: center;
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid #FFC107;
            object-fit: cover;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: white;
            margin-right: 10px;
        }

        .dropdown-btn {
            background: #00796B;
            color: white;
            font-size: 16px;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .dropdown-btn:hover {
            background: #009688;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #1a1a1a;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-menu a, .dropdown-menu form button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: left;
            font-size: 14px;
            font-family: 'Arial', sans-serif;
            font-weight: normal;
            color: white;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover, .dropdown-menu form button:hover {
            background-color: #FFC107;
            color: black;
        }

        @media (max-width: 768px) {
            .content {
                margin: 10px;
                padding: 15px;
            }

            .content h3 {
                font-size: 20px;
            }

            .content p {
                font-size: 14px;
            }

            .header {
                font-size: 18px;
                padding: 15px;
            }

            .toggle-sidebar-btn {
                font-size: 14px;
                padding: 8px 12px;
            }

            .sidebar {
                width: 240px;
            }

            .main-panel.shifted {
                margin-left: 240px;
            }
        }

        @media (max-width: 480px) {
            .content {
                margin: 5px;
                padding: 10px;
            }

            .content h3 {
                font-size: 18px;
            }

            .content p {
                font-size: 12px;
            }

            .header {
                font-size: 16px;
                padding: 10px;
            }

            .toggle-sidebar-btn {
                font-size: 12px;
                padding: 5px 10px;
            }

            .sidebar {
                width: 200px;
            }

            .main-panel.shifted {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar">
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
        <main class="main-panel" id="main-panel">
            <header class="header">
                <button class="toggle-sidebar-btn" onclick="toggleSidebar()">☰</button>
                <h2>DASHBOARD COORDINADOR</h2>
                <div class="user-menu">
                    <span class="user-name">{{ $user->name }}</span>
                    <button class="dropdown-btn" onclick="toggleDropdown()">⋮</button>
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="/profile">Ir al Perfil</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </header>
            <div class="content" id="content">
                <h3>Vista Previa</h3>
                <p>Aquí encontrarás información sobre tus juegos asignados y notificaciones importantes.</p>
            </div>
        </main>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            sidebar.classList.toggle('visible');
            mainPanel.classList.toggle('shifted');
        }

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('active');
        }

        function showGameDetails(gameName) {
            const content = document.getElementById('content');
            content.innerHTML = `<h3>Detalles del ${gameName}</h3><p>Información detallada sobre el ${gameName}.</p>`;
        }

        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownBtn = document.querySelector('.dropdown-btn');

            if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>
