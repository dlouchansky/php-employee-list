<?

namespace PHPEmployeeList\Model\Persistence;

use \PHPEmployeeList\Config;

/**
 * Class PDODB
 * @package PHPEmployeeList\Model\DB
 */
class PDODB
{

	private static $instance;
	private $conn;

	/**
	 * @return PDODB
	 */
	public static function getInstance()
	{
		if (!self::$instance)
			self::$instance = new PDODB();

		return self::$instance;
	}

	public function __construct()
	{
		$db = Config::PDO();
		$dsn = $db['dbtype'] . ':host=' . $db['host'] . ';dbname=' . $db['database'] . ';charset=utf8;port=' . $db['port'];
		$opt = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		];

		$this->conn = new \PDO($dsn, $db['user'], $db['pass'], $opt);
	}

	/**
	 * @param string $table
	 * @param string $order_field
	 * @param string $direction
	 * @param array|null
	 * @return array
	 * @throws \InvalidArgumentException if join params array is not null and something is missing from it
	 */
	public function getAll($table, $order_field, $direction, $join_params = null)
	{
		if ($join_params != null) {
			if (!$join_params['join_fields'])
				throw new \InvalidArgumentException("join fields are required");

			if (!$join_params['table'])
				throw new \InvalidArgumentException("join table is required");

			if (!$join_params['on'])
				throw new \InvalidArgumentException("join on is required");

			$query = $this->conn->prepare(
				"SELECT " . $table . ".*, " . $join_params['join_fields'].
				" FROM " . $table . " JOIN " . $join_params['table'] .
				" ON " . $join_params['on'] . " ORDER BY ".$order_field." ".$direction
			);

		} else {
			$query = $this->conn->prepare("SELECT " . $table . ".* FROM " . $table . " ORDER BY ".$order_field." ".$direction);
		}

		$query->execute();

		return $query->fetchAll();
	}

	/**
	 * @param string $table
	 * @param int $id
	 * @return array|null
	 */
	public function get($table, $id)
	{
		$query = $this->conn->prepare("SELECT * FROM " . $table . " WHERE id=:id");

		$query->execute(['id' => (int) $id]);

		return $query->fetch() ?: null;
	}

	/**
	 * @param string[] $fields
	 * @return string
	 */
	public function setFields($fields) {
		$set = '';
		foreach ($fields as $field) {
			$set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
		}
		return substr($set, 0, -2);
	}

	/**
	 * @param string $table
	 * @param int $id
	 * @param array $data
	 */
	public function edit($table, $id, $data)
	{
		$query = $this->conn->prepare("UPDATE " . $table . " SET " . $this->setFields(array_keys($data)) . " WHERE id=:id");

		$data = array_merge($data, ['id' => $id]);

		$query->execute($data);
	}

	/**
	 * @param string $table
	 * @param array $data
	 * @return int
	 */
	public function add($table, $data)
	{
		$this->conn->beginTransaction();

		$query = $this->conn->prepare("INSERT INTO " . $table . " SET ".$this->setFields(array_keys($data)));

		$data = array_merge($data, []);

		$query->execute($data);

		$insert_id = $this->conn->lastInsertId();
		$this->conn->commit();

		return $insert_id;
	}

	/**
	 * @param string $table
	 * @param int $id
	 */
	public function delete($table, $id)
	{
		$query = $this->conn->prepare("DELETE FROM " . $table . " WHERE id=:id");

		$data = ['id' => $id];

		$query->execute($data);
	}

}