 <?php

	session_start();

	if(isset($_POST['id']) and isset($_POST['password'])){
		$id = $_POST['id'];
		$password = $_POST['password'];
	

    	$link = mysqli_connect("localhost","root","12345678","practicework_3");
		if(!$link){
			echo "連接失敗".mysqli_connect_error();
		}
		
		$sql = "select * from account where id ='$id'";
    	$rs = mysqli_query($link,$sql);
	
		if($record = mysqli_fetch_assoc($rs)){
			if($password == $record['password']){
				$_SESSION['id'] = $record['id'];
				$_SESSION['password'] = $record['password'];
				header('location: index.php');
			}
		}

		if(mysqli_num_rows($rs) == 0){
			$error = "帳號不存在";
		}
		else{
			$error = "密碼錯誤";
		}
		
		echo $id," ",$password;
		echo $_SESSION['id']," ",$_SESSION['password'];
	  	
		mysqli_close($link);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
</head>
<body>
    <div class="container" style="width:25%">
        <form method="post">
            <br>
            帳號：<br>
            <input class="form-control" type="text" name="id" required autofocus>
        
            <br>
            
            密碼：<br>
            <input class="form-control" type="password" name="password" required>
            
            <br>
            
            <p><?php echo $error ?></p>
            
            <br>
            
            <p style="text-align:center">
                <input class="btn btn-primary" type="submit" value="登入">
            </p>
            
            <br>
            
            <p style="text-align:center">
                <a href=" ">尚未有帳號?點此註冊</a>
            </p>
        </form>
    </div>
</body>
</html>