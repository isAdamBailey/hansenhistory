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

	public function getUserByName($name)
	{
		$query = 'SELECT Name FROM tblUsers WHERE Name = "'.$name.'"';

		return $query;
	}

	public function setUser($name, $hash, $isadmin)
	{
		$query = "INSERT INTO tblUsers
            (Name, Password, isAdmin)
            VALUES ('$name', '$hash', '$isadmin')";

        return $query;
	}
	
	
		
	
}