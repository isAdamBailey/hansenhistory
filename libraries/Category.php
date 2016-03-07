<?php

class Category {

	public function getAllCategories()
	{
		$query = "SELECT * FROM tblCategories
  			ORDER BY Name";

  		return $query;
	}
	

	public function getCategoryById($id)
	{
		$query = "SELECT * FROM tblCategories WHERE id = ".$id;
            
        return $query;
	}
	
}