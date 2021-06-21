<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Packages -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h1>Properties </h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2 font-weight-bolder" data-toggle="modal"
                data-target="#exampleModalCenter">
                Add New Properties
            </button>
            <button type="button" class="btn btn-secondary mb-2 font-weight-bolder float-right text-light"
                onclick="print()">
                Print
            </button>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Name Property</th>
                                <th>Type Property</th>
                                <th>Prices</th>
                                <th>Rooms</th>
                                <th>Pools</th>
                                <th>Address</th>
                                <th>Images</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['properties'] as $property) : ?>
                            <tr>
                                <td><?= $property['name_property'] ?></td>
                                <td><?= $property['type_property'] ?></td>
                                <td>$ <?= number_format($property['prices'], 2) ?></td>
                                <td><?= $property['rooms'] ?></td>
                                <td><?= $property['pools'] == 'none' ? '0' : $property['pools'] ?></td>
                                <td><?= $property['address'] ?></td>
                                <td>
                                    <?php if($property['images']) : ?>
                                    <img style="width: 100%"
                                        src="<?= baseurl ?>/assets/images/<?= $property['images'] ?>" alt="">
                                    <?php else : ?>
                                    <img style="width: 100%" src="<?= baseurl ?>/assets/images/default.jpg" alt="" />
                                    <?php endif; ?>
                                </td>
                                <td><?= ($property['status'] == 'req' ? 'Requested' : 'Done') ?></td>
                                <td> <a href=" <?= baseurl ?>/owner/delete_property_action/<?= $property['id']?>"
                                        onclick="return confirm('Are u sure want to delete')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </a>
                                    <?php if($property['status'] == 'req' || $property['slug_agent_name'] == 'n-a') : ?>
                                    <?php else : ?>
                                    <a href="<?= baseurl ?>/owner/properties_update/<?= $property['id'] ?>"><i
                                            class="far fa-edit"></i>
                                    </a>
                                    <a href="<?= baseurl ?>/owner/properties_details/<?= $property['id'] ?>"><i
                                            class="fas fa-cubes"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Properties</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= baseurl ?>/owner/add_properties_action"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name Property</label>
                                    <input type="text" class="form-control" name="name_property"
                                        placeholder="Name Property" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type Property</label>
                                    <select class="form-control" name="type_property" id="">
                                        <option disabled>Select Type</option>
                                        <?php foreach($data['type_property'] as $type) : ?>
                                        <option value="<?= $type['name_type'] ?>">
                                            <?= $type['name_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room</label>
                                    <select class="form-control" name="rooms" id="">
                                        <option disabled>Select Room</option>
                                        <?php foreach($data['total_rooms'] as $room) : ?>
                                        <option value="<?= $room['total_rooms'] ?>"><?= $room['total_rooms'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pools</label>
                                    <select class="form-control" name="pools" id="">
                                        <option disabled>Select Pools</option>
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
                                    <input type="number" class="form-control" name="prices" placeholder="Prices"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sertificate</label>
                                    <input type="text" class="form-control" name="sertificate" placeholder="Sertificate"
                                        required />
                                </div>
                            </div>
                            <input class="form-control" type="hidden" value="<?= $_SESSION['slug_owner_name'] ?>"
                                name="slug_owner_name">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Images</label>
                                    <input type="file" class="form-control" name="images" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Descriptions</label>
                                    <textarea name="descriptions" id="descriptions" cols="30" rows="10"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>