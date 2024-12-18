<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tesorero</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --dynamic-color: #c43cc6;
        }

        body {
            background-color: #0d0d0d;
            color: #fff;
            font-family: 'League Spartan', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .sidebar {
            width: 220px;
            background-color: #1a1a1a;
            min-height: 100vh;
            padding: 1rem 0;
            color: #fff;
        }

        .sidebar h2 {
            font-family: 'Press Start 2P', cursive;
            color: var(--dynamic-color);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.2rem; /* Reduzco el tamaño del texto */
        }

        .sidebar a {
            display: block;
            color: #fff;
            padding: 1rem;
            text-decoration: none;
            border-bottom: 1px solid #333;
            text-transform: uppercase;
        }

        .sidebar a.active, .sidebar a:hover {
            background-color: var(--dynamic-color);
            color: #000;
        }

        .content {
            flex: 1;
            background-color: #1a1a1a;
            color: #fff;
            padding: 2rem;
            box-shadow: inset 0px 0px 10px var(--dynamic-color);
            min-height: 100vh;
        }

        h3 {
            font-family: 'Press Start 2P', cursive;
            color: var(--dynamic-color);
            margin-bottom: 1rem;
        }

        input, button {
            margin-top: 1rem;
            font-size: 1rem;
        }

        .neon-box {
            border: 2px solid var(--dynamic-color);
            box-shadow: 0 0 15px var(--dynamic-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .btn-neon {
            background-color: var(--dynamic-color);
            border: none;
            color: #000;
            padding: 0.5rem 1.5rem;
            font-family: 'League Spartan', sans-serif;
            text-transform: uppercase;
            box-shadow: 0px 0px 10px var(--dynamic-color);
        }

        .btn-neon:hover {
            background-color: #fff;
            color: var(--dynamic-color);
            box-shadow: 0px 0px 15px var(--dynamic-color);
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Tesorero</h2>
        <a href="#" class="active" onclick="showSection('solicitudes')">Solicitudes de Registro</a>
        <a href="#" onclick="showSection('fondos')">Fondos</a>
        <a href="#" onclick="showSection('gastos')">Gastos</a>
        <a href="#" onclick="showSection('donaciones')">Donaciones</a>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div id="solicitudes" class="section">
            <h3>Solicitudes de Registro</h3>
            <div class="neon-box">
                <p>Juan Pérez</p>
                <button class="btn btn-neon">Aprobar</button>
                <button class="btn btn-neon">Denegar</button>
            </div>
            <div class="neon-box">
                <p>María Gómez</p>
                <button class="btn btn-neon">Aprobar</button>
                <button class="btn btn-neon">Denegar</button>
            </div>
        </div>

        <div id="fondos" class="section d-none">
            <h3>Fondos Totales</h3>
            <div class="neon-box">
                <p id="total-fondos">Fondos Totales: $0</p>
            </div>
        </div>

        <div id="gastos" class="section d-none">
            <h3>Registrar Gasto</h3>
            <div class="neon-box">
                <input type="text" id="gasto-nombre" class="form-control" placeholder="Nombre del Gasto">
                <input type="number" id="gasto-cantidad" class="form-control" placeholder="Cantidad">
                <button class="btn btn-neon" onclick="registrarGasto()">Agregar Gasto</button>
            </div>
        </div>

        <div id="donaciones" class="section d-none">
            <h3>Registrar Donación</h3>
            <div class="neon-box">
                <input type="text" id="donacion-nombre" class="form-control" placeholder="Nombre de la Donación">
                <input type="number" id="donacion-cantidad" class="form-control" placeholder="Cantidad">
                <button class="btn btn-neon" onclick="registrarDonacion()">Agregar Donación</button>
            </div>
        </div>
    </div>
</div>

<script>
    let fondosTotales = 0;

    function showSection(section) {
        document.querySelectorAll('.section').forEach(sec => sec.classList.add('d-none'));
        document.getElementById(section).classList.remove('d-none');
        
        document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
        event.target.classList.add('active');
    }

    function registrarGasto() {
        const cantidad = parseFloat(document.getElementById('gasto-cantidad').value);
        if (cantidad > 0) {
            fondosTotales -= cantidad;
            actualizarFondos();
            alert("Gasto registrado.");
        }
    }

    function registrarDonacion() {
        const cantidad = parseFloat(document.getElementById('donacion-cantidad').value);
        if (cantidad > 0) {
            fondosTotales += cantidad;
            actualizarFondos();
            alert("Donación registrada.");
        }
    }

    function actualizarFondos() {
        document.getElementById('total-fondos').textContent = `Fondos Totales: $${fondosTotales}`;
    }
</script>
</body>
</html>
