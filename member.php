<?php
include_once "./inc/connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
    <?php

include_once "./inc/header.php";
?>
        <h1>使用者資料</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo "<div class='alert alert-warning text-center col-6 m-auto'>";
            echo $_SESSION['msg'];
            // 只出現一次，這樣重整不會再出現
            unset($_SESSION['msg']);
            echo "</div>";
        }
        // $sql = "select * from users where `acc`='{$_SESSION['user']}'";
        // $user = $pdo->query($sql)->fetch();
        $user=find('users',['acc'=>"{$_SESSION['user']}"]);
    ?>

        <form action="./api/update.php" method="post" class="col-4 m-auto">
            <div class="input-group my-1">
                <label class="col-4  input-group-text">帳號:</label>
                <input class="form-control" type="text" name="acc" id="acc" value="<?= $user['acc']; ?>">
            </div>
            <div class="input-group my-1">
                <label class="col-4  input-group-text">密碼:</label>
                <input class="form-control" type="password" name="pw" id="pw" value="<?= $user['pw']; ?>">
            </div>
            <div class="input-group my-1">
                <label class="col-4  input-group-text">姓名:</label>
                <input class="form-control" type="text" name="name" id="name" value="<?= $user['name']; ?>">
            </div>
            <div class="input-group my-1">
                <label class="col-4  input-group-text">電子郵件:</label>
                <input class="form-control" type="text" name="email" id="email" value="<?= $user['email']; ?>">
            </div>
            <div class="input-group my-1">
                <label class="col-4  input-group-text">居住地:</label>
                <input class="form-control" type="text" name="address" id="address" value="<?= $user['address']; ?>">
            </div>
            <div>
                <!-- 加入ID傳值以便update-php能在資料庫抓到對應的ID進行修改 -->
                <input class="form-control" type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
                <input class="btn btn-primary mx-2" type="submit" value="更新">
                <input class="btn btn-warning mx-2" type="reset" value="重置">
                <!-- 比較進階的做法 -->
                <input class="btn btn-danger mx-2" type="button" value="讓我消失吧" onclick="location.href='./api/del_user.php?id=<?=$user['id'];?>'">
            </div>



        </form>
<!-- 目前學的基礎方法 -->
        <form action="./api/del_usr.php" method="post">
            <input class="form-control" type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
            <input class="btn btn-danger mx-2" type="submit" value="讓我消失吧">
        </form>


    </div>
    <?php include_once "./inc/footer.php";?>
</body>

</html>