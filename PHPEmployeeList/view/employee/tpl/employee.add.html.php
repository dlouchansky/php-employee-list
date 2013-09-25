<form method="POST">
	<h3>Добавление работника</h3>
	<label>
		<span class="label">Имя</span>
		<input type="text" name="first_name" value="<?= $this->employee->first_name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Фамилия</span>
		<input type="text" name="last_name" value="<?= $this->employee->last_name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Оклад</span>
		<input type="text" name="salary" value="<?= $this->employee->salary ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Характеристика</span>
		<textarea name="description"><?= $this->employee->description ?></textarea>
	</label>
	<br/>
	<label>
		<span class="label">Должность</span>
		<select name="position">
			<option></option>
			<? foreach ($this->positions as $pos) { ?>
				<option value="<?= $pos->id ?>" <?= $this->employee->position == $pos->id ? 'selected' : '' ?>><?= $pos->name ?></option>
			<? } ?>
		</select>
	</label>
	<br/>
	<input type="submit" name="send" value="Добавить"/>

	<? if (count($this->errors)) { ?><div class="error"><pre><?= print_r($this->errors)?></pre></div><? } ?>
</form>