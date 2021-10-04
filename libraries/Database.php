<?php
class Database {
	public $host;
	public $username;
	public $password;
	public $db_name;

	public $link;
	public $error;

	// Class constructor
	public function __construct(){

        $this->host = getenv('DB_HOST');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
        $this->db_name = getenv('DB_NAME');

		// call connect function
		$this->connect();
	}

	//connector
	private function connect(){
		$this->link = new mysqli($this->host, $this->username, $this->password, $this->db_name);

		if(!$this->link){
			$this->error = "Connection failed: ".$this->link->connect_error;
			return false;
		}
	}

	// select method for selecting data from database
	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}

	// insert method
	public function insert($query){
		$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);

		// validate insert
		if($insert_row){
			header("Location: index.php?msg=".urlencode('Record Added'));
			exit();
		} else {
			die('Error : ('. $this->link->errno .') '. $this->link->error);
		}
	}

	// update method
	public function update($query){
		$update_row = $this->link->query($query) or die($this->link->error.__LINE__);

		// validate insert
		if($update_row){
			header("Location: index.php?msg=".urlencode('Record Updated'));
			exit();
		} else {
			die('Error : ('. $this->link->errno .') '. $this->link->error);
		}
	}

	// delete method
	public function delete($query){
		$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);

		// validate insert
		if($delete_row){
			header("Location: index.php?msg=".urlencode('Record Deleted'));
			exit();
		} else {
			die('Error : ('. $this->link->errno .') '. $this->link->error);
		}
	}
}