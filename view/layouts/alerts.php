
<div class="notes">
    <?php foreach($notes as $note):?>
		<div class="alert alert-<?= $note['type'] ?> alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <?= $note['message'] ?>
		</div>
    <?php endforeach ?>
</div>