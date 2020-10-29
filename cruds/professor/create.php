<?php
if (isset($_POST['inputSubmit'])) {
    require_once '../../utilities/dbConnect.php';
    

    $email = $_POST['inputEmail'];
    $name = $_POST['inputName'];
    $password = $_POST['inputPassword'];

    // C:\wamp64\tmp\php9799.tmp
    // $image = '/autella.com/images/userDefault.jpg';
    $image = 'C:\wamp64\www\autella.com\images\userDefault.jpg';
    $image = file_get_contents($image);
    $image = mysqli_escape_string($connection, $image);

    $sql = "INSERT INTO professor (email, name, password, picture) VALUES 
    ('$email', '$name', '$password', '$image');";

    if ($connection->query($sql) === TRUE) {
        $message = "Conta criada com sucesso!";
    } else {
        $message = "Erro: " . $sql . "<br>" . $connection->error;
    }
    $connection->close();

    $_SESSION['message'] = $message;

    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en" class="w-100 h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autella | Criar conta</title>
    <link rel="stylesheet" href="../../libraries/bootstrap/bootstrap.css">
</head>

<body class="w-100 h-100">
    <div class="container w-100 h-100 d-flex flex-column align-items-center justify-content-center">

        <h1>Autella | Criar conta</h1>

        <form action="" method="post" class="w-50 mt-5">
            <div class="form-group">
                <label for="inputName">Nome</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>

            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="inputEmail">
            </div>

            <div class="form-group">
                <label for="inputPassword">Nova senha</label>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword">
            </div>

            <div class="form-group">
                <label for="inputConfirmPassword">Confirmar nova senha</label>
                <input type="password" class="form-control" id="inputConfirmPassword" name="inputConfirmPassword">
            </div>

            <div class="d-flex justify-content-between mb-5">
                <div class="dropdown dropright">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Área
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>


                <div class="dropdown dropleft">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Disciplina
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between pt-5">
                <a class="btn btn-danger  btn-lg" href="../../index.php">Cancelar</a>
                <input type="submit" class="btn btn-success btn-lg" name="inputSubmit" value="Criar conta">
            </div>
        </form>
    </div>

    <script src="../../libraries/bootstrap/jquery-3.5.1.js"></script>
    <script src="../../libraries/bootstrap/bootstrap.bundle.js"></script>
</body>

</html>