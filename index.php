<?php

	session_start();

	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	$link = mysqli_connect("localhost","root","12345678","practicework_3");

    $sql_1 = "select * from account";
	$sql_2 = "select * from item";

	$rs1 = mysqli_query($link,$sql_1);
	$rs2 = mysqli_query($link,$sql_2);
	$rs3 = mysqli_query($link,$sql_2);

	if($record = mysqli_fetch_assoc($rs1)){
		$_SESSION['name'] = $record['name'];
	}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	
    <style>
        h1,h2,h5,p{text-align: center};
		
    </style>
</head>
<body>
	
<div class="container">	
	<nav class="navbar navbar-expand-lg bg-light">
		
		<!--	收藏導覽列	-->
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
          				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">收藏</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<?php
								for($i=0;$i<6;$i++){
									if($record1 = mysqli_fetch_assoc($rs3)){
										$item1 = $record1;
									}
									if(isset($_SESSION[$item1['name']])){
							?>
										<li><?php echo $item1['name'] ?></li>
							<?php
									}
								}
							?>
						</ul>
        			</li>
					
				</ul>
			</div>
		</div>
		
		<!--	帳號導覽列	-->
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="navbar-nav navbar-right">
			<?php
				if($_SESSION['id']<>""){  //登入成功
			?>	
					<li class="nav-item"><h6 class="nav-link" style="color:black"><?php echo $_SESSION['name']; ?></h6></li>
					<li class="nav-item"><a class="active btn btn-primary" style="color:white" href="login.php">登出</a></li>
					
			<?php
				}
			?>
				</ul>
			</div>
		</div>
		
	</nav>
	
    <form method="post" action=" ">
		<br>
        <h1>趴趴商店</h1>
		<br>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        	for($i=0;$i<6;$i++){
				if($record = mysqli_fetch_assoc($rs2)){
					$item = $record;
				}
            	$picture = "img/{$item['image']}.jpg"; //how
        ?>
        
        <div class="col">
            <div class="card h-100">
              <div class="card-header">
                <h5><?php echo $item['name'] ?></h5>
              </div>
                
              <img src="<?php echo $picture ?>" class="card-img-top">
                
              <div class="card-body">
                <h2><b><?php echo "￥",number_format($item['price']) ?></b></h2>  
                <p class="card-text"><?php echo $item['detail'] ?></p> 
              </div>
				
			  <!-- 收藏(start) -->
			  <div style="text-align:right">
			    <?php
					if(isset($_SESSION[$item['name']])){
				?>
				    <a href="dislike.php?item_name=<?php echo $item['name']; ?>">
				  		<img src="img/redheart.png" width="10%">
				  	</a>
			    <?php
					}
					else{
				?>
				  	<a href="like.php?item_name=<?php echo $item['name']; ?>">
				  		<img src="img/whiteheart.png" width="10%">
				  	</a>
				<?php
					}
				?>
			  </div>  
			  <!-- 收藏(end) -->	
					
            </div>
        </div>
        
        <?php 
            } 
        ?>
        
    </div>

    </form>
    
	<br>
	
</div>
        
</body>
</html>