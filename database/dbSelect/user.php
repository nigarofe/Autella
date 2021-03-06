<?php

function usersToRows($id_institution)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT user.id, user.name, user.email, role.name, field.name, discipline.name, user.status FROM user 
            JOIN discipline ON user.id_discipline = discipline.id
            JOIN field ON field.id = discipline.id_field
            JOIN role ON user.id_role = role.id
            WHERE user.id_institution = " . $id_institution .
        " AND user.id_role != 5";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                    <td style="vertical-align: middle;"> 
                        <a class="mt-2" href="/cruds/user/readGUI.php?id=' . $row[0] . '">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/eye.svg">
                        </a> 
                    </td>
                    <!-- <th style="vertical-align: middle;">' . $row[0] . '</th> -->
                    <td style="vertical-align: middle;">' . $row[1] . '</td>
                    <td style="vertical-align: middle;">' . $row[2] . '</td>
                    <td style="vertical-align: middle;">' . $row[3] . '</td>
                    <!-- <td style="vertical-align: middle;">' . $row[4] . '</td> -->
                    <td style="vertical-align: middle;">' . $row[5] . '</td>

                    <td style="vertical-align: middle;">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch' . $row[0] . '" onChange="changeAccountStatus(' . $row[0] . ')"';

            // Se a conta estiver ativada, colocar atributo "checked"
            if($row[6] == 1){
                echo 'checked';
            }
        
            echo '>
                            <label style="cursor: pointer;" class="custom-control-label" for="customSwitch' . $row[0] . '"></label>
                        </div>
                    </td>
                    
                    <td style="vertical-align: middle;"> 
                        <a class="mt-2" href="userUpdateGUI.php?id=' . $row[0] . '">
                            <img style="width: 32px" src="../../libraries/bootstrap/bootstrap-icons-1.0.0/pencil.svg">
                        </a>
                    </td>
                </tr>
            ';
        }
        // array_push($_SESSION['debug'], 'Usuários selecionados com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao selecionar usuários!');
    }
    $connection->close();
}

function getAccountStatus($id_user)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT status FROM user WHERE id = " . $id_user;

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row[0];
        }
        // array_push($_SESSION['debug'], 'Status da conta obtido com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao obter status da conta!');
    }
    $connection->close();
}

function getAccountInstitution($id_user)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT id_institution FROM user WHERE id =" . $id_user;

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row[0];
        }
        // array_push($_SESSION['debug'], 'Instituição da conta obtido com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao obter instituição da conta!');
    }
    $connection->close();
}

function getAccountCoordinator($id_user)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT id FROM user WHERE id_role = 1 and id_institution = " . getAccountInstitution($id_user);

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row[0];
        }
        // array_push($_SESSION['debug'], 'Coordenador da conta obtido com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao obter coordenador da conta!');
    }
    $connection->close();
}

function getAccountRole($id_user)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT id_role FROM user WHERE id = " . $id_user;

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row[0];
        }
        // array_push($_SESSION['debug'], 'Papel da conta obtido com sucesso!');
    } else {
        array_push($_SESSION['debug'], 'Erro ao obter papel da conta!');
    }
    $connection->close();
}

function selectUserName($user_id)
{
    require $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';

    $sql = "SELECT name FROM user WHERE id = " . $user_id;

    $result = mysqli_query($connection, $sql);

    $connection->close();

    return mysqli_fetch_array($result)[0];
}
