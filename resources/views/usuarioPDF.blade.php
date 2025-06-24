<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <style>

        h2,h3,h4 {
            text-align: center;
            margin: 0;
            padding: 5px 0;
        }

        h6 {
            margin: 0;
            padding: 0;
        }

        .principal {
            min-height: 100vh;
        }

        input {
            background: none;
            border: none;
            width: 100%;
        }

        .row {
            margin: 5px 0;
        }

        .tarjeta {
            padding: 0px;
            margin: 10px 0;
            border: 1px solid black;
            box-shadow: 5px 5px 0px 0px #0f4655;
            overflow: hidden;
            border-radius: 10px;
        }

        .titulo {
            border-block-end: 1px solid black;
            background-color: gray;
            color: white;
        }

        .tarjetainfo {
            border: 1px solid black;
            margin: 0;

        }

        table {
            margin: 0 !important;
            width: 100%;
        }

        td {
            text-align: center
        }

        .banner {
            display: inline;
        }
        .banner .informacion {
            width: 60%;
        }

    </style>
    <main class="justify-content-center align-items-center">
        <div class="principal">
            <div class="banner">
                <img src="{{ 'imagenes/logoABG.png' }}" class="img-fluid rounded-top" alt="GRUPO ABG" />
            </div>

            <!-------Usuario----------->
            <div class="row justify-content-center align-items-center tarjeta">
                <div class="col-12" style="background-color: black; color: white;">
                    <h2><b>Usuario</b></h2>
                </div>

                <div style="padding: 10px">
                    <div class="col-12">
                        Número de nómina: <b>{{ $id }}</b>
                    </div>
                    <div class="col-12">
                        Nombre: <b>{{ $name . ' ' . $lastName . ' ' . $lastName2 }}</b>
                    </div>
                    <div class="col-12">
                        Área: <b>{{ $area }}</b>
                    </div>
                    <div class="col-12">
                        Extensión: <b>{{ $extencion }}</b>
                    </div>
                </div>
            </div>

            <!-------Laptop----------->
            <div class="row justify-content-between align-items-between tarjeta">
                <div class="col-12 col-md-6">
                    <div class="col-12 titulo">
                        <h2><b>Laptop</b></h2>
                    </div>
                    <div class="col-12 tarjetainfo" style="padding:0 12px;">
                        <input type="text" name="pass_pc" id="pass_pc" value="{{ $pass_pc }}">
                    </div>
                </div>
            </div>

            <!-------Kiosco----------->
            <div class="tarjeta">
                <div class="titulo">
                    <h2><b>Kiosco</b></h2>
                    <h4>http://189.203.75.86/Kioscos/KioscoGrupoABG/index.php</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row"> {{ $id }}</td>
                            <td>Tu RFC en mayúsculas</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-------Correo----------->
            <div class="tarjeta">
                <div class="titulo">
                    <h2><b>Correo</b></h2>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Correo</th>
                            <th scope="col">Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row"> {{ $correo }}</td>
                            <td>{{ $pass_correo }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!----------VPN-------------------->
            <div class="tarjeta">
                <div class="titulo">
                    <h2><b>VPN</b></h2>
                </div>
                <div class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Contraseña</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td scope="row"> {{ $user_vpn }}</td>
                                <td>{{ $pass_vpn }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!----------Servidor-------------------->
            <div class="tarjeta">
                <div class="titulo">
                    <h2><b>Servidor</b></h2>
                </div>
                <div class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Contraseña</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td scope="row"> {{ $user_servidor }}</td>
                                <td>{{ $pass_servidor }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h6>*Para dudas o sugerencias puedes contactar al área de sistemas a las extensiones 138 y 140</h6>
            </div>

        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
