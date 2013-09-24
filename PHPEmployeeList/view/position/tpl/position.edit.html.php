<form method="POST">
	<h3>Редактирование должности</h3>
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
	<input type="hidden" name="id" value="<?= $this->model->getPosition()->id ?>" />

	<? if (count($this->model->getErrors())) { ?><div class="error"><pre><?= print_r($this->model->getErrors())?></pre></div><? } ?>
</form>