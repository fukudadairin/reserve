<!-- 予約内容の確認 -->
<?php

// ———————————————————
// DB接続
// ———————————————————
require_once(dirname(__FILE__) . "/config/config.php");
require_once(dirname(__FILE__) . "/function.php");
$pdo  = connect_db();


echo "<pre>";
session_start();


$reserve_date = $_SESSION["RESERVE"]["reserve_date"];
$reserve_num = $_SESSION["RESERVE"]["reserve_num"];
$reserve_time = $_SESSION["RESERVE"]["reserve_time"];
$name = $_SESSION["RESERVE"]["name"];
$email = $_SESSION["RESERVE"]["email"];
$tel = $_SESSION["RESERVE"]["tel"];
$comment = $_SESSION["RESERVE"]["comment"];

// var_dump($_SESSION["RESERVE"]);
// var_dump($reserve);

echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "INSERT INTO reserve(reserve_date,reserve_num,reserve_time,name,email,tel,comment) VALUES(:reserve_date,:reserve_num,:reserve_time,:name,:email,:tel,:comment)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':reserve_date', $reserve_date, PDO::PARAM_STR);
    $stmt->bindValue(':reserve_num', $reserve_num, PDO::PARAM_INT);
    $stmt->bindValue(':reserve_time', $reserve_time, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->execute(); // 実行


    $sql = "SELECT reserve_date,reserve_num,reserve_time,name,email,tel,comment FROM reserve WHERE reserve_date =:reserve_date AND reserve_num =:reserve_num AND reserve_time =:reserve_time AND name =:name AND email =:email AND tel =:tel AND comment =:comment limit 1";
    $stmt = $pdo->prepare($sql); //どれを使うのかを決める→SELECT文：INSERT文：UPDATE文：DELETE文：
    $stmt->bindValue(':reserve_date', $reserve_date, PDO::PARAM_STR);
    $stmt->bindValue(':reserve_num', $reserve_num, PDO::PARAM_INT);
    $stmt->bindValue(':reserve_time', $reserve_time, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->execute();
    $DB_InsertCheck = $stmt->fetch();


    if ($DB_InsertCheck) {
        echo "aaaa";
        header("Location:/reserve/complete.php/");
    } else {
        echo "bbbb";

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

    <!-- original CSS -->
    <link rel="stylesheet" href="/reserve/css/style.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->


    <title>予約内容確認</title>
</head>

<body>
    <header>SAMPLE　SHOP</header>
    <h1>予約内容確認</h1>

    <table class="table bgcWhite">

        <tbody>
            <tr>
                <th scope="row">日時</th>
                <td colspan="2">2022年07月30日(土)17時00分</td>
            </tr>
            <tr>
                <th scope="row">人数</th>
                <td colspan="2"><?= $reserve_num ?></td>
            </tr>
            <tr>
                <th scope="row">氏名</th>
                <td colspan="2"><?= $name ?></td>
            </tr>
            <tr>
                <th scope="row">メールアドレス</th>
                <td colspan="2"><?= $email ?></td>
            </tr>
            <tr>
                <th scope="row">電話番号</th>
                <td colspan="2"><?= $tel ?></td>
            </tr>
            <tr>
                <th scope="row">備考</th>
                <td colspan="2"><?= $comment ?></td>
            </tr>
        </tbody>
    </table>

    <form class="d-grid gap-2 mx-3" method="POST">
        <button class="btn btn-primary rounded-pill" type="submit">予約確定</button>
        <a class="btn btn-secondary rounded-pill" href="/reserve/">戻る</a>
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