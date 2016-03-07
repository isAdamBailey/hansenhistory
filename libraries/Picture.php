<?php

class Picture {

	public function getAllPictures($order = 'ASC')
	{
		$query = "SELECT * FROM tblImages
            ORDER BY Year " .$order;

        return $query;
	}
	
	public function getPictureCategories() 	// returns only the categories used on pictures
	{
		$query = "SELECT tc.id, Name FROM (SELECT DISTINCT * FROM tblCategories) as tc
            INNER JOIN tblImages
            ON tc.id = tblImages.CategoryId
            GROUP BY Name";
            
        return $query;
	}

	public function getPictureByCategory($id)
	{
		$query = "SELECT * FROM tblImages WHERE CategoryId = " .$id;

		return $query;
	}
	

	public function getPictureYears() 	// returns every year used on a picture
	{
		$query = "SELECT DISTINCT Year FROM tblImages
            ORDER BY Year ASC";

        return $query;
	}

	public function getPictureByYear($year)
	{
		$query = "SELECT * FROM tblImages WHERE Year = " .$year;

		return $query;
	}

	public function getPictureById($id)
	{
		$query = "SELECT * FROM tblImages WHERE id = " .$id;

		return $query;
	}
	
	
	
	
}