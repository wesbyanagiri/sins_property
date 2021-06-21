<?php Flasher::flash();  ?>
<div class="container-fluid">
    <!-- Data Tables Admin -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post"
                    action="<?= baseurl ?>/admin/update_agent_action/<?= $data['agent_single']['slug_agent_name'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Agent Name</label>
                                <input type="text" class="form-control" name="agent_name" placeholder="agent_name"
                                    value="<?= $data['agent_single']['agent_name'] ?>" required />
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
                                <label>Re Type-Password</label>
                                <input type="password" class="form-control" name="password2"
                                    placeholder="Re Type-Password" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">
                                Update Agent
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>