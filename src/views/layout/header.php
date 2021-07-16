<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/board.css">
    <script src="https://use.fontawesome.com/releases/v5.9.0/js/all.js"></script>
    <script src="//code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/main.js"></script>
    <title>Baseball Gallery</title>
</head>

<body>
    <div id="container" class="position-relative">
        <header class="d-flex justify-content-between">
            <div id="logo" class="d-flex align-items-center">
                <img src="images/logo.png" alt="logo">
                <div class="d-flex flex-column">
                    <h3 class="m-0"><i><b>BBG</b></i></h3>
                    <p class="mb-0"><i>Baseball Gallery</i></p>
                </div>
            </div>
            <ul id="menu" class="d-flex justify-content-between">
                <li><a href="/board?league=kbo">KBO</a></li>
                <li><a href="/board?league=mlb">MLB</a></li>
                <li><a href="/board?league=npb">NPB</a></li>
                <li><a href="/board?league=cpbl">CPBL</a></li>
            </ul>
            <ul id="loginMenu" class="d-flex justify-content-end">
                <?php if (__SESSION) : ?>
                    <li title="<?= htmlentities($_SESSION['user']->name) ?>">
                        <?php if ($_SESSION['user']->id === "admin") : ?>
                            <a href="/admin" class="text-dark">관리자</a>
                        <?php else : ?>
                            <a href="/password_lost">
                                <?= htmlentities($_SESSION['user']->name) ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <span>|</span>
                    <li><a href="/logout">LOGOUT</a></li>
                <?php else : ?>
                    <li><a href="/login" class="color-red">LOGIN</a></li>
                    <span>|</span>
                    <li><a href="/register">SIGN UP</a></li>
                <?php endif; ?>
            </ul>
        </header>