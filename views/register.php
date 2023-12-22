<?php /** @var $request App\core\Request */ ?>
<h1>Register</h1>

<form method="post" action="">
    <div class="row mb-3">
        <div class="col">
            <div class="form-group">
                <label for="Name">Name</label>
                <input id="Name" type="text" name="Name" value="<?= $request->old('Name'); ?>"
                       class="form-control <?= $request->hasError('Name') ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $request->getFirstError('Name'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="Email">Email address</label>
        <input id="Email" type="text" name="Email" value="<?= $request->old('Email'); ?>"
               class="form-control <?= $request->hasError('Email') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback">
            <?= $request->getFirstError('Email'); ?>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="Password">Password</label>
        <input id="Password" type="password" name="Password" value="<?= $request->old('Password'); ?>"
               class="form-control <?= $request->hasError('Password') ? 'is-invalid' : '' ?>">
        <div class="invalid-feedback">
            <?= $request->getFirstError('Password'); ?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>