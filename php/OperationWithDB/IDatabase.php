<?php

namespace OperationWithDB;

interface IDatabase
{
	public function getFields();
	public function getPrimaryKey();
	public function getPrimaryKeyValue();
	public function getTableName();
	
	public function setFieldsFromDb($fieldValues);
	//public function setPrimaryKeyValue($value);
}