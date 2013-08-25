<form method="POST">
	<h3>Добавление работника</h3>
	<label>
		<span class="label">Имя</span>
		<input type="text" name="first_name" value="<?= isset($this->data['employee']['first_name']) ? $this->data['employee']['first_name'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Фамилия</span>
		<input type="text" name="last_name" value="<?= isset($this->data['employee']['last_name']) ? $this->data['employee']['last_name'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Оклад</span>
		<input type="text" name="salary" value="<?= isset($this->data['employee']['salary']) ? $this->data['employee']['salary'] : ''?>" />
	</label>
	<br/>
	<label>
		<span class="label">Характеристика</span>
		<textarea name="description"><?= isset($this->data['employee']['description']) ? $this->data['employee']['description'] : ''?></textarea>
	</label>
	<br/>
	<label>
		<span class="label">Должность</span>
		<select name="position">
			<option></option>
			<? foreach ($this->data['positions'] as $pos) { ?>
				<option value="<?= $pos['id'] ?>" <?= isset($this->data['employee']['position']) ? ($this->data['employee']['position'] == $pos['id'] ? 'selected' : '') : '' ?>><?= $pos['name'] ?></option>
			<? } ?>
		</select>
	</label>
	<br/>
	<input type="submit" name="send" value="Добавить"/>

	<? if (isset($this->data['errors'])) { ?><div class="error"><pre><?= print_r($this->data['errors'])?></pre></div><? } ?>
</form>