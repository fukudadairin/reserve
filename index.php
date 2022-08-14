<!-- 予約受付画面 -->
<?php
// echo "<pre>";
// echo "</pre>";


session_start();
date_default_timezone_set('Asia/Tokyo');

$this_month = date('n');
$ThisMonth_DayCount = date("t", strtotime($this_month));
$today_count = date('d', strtotime('now'));


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reserve_date = $_POST["reserve_date"];
    $reserve_num = $_POST["reserve_num"];
    $reserve_time = $_POST["reserve_time"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $comment = $_POST["comment"];

    $_SESSION["RESERVE"]["reserve_date"] = $_POST["reserve_date"];
    $_SESSION["RESERVE"]["reserve_num"] = $_POST["reserve_num"];
    $_SESSION["RESERVE"]["reserve_time"] = $_POST["reserve_time"];
    $_SESSION["RESERVE"]["name"] = $_POST["name"];
    $_SESSION["RESERVE"]["email"] = $_POST["email"];
    $_SESSION["RESERVE"]["tel"] = $_POST["tel"];
    $_SESSION["RESERVE"]["comment"] = $_POST["comment"];


    $err = array();
    // if ($reserve_date = "予約日") {
    //     $err["reserve_date"] = "予約日時を選択して下さい";
    // }

    if (!$reserve_num) {
        $err["reserve_num"] = "予約人数を選択して下さい";
    } else if (!preg_match('/^\d{1,2}$/', $reserve_num)) {
        $err["reserve_num"] = "人数を入力して下さい";
    }

    // if ($reserve_time = "時間") {
    //     $err["reserve_time"] = "予約時間を選択して下さい";
    // }

    if (!$name) {
        $err["name"] = "予約者の氏名を入力して下さい";
    } elseif (mb_strlen($name, "utf-8") > 20) {
        $err["name"] = "20文字以内で入力して下さい";
    }

    if (!$email) {
        $err["email"] = "予約者のメールアドレスを入力して下さい";
    } elseif (mb_strlen($email, "utf-8") > 100) {
        $err["email"] = "100文字以内で入力して下さい";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err["email"] = "正確なメールアドレスを入力して下さい";
    }

    if (!$tel) {
        $err["tel"] = "予約者の電話番号を入力して下さい";
    } elseif (mb_strlen($tel, "utf-8") > 20) {
        $err["tel"] = "20文字以内で入力して下さい";
    } else if (!preg_match('/^\d{10,12}$/', $tel)) {
        $err["tel"] = "正確な番号を入力して下さい";
    }

    if ($comment && mb_strlen($comment, "utf-8") > 2000) {
        $err["comment"] = "2000文字以内で入力して下さい";
    }

    if (!$err) {
        header("Location:/reserve/confirm.php/");
    }

    var_dump($_SESSION["RESERVE"]);
    // var_dump($_SESSION["reserve_num"]);
    // var_dump($_SESSION["reserve_time"]);
    // var_dump($_SESSION["name"]);
    // var_dump($_SESSION["email"]);
    // var_dump($_SESSION["tel"]);
    // var_dump($_SESSION["comment"]);

    
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
            <select name="reserve_date" class="form-select <?php
                                                            if (isset($err["reserve_date"])) {
                                                                echo "is-invalid";
                                                            }  ?>">
                <option selected>予約日</option>
                <?php
                for ($i = 0; $i <= $ThisMonth_DayCount; $i++) :
                    $old_day = "{$i}day";
                ?>
                    <option value="<?= date("Y-m-d", strtotime($old_day)); ?>"><?= date("m/d", strtotime($old_day)); ?></option>
                <?php

                    var_dump($i);
                endfor;
                ?>

            </select>
            <div class="invalid-feedback">
                <?php echo $err["reserve_date"] ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【2】人数を選択</label>
            <select class="form-select  <?php
                                        if (isset($err["reserve_num"])) {
                                            echo "is-invalid";
                                        }  ?>" name="reserve_num">
                <option selected>人数</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="invalid-feedback">
                <?php echo $err["reserve_num"] ?>
            </div>

        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【3】予約時間を選択</label>
            <select class="form-select <?php
                                        if (isset($err["reserve_time"])) {
                                            echo "is-invalid";
                                        }  ?>" name="reserve_time">
                <option selected>時間</option>
                <option value="11:00">11:00</option>
                <option value="11:30">11:30</option>
                <option value="12:00">12:00</option>
            </select>
            <div class="invalid-feedback">
                <?php echo $err["reserve_time"] ?>
            </div>

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">【4】予約者情報を入力</label>
            <input type="text" class="form-control <?php
                                                    if (isset($err["name"])) {
                                                        echo "is-invalid";
                                                    }  ?>" placeholder="氏名" name="name">
            <div class="invalid-feedback">
                <?php echo $err["name"] ?>
            </div>

        </div>
        <div class="mb-3">
            <input type="email" class="form-control <?php
                                                    if (isset($err["email"])) {
                                                        echo "is-invalid";
                                                    }  ?>" placeholder="メールアドレス" name="email">
            <div class="invalid-feedback">
                <?php echo $err["email"] ?>
            </div>

        </div>
        <div class="mb-3">
            <input type="number" class="form-control <?php
                                                        if (isset($err["tel"])) {
                                                            echo "is-invalid";
                                                        }  ?>" placeholder="電話番号(ハイフン無し、半角入力)" name="tel">
            <div class="invalid-feedback">
                <?php echo $err["tel"] ?>
            </div>

        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label ">【5】備考</label>
            <textarea class="form-control <?php
                                            if (isset($err["comment"])) {
                                                echo "is-invalid";
                                            }  ?>" rows="3" placeholder="備考欄" name="comment"></textarea>
            <div class="invalid-feedback">
                <?php echo $err["comment"] ?>
            </div>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary rounded-pill" type="submit">確認画面へ</button>
            <a class="btn btn-secondary rounded-pill" href="/reserve/logout.php">戻る</a>
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