<?php
require_once('controller.php');
require_once('model/positions.php');

class Position extends Controller {

	public static function GetList() {
		self::$data['positions'] = DB::GetList('positions');
		self::Show('position.list');
	}

	public static function Edit($id) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			self::$data['errors'] = array();

			if (!isset($_POST['name']) || !strlen($_POST['name'])) {
				self::$data['errors'][] = 'Название обязательно';
			}

			if (!count(self::$data['errors'])) {
				DB::Edit('positions', $id, self::GetPostFields(Positions::$fields));
				return header('Location: '.Config::$root.'/index.php/position');
			} else {
				self::$data['position'] = $_POST;
			}
		} else {
			self::$data['position'] = DB::Get('positions', $id);
		}

		self::Show('position.edit');
	}

	public static function Add() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			self::$data['errors'] = array();

			if (!isset($_POST['name']) || !strlen($_POST['name'])) {
				self::$data['errors'][] = 'Название обязательно';
			}

			if (!count(self::$data['errors'])) {
				DB::Add('positions', self::GetPostFields(Positions::$fields));
				return header('Location: '.Config::$root.'/index.php/position');
			} else {
				self::$data['position'] = $_POST;
			}
		}

		self::Show('position.add');
	}

	public static function Delete($id) {
		DB::Delete('positions', $id);
		return header('Location: '.Config::$root.'/index.php/position');
	}

}