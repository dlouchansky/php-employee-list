<?php

namespace PHPEmployeeList\Model\Persistence;


use PHPEmployeeList\Model\Domain\Position;

/**
 * Class PositionDAO
 * @package PHPEmployeeList\Model\DB
 */
interface PositionDAO
{

	/**
	 * @param string $order_field
	 * @param string $order_direction
	 * @return Position[]
	 */
	public function getAll($order_field = "name", $order_direction = "asc");

	/**
	 * @param Position $position
	 * @return bool
	 */
	public function edit(Position $position);

	/**
	 * @param int $position_id
	 * @return Position|null
	 */
	public function get($position_id);

	/**
	 * @param Position $position
	 * @return Position $position
	 */
	public function add(Position $position);

	/**
	 * @param Position $position
	 * @return bool
	 */
	public function delete(Position $position);

}