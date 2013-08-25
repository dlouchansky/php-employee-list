<form method="POST">
	<h3>Добавление должности</h3>
	<label>
		<span class="label">Название</span>
		<input type="text" name="name" value="<?= self::$data['position']['name'] ?: ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Описание</span>
		<textarea name="description"><?= self::$data['position']['description'] ?: ''?></textarea>
	</label>
	<br/>
	<input type="submit" name="send" value="Добавить"/>

	<? if (isset(self::$data['errors'])) { ?><div class="error"><pre><?= print_r(self::$data['errors'])?></pre></div><? } ?>
</form>