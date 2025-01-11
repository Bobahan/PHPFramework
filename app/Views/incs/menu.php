<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?= base_url('/') ?>">Home</a>
    </li>
    <?php if(check_auth()): ?>
    <li class="nav-item">
        <span class="nav-link"><?= get_user()['name'] ?></span>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_url(path: '/dashboard') ?>">Dashboard</a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/logout') ?>" class="nav-link">Logout</a>
    </li>
    <?php else: ?>
        <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_url('/register') ?>">Register</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="<?= base_url('/login') ?>">Login</a>
    </li>
    <?php endif; ?>
</ul>