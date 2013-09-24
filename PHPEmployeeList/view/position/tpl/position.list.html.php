<?

namespace PHPEmployeeList\View;

use PHPEmployeeList\Config;

?>
<a href="<?= Config::base() ?>position/add">Добавить новую</a>
<table>
	<thead>
	<tr>
		<td class="medium">Название</td>
		<td class="long">Описание</td>
		<td>Редактировать</td>
		<td>Удалить</td>
	</tr>
	</thead>
	<? if (count($this->model->getPositions())) foreach ($this->model->getPositions() as $position) { ?>
		<tr>
			<td><?= htmlspecialchars($position->name) ?></td>
			<td><?= htmlspecialchars($position->description) ?></td>
			<td><a href="<?= Config::base() ?>position/edit/<?= $position->id?>">[\]</a></td>
			<td>
				<form method="POST" action="<?= Config::base() ?>position/delete/<?= $position->id?>">
					<input type="hidden" name="id" value="<?= $position->id?>" />
					<button type="submit">[X]</button>
				</form>
			</td>
		</tr>
	<? } ?>
</table>