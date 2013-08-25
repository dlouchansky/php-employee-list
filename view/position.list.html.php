<a href="<?= Config::$root ?>/index.php/position/add">Добавить новую</a>
<table>
	<thead>
	<tr>
		<td class="medium">Название</td>
		<td class="long">Описание</td>
		<td>Редактировать</td>
		<td>Удалить</td>
	</tr>
	</thead>
	<? if (count(self::$data['positions'])) foreach (self::$data['positions'] as $position) { ?>
		<tr>
			<td><?= htmlspecialchars($position['name']) ?></td>
			<td><?= htmlspecialchars($position['description']) ?></td>
			<td><a href="<?= Config::$root ?>/index.php/position/edit/<?= $position['id']?>">[\]</a></td>
			<td><a href="<?= Config::$root ?>/index.php/position/delete/<?= $position['id']?>">[X]</a></td>
		</tr>
	<? } ?>
</table>