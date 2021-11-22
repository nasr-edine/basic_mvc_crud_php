<?php
class dbOperations
{
	// set database config for mysql
	function __construct($consetup)
	{
		$this->host = $consetup->host;
		$this->user = $consetup->user;
		$this->pass =  $consetup->pass;
		$this->db = $consetup->db;
	}
	// open mysql data base
	public function open_db()
	{
		$this->condb = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if ($this->condb->connect_error) {
			die("Error in connection: " . $this->condb->connect_error);
		}
	}
	// close database
	public function close_db()
	{
		$this->condb->close();
	}
	// insert record
	public function insertRecord($obj)
	{
		try {
			$this->open_db();
			// echo $this->condb->error_list;
			print("test");
			$query = $this->condb->prepare("INSERT INTO user (first_name,last_name,email) VALUES (?, ?, ?)");
			if (!$query) {
				echo "query is false";
			} else {
				echo "query is ok";
			}
			$query->bind_param("sss", $obj->first_name, $obj->last_name, $obj->email);
			$query->execute();
			$res = $query->get_result();
			$last_id = $this->condb->insert_id;
			$query->close();
			$this->close_db();
			return $last_id;
		} catch (Exception $e) {
			print("catch called");
			$this->close_db();
			throw $e;
		}
	}
	//update record
	public function updateRecord($obj)
	{
		try {
			print("test 3");
			$this->open_db();
			print("test 4");
			$sql = "UPDATE user SET first_name=?,last_name=?, email=? WHERE id=?";
			$query = $this->condb->prepare($sql);
			if (!$query) {
				echo "query is false";
			}
			$query->bind_param('sssi', $obj->first_name, $obj->last_name, $obj->email, $obj->id);
			print("test 6");
			$query->execute();
			$res = $query->get_result();
			$query->close();
			$this->close_db();
			return true;
		} catch (Exception $e) {
			$this->close_db();
			throw $e;
		}
	}
	// delete record
	public function deleteRecord($id)
	{
		try {
			$this->open_db();
			$query = $this->condb->prepare("DELETE FROM user WHERE id=?");
			$query->bind_param("i", $id);
			$query->execute();
			$res = $query->get_result();
			$query->close();
			$this->close_db();
			return true;
		} catch (Exception $e) {
			$this->close_db();
			throw $e;
		}
	}
	// select record     
	public function selectRecord($id)
	{
		try {
			$this->open_db();

			if ($id > 0) {
				$query = $this->condb->prepare("SELECT * FROM user WHERE id=?");
				$query->bind_param("i", $id);
			} else {
				$query = $this->condb->prepare("SELECT * FROM user");
			}
			$query->execute();
			$res = $query->get_result();
			$query->close();
			$this->close_db();
			return $res;
		} catch (Exception $e) {
			$this->close_db();
			throw $e;
		}
	}
}
