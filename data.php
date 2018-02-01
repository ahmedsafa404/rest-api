<?php

class API
{
	private $connect;

	public function __construct()
	{
		try
		{
			return $this->connect = new PDO("mysql:host=localhost;dbname={Database Name}","{User Name}","{Password}");
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	public function fetch()
	{
		$query = $this->connect->prepare("SELECT * FROM users");
		$query->execute();
		$data = $query->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($data);
	}
	public function insert($params = [])
	{
		$question = htmlspecialchars(htmlentities(stripcslashes(strip_tags($params['question']))));
		$description = htmlspecialchars(htmlentities(stripcslashes(strip_tags($params['description']))));
		$user_id = htmlspecialchars(htmlentities(stripcslashes(strip_tags($params['user_id']))));

		$sql = "INSERT INTO question(question,description,user_id) VALUES(?,?,?)";
		$insert = $this->connect->prepare($sql);
		$insert->bindValue(1,$question);
		$insert->bindValue(2,$description);
		$insert->bindValue(3,$user_id);
		
		if($insert->execute())
		{
			echo '{"success" : "Answer has been submitted"}';
		}
		else
		{
			echo '{"error" : "There was an error"}';
		}
	}
}
