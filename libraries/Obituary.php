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
	
}