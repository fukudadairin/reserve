<!-- ログイン画面 -->
<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/../function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login_id = $_POST["login_id"];
    $login_password = $_POST["login_password"];

    $pdo  = connect_db();
    $sql = "SELECT login_id,login_password FROM shop WHERE login_id = :login_id AND login_password = :login_password LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":login_id", (int)$login_id, PDO::PARAM_INT);
    $stmt->bindValue(":login_password", $login_password, PDO::PARAM_STR);
    $stmt->execute();
    $login_check = $stmt->fetch();

    if($login_check){
        header("Location:/reserve/admin/reserve_list.php/");
    }



}

?>

<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

    <!-- original CSS -->
    <link rel="stylesheet" href="/reserve/css/style.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->


    <title>予約システムログイン</title>
</head>

<body>
    <header class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">SAMPLE　SHOP</div>
            <form class="d-flex">
                <a href="/reserve/admin/reserve_list.php/"><i class="bi bi-list-task"></i></a>
                <a href="/reserve/admin/setting.php/"><i class="bi bi-gear"></i></a>
            </form>
        </div>
    </header>

    <h1>予約システムログイン</h1>

    <form class="card text-center" method="POST">
        <div class="card-body">
            <div class="mb-3">
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ID" name="login_id">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="PASSWORD" name="login_password">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary rounded-pill">ログイン</button>
            </div>
        </div>
    </form>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>