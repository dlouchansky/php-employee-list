<form method="POST">
	<h3>Редактирование работника</h3>
	<label>
		<span class="label">Имя</span>
		<input type="text" name="first_name" value="<?= $this->model->getEmployee()->first_name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Фамилия</span>
		<input type="text" name="last_name" value="<?= $this->model->getEmployee()->last_name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Оклад</span>
		<input type="text" name="salary" value="<?= $this->model->getEmployee()->salary ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Характеристика</span>
		<textarea name="description"><?= $this->model->getEmployee()->description ?></textarea>
	</label>
	<br/>
	<label>
		<span class="label">Должность</span>
		<select name="position">
			<option></option>
			<? foreach ($this->model->getPositions() as $pos) { ?>
					<?= $pos->id ?>
				<option value="<?= $pos->id ?>"<?= $this->model->getEmployee()->position == $pos->id ? ' selected' : '' ?>><?= $pos->name ?></option>
			<? } ?>
		</select>
	</label>
	<br/>
	<input type="submit" name="send" value="Сохранить"/>
	<input type="hidden" name="id" value="<?= $this->model->getEmployee()->id ?>" />

	<? if (count($this->model->getErrors())) { ?><div class="error"><pre><?= print_r($this->model->getErrors())?></pre></div><? } ?>
</form>