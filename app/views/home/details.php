<div class="container">
    <div class="row mt-5">
        <div class="col-8">
            <div>
                <img style="width: 100%;"
                    src="<?= baseurl; ?>/assets/images/<?= $data['property_single']['images'] == '' ? 'default.jpg' : $data['property_single']['images'] ?>"
                    alt="">
            </div>
            <div class="mt-3">
                <h5 class="card-title"><?= $data['property_single']['name_property'] ?></h5>
                <h2 class="card-text">$<?= number_format($data['property_single']['prices'], 2) ?></h2>
                <p class="text-muted"><?= $data['property_single']['address']?></p>
                <div class="row">
                    <div class="col-5">
                        <p class="text-muted">Owner : <?= $data['property_single']['owner_name']?></p>
                    </div>
                    <div class="col-5">
                        <p class="text-muted">Agent : <?= $data['property_single']['agent_name']?></p>
                    </div>
                    <div class="col-5">
                        <p class="text-muted"><i class="fas fa-bed"></i> : <?= $data['property_single']['rooms'] ?>
                        </p>
                    </div>
                    <div class="col-5">
                        <p class="text-muted"><i class="fas fa-swimmer"></i> : <?= $data['property_single']['pools'] ?>
                        </p>
                    </div>
                </div>
                <p>Descriptions : </p>
                <p><?= $data['property_single']['descriptions']?></p>
                <a href="https://wa.me/6281338103073?text=I'm%20interested%20to%20book"
                    class="btn btn-outline-success"><i class="fas fa-phone-alt"></i> Contact Now</a>
            </div>
        </div>
        <div class="col-4">
            <div>
                <?php $increment = 0; foreach($data['properties'] as $property) : ?>
                <div data-aos="zoom-out-up" data-aos-delay="<?= $increment += 100 ?>" class="card mb-3">
                    <img src="<?= baseurl; ?>/assets/images/<?= $property['images'] == '' ? 'default.jpg' : $property['images']; ?>"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $property['name_property'] ?></h5>
                        <h2 class="card-text">$<?= $property['prices'] ?></h2>
                        <p class="text-muted"><?= $property['address'] ?></p>
                        <p class="text-muted"><i class="fas fa-bed"></i> : <?= $property['rooms'] ?></p>
                        <p class="text-muted"><i class="fas fa-swimmer"></i> :
                            <?= $property['pools'] == 'none' ? '0' : $property['pools'] ?></p>
                        <a href="<?= baseurl; ?>/home/details/<?= $property['id'] ?>"
                            class="btn btn btn-outline-dark">See Detail</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="container mt-5" id="contact">
    <div class="row">
        <div class="col-10">
            <h2 class="mt-2 fw-bold">Contact Us</h2>
        </div>
    </div>
    <form action="">
        <div class="row mt-3">
            <div class="col-6 mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username">
            </div>
            <div class="col-6 mb-3">
                <input type="text" class="form-control" name="email" placeholder="Your Email">
            </div>
            <div class="col-12">
                <textarea name="message" id="" cols="30" rows="10" class="form-control"
                    placeholder="Type your message or question "></textarea>
            </div>
        </div>
    </form>
</section>