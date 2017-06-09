<?php require_once '../Connections/conex2.php'; ?>
<?php

$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if ((isset($_POST['formid'])) && (isset($_POST['formid']) == 1)) {
    $UserEmail = $_POST['email'];
    $UserPassword = $_POST['password'];
    if (!isset($_SESSION)) {
        session_start();
    }

    $sql = 'SELECT * FROM users WHERE email = :email AND status=:status';
    $stmt = $conex->prepare($sql);
    $stmt->execute([$UserEmail, $UserPassword]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $loginFoundUser = $stmt->rowCount();

    if ($loginFoundUser) {
        $loginStrGroup = "";

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(TRUE);
        } else {
            session_regenerate_id();
        }
        $_SESSION['MM_UsernameAdmin'] = $UserEmail;
        $_SESSION['MM_UserGroupAdmin'] = $loginStrGroup;
        $_SESSION['MM_idAdmin'] = $user['id_admin'];
    }
    echo $loginFoundUser;
}
?>

