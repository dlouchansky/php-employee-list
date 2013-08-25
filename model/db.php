<?
require_once('config.php');

class DB {

	private static $conn;

	private static function GetConn() {
		if (!isset(self::$conn)) {
			$db = Config::DB();
			self::$conn = new mysqli($db['host'], $db['user'], $db['pass'], $db['database'], $db['port']);
		}
		return self::$conn;
	}

	public static function GetList($table, $params = array('join' => '', 'order' => '')) {
		$conn = DB::GetConn();

		$q = "SELECT ";
		$q .= strlen($params['join']) ? $table.'.*, '.$conn->real_escape_string($params['join_fields']) : '*';
		$q .= " FROM ".$table;
		$q .= strlen($params['join']) ? " LEFT JOIN ".$conn->real_escape_string($params['join'])." ON ".$params['on'] : '';
		$q .= strlen($params['order']) ? " ORDER BY ".$conn->real_escape_string($params['order']) : '';


		if ($result = $conn->query($q)) {
			$data = array();

			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_array(MYSQLI_ASSOC);
				$data[$i] = $row;
			}

			$result->close();

			return $data;
		} else {
			return false;
		}
	}

	public static function Get($table, $id) {
		$conn = DB::GetConn();

		$q = "SELECT * FROM ".$table." WHERE id=".$id;

		if ($result = $conn->query($q)) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			return $row;
		} else {
			return false;
		}

	}

	public static function Edit($table, $id, $data) {
		$conn = DB::GetConn();

		$values = array();
		foreach($data as $field => $value) {
			$values[] = $field."=".'"'.$conn->real_escape_string($value).'"';
		}

		$q = "UPDATE ".$table." SET ".implode(',', $values)." WHERE id=".$id;

		$conn->query($q);
	}

	public static function Add($table, $data) {
		$conn = DB::GetConn();

		$fields = implode(',', array_keys($data));

		foreach ($data as $k => &$v) {
			$v = '"'.$conn->real_escape_string($v).'"';
		}
		$values = implode(',', array_values($data));

		$q = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";

		$conn->query($q);
	}

	public static function Delete($table, $id) {
		$conn = DB::GetConn();
		$conn->query("DELETE FROM ".$table." WHERE id=".$id);
	}

}