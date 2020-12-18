<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="/image/logo.png" alt="" width="8%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/'); ?>">Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/users'); ?>">User</a>
                </li>
                <li class="nav-item">
                    <?php if (logged_in()) : ?>
                        <a class="nav-link" href="<?= base_url('/logout'); ?>">Logout</a>
                    <?php else : ?>
                        <a class="nav-link" href="<?= base_url('/login'); ?>">Login</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>