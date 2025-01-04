<!DOCTYPE html>
<html lang="en">
@yield('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Participante</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap');
        @font-face {
            font-family: "Arcade Gamer";
            src: url("/fonts/arcade-gamer.ttf") format("truetype");
        }

        body {
            margin: 0;
            font-family: 'League Spartan', sans-serif;
            color: white;
            background-color: #1a1a1a;
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #ab59a3, #586be6);
            padding: 20px;
        }

        .sidebar ul li {
            margin: 20px 0;
            cursor: pointer;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #1a1a1a;
        }

        .header {
            background: linear-gradient(to right, #ab59a3, #586be6);
            padding: 15px;
            display: flex;
            justify-content: space-between;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuItems = document.querySelectorAll('.sidebar ul li');
        const contentArea = document.querySelector('.main');

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
            if (key === "Juegos inscripcion") {
                const juegosOptions = await fetchJuegos();

                contentArea.innerHTML = `
                    <h2>Registrar Inscripción</h2>
                    <form id="form-inscripcion" enctype="multipart/form-data">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <!-- Campo oculto para enviar el ID del usuario autenticado -->
                        <input type="hidden" id="IDUsuario" name="IDUsuario" value="{{ auth()->user()->id }}">

                        <div>
                            <label for="IDJuego">Juego:</label>
                            <select id="IDJuego" name="IDJuego">
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
                            <input type="file" id="ComprobantePago" name="ComprobantePago">
                        </div>
                        <button type="submit">Registrar</button>
                    </form>
                `;

                // Manejo del envío del formulario
                document.querySelector('#form-inscripcion').addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const formData = new FormData(e.target);

                    try {
                        const response = await fetch("{{ route('inscripciones.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const data = await response.json();
                            alert('Inscripción registrada con éxito');
                        } else {
                            const error = await response.json();
                            alert('Error: ' + error.message);
                        }
                    } catch (error) {
                        console.error('Error en el registro:', error);
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
        loadContent("Juegos inscripcion");
    });
</script>

</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Gamer Fest</h2>
            <ul>
                <li>Juegos inscripcion</li>
                <li>Estado de inscripcion</li>
                <li>Juegos inscritos</li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <h1>Dashboard de Participante</h1>
                <div class="user">{{ auth()->user()->name }}</div>
            </div>
            <div class="main"></div>
        </div>
    </div>
</body>
</html>
