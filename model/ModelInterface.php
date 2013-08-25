<?

interface ModelInterface {
	public static function Edit($id, $data);

	public static function Get($id);

	public static function Add($data);

	public static function Delete($id);

	public static function GetList();

	public static function Validate($data);
}