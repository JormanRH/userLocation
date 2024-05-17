<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info User</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Cerrar"></button>
                        </div>
                    @endif
                    <div class="card-header inline-block">
                        <h3 class="d-inline">Welcome
                            @auth
                                {{ Auth::user()->name }}
                                {{ Auth::user()->lastName }}
                            @endauth
                        </h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('logout') }}" class="btn btn-secondary">Logout</a>
                        </div>
                    </div>

                    <section class="bg-light p-3 p-md-4 p-xl-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                                    <div class="card border border-light-subtle rounded-4">
                                        <div class="card-body p-3 p-md-4 p-xl-5">
                                            <form id="miFormulario">
                                                @csrf
                                                <div class="row gy-3 overflow-hidden">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="name"
                                                                id="name" placeholder="Write a name"
                                                                value="{{ old('name') ?? @$user->name }}" required>
                                                            <label for="name" class="form-label">Name</label>
                                                        </div>
                                                        @error('name')
                                                            <p class="form-text text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="lastName"
                                                                id="lastName" placeholder="Write a lastName"
                                                                value="{{ old('lastName') ?? @$user->lastName }}"
                                                                required>
                                                            <label for="lastName" class="form-label">Lastname</label>
                                                        </div>
                                                        @error('lastName')
                                                            <p class="form-text text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="email" class="form-control" name="email"
                                                                id="email" placeholder="name@example.com"
                                                                value="{{ old('email') ?? @$user->email }}" required>
                                                            <label for="email" class="form-label">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="location" class="form-label">Current
                                                            Location</label>
                                                        <div id="map"></div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn bsb-btn-xl btn-primary"
                                                                type="submit">Save Location</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        $(document).ready(function() {

            //******************************************************
            var map = L.map('map').setView([60, -10], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">Map Test</a>'
            }).addTo(map);

            // Capturar la ubicación del usuario al cargar la página
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('Tu ubicación actual')
                    .openPopup();

                //********************************************
                $('#miFormulario').submit(function(e) {
                    e.preventDefault(); // Evitar que el formulario se envíe normalmente

                    // Obtener los datos del formulario
                    var formData = $(this).serialize();

                    // Llamar a la función AJAX y pasar los datos del formulario
                    enviarDatos(formData, latitude, longitude);
                });
                //********************************************

            });

        });

        function enviarDatos(formData, latitude, longitude) {
            var latitude = latitude;
            var longitude = longitude;
            var dataComplete = formData + "&latitude=" + latitude + "&longitude=" + longitude;
            //alert(dataComplete);
            $.ajax({
                method: 'POST',
                url: 'update',
                data: dataComplete,
                success: function(response) {
                    console.log('Ubicación actualizada correctamente');
                },
                error: function(xhr, status, error) {
                    console.error('Error al actualizar la ubicación:', error);
                }
            });
        }
    </script>
</body>

</html>
