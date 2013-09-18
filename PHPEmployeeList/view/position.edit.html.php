<?

namespace PHPEmployeeList\View;

use PHPEmployeeList\Config;

?>
<form method="POST">
	<h3>Редактирование должности</h3>
	<label>
		<span class="label">Название</span>
		<input type="text" name="name" value="<?= $this->data['position']['name'] ?: ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Описание</span>
		<textarea name="description"><?= $this->data['position']['description'] ?: ''?></textarea>
	</label>
	<br/>
	<input type="submit" name="send" value="Сохранить"/>

	<? if (isset($this->data['errors'])) { ?><div class="error"><pre><?= print_r($this->data['errors'])?></pre></div><? } ?>
</form>