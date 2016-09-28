<?php

function getFromArray($array, $key, $default = null) {
	return isset($array[$key]) ? $array[$key] : $default;
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}