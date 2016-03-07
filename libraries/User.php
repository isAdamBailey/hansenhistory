<?php

class User {

	public function getAllUsers()
	{
		$query = "SELECT * FROM tblUsers";

		return $query;
	}

	public function getUserById($id)
	{
  		$query = "SELECT * FROM tblUsers WHERE id = " .$id;

  		return $query;
	}
		
	
}