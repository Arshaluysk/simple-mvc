<?php include_once __DIR__."./../../layouts/header.php"; ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header d-flex ">
						Create task
					</div>
					<div class="card-body">
						<form action="<?= App::route('task-update') ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="task_id" value="<?= $data['task']->id ?> ">
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
								<div class="col-md-6">
									<input id="description" type="text" class="form-control <?= (isset($errors['description'])) ? 'is-invalid' : ''?>" name="description" required 
									value="<?= (isset($old['description'])) ? $old['description'] : $data['task']->description ?>" >
									<?php if(isset($errors['description'] )): ?>
										<?php foreach($errors['description'] as $error):?>
											<span class="invalid-feedback" role="alert">
		                                        <strong><?= $error ?> </strong>
		                                    </span>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>

							<div class="form-group row">
								<label for="category" class="col-md-4 col-form-label text-md-right">Status</label>

								<div class="col-md-6">
									<select name="status" id="status" class="form-control <?= (isset($errors['status'])) ? 'is-invalid' : ''?>" required>
										<option <?= ($data['task']->status == 0) ? 'selected' : '' ?> value="0"> To Do</option>
										<option <?= ($data['task']->status == 1) ? 'selected' : '' ?> value="1"> Done</option>
									</select>

									<?php if(isset($errors['status'] )): ?>
										<?php foreach($errors['status'] as $error):?>
											<span class="invalid-feedback" role="alert">
		                                        <strong><?= $error ?> </strong>
		                                    </span>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Submit
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include_once __DIR__.'./../../layouts/header.php'; ?>
