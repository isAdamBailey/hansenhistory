<?php
	function search(){

		global $db;

		$button = isset($_GET [ 'submit' ]) ? $_GET ['submit'] : null; 
		$search = isset($_GET [ 'search' ]) ? $_GET ['search'] : null; 
	 	
	 	if( !$button ) {
	 		echo "<p>Enter a keyword</p>";
	 	} else {
	 		if(strlen($search) < 4 ) {
	 			echo "</p>Search term too short</p>";
	 			exit();
	 	} else {
	 		echo "</p>You searched for:</p> 
	 			<h4>" .$search. "</h4> 
	 			<hr size='1'>";
	 	}

	 	$search_exploded = explode ( " ", $search );
	 	$x = 0;
	 	foreach( $search_exploded as $search_each) {
	 		$x++;
	 		$construct = " ";
	 		if($x <= 1) {
	 			$construct .= "Body LIKE '%$search_each%'";
	 		} else {
	 			$construct .= "AND Body LIKE '%$search_each%'";
	 		}
	 	}

	 	// query instances of the keywords in the body
	 	$query = "SELECT * FROM tblStories WHERE " .$construct;
	 	$result = $db->select($query);

	 	if(!$result) {
	 		echo "<p>There are no stories with that word in the body.</p>";
	 	} else {
	 		$foundnum = mysqli_num_rows($result);
	 		echo "<p><strong>" .$foundnum. "</strong> result(s) found!</p>";
	 		while($row = $result->fetch_assoc()){
	 			$title = $row['Title'];
	 			
	 			// query the story id of the search results
	 			$query = "SELECT id FROM tblStories
	 			  WHERE Title LIKE '%" .$title. "%'";		
	 			$storyid = $db->select($query);
	 			$rowid = $storyid->fetch_assoc();

	 			echo "<ol class='list-unstyled'>";
	 			echo "<li><a href='story.php?id=" .$rowid['id']. "' data-html='true' data-toggle='tooltip' data-placement='top' title='<h4>" .$title. "</h4>'>" .$title. "</a></li>";
	 			echo "</ol>";
	 		}
	 	}
	}
}
?>
