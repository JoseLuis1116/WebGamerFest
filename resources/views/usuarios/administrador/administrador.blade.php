<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
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
            background: linear-gradient(180deg, #4A148C, #6A1B9A, #7B1FA2);
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
            background: #6A1B9A;
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
            background: #9C27B0;
        }

        .close-btn {
            display: block;
            align-self: flex-end;
            margin: 10px 20px 0;
            background: #7B1FA2;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
        }

        .close-btn:hover {
            background: #9C27B0;
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
            object-fit: contain; /* Asegura que la imagen no se deforme */
        }

        .section ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #FFC107;
            transform: translateX(10px) scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        /* Panel principal */
        .header {
            background: linear-gradient(to right, #4A148C, #6A1B9A, #7B1FA2);
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

        form {
            background: #2a2a2a;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 16px;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #FFC107;
            text-shadow: 0 0 5px #FFC107, 0 0 10px #FFC107;
        }

        form input[type="text"],
        form textarea,
        form select,
        form input[type="file"] {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #6A1B9A;
            border-radius: 5px;
            background: #1a1a1a;
            color: #fff;
            font-size: 16px;
            transition: border 0.3s;
        }

        form input[type="text"]:focus,
        form textarea:focus,
        form select:focus,
        form input[type="file"]:focus {
            border: 1px solid #FFC107;
            outline: none;
        }

        form button[type="submit"],
        form button[type="reset"] {
            background: #6A1B9A;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-right: 10px;
        }

        form button[type="submit"]:hover,
        form button[type="reset"]:hover {
            background: #9C27B0;
        }

        form div {
            margin-bottom: 15px;
        }


    </style>
</head>
<body>
    <button class="toggle-btn" aria-label="Abrir/Cerrar menú" role="button" onclick="toggleSidebar()">☰ Menú</button>
    <div class="dashboard">
        <aside class="sidebar" id="sidebar" role="complementary">
            <div class="logo">
                <img src="/images/logov2.png" alt="Gamer Fest Logo" class="logo-img" loading="lazy">
                <h1 class="logo-text">GAMER FEST</h1>
            </div>
            <nav class="menu">
                <div class="section">
                    <h3>TESORERIA</h3>
                    <ul>
                        <li><a href="#" onclick="handleOption('asignar-tesoreria')"><img src="/images/agregar.png" alt="Asignar"> Asignar</a></li>
                        <li><a href="#" onclick="handleOption('ver-reportes')"><img src="/images/reportes.png" alt="Ver Reportes"> Ver Reportes</a></li>
                    </ul>
                </div>
                <div class="section">
                    <h3>Juegos</h3>
                    <ul>
                        <li><a href="#" onclick="handleOption('agregar-juego')"><img src="/images/agregar.png" alt="Agregar"> Agregar</a></li>
                        <li><a href="#" onclick="handleOption('editar-juego')"><img src="/images/modificar.png" alt="Editar"> Modificar</a></li>
                        <li><a href="#" onclick="handleOption('eliminar-juego')"><img src="/images/eliminar.png" alt="Eliminar"> Eliminar</a></li>
                    </ul>
                </div>

                <div class="section">
                    <h3>Coordinadores</h3>
                    <ul>
                        <li><a href="#" onclick="handleOption('asignar-coordinador')"><img src="/images/agregar.png" alt="Asignar"> Asignar</a></li>
                        <li><a href="#" onclick="handleOption('modificar-coordinador')"><img src="/images/modificar.png" alt="Modificar"> Modificar</a></li>
                        <li><a href="#" onclick="handleOption('eliminar-coordinador')"><img src="/images/eliminar.png" alt="Eliminar"> Eliminar</a></li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="main-panel expanded" id="main-panel">
            <header class="header" role="banner">
                <h2>DASHBOARD ADMINISTRADOR</h2>
                <span>JUAN PÉREZ</span>
            </header>
            <div class="content" id="content">
                <h3>Bienvenido al panel de administrador</h3>
                <p>Selecciona una opción del menú para empezar.</p>
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

        function handleOption(option) {
            switch(option) {
                case 'asignar-tesoreria':
                    content.innerHTML = '<h3>Asignar Tesorería</h3><p>Formulario para asignar tesorería.</p>';
                    break;
                case 'ver-reportes':
                    content.innerHTML = '<h3>Ver Reportes</h3><p>Sección para ver reportes financieros.</p>';
                    break;
                case 'agregar-juego':
                    content.innerHTML = `
                        <h3>Agregar Juego</h3>
                        <p>Formulario para agregar un nuevo juego.</p>
                        <form id="form-juego" action="/guardar-juego" method="POST" enctype="multipart/form-data">
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <!-- Campo para Nombre del Juego -->
                            <div>
                                <label for="NombreJuego">Nombre del Juego:</label>
                                <input type="text" id="NombreJuego" name="NombreJuego" required maxlength="255" placeholder="Ingrese el nombre del juego">
                            </div>
                            
                            <!-- Campo para Descripción del Juego -->
                            <div>
                                <label for="DescripcionJuego">Descripción del Juego:</label>
                                <textarea id="DescripcionJuego" name="DescripcionJuego" placeholder="Ingrese una descripción del juego"></textarea>
                            </div>
                            
                            <!-- Campo para ID de Categoría -->
                            <div>
                                <label for="IDCategoria">Categoría:</label>
                                <select id="IDCategoria" name="IDCategoria" required>
                                    <option value="" disabled selected>Seleccione una categoría</option>
                                    <option value="1">Individual</option>
                                    <option value="2">Grupal</option>
                                </select>
                            </div>
                            
                            <!-- Campo para ID de Modalidad -->
                            <div>
                                <label for="IDModalidad">Modalidad:</label>
                                <select id="IDModalidad" name="IDModalidad" required>
                                    <option value="" disabled selected>Seleccione una modalidad</option>
                                    <option value="1">Presencial</option>
                                    <option value="2">Virtual</option>
                                </select>
                            </div>
                            
                            <!-- Campo para Imagen del Juego -->
                            <div>
                                <label for="ImagenJuego">Imagen del Juego:</label>
                                <input type="file" id="ImagenJuego" name="ImagenJuego" accept="image/*">
                            </div>

                            <!-- Contenedor para la notificación -->
                            <div id="notification" style="display: none; position: fixed; top: 20px; right: 20px; background: #28a745; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); z-index: 1000;">
                                <span id="notification-message"></span>
                            </div>

                            <!-- Botones para enviar o cancelar -->
                            <div>
                                <button type="submit">Guardar</button>
                                <button type="reset">Limpiar</button>
                            </div>
                        </form>
                    `;

                        document.querySelector('#form-juego').addEventListener('submit', function (e) {
                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('/guardar-juego', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Mostrar notificación
                            const notification = document.getElementById('notification');
                            const message = document.getElementById('notification-message');
                            message.textContent = data.message; // Mensaje del backend
                            notification.style.display = 'block';

                            // Ocultar notificación después de 5 segundos
                            setTimeout(() => {
                                notification.style.display = 'none';
                            }, 5000);

                            // Actualizar contenido dinámico si es necesario
                        })
                        .catch(error => console.error('Error:', error));
                    });

                    break;
                case 'editar-juego':
                    content.innerHTML = '<h3>Editar Juego</h3><p>Sección para editar juegos existentes.</p>';
                    break;
                case 'eliminar-juego':
                    content.innerHTML = '<h3>Eliminar Juego</h3><p>Confirmación para eliminar juegos.</p>';
                    break;
                case 'asignar-coordinador':
                    content.innerHTML = '<h3>Asignar Coordinador</h3><p>Formulario para asignar coordinadores.</p>';
                    break;
                case 'modificar-coordinador':
                    content.innerHTML = '<h3>Modificar Coordinador</h3><p>Formulario para modificar datos de coordinadores.</p>';
                    break;
                case 'eliminar-coordinador':
                    content.innerHTML = '<h3>Eliminar Coordinador</h3><p>Confirmación para eliminar coordinadores.</p>';
                    break;
                default:
                    content.innerHTML = '<h3>Bienvenido al panel de administrador</h3><p>Selecciona una opción del menú para empezar.</p>';
            }
        }
    </script>
</body>
</html>
