<!DOCTYPE html>
<html>
<head>
    <title>Tabla con filtros de búsqueda</title>
    <!-- Enlace de CDN para Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Tabla con filtros de búsqueda</h2>
        <div class="form-group">
            <input type="text" id="search-input" class="form-control" placeholder="Buscar">
        </div>
        <table id="data-table" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID CASO</th>
                    <th>ID ESTABLECIMIENTOS</th>
                    <th>CONTACTO ESTRECHOS</th>
                    <th>GRUPOS DE RIESGOS</th>
                    <th>SINTOMAS</th>
                    <th>PROCESOS</th>
                    <th>MUESTRAS</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Enlace de CDN para jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Enlace de CDN para DataTables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.2/jspdf.umd.min.js"></script>

    <script>
    $(document).ready(function() {
        // Inicializar la tabla con DataTables
        var table = $('#data-table').DataTable();

        // Obtener los datos del archivo plano en formato JSON
        $.getJSON('json_control.php', function(data) {
            // Iterar sobre los datos y agregar filas a la tabla
            $.each(data, function(index, row) {
                table.row.add([
                    index + 1,
                    row.columna1,
                    row.columna2,
                    row.columna3,
                    row.columna4,
                    row.columna5,
                    row.columna6,
                    row.columna7,
                ]).draw(false);
            });
        });

        // Agregar funcionalidad de filtro de búsqueda
        $('#search-input').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
    </script>

  
</body>
</html>










