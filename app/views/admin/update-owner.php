<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Admin -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post"
                    action="<?= baseurl ?>/admin/update_owner_controller/<?= $data['owner_single']['slug_owner_name'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Owner Name</label>
                                <input type="text" class="form-control" name="owner_name"
                                    value="<?= $data['owner_single']['owner_name'] ?>" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Re Type-Password</label>
                                <input type="password" class="form-control" name="password2"
                                    placeholder="Re Type-Password" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">
                                Update Owner
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>