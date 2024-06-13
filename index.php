<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
        }
        h1 {
            margin-top: 20px;
            font-size: 3em;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 5px #000;
        }
        .container-fluid {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            color: #333;
        }
        .btn-primary {
            background: #2575fc;
            border: none;
        }
        .btn-primary:hover {
            background: #6a11cb;
        }
        .table {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background: #2575fc;
            color: #fff;
        }
        .modal-header {
            background: #2575fc;
            color: #fff;
        }
        .modal-footer {
            background: #f1f1f1;
        }
        .modal-content {
            color: #000;
        }
    </style>
</head>
<body>
    <h1>CRUD con PHP</h1>
    <div class="container-fluid row mx-auto mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="#" class="btn btn-small btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">Registrar</a>
        </div>
        <div class="p-4">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">RUT</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">TELEFONO</th>
                        <th width="20%" scope="col">COMENTARIO</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "Modelo/conexion.php";
                    $sql = $conn->query("SELECT * FROM usuarios");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td><?php echo $datos->rut; ?></td>
                            <td><?php echo $datos->nombre; ?></td>
                            <td><?php echo $datos->apellido; ?></td>
                            <td><?php echo $datos->correo; ?></td>
                            <td><?php echo $datos->telefono; ?></td>
                            <td><?php echo $datos->comentario; ?></td>
                            <td>
                                <a href="#" class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="<?= $datos->id; ?>"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" data-bs-id="<?= $datos->id; ?>"><i class="bi bi-trash"></i></a> 
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'modalCrear.php'; ?>
    <?php include 'modalEditar.php'; ?>
    <?php include 'modalEliminar.php'; ?>

    <script>
        let modalEliminar = document.getElementById('modalEliminar')

        document.addEventListener('DOMContentLoaded', function () {
            let modalEditar = document.getElementById('modalEditar');

            modalEditar.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-bs-id');
                let tr = button.closest('tr');
                let rut = tr.cells[0].innerText;
                let nombre = tr.cells[1].innerText;
                let apellido = tr.cells[2].innerText;
                let correo = tr.cells[3].innerText;
                let telefono = tr.cells[4].innerText;
                let comentario = tr.cells[5].innerText;

                modalEditar.querySelector('#id').value = id;
                modalEditar.querySelector('#rut').value = rut;
                modalEditar.querySelector('#nombre').value = nombre;
                modalEditar.querySelector('#apellido').value = apellido;
                modalEditar.querySelector('#correo').value = correo;
                modalEditar.querySelector('#telefono').value = telefono;
                modalEditar.querySelector('#comentario').value = comentario;

            });
        });

        modalEliminar.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            modalEliminar.querySelector('.modal-footer #id').value = id
        })

        // VALIDAR RUT
        /*
        function validarRut(rut) {
        rut = rut.replace(/\./g, '');
        var regex = /^[0-9]+[-|‐]{1}[0-9kK]{1}$/; 

        if (!regex.test(rut)) {
            return false; 
        }

        var splitRut = rut.split('-'); 
        var numero = splitRut[0];
        var dv = splitRut[1];

        var suma = 0;
        var multiplo = 2;

        for (var i = numero.length - 1; i >= 0; i--) {
            suma += parseInt(numero.charAt(i)) * multiplo;
            multiplo = multiplo === 7 ? 2 : multiplo + 1;
        }

        var dvEsperado = 11 - (suma % 11);

        if (dvEsperado === 11) {
            dvEsperado = 0;
        } else if (dvEsperado === 10) {
            dvEsperado = 'k';
        }

        return dvEsperado.toString().toUpperCase() === dv.toUpperCase();
        }

        document.getElementById('btnGuardar').addEventListener('click', function(event) {
            var rutInput = document.getElementById('rut');
            var rut = rutInput.value;

            if (!validarRut(rut)) {
                alert('RUT no válido. Por favor, ingrese un RUT válido.');
                rutInput.focus();
                event.preventDefault();
            }
        });
        */

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
