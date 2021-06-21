<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Packages -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary mb-2 font-weight-bolder float-right text-light"
                onclick="print()">
                Print
            </button>
            <h1>Properties </h1>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Name Property</th>
                                <th>Type Property</th>
                                <th>Prices</th>
                                <th>Descriptions</th>
                                <th>Rooms</th>
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
                                <td><?= $property['descriptions'] ?></td>
                                <td><?= $property['rooms'] ?></td>
                                <td><?= $property['address'] ?></td>
                                <td>
                                    <?php if($property['images']) : ?>
                                    <img style="width: 100%"
                                        src="<?= baseurl ?>/assets/images/<?= $property['images'] ?>" alt="">
                                    <?php else : ?>
                                    <img style="width: 100%" src="<?= baseurl ?>/assets/images/default.jpg" alt="" />
                                    <?php endif; ?>
                                </td>
                                <td><?= ($property['status'] == 'req') ? 'Requested' : 'Done'; ?></td>
                                <td>
                                    <a href="<?= baseurl ?>/admin/properties_confirm/<?= $property['id'] ?>"><i
                                            class="far fa-edit"></i>
                                    </a>
                                    <?php if($property['status'] == 'req' || $property['slug_agent_name'] == 'n-a' || $property['slug_owner_name'] == '') : ?>
                                    <?php else : ?>
                                    <a href="<?= baseurl ?>/admin/properties_details/<?= $property['id'] ?>"><i
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
</div>