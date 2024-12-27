<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- форма будет отправлена на этот же URL адрес /register -->
            <form action="<?= base_url('/register') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-dark">Register</button>
            </form>
        </div>
    </div>
</div>