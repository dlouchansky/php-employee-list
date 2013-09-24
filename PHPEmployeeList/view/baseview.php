<?php

namespace PHPEmployeeList\View;


abstract class BaseView implements View
{

	public function output($mode, $uri_params)
	{
		if ($mode == "html") {
			header('Content-type: text/html');

			include_once('tpl/header.html.php');
			$this->showHtml($uri_params);
			include_once('tpl/footer.html.php');
		} elseif ($mode == "ajax") {
			header('Content-type: application/json');

			echo json_encode($this->showJson($uri_params));
		}
	}

	abstract public function showHtml($uri_params);

	abstract public function showJson($uri_params);

}