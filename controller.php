<?php

class Controller {

	public static $data;

	public static function Show($content = '') {
		include_once('view/header.html.php');

		if (strlen($content))
			include_once('view/'.$content.'.html.php');

		include_once('view/footer.html.php');
	}

	public static function GetPostFields($model_fields) {
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