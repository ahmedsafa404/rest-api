<?php
require_once 'data.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		fetchToGet();
		break;
	case 'POST':
		$data = json_decode(file_get_contents('php://input'),true);
		post($data);
		break;
	case 'PUT':
		# code...
		break;
	case 'DELETE':
		# code...
		break;
	case 'PATCH':
		# code...
		break;					
	default:
		echo '{"error" : "Invalid method"}';
		break;
}

function fetchToGet()
{
	$obj = new API;
	$obj->fetch();
}

function post($input = [])
{
	$obj = new API;
	$obj->insert($input);
}

