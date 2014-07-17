<?php
require_once 'database_conf.php';
require_once 'h.php';
session_start();
$tai = $_POST['tai'];
$sin = $_POST['sin'];
$bmi = round($tai / ($sin/100) / ($sin/100), 2);
$kcl = round(($sin/100) * ($sin/100) * 22 * 25, 2);
$kg = round(($sin/100) * ($sin/100) * 22 , 2);
$kari = ($kcl + 100) / 3 +100;
$itiniti = round($kari, -2);
try {
    # MySQLデータベースに接続します☆レシピ260☆
    $db = new PDO($dsn, $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    #メニューをデータベースから取得する。
    $sql = 'SELECT * FROM lunch WHERE MenuNo = :itiniti';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':itiniti', $itiniti,PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $menu) {
        $menuname = $menu['MenuName'];
        $menukcl = $menu['Kcal'];
        $imageurl = $menu['ImageURL'];
    }
}catch (PDOException $e) {
    echo 'エラーが発生しました。内容: ' . h($e->getMessage());
}
?>
                  
<html>
    <head>
        <title>学食メニュー推奨システム</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            #top {
                position: fixed;
            }
            #menu {
                padding-top: 150px;
            }
            #menu table {
                position: fixed;  
            }
            #menu td {
                width: 110px;
            }
            #main {
                padding-left: 180px;
            }
        </style>
    </head>
	<body>
            <div id="top">
            <img src="image/title.png" alt="プロジェクトマネジメント学科" width="900" height="100">
            </div>
            <div id="menu">
                <form method="post" action="search.php">
            <table>
                <tr>
			<td height="30" align="center">
			  体重
			</td>
			<td>
			  <input name="tai" value="<?php echo $tai;?>" size="6" style="text-align:right" maxlength="3">kg
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  身長
			</td>
			<td>
			  <input name="sin" value="<?php echo $sin;?>" size="6" style="text-align:right" maxlength="3">cm
			</td>
		</tr>
		<tr>
			<td height="40" align="center" colspan="2">
                            <input type="submit" value="計算！">
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  BMI指数
			</td>
			<td width="40"  style="text-align:right">
			<?php echo $bmi;?>
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  適正カロリー
			</td>
			<td width="40"  style="text-align:right">
                            <?php echo $kcl;?>kcl
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  適正体重
			</td>
			<td width="40"  style="text-align:right">
                            <?php echo $kg;?>kg
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
			    <img src="image/message.png" alt="メッセージ" width="80%" name="message">
			    <span style="position: absolute; top: 247px; left: 40px; width: 130px;">
			    <div id="text">身長と体重を入力してください</div>
			    </span>
			</td>
		</tr>		<tr>
			<td align="center" colspan="2">
			    <img src="image/face_smile.png" alt="顔" width="80%" name="face">
                            <?php
                            if($bmi > 40){
                              $imageurl = "image/menu.PNG";
                                echo '<script type="text/javascript">' ;
                                echo 'alert("bmiエラー");' ;
                                echo 'document.face.src = "image/face_angree.png";' ;
                                echo 'document.getElementById("text").innerHTML="正常なBMIを算出できませんでした";' ;
                                echo '</script>' ;
                            }else if($bmi > 25){
                                echo '<script type="text/javascript">' ;
                                echo 'document.face.src = "image/face_angree.png";' ;
                                echo 'document.getElementById("text").innerHTML="太っています";' ;
                                echo '</script>' ;
                            }else if($bmi > 18.5){
                                echo '<script type="text/javascript">' ;
                                echo 'document.face.src = "image/face_smile.png";' ;
                                echo 'document.getElementById("text").innerHTML="普通です";' ;
                                echo '</script>' ;
                            }else if($bmi > 11){
                                echo '<script type="text/javascript">' ;
                                echo 'document.face.src = "image/face_angree.png";' ;
                                echo 'document.getElementById("text").innerHTML="痩せています";' ;
                                echo '</script>' ;
                            }else{
                              $imageurl = "image/menu.PNG";
                                echo '<script type="text/javascript">' ;
                                echo 'alert("bmiエラー");' ;
                                echo 'document.face.src = "image/face_angree.png";' ;
                                echo 'document.getElementById("text").innerHTML="正常なBMIを算出できませんでした";' ;
                                echo '</script>' ;
                            }
                            ?>
			</td>
		</tr>
	  </table>
	</form>
               
	</div>
	<div id="main">
    <div style="text-align:center">
            <h1><?php echo $menuname;?></h1>
            <img src="<?php echo $imageurl;?>" alt="メニュー" width="80%" >
    </div>
        <div style="text-align:right" ><h2><?php echo $menukcl;?>カロリー</h2>
        </div>
    </div>
    </body>
</html>