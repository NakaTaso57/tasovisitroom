<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission_4-1</title>
</head>
<body>
<pre>
<?php 
//sqlにログイン
$dsn='データベース名';
$user='ユーザ―名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);
$tb="tb";
//テーブル tbを作成
$sql="create table tb"
."("
."id INT,"
."name char(32),"
."comment char(32),"
."time TEXT"
.");";
$stmt=$pdo->query($sql);
?>
</pre>
<pre>
<?php
     $name=$_POST['name'];
     $comment=$_POST['comment'];
     $pass="kirby";
	 $dsn='データベース名';
     $user='ユーザー名';
     $password='パスワード';
     $pdo=new PDO($dsn,$user,$password);
	 $tb="tb";
	 
//コメント編集
 if(!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['hidd'])){
					$id=$_POST['hidd'];
                    $nm2=$name;
                    $kome=$comment;
                    $result=$pdo->query("update tb set name='$nm2',comment='$kome' where id=$id");
          
}
//コメント書き込み
    if(!empty($_POST['name']) && !empty($_POST['comment']) && empty($_POST['hidd'])){
		
		$sql=$pdo->prepare("INSERT INTO tb(id,name,comment,time)
        VALUES(:nm,:name,:comment,:time)");
		$results=$pdo->query('SELECT* FROM tb ORDER BY id;');
		foreach($results as $row){
			$nms=$row['id'];
		}
		$sql->bindParam(':nm',$nms,PDO::PARAM_STR);
        $sql->bindParam(':name',$name,PDO::PARAM_STR);
        $sql->bindParam(':comment',$comment,PDO::PARAM_STR);
		$sql->bindParam(':time',$time,PDO::PARAM_STR);
		$nms=$nms+1;
		$name=$_POST['name'];
        $comment=$_POST['comment'];
		$time=date('Y年m月d日 H:i:s');
        $sql->execute();
	}
//削除
if(!empty($_POST['bangou'])){        //削除番号が入力されていた場合
          if($_POST['pass'] == $pass){
			   $id=$_POST['bangou'];
               $result=$pdo->query("delete from tb where id=$id");
          }
          else{
               echo '<p><font size=6><font color=deeppink>パスワードが違うわよっ</font></font></p>';
          }
     
}
//編集選択出力
     if(!empty($_POST['rewrite'])){
          if($_POST['pass'] == $pass){
               $nm2=$_POST['rewrite'];
			   $results=$pdo->query('SELECT* FROM tb ORDER BY id;');
               foreach($results as $row){
                    if ($row['id']== $nm2){
						
						$hi=$row['id'];
						$name3=$row['name'];
						$massage3=$row['comment'];
                    }
                    else{
                    }
                 }
          }
          else{
               echo '<p><font size=6><font color=deeppink>パスワードが違うわよっ</font></font></p>';
          }
     }


?>
</pre>
<form method="post">
<p>名前：<input type="text" name="name" value="<?php echo $name3; ?>"><br></p>
<p>コメント：<input type="text" name="comment" value="<?php echo $massage3; ?>"><br></p>
<input type="hidden" name="hidd" value="<?php echo $hi; ?>">
<input type="submit" value="送信">
</form>
<form method="post">
<p>編集番号：<input type="number" name="rewrite" min="1" max="10"><br></p>
<p>パスワード:<input type="password" name="pass" maxlength="5"></p>
<input type="submit" value="送信">
</form>
<form method="post">
<p>削除番号：<input type="number" name="bangou" min="1" max="10"><br></p>
<p>パスワード:<input type="password" name="pass" maxlength="5"></p>
<input type="submit" value="送信">
</form>
<pre>
<?php
//出力
    if(!empty($_POST['name']) && !empty($_POST['comment']) || !empty($_POST['bangou'])){
      $dsn='データベース名';
      $user='ユーザー名';
      $password='パスワード';
      $pdo=new PDO($dsn,$user,$password);

      $results=$pdo->query('SELECT* FROM tb ORDER BY id;');
	  foreach($results as $row){
	  echo $row['id'].' ';
	  echo $row['name'].' ';
	  echo $row['comment'].' ';
	  echo $row['time'].'<hr>';
	  }
     }
?>
</pre>
</body>
</html>