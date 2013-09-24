<?

namespace PHPEmployeeList\View;

use PHPEmployeeList\Config;

?>
<a href="<?= Config::base() ?>employee/add">Добавить нового</a>
<table>
	<thead>
		<tr>
			<td class="medium">Имя
				<a href="<?= Config::base() ?>employee/getList/first_name/asc">&darr;</a>
				<a href="<?= Config::base() ?>employee/getList/first_name/desc">&uarr;</a>
			</td>
			<td class="medium">Фамилия
				<a href="<?= Config::base() ?>employee/getList/last_name/asc">&darr;</a>
				<a href="<?= Config::base() ?>employee/getList/last_name/desc">&uarr;</a>
			</td>
			<td class="medium">Должность
				<a href="<?= Config::base() ?>employee/getList/position/asc">&darr;</a>
				<a href="<?= Config::base() ?>employee/getList/position/desc">&uarr;</a>
			</td>
			<td>Зарплата
				<a href="<?= Config::base() ?>employee/getList/salary/asc">&darr;</a>
				<a href="<?= Config::base() ?>employee/getList/salary/desc">&uarr;</a>
			</td>
			<td>Редактировать</td>
			<td>Удалить</td>
		</tr>
	</thead>
	<? if (count($this->model->getEmployees())) foreach ($this->model->getEmployees() as $employee) { ?>
	<tr>
		<td><?= htmlspecialchars($employee->first_name) ?></td>
		<td><?= htmlspecialchars($employee->last_name) ?></td>
		<td><?= $employee->position->name ?></td>
		<td><?= htmlspecialchars($employee->salary) ?></td>
		<td><a href="<?= Config::base() ?>employee/edit/<?= $employee->id?>">[\]</a></td>
		<td>
			<form method="POST" action="<?= Config::base() ?>employee/delete/<?= $employee->id?>">
				<input type="hidden" name="id" value="<?= $employee->id?>" />
				<button type="submit">[X]</button>
			</form>
		</td>
	</tr>
	<? } ?>
</table>