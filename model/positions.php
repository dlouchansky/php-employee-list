<?php

class Positions {
	public static $fields = array(
		'name' => 'string',
		'description' => 'string',
	);

	public static $table = "positions";

	public static function GetList() {
		return DB::GetInstance()->GetList('positions');
	}

	public static function Edit($id, $data) {
		DB::GetInstance()->Edit('positions', $id, $data);
	}

	public static function Get($id) {
		return DB::GetInstance()->Get('positions', $id);
	}

	public static function Add($data) {
		DB::GetInstance()->Add('positions', $data);
	}

	public static function Delete($id) {
		DB::GetInstance()->Delete('positions', $id);
	}

}