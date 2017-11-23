<?php
define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
require_once root.'connection/connect.php';


$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if ((isset($_POST['L_USER'])) && (isset($_POST['L_PASSWORD']))&& (isset($_POST['login_ingresar']))==1) {
    $LOGIN_USER = $_POST['L_USER'];
    $LOGIN_PASSWORD = $_POST['L_PASSWORD'];
    if (!isset($_SESSION)) {
        session_start();
    }

    $sql = 'SELECT r.id_rol AS id_rol,r.descripcion , f.id_funcionario , p.nombre , p.apellido '
            . 'FROM funcionario f, rol r, rol_usuario ru, persona p '
            . 'WHERE p.id_persona = f.id_persona '
            . 'AND f.id_funcionario = ru.id_funcionario '
            . 'AND ru.id_rol = r.id_rol '
            . 'AND alias = :LOGIN_USER AND password = :LOGIN_PASSWORD';
    $stmt = $conex->prepare($sql);
    $stmt->execute([$LOGIN_USER, $LOGIN_PASSWORD]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $loginFoundUser = $stmt->rowCount();
    if ($loginFoundUser) {
        $loginStrGroup = "";

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(TRUE);
        } else {
            session_regenerate_id();
        }
        $_SESSION['MS_USER'] = $LOGIN_USER;
        $_SESSION['MS_USER_ROL_ID'] = $user['id_rol'];
        $_SESSION['MS_USER_ROL_NAME'] = $user['descripcion'];
        $_SESSION['MS_USER_ID'] = $user['id_funcionario'];
        $_SESSION['MS_USER_NAME'] = $user['nombre'] . ' ' . $user['apellido'];
    }
    echo $loginFoundUser;
}
?>

