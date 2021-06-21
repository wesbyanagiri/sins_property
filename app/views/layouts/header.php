<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= baseurl; ?>/assets/style/font-awesome/css/all.css" />
    <link rel="stylesheet" href="<?= baseurl; ?>/assets/style/css/style.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title><?= $data['title'] ?></title>
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<body>
    <!-- Navbar Start  -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand"
                href="<?= baseurl; ?><?= ($data['set_active'] == 'agent_logout') ? '/agent' : '/home' ?>">
                <!-- <img data-aos="zoom-out-up" data-aos-delay="900" src="<?= baseurl; ?>/assets/images/logo.png" alt="" /> -->
                <h2>SINS Property</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse"></div>
            <div class="collapse navbar-collapse"></div>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav navbar-group">
                    <li data-aos="zoom-out-up" data-aos-delay="1000" class="nav-item">
                        <a class="nav-link <?= $data['set_active'] == 'index' ? 'active' : '' ?>"
                            href="<?= baseurl; ?><?= ($data['set_active'] == 'agent_logout') ? '/agent' : '/home' ?>">Home
                            <span class="sr-only">(current)</span></a>
                        <div class="underline-bar"></div>
                    </li>
                    <li data-aos="zoom-out-up" data-aos-delay="1200" class="nav-item">
                        <a class="nav-link <?= $data['set_active'] == 'properties' ? 'active' : '' ?>"
                            href="#property">Properties</a>
                        <div class="underline-bar"></div>
                    </li>
                    <li data-aos="zoom-out-up" data-aos-delay="1300" class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                        <div class="underline-bar"></div>
                    </li>
                    <?php if ($data['set_active'] == 'agent_logout') : ?>
                    <li data-aos="zoom-out-up" data-aos-delay="1300" class="nav-item">
                        <a class="nav-link text-danger" href="<?= baseurl; ?>/agent/setOut">Log out</a>
                        <div class="underline-bar"></div>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->