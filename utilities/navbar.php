<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Autella</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/autella.com/questao/create.php">Criar questão</a>
            </li>
        </ul>


        <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item">


                <div class="dropdown">
                    <a data-toggle="dropdown" class="nav-link" href=""><?php echo $_SESSION['userData']['name']; ?>&nbsp <img src="/autella.com/bootstrap/bootstrap-icons-1.0.0/caret-down-fill.svg" alt=""></a>


                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/autella.com/utilities/logout.php">Logout</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalEditarConta">Alterar dados</a>
                    </div>
                </div>
            </li>
            <img class="rounded-circle" style="width: 64px; height: 64px" src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['userData']['picture']); ?>" />
        </ul>
    </div>
</nav>