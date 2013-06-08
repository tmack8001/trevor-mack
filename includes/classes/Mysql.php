<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/includes/php/constants.php';

function stmt_bind_assoc (&$stmt, &$out) {
	    $data = mysqli_stmt_result_metadata($stmt);
	    $fields = array();
	    $out = array();
	
	    $fields[0] = $stmt;
	    $count = 1;
	
	    while($field = mysqli_fetch_field($data)) {
	        $fields[$count] = &$out[$field->name];
	        $count++;
	    }    
	    call_user_func_array("mysqli_stmt_bind_result", $fields);
	}

class Mysql {
	private $conn;
	
	function __construct() {
		$this->conn = new mysqli( DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME ) or
					  die('There was a problem connecting to the database');
	}
	
	function sanitize($user_input) {
	    return mysql_real_escape_string($user_input);
	}

	function get_blogs($article = '', $permalink = '', $date = '', $format = 'full') {
		$blogs = array();
		
		$articleFilter = '';
		$dateFilter = false;
		if($article)
			$articleFilter = ' AND article.articleID = ' . $this->sanitize($article);
		if($permalink)
		    $articleFilter = ' AND article.permalink = \"' . $this->sanitize($permalink) . '\"';
		if($date)
			$dateFilter = true;

		$query = "SELECT *
				  FROM `article`, `categories`
				  WHERE article.categoryID = categories.categoryID $articleFilter
				  ORDER BY date_posted DESC
				  LIMIT 10";
		//echo $query."<br>";
		if( $stmt = $this->conn->prepare($query) ) {
			$stmt->execute();
			
			$row = array();
			stmt_bind_assoc($stmt, $row);
			
			while( $stmt->fetch() ) {
				if( $format == 'full' ) {
					//echo "articleDate: " . date("Ymd", $row['date_posted']) . "<br>";
					if(!$dateFilter || $date == date("Ymd", $row['date_posted'])) {
						$blogs[] = array("articleID" => $row['articleID'], 
									"title" => $row['title'],
									"name" => $row['name'],
									"articleText" => $row['articleText'],
									"picture" => $row['picture'],
									"categoryName" => $row['categoryName'],
									"date_posted" => $row['date_posted']);
					}
				} else {
					$blogs[] = $row['articleID'];
				}
			}
			$stmt->close();
			
			for( $i = 0; $i<count($blogs); $i++ ) {
				$blogs[$i]["comments"] = $this->get_comments($blogs[$i]["articleID"]);
			}
			
		}else {
			echo "could not get query: " . $query;
		}
		return $blogs;
	}
	
	function get_comments($article = '', $page = 0) {		
		$comments = array();
		
		$query = "SELECT *
		  FROM `comments`
		  WHERE comments.articleID = $article
		  AND comments.hidden = 0
		  ORDER BY date_posted ASC";
		//echo $query."<br>";
		if( $stmt = $this->conn->prepare($query) ) {
			$stmt->execute();
			
			$row = array();
			stmt_bind_assoc($stmt, $row);
			while( $stmt->fetch() ) {
				$comments[] = array("commentID" => $row['commentID'], 
								  "name" => $row['name'],
								  "email" => $row['email'],
								  "commentText" => $row['commentText'],
								  "date_posted" => $row['date_posted']);
			}
			$stmt->close();
		}else {
			echo "could not get query: " . $query;
		}
		return $comments;
	}
	
	function add_comment($name, $email, $commentText, $articleID) {
		// sanitize data
		$name = strip_tags($name);
		$email = strip_tags($email);
		// remove img tags (potential security risk)
		$commentText = eregi_replace("<[[:space:]]* img[[:space:]]*([^>]*)[[:space:]]*>", "", $commentText);
		// remove all anchor attributes except href (potential security risk)
		$commentText = eregi_replace("<a[^>]*href[[:space:]]*=[[:space:]]*\"?[[:space:]]*([^\" >]*)[[:space:]]*\"?[^>]*>", '<a href="\\1">', $commentText);
		// removes all obtrusive HTML tags as well as any potentially malious tags
		$commentText = strip_tags($commentText, "<p><b><i><a><em><br><li><ol><ul><blockquote><pre><font>");
		
		$name = htmlspecialchars(mysql_real_escape_string($name));
		$email = htmlspecialchars(mysql_real_escape_string($email));
		$commentText = htmlspecialchars(mysql_real_escape_string($commentText));
		
		$query = "INSERT INTO comments (name, email, commentText, articleID, date_posted) VALUES( ?, ?, ?, ?, ? )";
		
		/*echo "name: " . $name . "<br/>";
		echo "email: " . $email . "<br/>";
		echo "text: " . $commentText . "<br/>";
		eco "artID: " . $articleID . "<br/>";*/
		
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param("sssii", $name, $email, $commentText, $articleID,	time() );
			$stmt->execute();
			
			$commentID = $this->conn->insert_id;
			$stmt->fetch();
			$stmt->close();
			
			if(isset($commentID) && $commentID != "") {
				//echo "success";
				return $commentID;
			}
			//echo "failure";
			echo mysqli_error($this->conn);
		}
		return false;
	}	
}

?>