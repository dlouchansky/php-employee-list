<form method="POST">
	<h3>Редактирование работника</h3>
	<label>
		<span class="label">Имя</span>
		<input type="text" name="first_name" value="<?= isset(self::$data['employee']['first_name']) ? self::$data['employee']['first_name'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Фамилия</span>
		<input type="text" name="last_name" value="<?= isset(self::$data['employee']['last_name']) ? self::$data['employee']['last_name'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Оклад</span>
		<input type="text" name="salary" value="<?= isset(self::$data['employee']['salary']) ? self::$data['employee']['salary'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Характеристика</span>
		<textarea name="description"><?= isset(self::$data['employee']['description']) ? self::$data['employee']['description'] : ''?></textarea>
	</label>
	<br/>
	<label>
		<span class="label">Должность</span>
		<select name="position">
			<option></option>
			<? foreach (self::$data['positions'] as $pos) { ?>
			<option value="<?= $pos['id'] ?>" <?=isset(self::$data['employee']['position']) ? (self::$data['employee']['position'] == $pos['id'] ? 'selected="selected"' : '') : '' ?>><?= $pos['name'] ?></option>
			<? } ?>
		</select>
	</label>
	<br/>
	<input type="submit" name="send" value="Сохранить"/>

	<? if (isset(self::$data['errors'])) { ?><div class="error"><pre><?= print_r(self::$data['errors'])?></pre></div><? } ?>
</form>