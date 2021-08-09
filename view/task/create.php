<?php include_once __DIR__."./../layouts/header.php"; ?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header d-flex ">
						Create task
					</div>
					<div class="card-body">
						<form action="<?= App::route('task-store') ?>" method="post" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
								<div class="col-md-6">
									<input id="name" type="text" class="form-control <?= (isset($errors['name'])) ? 'is-invalid' : ''?>" name="name" required 
									value="<?= (isset($old['name'])) ? $old['name'] : '' ?>" >
									<?php if(isset($errors['name'] )): ?>
										<?php foreach($errors['name'] as $error):?>
											<span class="invalid-feedback" role="alert">
		                                        <strong><?= $error ?> </strong>
		                                    </span>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>							

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
								<div class="col-md-6">
									<input id="email" type="text" class="form-control <?= (isset($errors['email'])) ? 'is-invalid' : ''?>" name="email" required 
									value="<?= (isset($old['email'])) ? $old['email'] : '' ?>" >
									<?php if(isset($errors['email'] )): ?>
										<?php foreach($errors['email'] as $error):?>
											<span class="invalid-feedback" role="alert">
		                                        <strong><?= $error ?> </strong>
		                                    </span>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</div>							

							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
								<div class="col-md-6">
									<input id="description" type="text" class="form-control <?= (isset($errors['description'])) ? 'is-invalid' : ''?>" name="description" required 
									value="<?= (isset($old['description'])) ? $old['description'] : '' ?>" >
									<?php if(isset($errors['description'] )): ?>
										<?php foreach($errors['description'] as $error):?>
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

<?php include_once __DIR__.'./../layouts/header.php'; ?>
