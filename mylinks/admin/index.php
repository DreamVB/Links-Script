<?php
	
	$links_path = '../content/links.txt';
	$Home_Title = "Admin Area";
	$lines = file($links_path, FILE_IGNORE_NEW_LINES);
	
	function loadLinks(){
		global $links_path;
		global $lines;
		
		$x = 0;
		
		foreach($lines as $value){
			
			if(strlen($value) > 0){
				$parts = explode('|',$value);
				$text = '<li><a href="' . "index.php?action=delete&id=" . $x .'" target="blank"> <div class="div-delete">Delete</div> ' . $parts[0] .'</a></li>';
			
			echo($text);	
			}
			$x++;
		}
		unset($value);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		  <link rel="stylesheet" href="../css/style.css">
		<title>Admin Area</title>
	</head>
	<body>
		<div class="container">
			<div class="hero">
				<h1><?php echo($Home_Title);?></h1>
			</div>
			
			
			<?php
				global $lines;
				global $links_path;
				
				if(isset($_GET['action'])){
					unset($lines[$_GET['id']]);
					file_put_contents($links_path, implode(PHP_EOL, $lines));
					header('Location: index.php');
				}
			?>
			
			<div class="links">
				<ul>
					<?php loadLinks();?>
				</ul>
			</div>
			
<script>
	if ( window.history.replaceState ) {
  		window.history.replaceState( null, null, window.location.href );
	}
</script>

		<div class="footer">
			<span>&copy; <?php echo(date("Y"));?> <a href="http://dreamvb.rf.gd/">DreamVB OpenSource Blog</a></span>
		</div>

		</div>
	</body>
</html>