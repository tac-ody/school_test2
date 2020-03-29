<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>三目並べ</title>
    <link rel="stylesheet" href="gamestart.css">
</head>
<body>
    <form action="game.php" method="POST">
        <div id="header">
            <h1>三目並べゲーム</h1>
        </div>
        <div id="firstorsecond">先後:
            <select name="firstorsecond" class="box" required>
                <option value="">▼選択してください</option>
                <option value="先手">先手</option>
                <option value="後手">後手</option>
            </select>
        </div>
        <div id="mark">マーク:
            <select name="mark" class="box" required>
                <option value="">▼選択してください</option>
                <option value="○">○</option>
                <option value="×">×</option>
            </select>
        </div>
        <div id="name">名前:
            <input type="text" name="name" class="box" required>
        </div>
        <div id="footer">
            <button type="submit" id="submit">スタート</button>
        </div>
    </form>
</body>
</html>
