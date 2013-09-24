<form method="POST">
	<h3>Добавление должности</h3>
	<label>
		<span class="label">Название</span>
		<input type="text" name="name" value="<?= $this->model->getPosition()->name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Описание</span>
		<textarea name="description"><?= $this->model->getPosition()->description ?></textarea>
	</label>
	<br/>
	<input type="submit" name="send" value="Сохранить"/>

	<? if (count($this->model->getErrors())) { ?><div class="error"><pre><?= print_r($this->model->getErrors())?></pre></div><? } ?>
</form>