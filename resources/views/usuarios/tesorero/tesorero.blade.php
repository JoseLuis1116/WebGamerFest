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
            flex-direction: column;
            height: 100vh;
        }

        /* Menú lateral */
        .sidebar {
            height: 100%;
            width: 300px;
            background: linear-gradient(180deg, #004D40, #00796B, #009688);
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
            transform: translateX(0);
            z-index: 1000;
        }

        .sidebar.closed {
            transform: translateX(-100%);
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
            margin-left: 300px;
            display: flex;
            flex-direction: column;
            background-color: #222;
            transition: margin-left 0.3s ease;
        }

        .main-panel.shifted {
            margin-left: 0;
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

        .toggle-sidebar {
            background: #FFC107;
            color: black;
            font-size: 18px;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            display: none;
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

        @media (max-width: 767px) {
            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1100;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.closed {
                transform: translateX(-100%);
            }

            .main-panel {
                margin-left: 0;
            }
        }

        @media (min-width: 768px) {
            .dashboard {
                flex-direction: row;
            }

            .main-panel {
                margin-left: 300px;
            }

            .toggle-sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <button class="toggle-sidebar" onclick="toggleSidebar()">☰ Menú</button>
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
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('active');
        }

        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownBtn = document.querySelector('.dropdown-btn');

            if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            sidebar.classList.toggle('closed');
            mainPanel.classList.toggle('shifted');
        }
    </script>
</body>
</html>
