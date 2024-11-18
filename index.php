<?php 
require 'conexão.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Tabela</title>
</head>
<body>


<form id="filterForm">
<label for="name">name</label>
<input type="text" id="name" name="name" placeholder="Digite o nome">
<label for="email">email</label>
<input type="email" id="email" name="email" placeholder="Digite o email">
<label for="idade">idade</label>
<input type="number" id="idade" name="idade" placeholder="Digite a idade">
<label for="id">id</label>
<input type="number" id="id" name="id" placeholder="Digite o id">






<button type="submit">Filtrar</button>

</form>
    
<table id="usersTable">
    <thead>
        <tr>
            <th>id</th>
            <th>nome</th>
            <th>email</th>
            <th>idade</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>







<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    $(document).ready(function(){
     var table =   $('#usersTable').DataTable({
            searching: false,
        ajax:{
            url: 'filter.php',
            type: 'GET',
            data: function(d){
                d.name = $('#name').val();
                d.email = $('#email').val();
                d.idade = $('#idade').val();
                d.id = $('#id').val();
            },
            dataSrc: ''

        },
        columns:[
            {data: 'id'},
            {data: 'nome'},
            {data: 'email'},
            {data: 'idade'}
        ],
        language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
            },
        });
        $('#filterForm').on('submit', function(e){
            e.preventDefault();

            table.ajax.reload();
        });
    });



</script>
</body>
</html>

