<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="<?= base_url('/login') ?>" method="post" class="ajax-form2">
                <?= get_csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control <?= get_validation_class('email') ?>" id="email" placeholder="name@example.com" value="<?= old('email') ?>">
                    <?= get_errors('email') ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control <?= get_validation_class('password') ?>" id="password" placeholder="Password">
                    <?= get_errors('password') ?>
                </div>
                <button type="submit" class="btn btn-dark">Login</button>
            </form>
            
            <?php
                session()->remove('form_data');
                session()->remove('form_errors');
            ?>
        </div>
    </div>
</div>