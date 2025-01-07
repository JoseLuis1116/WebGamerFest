<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tesorería</title>
    <style>
        /* General */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: white;
            background-color: #0a0e27;
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
            background: linear-gradient(180deg, #001f3f, #00509e, #007bff);
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transform: translateX(0); /* Ajusta la posición inicial */
            transition: transform 0.3s ease-in-out; /* Agrega transición suave */
        }

        .sidebar.hidden {
            transform: translateX(-100%); /* Oculta la barra lateral al moverla fuera de la pantalla */
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            box-shadow: 0 0 25px #00d4ff, 0 0 50px #00d4ff;
        }

        .logo-text {
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
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
            color: #00aaff;
            text-shadow: 0 0 10px #00aaff, 0 0 20px #00aaff;
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
            filter: drop-shadow(0 0 5px #00aaff);
            object-fit: contain;
        }

        .section ul li a:hover {
            background: rgba(0, 122, 255, 0.2);
            color: #00d4ff;
            transform: translateX(10px) scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 122, 255, 0.3);
        }

        /* Panel principal */
        .main-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #001427;
            margin-left: 300px; /* Cambia a 300px si la barra lateral está visible */
            transition: margin-left 0.3s ease-in-out;
        }

        .main-panel.shifted {
            margin-left: 0; /* Panel ocupa todo el ancho cuando la barra lateral está oculta */
        }
        
        .header {
            background: linear-gradient(to right, #001f3f, #00509e, #007bff);
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
            background: #007bff;
            color: white;
            font-size: 18px;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: none;
            position: fixed; /* Asegura que el botón no se desplace con el contenido */
            top: 20px; /* Ajusta según el diseño */
            left: 20px; /* Ajusta según el diseño */
            z-index: 1100; /* Asegura que esté por encima de la barra lateral */
        }


        .toggle-sidebar-btn:hover {
            background: #00509e;
        }

        @media (max-width: 768px) {
            .toggle-sidebar-btn {
                display: block; /* El botón aparece en pantallas pequeñas */
            }
            .sidebar.hidden {
                transform: translateX(-100%); /* Asegura que esté fuera de la vista */
            }
            .main-panel {
                margin-left: 0; /* Resetea el margen para pantallas pequeñas */
            }
            .main-panel.shifted {
                margin-left: 240px; /* Ajusta si decides que el panel se mueva */
            }
        }


        .content {
            padding: 20px;
            background-color: #0a0e27;
            color: white;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .content h3 {
            margin-top: 0;
            font-size: 24px;
            color: #00d4ff;
            text-shadow: 0 0 10px #00d4ff, 0 0 20px #00d4ff;
        }

        .content p {
            margin: 10px 0;
            font-size: 16px;
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 200px;
            }
            .sidebar.hidden {
                transform: translateX(-200px);
            }
            .main-panel.shifted {
                margin-left: 200px;
            }

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
    </style>
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <img src="/images/logov2.png" alt="Tesorería Logo" class="logo-img" loading="lazy">
                <h1 class="logo-text">TESORERÍA</h1>
            </div>
            <nav class="menu">
                <div class="section">
                    <h3>Gestión de Participantes</h3>
                    <ul>
                        <li><a href="#" onclick="showContent('Inscribir Participantes')"><img src="/images/agregar-usuario.png" alt="Icono"> Inscribir Participantes</a></li>
                    </ul>
                </div>
                <div class="section">
                    <h3>Gestión de Pagos</h3>
                    <ul>
                        <li><a href="#" onclick="showContent('Verificar Pagos')"><img src="/images/verificar-pago.png" alt="Icono"> Verificar Pagos</a></li>
                    </ul>
                </div>
                <div class="section">
                    <h3>Gestión Financiera</h3>
                    <ul>
                        <li><a href="#" onclick="showContent('Registrar Ingresos')"><img src="/images/ingreso.png" alt="Icono"> Registrar Ingresos</a></li>
                        <li><a href="#" onclick="showContent('Registrar Egresos')"><img src="/images/egresos.png" alt="Icono"> Registrar Egresos</a></li>
                        <li><a href="#" onclick="showContent('Ver Reportes')"><img src="/images/reportes.png" alt="Icono"> Ver Reportes</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="main-panel" id="main-panel">
            <header class="header">
                <button class="toggle-sidebar-btn" onclick="toggleSidebar()">☰</button>
                <h2>DASHBOARD TESORERÍA</h2>
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
                <h3>Bienvenido</h3>
                <p>Utiliza el menú para navegar por las opciones de tesorería.</p>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            sidebar.classList.toggle('hidden');
            mainPanel.classList.toggle('shifted');
        }

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('active');
        }

        function showContent(section) {
            const content = document.getElementById('content');
            content.innerHTML = `<h3>${section}</h3><p>Aquí puedes gestionar la sección de ${section.toLowerCase()}.</p>`;

            // Cierra la barra lateral en pantallas pequeñas
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        }

        // Cerrar el menú desplegable al hacer clic fuera de él
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const sidebar = document.getElementById('sidebar');

            if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }

            // Cerrar la barra lateral al hacer clic fuera de ella
            if (!sidebar.contains(event.target) && !event.target.classList.contains('toggle-sidebar-btn')) {
                if (!sidebar.classList.contains('hidden') && window.innerWidth <= 768) {
                    toggleSidebar();
                }
            }
        });

        // Ajustar automáticamente la barra lateral al redimensionar la ventana
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('hidden');
                mainPanel.classList.remove('shifted');
            }
        });

        // Función para alternar la visibilidad de la barra lateral
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            sidebar.classList.toggle('hidden'); // Alterna la clase 'hidden' para ocultar o mostrar la barra lateral
            mainPanel.classList.toggle('shifted'); // Ajusta el panel principal cuando la barra lateral está oculta o visible
        }

        // Función para mostrar contenido dinámico al hacer clic en una opción del menú
        function showContent(section) {
            const content = document.getElementById('content');
            content.innerHTML = `<h3>${section}</h3><p>Aquí puedes gestionar la sección de ${section.toLowerCase()}.</p>`;

            // Cierra la barra lateral automáticamente en pantallas pequeñas
            if (window.innerWidth <= 768) {
                toggleSidebar();
            }
        }

        // Función para alternar el menú desplegable de usuario
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('active'); // Alterna la clase 'active' para mostrar u ocultar el menú desplegable
        }

        // Detectar clics fuera de elementos específicos para cerrarlos
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.querySelector('.toggle-sidebar-btn');

            // Cerrar el menú desplegable si el clic fue fuera de este y del botón
            if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }

            // Cerrar la barra lateral si el clic fue fuera de esta y del botón, en pantallas pequeñas
            if (!sidebar.contains(event.target) && !toggleButton.contains(event.target)) {
                if (!sidebar.classList.contains('hidden') && window.innerWidth <= 768) {
                    toggleSidebar();
                }
            }
        });

        // Ajustar la visibilidad de la barra lateral al redimensionar la ventana
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const mainPanel = document.getElementById('main-panel');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('hidden'); // Asegura que la barra lateral esté visible en pantallas grandes
                mainPanel.classList.remove('shifted'); // Restablece el panel principal
            } else if (!sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden'); // Oculta la barra lateral si está abierta en pantallas pequeñas
                mainPanel.classList.remove('shifted');
            }
        });

    </script>

</body>
</html>
