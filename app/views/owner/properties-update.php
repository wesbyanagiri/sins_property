<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <?php Flasher::flash();  ?>
                <form method="post"
                    action="<?= baseurl ?>/owner/update_properties_action/<?= $data['property_single']['id'] ?>"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name Property</label>
                                <input type="text" class="form-control" name="name_property"
                                    value="<?= $data['property_single']['name_property'] ?>" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Type Property</label>
                                <select class="form-control" name="type_property" id="">
                                    <?php foreach($data['type_property'] as $type) : ?>
                                    <option value="<?= $type['name_type'] ?>">
                                        <?= $type['name_type'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rooms</label>
                                <select class="form-control" name="rooms" id="">
                                    <option disabled>How Many Rooms</option>
                                    <?php foreach($data['total_rooms'] as $room) : ?>
                                    <option value="<?= $room['total_rooms'] ?>">
                                        <?= $room['total_rooms'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pools</label>
                                <select class="form-control" name="pools" id="">
                                    <option disabled>How Many Pool</option>
                                    <option value="none">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Prices</label>
                                <input type="number" class="form-control" name="prices"
                                    value="<?= $data['property_single']['prices']?>" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sertificate</label>
                                <input type="text" class="form-control" name="sertificate"
                                    value="<?= $data['property_single']['sertificate']?>" required />
                            </div>
                        </div>
                        <input class="form-control" type="hidden" value="<?= $_SESSION['slug_owner_name'] ?>"
                            name="slug_owner_name">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="<?= $data['property_single']['address']?>" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Images</label>
                                <input type="file" class="form-control" name="images" placeholder="" />
                                <img class="w-25 mt-2"
                                    src="<?= baseurl; ?>/assets/images/<?= $data['property_single']['images'] ?>"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descriptions</label>
                                <textarea name="descriptions" id="descriptions" cols="30" rows="10"
                                    class="form-control"><?= $data['property_single']['descriptions'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">
                                Update Properties
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>