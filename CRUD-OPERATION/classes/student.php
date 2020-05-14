<?php

include 'DB.php';

class Student{
	private $table = "student";
	private $name;
	private $dpt;
	private $age;

	public function setName($name){
		$this->name = $name;
	}
	public function setDpt($dpt){
		$this->dpt = $dpt;
	}
	public function setAge($age){
		$this->age = $age;
	}

	// data read for update data
	public function readById($id){
		$sql = "SELECT * FROM $this->table WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		return $stmt->fetch();
	}

	// update method
	public function Update($id){
		$sql = "UPDATE $this->table SET name=:name, dpt=:dpt, age=:age WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':dpt', $this->dpt);
		$stmt->bindParam(':age', $this->age);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}

	// delete method
	public function Delete($id){
		$sql = "DELETE FROM $this->table WHERE id=:id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}

	// data insert method
	public function insertData(){
		$sql = "INSERT INTO $this->table(name, dpt, age) VALUES(:name, :dpt, :age)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':dpt', $this->dpt);
		$stmt->bindParam(':age', $this->age);
		return $stmt->execute();
	}

	
	public function readAll(){
		$sql = "select * from $this->table";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	

}











