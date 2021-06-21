<!-- Banner -->
<section class="container">
    <div class="row mt-5">
        <div style="margin-top: 90px" class="col-6">
            <h3 class="lh-base">
                <b>Bli Rumah</b> <br>
                merupakan website terbaik
                dalam menyediakan berbagai macam
                property
            </h3>
            <a href="#property" class="btn btn-outline-secondary mt-2"> Explore Now</a>
        </div>

        <div class="col-6 d-xs-none">
            <img style="border-radius: 0 100px 0 100px" src="<?= baseurl; ?>/assets/images/house-banner-1.png" alt="">
        </div>
    </div>
</section>

<!-- Card Section -->
<section class="container mt-5" id="property">
    <div class="row">
        <div class="col-10">
            <b class="text-muted">Explore Space</b>
            <h2 class="mt-2 fw-bold">Future Space at <br>
                Budget
            </h2>
        </div>
    </div>

    <form method="get" action="<?= baseurl; ?>/home/filter">
        <div class="row mt-3">
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-lg btn-outline-dark">Search</button>
            </div>
            <div class="col-3">
                <input class="form-control form-control-lg" type="text" name="address" id=""
                    value="<?= isset($_GET['address']) ? $_GET['address'] : '' ?>">
            </div>
            <div class="col-3">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="prices"
                    id="">
                    <option selected disabled>Price Up To</option>
                    <?php foreach($data['prices'] as $price): ?>
                    <option value="<?= $price['prices'] ?>"
                        <?= isset($_GET['prices']) && $_GET['prices'] == $price['prices'] ? 'selected' : '' ?>>
                        $<?= (number_format($price['prices'], 2)) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-3">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="rooms">
                    <option selected disabled>Room</option>
                    <?php foreach($data['rooms'] as $rooms): ?>
                    <option
                        value="<?= $rooms['total_rooms'] >= 1 || $rooms['total_rooms'] < 5 ? $rooms['total_rooms'] : '5+' ?>"
                        <?= isset($_GET['rooms']) && $_GET['rooms'] == $rooms['total_rooms'] ? 'selected' : '' ?>>
                        <?= ($rooms['total_rooms'] >= 5) ? '5+' : $rooms['total_rooms'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-3">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="pools">
                    <option selected disabled>Pool</option>
                    <option value="none">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>
    </form>

    <?php
        if(!empty($_GET['prices']) && !empty($_GET['rooms']) && !empty($_GET['rooms'])):
            if (count($data['filter']) > 0):
    ?>
    <div class="row mt-3">
        <div class="col-12">
            <p>Showing result with price up to $<?= (number_format($_GET['prices'], 2)) ?>, have
                <?= $_GET['rooms'] == 1 ? '1 room' : $_GET['rooms'] . ' rooms' ?>, and have
                <?= $_GET['pools'] ?> pools.</p>
        </div>
    </div>
    <?php
            else:
    ?>
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                Ups, We didn't find what you were looking for. Please try again with other options.
            </div>
        </div>
    </div>
    <?php
            endif;
        endif;
    ?>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php $increment = 0; foreach($data['filter'] as $filter) : ?>
        <div class="col">
            <div data-aos="zoom-out-up" data-aos-delay="<?= $increment += 100 ?>" class="card">
                <img style="width: 100%"
                    src="<?= baseurl; ?>/assets/images/<?= ($filter['images'] == '') ? 'default.jpg' : $filter['images']  ?>"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $filter['name_property'] ?></h5>
                    <h2 class="card-text">$<?= number_format($filter['prices'], 2) ?></h2>
                    <p class="text-muted"><?= $filter['address'] ?></p>
                    <p class="text-muted ml-5"><i class="fas fa-bed"></i> : <?= $filter['rooms'] ?></p>
                    <p class="text-muted"><i class="fas fa-swimmer"></i> :
                        <?= $filter['pools'] == 'none' ? '0' : $filter['pools']  ?></p>
                    <a href="<?= baseurl; ?>/home/details/<?= $filter['id'] ?>" class="btn btn btn-outline-dark">See
                        Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Contact Section -->
<section class="container mt-5" id="contact">
    <div class="row">
        <div class="col-10">
            <h2 class="mt-2 fw-bold">Contact Us</h2>
        </div>
    </div>
    <form method="post" action="">
        <div class="row mt-3">
            <div class="col-6 mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username">
            </div>
            <div class="col-6 mb-3">
                <input type="text" class="form-control" name="email" placeholder="Your Email">
            </div>
            <div class="col-12 mb-3">
                <textarea name="message" id="" cols="30" rows="10" class="form-control"
                    placeholder="Type your message or question "></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-outline-dark">Send Message</button>
            </div>
        </div>
    </form>
</section>