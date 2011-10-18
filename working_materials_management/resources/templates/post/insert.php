<?php

	if(isAdmin()){
		if( isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["classID"]) && isset($_POST["subjectID"]) ) {
			$title = $_POST["title"];
			$content = $_POST["content"];
			$active = isset($_POST["active"]) ? 1 : 0;
			$classID = $_POST["classID"];
			$subjectID = $_POST["subjectID"];
			
			$postID = insertPost($title, $content, $active, $classID, $subjectID);
			
			if( strlen($_FILES["file"]["name"][0]) != 0 ){
				for($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
					$name = $_FILES["file"]["name"][$i];
					$tmpName = $_FILES["file"]["tmp_name"][$i];
					$size = $_FILES["file"]["size"][$i];
					$type = $_FILES["file"]["type"][$i];
					
					
					$fp      = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					
					if(!get_magic_quotes_gpc())
					{
					    $name = addslashes($name);
					}
					
					insertFile($name, $type, $size, $content, $postID);
				}
			}
			
			if( strlen($_POST["link"][0]) != 0 ){
				foreach( $_POST["link"] as $link) {
					insertLink($link, $postID);
				}
			}
			
			if( strlen($_FILES["image"]["name"][0]) != 0 ){
				for($i = 0; $i < count($_FILES["image"]["name"]); $i++) {
					$name = $_FILES["image"]["name"][$i];
					$tmpName = $_FILES["image"]["tmp_name"][$i];
					$size = $_FILES["image"]["size"][$i];
					$type = $_FILES["image"]["type"][$i];
					
					
					$fp      = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					
					if(!get_magic_quotes_gpc())
					{
					    $name = addslashes($name);
					}
					
					insertImage($name, $type, $size, $content, $postID);
				}
			}	
	    }
	    
		require_once(TEMPLATES_PATH . "/post/post.php");
    }
?>
