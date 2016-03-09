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
		$query = "SELECT * FROM tblUsers WHERE Name = '$name'";

		return $query;
	}

	public function setUser($name, $hash, $isadmin)
	{
		$query = "INSERT INTO tblUsers
            (Name, Password, isAdmin)
            VALUES ('$name', '$hash', '$isadmin')";

        return $query;
	}

	public function updateUser($name, $isadmin, $id)
	{
		$query = "UPDATE tblUsers 
            SET Name = '$name', 
                isAdmin = '$isadmin'
            WHERE id = " .$id;

        return $query;
	}

	public function getPasswordById($id)
	{
		$query = "SELECT Password FROM tblUsers WHERE id = " .$id;

		return $query;
	}

	public function updatePassword($newPassword, $id)
	{
		$query = "UPDATE tblUsers 
            SET Password = '$newPassword'
            WHERE id = " .$id;

        return $query;
	}
	
	public function deleteUser($id)
	{
		$query = "DELETE FROM tblUsers WHERE id = " .$id;

		return $query;
	}
	
		
	
}