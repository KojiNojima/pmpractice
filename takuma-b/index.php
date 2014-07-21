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
            #text {
            	position: absolute; top: 250px; left: 40px; width: 130px;
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
			  <input name="tai" size="6" style="text-align:right" maxlength="3">kg
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  身長
			</td>
			<td>
			  <input name="sin" size="6" style="text-align:right" maxlength="3">cm
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
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  適正カロリー
			</td>
			<td width="40"  style="text-align:right">
                            kcl
			</td>
		</tr>
		<tr>
			<td height="30" align="center">
			  適正体重
			</td>
			<td width="40"  style="text-align:right">
                            kg
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
			    <img src="image/message.png" alt="メッセージ" width="80%" name="message">
			    <div id="text">
			    身長と体重を入力してください
				</div>
			</td>
		</tr>		
		<tr>
			<td align="center" colspan="2">
			    <img src="image/face_smile.png" alt="顔" width="80%" name="face">
			</td>
		</tr>
	  </table>
                 
	</form>
           
	</div>
	<div id="main">
    <div style="text-align:center">
    <h1>ランチメニュー</h1>
    <img src="image/menu.PNG" alt="メニュー" width="80%" >
    </div>
    <div style="text-align:right">
    </div>
    </div>
    </body>
</html>