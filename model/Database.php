<?php

class Database 
{
	private static $dbName 	   = 'crud_mvc_oop';
	private static $dbHost 	   = 'localhost';
	private static $dbUsername = 'root';
	private static $dbPassword = 'abc123';

	private static $conn = null;

	public function __construct()
	{
		// die('Init function is not allowed');
	}

	public static function connect()
	{
		// One connection through whole application
		if (null == self::$conn)
		{
			try
			{
				self::$conn =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbPassword); 
			} 
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$conn;
	}

	public static function disconnect()
	{
		self::$conn = null;
	}

}

?>
