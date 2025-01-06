<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tesorero</title>
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
            flex-direction: row;
        }

        /* Menú lateral */
        .sidebar {
            height: 100%;
            width: 300px;
            background: linear-gradient(180deg, #1565C0, #1E88E5, #42A5F5);
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
        }

        .logo {
            text-align: center;
            margin: 20px 0;
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
            flex: 1;
            padding: 20px;
        }

        .menu h3 {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
            color: #00E676;
            text-shadow: 0 0 10px #00E676, 0 0 20px #00E676;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 5px;
        }

        .menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu ul li {
            margin: 15px 0;
        }

        .menu ul li a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .menu ul li a img {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            filter: drop-shadow(0 0 5px #FFF);
        }

        .menu ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FFC107;
            transform: translateX(10px) scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        /* Panel principal */
        .main-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #222;
            padding: 20px;
        }

        .header {
            background: linear-gradient(to right, #1565C0, #1E88E5, #42A5F5);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
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
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-btn {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #1a1a1a;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
            z-index: 1000;
        }

        .dropdown-content a, .dropdown-content form {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .dropdown-content button {
            background: none;
            border: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .user-menu:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a:hover, .dropdown-content button:hover {
            color: #FFC107;
        }

        .content {
            padding: 20px;
            background-color: #1a1a1a;
            color: white;
            border-radius: 10px;
            margin: 20px 0;
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
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <img src="/images/logov2.png" alt="Tesorero Logo" class="logo-img">
                <h1 class="logo-text">TESORERO</h1>
            </div>
            <nav class="menu">
                <div>
                    <h3>Gestión de Participantes</h3>
                    <ul>
                        <li><a href="#" onclick="loadSection('inscribir-participantes')"><img src="/images/inscribir.png" alt="Inscribir"> Inscribir Participantes</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Gestión de Pagos</h3>
                    <ul>
                        <li><a href="#" onclick="loadSection('verificar-pagos')"><img src="/images/verificar.png" alt="Verificar"> Verificar Pagos</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Gestión Financiera</h3>
                    <ul>
                        <li><a href="#" onclick="loadSection('registrar-ingresos')"><img src="/images/ingresos.png" alt="Ingresos"> Registrar Ingresos</a></li>
                        <li><a href="#" onclick="loadSection('registrar-egresos')"><img src="/images/egresos.png" alt="Egresos"> Registrar Egresos</a></li>
                        <li><a href="#" onclick="loadSection('ver-reportes')"><img src="/images/reportes.png" alt="Reportes"> Ver Reportes</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="main-panel">
            <header class="header">
                <div>Dashboard Tesorero</div>
                <div class="user-menu">
                    <img src="/images/user-avatar.png" alt="Avatar" class="user-avatar">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <button class="dropdown-btn">▼</button>
                        <div class="dropdown-content">
                            <a href="/profile">Ir al Perfil</a>
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <div class="content" id="content">
                <h3>Bienvenido al panel de tesorero</h3>
                <p>Selecciona una sección del menú para empezar.</p>
            </div>
        </main>
    </div>
    <script>
        const content = document.getElementById('content');

        function loadSection(section) {
            switch (section) {
                case 'inscribir-participantes':
                    content.innerHTML = '<h3>Inscribir Participantes</h3><p>Aquí puedes inscribir a los participantes en los juegos.</p>';
                    break;
                case 'verificar-pagos':
                    content.innerHTML = '<h3>Verificar Pagos</h3><p>Aquí puedes verificar y aprobar o rechazar pagos de inscripciones.</p>';
                    break;
                case 'registrar-ingresos':
                    content.innerHTML = '<h3>Registrar Ingresos</h3><p>Formulario para registrar nuevos ingresos.</p>';
                    break;
                case 'registrar-egresos':
                    content.innerHTML = '<h3>Registrar Egresos</h3><p>Formulario para registrar gastos realizados.</p>';
                    break;
                case 'ver-reportes':
                    content.innerHTML = '<h3>Ver Reportes</h3><p>Resumen de ingresos, egresos y balance financiero del evento.</p>';
                    break;
                default:
                    content.innerHTML = '<h3>Bienvenido al panel de tesorero</h3><p>Selecciona una sección del menú para empezar.</p>';
            }
        }
    </script>
</body>
</html>
