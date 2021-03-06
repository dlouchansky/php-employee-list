<?php

namespace PHPEmployeeList\Controller;

class Controller
{

	protected $data;

	public function show($content = '')
	{
		include_once('./view/header.html.php');

		if (strlen($content))
			include_once('./view/'.$content.'.html.php');

		include_once('./view/footer.html.php');
	}

	public function getPostFields($model_fields)
	{
		$data = array();

		foreach($model_fields as $field => $type) {
			if (isset($_POST[$field]) && $type == 'int') {
				$data[$field] = (int) $_POST[$field];
			}
			else if (isset($_POST[$field])) {
				$data[$field] = $_POST[$field];
			}
			else
				$data[$field] = '';

			$data[$field] = strip_tags($data[$field]);
		}

		return $data;
	}
}