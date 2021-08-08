<?php include_once __DIR__."./../layouts/header.php"; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="<?= App::route('register-store') ?>">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control <?= (isset($errors['name'])) ? 'is-invalid' : ''?>" name="name" value="<?= (isset($old['name'])) ? $old['name'] : '' ?>" required autocomplete="name" autofocus>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?= (isset($errors['email'])) ? 'is-invalid' : ''?>" name="email" value="<?= (isset($old['email'])) ? $old['email'] : '' ?>" required autocomplete="email">

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?= (isset($errors['password'])) ? 'is-invalid' : ''?>" name="password" required autocomplete="new-password">

                                <?php if(isset($errors['password'] )): ?>
                                    <?php foreach($errors['password'] as $error):?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $error ?> </strong>
                                        </span>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__.'./../layouts/footer.php'; ?>

