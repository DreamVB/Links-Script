<?php
	
	$links_path = 'content/links.txt';
	$Home_Title = "Bens Fav Links";
	
	function loadLinks(){
		global $links_path;
		
		$file = fopen($links_path,'r');
		
		while(!feof($file)){
			$line = fgets($file,255);
			
			if(strlen($line) > 0){
				$parts = explode('|',$line);
				$text = '<li><a href="' . $parts[1] .'" target="blank">' . $parts[0] .'</a></li>';
			
			echo($text);	
			}
		}
		unset($parts);
		fclose($file);
	}

	function postLink(){
		global $links_path;
		
		$title = strip_tags($_POST["txt_title"]);
		$url =  strip_tags($_POST["txt_url"]);
		
		$line = $title . "|" . $url . "\r\n";
		
		$file = fopen($links_path,'a');
		fwrite($file,$line);
		fclose($file);
		
		unset($title);
		unset($url);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		  <link rel="stylesheet" href="css/style.css">
		<title></title>
	</head>
	<body>
		<div class="container">
			<div class="hero">
				<h1><?php echo($Home_Title);?></h1>
				<form method="post" action="">
					<label>Link Title</label>
					<input id="link-title" name="txt_title" class="txt-box" type="text" placeholder="Enter link title ...">
					<label>Link Url</label>
					<input id="link-url" name="txt_url" class="txt-box" type="text" value="http://" placeholder="Enter link URL ...">
					<button onclick="return validateMyForm();" class="btn" type="submit">Submit</button>
					<button class="btn btn-reset" type="reset">Reset</button>
				</form>
			</div>
			
			<?php
				if(!empty($_POST) &&  $_SERVER["REQUEST_METHOD"] == "POST"){
					//Post the link
					postLink();
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


<script>
	function validateMyForm()
	{
		var cTitle = document.getElementById("link-title").value;
		var cUrl = document.getElementById("link-url").value;
 		
 		if(cTitle == "")
  		{ 
    		alert("You need to include a title for the URL.");
    		return false;
  		} else if(cUrl == ""){
  			alert("You must include a Address for the website.");
  			return false;
  		}
  		else{
  			return true;
		}
}
</script>

		
		<div class="footer">
			<span>&copy; <?php echo(date("Y"));?> <a href="http://dreamvb.rf.gd/">DreamVB OpenSource Blog</a></span>
		</div>

		</div>
	</body>
</html>