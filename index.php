<!-- 予約受付画面 -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION["reserve_date"] = $_POST["reserve_date"];
    $_SESSION["reserve_num"] = $_POST["reserve_num"];
    $_SESSION["reserve_time"] = $_POST["reserve_time"];
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["tel"] = $_POST["tel"];
    $_SESSION["comment"] = $_POST["comment"];

    // var_dump($_SESSION["reserve_date"]);
    // var_dump($_SESSION["reserve_num"]);
    // var_dump($_SESSION["reserve_time"]);
    // var_dump($_SESSION["name"]);
    // var_dump($_SESSION["email"]);
    // var_dump($_SESSION["tel"]);
    // var_dump($_SESSION["comment"]);



    $this_month = date('n');
    $ThisMonth_DayCount = date("t", strtotime($this_month));


    $today_count = date('d', strtotime('now'));
    // $Reservable

    // header("Location:/reserve/confirm.php/");

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

    <title>ご来店予約</title>
</head>

<body>
    <header>SAMPLE　SHOP</header>
    <h1>ご来店予約</h1>

    <form method="POST" class="m-3">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【1】予約日を選択</label>
            <select class="form-select" name="reserve_date">
                <option selected>予約日</option>

                <?php for ($i = $today_count; $i <= $ThisMonth_DayCount; $i++) :  ?>
                    <option value="<?= $i ?>"><?=  $this_month."/".$i ?></option>
                <?php endfor; ?>

            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【2】人数を選択</label>
            <select class="form-select" name="reserve_num">
                <option selected>人数</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【3】予約時間を選択</label>
            <select class="form-select" name="reserve_time">
                <option selected>時間</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【4】予約者情報を入力</label>
            <input type="text" class="form-control" placeholder="氏名" name="name">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="メールアドレス" name="email">
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" placeholder="電話番号" name="tel">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">【5】備考</label>
            <textarea class="form-control" rows="3" placeholder="備考欄" name="comment"></textarea>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary rounded-pill" type="submit">確認画面へ</button>
            <button class="btn btn-secondary rounded-pill" type="button">戻る</button>
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