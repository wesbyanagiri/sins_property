<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Packages -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <h1>Properties Details</h1>
            <button type="button" class="btn btn-secondary mb-2 font-weight-bolder text-light" onclick="print()">
                Print
            </button>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Name Property</th>
                                <th>Agent Name</th>
                                <th>Owner Name</th>
                                <th>Type Property</th>
                                <th>Prices</th>
                                <th>Descriptions</th>
                                <th>Rooms</th>
                                <th>Address</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $data['properties_details']['name_property'] ?></td>
                                <td><?= $data['properties_details']['agent_name'] ?></td>
                                <td><?= $data['properties_details']['owner_name'] ?></td>
                                <td><?= $data['properties_details']['type_property'] ?></td>
                                <td>$ <?= number_format($data['properties_details']['prices'], 2) ?></td>
                                <td><?= $data['properties_details']['descriptions'] ?></td>
                                <td><?= $data['properties_details']['rooms'] ?></td>
                                <td><?= $data['properties_details']['address'] ?></td>
                                <td>
                                    <?php if($data['properties_details']['images']) : ?>
                                    <img style="width: 100%"
                                        src="<?= baseurl ?>/assets/images/<?= $data['properties_details']['images'] ?>"
                                        alt="">
                                    <?php else : ?>
                                    <img src="<?= baseurl ?>/assets/images/default.jpg" alt="" />
                                    <?php endif; ?>
                                </td>
                                <td> <a href=" <?= baseurl ?>/owner/delete_property_action/<?= $data['properties_details']['id']?>"
                                        onclick="return confirm('Are u sure want to delete')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </a>
                                    <a
                                        href="<?= baseurl ?>/owner/properties_update/<?= $data['properties_details']['id'] ?>"><i
                                            class="far fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>