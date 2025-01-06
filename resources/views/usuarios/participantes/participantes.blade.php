<!DOCTYPE html>
<html lang="en">
@yield('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Participante</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&family=Roboto:wght@400;500;700&display=swap');

        @font-face {
            font-family: "Arcade Gamer";
            src: url("/fonts/arcade-gamer.ttf") format("truetype");
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: #ffffff;
            background-color: #1a1a2e;
            overflow: hidden;
        }

        .dashboard {
            display: flex;
            flex-wrap: nowrap;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #0f3460, #e94560);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        @media (min-width: 769px) {
            .sidebar {
                transform: translateX(0) !important;
            }

            .toggle-sidebar {
                display: none;
            }
        }

        .sidebar h2 {
            font-family: "Arcade Gamer", sans-serif;
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
            color: #ffffff;
            text-shadow: 0 0 10px #e94560, 0 0 20px #0f3460;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            transition: background-color 0.3s, box-shadow 0.3s;
            color: #ffffff;
            text-shadow: 0 0 5px #ffffff;
        }

        .sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px #e94560, 0 0 20px #0f3460;
        }

        .sidebar ul li.active {
            background-color: #ffffff;
            color: #e94560;
            font-weight: bold;
            box-shadow: 0 0 10px #e94560, 0 0 20px #0f3460;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: #1a1a2e;
            color: #ffffff;
            overflow-y: auto;
        }

        .header {
            background: linear-gradient(90deg, #0f3460, #e94560);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-shadow: 0 0 10px #e94560, 0 0 20px #0f3460;
            flex-wrap: wrap;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            flex: 1;
        }

        .header .user {
            font-size: 18px;
            color: #f1f1f1;
            text-shadow: 0 0 5px #ffffff;
        }

        .main {
            flex: 1;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-shadow: 0 0 5px #ffffff;
            overflow-y: auto;
        }

        .toggle-sidebar {
            display: none;
            background-color: #e94560;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
        }

        form {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #ffffff;
        }

        input, select {
            width: 95%;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        select option {
            color: #000000;
            background-color: #ffffff;
        }

        input::placeholder {
            color: #ffffff;
            opacity: 0.7;
        }

        input:focus, select:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 8px #e94560;
        }

        button {
            background-color: #e94560;
            color: #ffffff;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #0f3460;
            box-shadow: 0 0 10px #e94560, 0 0 20px #0f3460;
        }

        #notification {
            display: none;
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
        }

        #notification.success {
            background-color: #4caf50;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #notification.error {
            background-color: #f44336;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100%;
                transform: translateX(-100%);
            }

            .toggle-sidebar {
                display: block;
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            .sidebar.visible {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <button class="toggle-sidebar">☰</button>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Gamer Fest</h2>
            <ul>
                <li class="active">Inscribirse a juegos</li>
                <li>Estado de inscripción</li>
                <li>Juegos inscritos</li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h1>Dashboard de Participante</h1>
                <div class="user">{{ auth()->user()->name }}</div>
            </div>
            <div class="main">
                <!-- Contenido dinámico aquí -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuItems = document.querySelectorAll('.sidebar ul li');
            const contentArea = document.querySelector('.main');
            const sidebar = document.querySelector('.sidebar');
            const toggleSidebarButton = document.querySelector('.toggle-sidebar');

            // Función para alternar la visibilidad de la sidebar
            toggleSidebarButton.addEventListener('click', () => {
                if (sidebar.classList.contains('hidden')) {
                    sidebar.classList.remove('hidden');
                    sidebar.classList.add('visible');
                } else {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('visible');
                }
            });

            // Función para obtener juegos dinámicamente desde el backend
            const fetchJuegos = async () => {
                try {
                    const response = await fetch("{{ route('juegos.list') }}");
                    const juegos = await response.json();
                    return juegos.map(juego => `<option value="${juego.IDJuego}">${juego.NombreJuego}</option>`).join('');
                } catch (error) {
                    console.error('Error fetching juegos:', error);
                    return '<option>Error al cargar los juegos</option>';
                }
            };

            // Función para cargar contenido dinámico
            const loadContent = async (key) => {
                if (key === "Inscribirse a juegos") {
                    const juegosOptions = await fetchJuegos();

                    contentArea.innerHTML = `
                        <h2>Registrar Inscripción</h2>
                        <form id="form-inscripcion" enctype="multipart/form-data">
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <input type="hidden" id="IDUsuario" name="IDUsuario" value="{{ auth()->user()->id }}">

                            <div>
                                <label for="IDJuego">Juego:</label>
                                <select id="IDJuego" name="IDJuego" required>
                                    <option value="">Seleccione un juego</option>
                                    ${juegosOptions}
                                </select>
                            </div>
                            <div>
                                <label for="Monto">Monto:</label>
                                <input type="number" id="Monto" name="Monto" required>
                            </div>
                            <div>
                                <label for="FechaInscripcion">Fecha de Inscripción:</label>
                                <input type="datetime-local" id="FechaInscripcion" name="FechaInscripcion" required>
                            </div>
                            <div>
                                <label for="ComprobantePago">Comprobante de Pago:</label>
                                <input type="file" id="ComprobantePago" name="ComprobantePago" accept=".jpg,.png,.pdf">
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <button type="submit">Registrar</button>
                                <button type="button" id="clear-form">Limpiar</button>
                            </div>
                        </form>
                        <div id="notification" class="success" style="display:none;">Inscripción registrada con éxito</div>
                    `;

                    // Manejo del botón de limpiar formulario
                    document.getElementById('clear-form').addEventListener('click', () => {
                        document.getElementById('form-inscripcion').reset();
                        document.getElementById('notification').style.display = 'none';
                    });

                    // Manejo del envío del formulario
                    document.querySelector('#form-inscripcion').addEventListener('submit', async (e) => {
                        e.preventDefault();

                        const form = e.target;
                        if (!form.checkValidity()) {
                            const notification = document.getElementById('notification');
                            notification.textContent = 'Por favor, complete todos los campos requeridos.';
                            notification.className = 'error';
                            notification.style.display = 'block';
                            return;
                        }

                        const formData = new FormData(form);

                        try {
                            const response = await fetch("{{ route('inscripciones.store') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            const notification = document.getElementById('notification');

                            if (response.ok) {
                                notification.textContent = 'Inscripción registrada con éxito';
                                notification.className = 'success';
                                notification.style.display = 'block';
                                form.reset();
                            } else {
                                const error = await response.json();
                                notification.textContent = 'Error: ' + error.message;
                                notification.className = 'error';
                                notification.style.display = 'block';
                            }
                        } catch (error) {
                            const notification = document.getElementById('notification');
                            notification.textContent = 'Error en el registro. Inténtelo nuevamente.';
                            notification.className = 'error';
                            notification.style.display = 'block';
                        }
                    });
                } else {
                    contentArea.innerHTML = "<p>Contenido no disponible</p>";
                }
            };

            // Manejo del menú
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    menuItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                    const key = item.textContent.trim();
                    loadContent(key);
                });
            });

            // Cargar contenido inicial
            loadContent("Inscribirse a juegos");
        });
    </script>
</body>
</html>
