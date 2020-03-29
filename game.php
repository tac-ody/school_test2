<?php
session_start();
//先手か後手か、○か×かをセッション変数に代入
$_SESSION['firstorsecond'] = $_POST['firstorsecond'];
$_SESSION['mark'] = $_POST['mark'];
$_SESSION['name'] = $_POST['name'];
$token = array("","","","","","","","","");
$token2 = array("","","","","","","","","");
// <!--入力された○か×を次の画面でも保持-->
for($i = 0; $i < 9; $i++){
if (!empty($_POST['squarebox'][$i])) {
    $token[$i] = $_POST['squarebox'][$i];
    continue;
 }
}
//マス目配列のインデックス数の乱数を$iに代入
$i = mt_rand(0,count($token)-1);
//ユーザーが○を選び、なおかつ後手のときに発動
if($_SESSION['mark'] == "○" && $_SESSION['firstorsecond'] == "後手"){
    while($token[$i]=="○" || $token[$i]=="×"){
        $i = mt_rand(0,count($token)-1);
    }
        $token[$i]="×";
}
//ユーザーが×を選び、なおかつ後手のときに発動
if($_SESSION['mark'] == "×" && $_SESSION['firstorsecond'] == "後手"){
    while($token[$i]=="○" || $token[$i]=="×"){
        $i = mt_rand(0,count($token)-1);
    }
        $token[$i]="○";
}
//ユーザーが○を選び、なおかつ先手のときに発動
if($_SESSION['mark'] == "○" && $_SESSION['firstorsecond'] == "先手" && in_array("○", $token) && in_array("", $token)){
    while($token[$i]=="○" || $token[$i]=="×"){
        $i = mt_rand(0,count($token)-1);
    }
        $token[$i]="×";
}
//ユーザーが×を選び、なおかつ先手のときに発動
if($_SESSION['mark'] == "×" && $_SESSION['firstorsecond'] == "先手" && in_array("×", $token) && in_array("", $token)){
    while($token[$i]=="○" || $token[$i]=="×"){
        $i = mt_rand(0,count($token)-1);
    }
        $token[$i]="○";
}
// 項番を保存
if (!empty($_SESSION['counter'])) {
  // 2周目以降
  $_SESSION['counter'] = $_SESSION['counter']+2;
} else if ($token[$i]=="○" || $token[$i]=="×") {
  // 1周目
  $_SESSION['counter'] = 1;
}
// CSV書き込み時のコンピューターの先手or後手と○or×を判別
if ($_SESSION['firstorsecond'] == "先手"){
  $cputurn = "後手";
} else {
  $cputurn = "先手";
}
if ($_SESSION['mark'] == "○"){
  $cpumark = "×";
} else {
  $cpumark = "○";
}
// CSV書き込み（ユーザー先手の時）
if($_SESSION['firstorsecond'] == "先手" && !empty($_POST['squarebox'])){
 $ary = array(array($_SESSION['counter'],$_SESSION['name'],$_SESSION['firstorsecond'],$_SESSION['mark']));
 $ary = mb_convert_encoding($ary, 'SJIS-win', 'UTF-8');

        $csv = fopen('CSV/3x3score.csv', 'a');
        foreach ($ary as $line) {
            fputcsv($csv, $line);
        }
        fclose($csv);
 $arycpu = array(array($_SESSION['counter']+1,"PC",$cputurn,$cpumark));
 $arycpu = mb_convert_encoding($arycpu, 'SJIS-win', 'UTF-8');

         $csvcpu = fopen('CSV/3x3score.csv', 'a');
         foreach ($arycpu as $line) {
             fputcsv($csvcpu, $line);
        }
        fclose($csvcpu);
}
// CSV書き込み（ユーザー後手の時）
if($_SESSION['firstorsecond'] == "後手" && !empty($_POST['squarebox'])){
  $arycpu = array(array($_SESSION['counter']-2,"PC",$cputurn,$cpumark));
  $arycpu = mb_convert_encoding($arycpu, 'SJIS-win', 'UTF-8');

          $csvcpu = fopen('CSV/3x3score.csv', 'a');
          foreach ($arycpu as $line) {
              fputcsv($csvcpu, $line);
          }
          fclose($csvcpu);
  $ary = array(array($_SESSION['counter']-1,$_SESSION['name'],$_SESSION['firstorsecond'],$_SESSION['mark']));
  $ary = mb_convert_encoding($ary, 'SJIS-win', 'UTF-8');

          $csv = fopen('CSV/3x3score.csv', 'a');
          foreach ($ary as $line) {
              fputcsv($csv, $line);
          }
          fclose($csv);
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>三目並べ</title>
    <link rel="stylesheet" href="game.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
    <form action="gameresult.php" method="POST">
        <div id="header">
            <h1>三目並べゲーム</h1>
        </div>
        <div id="firstorsecond">先後:
            <input type="text" name="firstorsecond" id="box" value="<?php echo $_POST['firstorsecond']?>" readonly>
            <input type="hidden" name="mark" id="box" value="<?php echo $_POST['mark']?>" readonly>
            <input type="hidden" name="name" id="box" value="<?php echo $_POST['name']?>" readonly>
        </div>
        <div id="squares">
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[0] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[1] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[2] ?>">
            </div>
            <br>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[3] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[4] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[5] ?>">
            </div>
            <br>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[6] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[7] ?>">
            </div>
            <div class="square">
                <input type="text" class="squarebox" name="squarebox[]" value="<?php echo $token[8] ?>">
            </div>
        </div>
        <div id="footer">
            <button type="submit" formaction="http://localhost/test20200221/game.php" id="submit">送信</button>
            <button type="submit" formaction="gameend.php" id="makerecord">棋譜</button>
        </div>
    </form>
    <script src="game.js"></script>
</body>
</html>
