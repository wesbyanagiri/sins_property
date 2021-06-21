<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Owner -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3 font-weight-bolder mb-2" data-toggle="modal"
                data-target="#modal-owner">
                Add New Owner
            </button>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Owner Name</th>
                                <th>Username</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['owners'] as $ownerData) : ?>
                            <tr>
                                <td><?= $ownerData['owner_name'] ?></td>
                                <td><?= $ownerData['email'] ?></td>
                                <td><?php $date = date_create($ownerData['created_at']); echo date_format($date, "d-m-Y"); ?>
                                </td>
                                <td>
                                    <a href="<?= baseurl ?>/admin/delete_owner/<?= $ownerData['slug_owner_name']?>"
                                        onclick="return confirm('Are u sure want to delete')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </a>
                                    <a href="<?= baseurl ?>/admin/update_owner/<?= $ownerData['slug_owner_name']?>">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Owner -->
    <div class="modal fade" id="modal-owner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Owner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= baseurl ?>/admin/add_owner">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Owner Name</label>
                                    <input type="text" class="form-control" name="owner_name" placeholder="Owner Name"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" name="password2" placeholder="Password"
                                        required />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Owner</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>