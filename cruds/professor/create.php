<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/dbSelect.php';

if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];
    $id_discipline = $_POST['inputDisciplineId'];

    // $image = '/autella.com/images/userDefault.jpg';
    $image = 'C:\wamp64\www\autella.com\images\userDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    $sql = "INSERT INTO professor (email, name, password, picture, id_discipline) VALUES 
    ('$email', '$name', '$password', '$image', '$id_discipline');";

    if ($connection->query($sql) === TRUE) {
        $message = "Conta criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    array_push($_SESSION['debug'], $message);

    header('Location: ../../index.php');
}
?>





<!DOCTYPE html>

<html class="h-100 w-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="/libraries/bootstrap/bootstrap.css">
    <title>Autella</title>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utilities/sessionDebug.php';
    ?>
</head>

<body class="h-100 w-100 row align-items-center justify-content-center">
    <div class="col-12 ml-4
                col-sm-10
                col-lg-8
                col-xl-6">
        <h1 class="text-center mb-3 mb-sm-5">Autella <span class="d-none d-sm-inline">| Criar conta</span></h1>

        <form action="" method="post">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail">
            </div>

            <div class="form-group">
                <label>Nova senha</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>

            <div class="form-group">
                <label>Confirmar nova senha</label>
                <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword">
            </div>

            <div class="row justify-content-between mb-0 mb-sm-5 mx-1">
                <select onchange="updateDisciplines()" class="dropdown-toggle btn border col-12 col-sm-6" id="fieldList">
                    <?php
                    fieldNamesToDropdownItems();
                    ?>
                </select>

                <select class="dropdown-toggle btn border col-12 mt-3 col-sm-3 mt-sm-0" name="inputDisciplineId" id="disciplineList">

                </select>
            </div>

            <div class="d-flex justify-content-between pt-4 pt-sm-5">
                <a class="btn btn-danger btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Criar conta">
            </div>
        </form>
    </div>

    <script src="/libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="/libraries/bootstrap/bootstrap.bundle.js"></script>
    <script>
        $(".dropdown-menu a").click(function() {
            $(this).parents(".dropdown").find('.btn').html(' ' + $(this).text() + ' ');
            $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });

        function updateDisciplines() {
            var id_field = document.getElementById("fieldList");
            var id_field = id_field.value;

            var container = document.getElementById("disciplineList");
            container.innerHTML = "";

            <?php
            $php_array = selectDisciplines();
            $js_array = json_encode($php_array);
            echo "var allDisciplines = " . $js_array . ";\n";
            ?>

            for (let i = 0; i < allDisciplines.length; i++) {
                if (allDisciplines[i][1] == id_field) {
                    var option = document.createElement("option");
                    var node = document.createTextNode(allDisciplines[i][2]);
                    option.appendChild(node);
                    option.setAttribute("value", allDisciplines[i][0]);

                    container.appendChild(option);
                }
            }
        };

        document.addEventListener('DOMContentLoaded', updateDisciplines(), false);
    </script>
</body>

</html>
