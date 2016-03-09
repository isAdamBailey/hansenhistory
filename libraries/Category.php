<?php

class Category {

	public function getAllCategories()
	{
		$query = "SELECT * FROM tblCategories ORDER BY Name";

  		return $query;
	}

	public function getCategoryById($id)
	{
		$query = "SELECT * FROM tblCategories WHERE id = " .$id;
            
        return $query;
	}

	public function setCategory($name)
	{
		$query = "INSERT INTO tblCategories
            (Name)
            VALUES ('$name')";

        return $query;
	}

	public function updateCategory($name, $id)
	{
		$query = "UPDATE tblCategories
            SET Name = '$name'
            WHERE id = " .$id;

        return $query;
	}

	public function deleteCategory($id)
	{
		$query = "DELETE FROM tblCategories WHERE id = " .$id;

        return $query;
	}
	
	
	
	
}