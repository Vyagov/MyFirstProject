<?php

namespace OperationWithDB;

class Database 
{
	const DB_HOST = 'localhost';
	const DB_NAME = 'my_db';
	const DB_USER = 'root';
	const DB_PASS = '';
	
	const SELECT_STR = 'SELECT * FROM %s WHERE %s = ?';
	
	private static $connection;
	
	public static function getConnection()
	{
		if (is_null(self::$connection)) {
			self::$connection = self::makeConnection();
		}
		return self::$connection;
	}
	
	private static function makeConnection()
	{
		$pdo = new \PDO(sprintf('mysql:dbname=%s;host=%s', 
				self::DB_NAME,
				self::DB_HOST
			), self::DB_USER, self::DB_PASS);
		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
	
	public static function query($sql, $params = null)
	{
		$statement = self::getConnection()->prepare($sql);
		$statement->execute($params);
		
		if (stripos($sql, 'select') === 0) {
			return $statement->fetchAll(\PDO::FETCH_ASSOC);
		}
		if (stripos($sql, 'insert') === 0) {
			return self::getConnection()->lastInsertId();
		}
		if (stripos($sql, 'update') === 0 || stripos($sql, 'delete') === 0) {
			return $statement->rowCount();
		}
		
		throw  new InvalidArgumentException('Expected select, insert, update or delete sql ' . $sql . ' received');
	}
	
	public static function selectObject(IDatabase $object)
	{
		$sql = sprintf(self::SELECT_STR, 
				$object->getTableName(), 
				$object->getPrimaryKey()
			);
		
		$data = self::query($sql, [$object->getPrimaryKeyValue()]);
		
		if ($data) {
			$object->setFieldsFromDb($data[0]);
		}
	}

	public static function checkEmail(IDatabase $object)
	{
		$sql = sprintf(self::SELECT_STR, 
				$object->getTableName(), 
				$object->getEmail());
		
		$data = self::query($sql, [$object->getEmailValue()]);
		
		return $data;
	}

	public static function checkID(IDatabase $object)
	{
		$sql = sprintf(self::SELECT_STR,
				$object->getTableName(), 'user_id');
		$data = self::query($sql, [$_SESSION['user_id']]);
		
		return $data[count($data) - 1]['user_id'];
	}
	
	public static function insertObject(IDatabase $object)
	{
		$fields = $object->getFields();

		$questionMarks = implode(', ', array_fill(0, count($fields), '?'));
		
		$sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', 
				$object->getTableName(),  
				implode(', ', array_keys($fields)), 
				$questionMarks
			);
		
		$result = self::query($sql, array_values($fields));

		$object->setPrimaryKeyValue($result);
	}
	
	public static function updateObject(IDatabase $object)
	{
		if (!$object->getPrimaryKeyValue()) {
			throw new InvalidArgumentException('This object does not have primary key value');
		}
		$fields = $object->getFields();
		
		$sets = '';
		
		foreach ($fields as $key => $value) {
			$sets .= 'SET ' . $key . ' = ? ';
		}
		
		$sql = sprintf('UPDATE %s %s WHERE %s = ?', 
				$object->getTableName(),
				$sets, 
				$object->getPrimaryKey()
			);
		
		$params = array_values($fields);
		$params[] = $object->getPrimaryKeyValue();
		$result = self::query($sql, $params);
		
		return $result;
	}
	
	public static function deleteObject(IDatabase $object)
	{
		if (!$object->getPrimaryKeyValue()) {
			throw new InvalidArgumentException('This object does not have primary key value');
		}
		$sql = sprintf('DELETE FROM %s WHERE %s = ?', 
				$object->getTableName(), 
				$object->getPrimaryKey()
			);
		
		$result = self::query($sql, [$object->getPrimaryKeyValue()]);
		
		return $result;
	}
}