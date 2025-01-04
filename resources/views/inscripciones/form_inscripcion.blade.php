@extends('usuarios.participantes.participantes')

@section('content')
<div class="container mx-auto mt-5">
    <h1 class="mb-4 text-2xl font-bold">Registrar Inscripción</h1>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('inscripciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="IDUsuario" class="block text-sm font-medium text-gray-700">Usuario</label>
            <input type="hidden" id="IDUsuario" name="IDUsuario" value="{{ auth()->user()->id }}">
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
        </div>

        <div class="mb-4">
            <label for="IDJuego" class="block text-sm font-medium text-gray-700">Juego</label>
            <select id="IDJuego" name="IDJuego" class="form-control">
                <!-- Opciones de juegos dinámicas -->
            </select>
        </div>

        <div class="mb-4">
            <label for="FechaInscripcion" class="block text-sm font-medium text-gray-700">Fecha de Inscripción</label>
            <input type="datetime-local" id="FechaInscripcion" name="FechaInscripcion" class="form-control">
        </div>

        <div class="mb-4">
            <label for="Monto" class="block text-sm font-medium text-gray-700">Monto</label>
            <input type="number" step="0.01" id="Monto" name="Monto" class="form-control">
        </div>

        <div class="mb-4">
            <label for="NumeroComprobante" class="block text-sm font-medium text-gray-700">Número de Comprobante</label>
            <input type="text" id="NumeroComprobante" name="NumeroComprobante" class="form-control">
        </div>

        <div class="mb-4">
            <label for="Estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select id="Estado" name="Estado" class="form-control">
                <option value="pendiente">Pendiente</option>
                <option value="aprobado">Aprobado</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="ComprobantePago" class="block text-sm font-medium text-gray-700">Comprobante de Pago</label>
            <input type="file" id="ComprobantePago" name="ComprobantePago" class="form-control">
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Registrar</button>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Cargar usuarios
            fetch("{{ route('usuarios.list') }}")
                .then(response => response.json())
                .then(data => {
                    let usuarioSelect = document.getElementById("IDUsuario");
                    data.forEach(usuario => {
                        let option = document.createElement("option");
                        option.value = usuario.id;
                        option.textContent = usuario.name;
                        usuarioSelect.appendChild(option);
                    });
                });

            // Cargar juegos
            fetch("{{ route('juegos.list') }}")
                .then(response => response.json())
                .then(data => {
                    let juegoSelect = document.getElementById("IDJuego");
                    data.forEach(juego => {
                        let option = document.createElement("option");
                        option.value = juego.id;
                        option.textContent = juego.NombreJuego;
                        juegoSelect.appendChild(option);
                    });
                });
        });
    </script>
</div>
@endsection
