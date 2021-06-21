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

    <form method="get" action="<?= baseurl; ?>/agent/filter">
        <div class="row mt-3">
            <div class="col-12 mb-3">
                <button type="submit" class="btn btn-lg btn-outline-dark">Search</button>
            </div>
            <div class="col-3">
                <input class="form-control form-control-lg" type="text" name="address" id=""
                    placeholder="Type location...">
            </div>
            <div class="col-3">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="prices">
                    <option selected disabled>Price Up To</option>
                    <?php foreach($data['prices'] as $price): ?>
                    <option value="<?= $price['prices'] ?>">
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
                        value="<?= $rooms['total_rooms'] >= 1 || $rooms['total_rooms'] < 5 ? $rooms['total_rooms'] : '5+' ?>">
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

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        <?php $increment = 0; foreach($data['properties'] as $property) : ?>
        <div class="col">
            <div data-aos="zoom-out-up" data-aos-delay="<?= $increment += 100 ?>" class="card">
                <img style="width: 100%"
                    src="<?= baseurl; ?>/assets/images/<?= ($property['images'] == '') ? 'default.jpg' : $property['images']  ?>"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $property['name_property'] ?></h5>
                    <h2 class="card-text">$<?= number_format($property['prices'], 2) ?></h2>
                    <p class="text-muted"><?= $property['address'] ?></p>
                    <p class="text-muted"><i class="fas fa-bed"></i> : <?= $property['rooms'] ?></p>
                    <p class="text-muted"><i class="fas fa-swimmer"></i> :
                        <?= $property['pools'] == 'none' ? '0' : $property['pools'];  ?></p>
                    <a href="<?= baseurl; ?>/agent/details/<?= $property['id'] ?>" class="btn btn btn-outline-dark">See
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