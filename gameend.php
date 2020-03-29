<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>ゲーム終了</title>
    <link rel="stylesheet" href="gameend.css">
</head>
<body>
    <div id="header">
        <h1>三目並べゲーム</h1>
        <h2>協力ありがとうございました</h2>
    </div>
    <div id="footer">
        <button type="submit" onclick="location.href='gamestart.php'" id="return-box">OK</button>
    </div>
</body>
</html>
