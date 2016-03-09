<?php

class Obituary {

	public function getAllObituaries()
	{
		$query = "SELECT * FROM tblObits ORDER BY DeathDate DESC";

        return $query;
	}

	public function getObituaryById()
	{
		$this->id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : header("Location: obits.php");

		$query = "SELECT * FROM tblObits WHERE id = " .$this->id;

		return $query;
	}

	public function setObituary($imagepath, $name, $obituary, $birthdate, $deathdate)
	{
		$query = "INSERT INTO tblObits
            (ImagePath, Name, Obituary, BirthDate, DeathDate)                
            VALUES
            ('$imagepath', '$name', '$obituary', '$birthdate', '$deathdate')";

        return $query;
	}

	public function updateObituary($imagepath, $name, $obituary, $birthdate, $deathdate, $id)
	{
		$query = "UPDATE tblObits
            SET Name = '$name',
                Obituary = '$obituary',
                BirthDate = '$birthdate',
                DeathDate = '$deathdate'                      
            WHERE id = " .$id;

        return $query;
	}
	
	public function deleteObituary($id)
	{
		$query = "DELETE FROM tblObits WHERE id = " .$id;

        return $query;
	}
	
	
}