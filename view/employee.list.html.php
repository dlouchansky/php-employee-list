<a href="<?= Config::$root ?>/index.php/employee/add">Добавить нового</a>
<table>
	<thead>
		<tr>
			<td class="medium">Имя
				<a href="<?= Config::$root ?>/index.php/employee/list/first_name/asc">&darr;</a>
				<a href="<?= Config::$root ?>/index.php/employee/list/first_name/desc">&uarr;</a>
			</td>
			<td class="medium">Фамилия
				<a href="<?= Config::$root ?>/index.php/employee/list/last_name/asc">&darr;</a>
				<a href="<?= Config::$root ?>/index.php/employee/list/last_name/desc">&uarr;</a>
			</td>
			<td class="medium">Должность
				<a href="<?= Config::$root ?>/index.php/employee/list/position/asc">&darr;</a>
				<a href="<?= Config::$root ?>/index.php/employee/list/position/desc">&uarr;</a>
			</td>
			<td>Зарплата
				<a href="<?= Config::$root ?>/index.php/employee/list/salary/asc">&darr;</a>
				<a href="<?= Config::$root ?>/index.php/employee/list/salary/desc">&uarr;</a>
			</td>
			<td>Редактировать</td>
			<td>Удалить</td>
		</tr>
	</thead>
	<? if (count($this->data['employees'])) foreach ($this->data['employees'] as $employee) { ?>
	<tr>
		<td><?= htmlspecialchars($employee['first_name']) ?></td>
		<td><?= htmlspecialchars($employee['last_name']) ?></td>
		<td><?= $employee['pos_name'] ?></td>
		<td><?= htmlspecialchars($employee['salary']) ?></td>
		<td><a href="<?= Config::$root ?>/index.php/employee/edit/<?= $employee['id']?>">[\]</a></td>
		<td><a href="<?= Config::$root ?>/index.php/employee/delete/<?= $employee['id']?>">[X]</a></td>
	</tr>
	<? } ?>
</table>