<form method="POST">
	<h3>Редактирование должности</h3>
	<label>
		<span class="label">Название</span>
		<input type="text" name="name" value="<?= $this->position->name ?>" />
	</label>
	<br/>
	<label>
		<span class="label">Описание</span>
		<textarea name="description"><?= $this->position->description ?></textarea>
	</label>
	<br/>
	<input type="submit" name="send" value="Сохранить"/>
	<input type="hidden" name="id" value="<?= $this->position->id ?>" />

	<? if (count($this->errors)) { ?><div class="error"><pre><?= print_r($this->errors)?></pre></div><? } ?>
</form>