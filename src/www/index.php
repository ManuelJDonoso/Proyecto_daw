<?php
include_once "models/usuario.php";
session_start();
if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof Usuario)) {
    $_SESSION['user'] = new Visitante();
}

$usuario = $_SESSION['user'];
include_once "views/head.php";

$pdo = require_once 'config/conexion.php';
?>

<body>
<div class="wrapper">
    <header>

        <div class="banner">
            <h1 class="banner__text">Cronicas de Merida</h1>
        </div>
       
    </header>
    <?php
        include_once "views/menu.php";
        ?>
    <main class="main">
  
        <?php
        if (isset($_GET["pag"])) {
            switch ($_GET["pag"]) {
                case 'login':
                    include_once "views/login.php";
                    break;
                case 'registro_ok':
                    include_once "views/registro_ok.php";
                    break;
                case 'registro_err':
                    include_once "views/registro_err.php";
                    break;
                case 'creat_account':
                    include_once "views/creat_account.php";
                    break;
                case 'creat_account_err':
                    include_once "views/creat_account_err.php";
                    break;
                case 'about':
                    include_once "views/about.php";
                    break;
                case 'show_events':
                    include_once "views/show_events.php";
                    break;

                case 'event':
                    include_once "views/event.php";
                    break;
                case 'add_event':
                    include_once "views/add_event.php";
                    break;
                case 'my_profile':
                    include_once "views/my_profile.php";
                    break;
                case 'assing_role':
                    include_once "views/assing_role.php";
                    break;
                case 'delete_user':
                    include_once "views/delete_user.php";
                    break;
                case 'forum':
                    include_once "views/forum.php";
                    break;
                case 'tema':
                    include_once "views/tema.php";
                    break;


                default:
                include_once "views/pag_err.php";
                    break;
            }
        }



        ?>

    </main>

    <?php include_once"views/footer.php"; ?>
</div>
    <script src="js/script.js"></script>
</body>

</html>
