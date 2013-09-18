<?

namespace PHPEmployeeList\Model;

use \PHPEmployeeList\Config;

class DB
{

	private static $instance;
	private $conn;

	public static function getInstance()
	{
		if (!self::$instance)
			self::$instance = new DB();

		return self::$instance;
	}

	public function __construct()
	{
		$db = Config::DB();
		$this->conn = new \MySQLi($db['host'], $db['user'], $db['pass'], $db['database'], $db['port']);

		if (!$this->conn)
		{
			throw new \Exception(mysqli_connect_error());
		}
	}

	public function getList($table, $params = array('join' => '', 'order' => ''))
	{
		$q = "SELECT ";
		$q .= strlen($params['join']) ? $table.'.*, '.$this->conn->real_escape_string($params['join_fields']) : '*';
		$q .= " FROM ".$table;
		$q .= strlen($params['join']) ? " LEFT JOIN ".$this->conn->real_escape_string($params['join'])." ON ".$params['on'] : '';
		$q .= strlen($params['order']) ? " ORDER BY ".$this->conn->real_escape_string($params['order']) : '';

		if ($result = $this->conn->query($q)) {
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

	public function get($table, $id)
	{
		$q = "SELECT * FROM ".$table." WHERE id=".$id;

		if ($result = $this->conn->query($q)) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			return $row;
		} else {
			return false;
		}
	}

	public function edit($table, $id, $data)
	{
		$values = array();
		foreach($data as $field => $value) {
			$values[] = $field."=".'"'.$this->conn->real_escape_string($value).'"';
		}

		$q = "UPDATE ".$table." SET ".implode(',', $values)." WHERE id=".$id;

		$this->conn->query($q);
	}

	public function add($table, $data)
	{
		$fields = implode(',', array_keys($data));

		foreach ($data as $k => &$v) {
			$v = '"'.$this->conn->real_escape_string($v).'"';
		}
		$values = implode(',', array_values($data));

		$q = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";

		$this->conn->query($q);
	}

	public function delete($table, $id)
	{
		$this->conn->query("DELETE FROM ".$table." WHERE id=".$id);
	}

}