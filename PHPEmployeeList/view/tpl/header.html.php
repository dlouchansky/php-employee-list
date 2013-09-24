<?

namespace PHPEmployeeList\View;

use PHPEmployeeList\Config;

?>

<html>

	<head>
		<title>PHP Employee List</title>
		<link rel="stylesheet" type="text/css" href="<?= Config::$root ?>files/style.css" media="all" />
	</head>

	<body>
		<ul>
			<li><a href="<?= Config::base() ?>">Главная</a></li>
			<li><a href="<?= Config::base() ?>employee/getList">Работники</a></li>
			<li><a href="<?= Config::base() ?>position/getList">Должности</a></li>
		</ul>

		<div class="content">