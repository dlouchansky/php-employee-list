<?php

namespace PHPEmployeeList\Controller;

interface Controller
{

	public function execute($method, $uri_params);

}