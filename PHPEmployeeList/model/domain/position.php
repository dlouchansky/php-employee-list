<?php

namespace PHPEmployeeList\Model\Domain;

/**
 * Class Position
 * @package PHPEmployeeList\Model\Domain
 */
class Position
{
	private static $field_types = [
		'id' => 'int',
		'name' => 'string',
		'description' => 'string',
	];

	private $data = [
		'id', 'name', 'description'
	];

	public function __construct(array $data)
	{
		foreach($this->data as $field) {
			if (isset($data[$field]) && $this->getFieldType($field) == 'int') {
				$this->$field = $data[$field];
			}
			else if (isset($data[$field])) {
				$this->$field = $data[$field];
			}
			else
				$this->$field = '';

			$this->$field = strip_tags($this->$field);
		}
	}

	/**
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
		return null;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 * @return void
	 */
	public function __set($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return "Position ID: " . $this->id . ". Name: " . $this->name . ".";
	}

	/**
	 * @param string $field
	 * @return string mixed|null
	 */
	public static function getFieldType($field)
	{
		if (array_key_exists($field, self::$field_types)) {
			return self::$field_types[$field];
		}
		return null;
	}

}