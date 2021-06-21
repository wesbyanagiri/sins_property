<?php Flasher::flash();  ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Agents</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <?php foreach($data['total_agents'] as $totalAgents) : ?>
                    <li class="ms-auto"><span class="counter text-success"><?= $totalAgents['count']?></span>
                        <?php endforeach; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Properties</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash2"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <?php foreach($data['total_properties'] as $totalProperties) : ?>
                    <li class="ms-auto"><span class="counter text-purple"><?= $totalProperties['count'] ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Owners</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <?php foreach($data['total_owners'] as $totalOwners) : ?>
                    <li class="ms-auto"><span class="counter text-info"><?= $totalOwners['count'] ?></span>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Data Tables Agent -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3 font-weight-bolder mb-2" data-toggle="modal"
                data-target="#modal-agent">
                Add New Agents
            </button>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Agent Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['agents'] as $agentData) : ?>
                            <tr>
                                <td><?= $agentData['agent_name'] ?></td>
                                <td><?= $agentData['email'] ?></td>
                                <td><?php $date = date_create($agentData['created_at']); echo date_format($date, "d-m-Y");?>
                                </td>
                                <td>
                                    <a href="<?= baseurl ?>/admin/delete_agent/<?= $agentData['slug_agent_name']?>"
                                        onclick="return confirm('Are u sure want to delete')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </a>
                                    <a href="<?= baseurl ?>/admin/update_agent/<?= $agentData['slug_agent_name']?>">
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

    <!-- Modal Agent -->
    <div class="modal fade" id="modal-agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= baseurl ?>/admin/add_agent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent Name</label>
                                    <input type="text" class="form-control" name="agent_name" placeholder="Agent Name"
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
                    <button type="submit" class="btn btn-primary">Add Agent</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Tables Admin -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3 font-weight-bolder mb-2" data-toggle="modal"
                data-target="#modal-admin">
                Add New Admin
            </button>
            <div class="white-box">
                <div class="table-responsive">
                    <table id="data-tables-admin" class="display table table-bordered">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['admins'] as $adminData) : ?>
                            <tr>
                                <td><?= $adminData['username'] ?></td>
                                <td><?php $date = date_create($adminData['created_at']); echo date_format($date, "d-m-Y");?>
                                </td>
                                <td>
                                    <a href="<?= baseurl ?>/admin/delete_admin/<?= $adminData['id']?>"
                                        onclick="return confirm('Are u sure want to delete')">
                                        <i class="fas fa-trash-alt" style="color: red;"></i>
                                    </a>
                                    <a href="<?= baseurl ?>/admin/update_admin/<?= $adminData['id']?>">
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

    <!-- Modal Agent -->
    <div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= baseurl ?>/admin/add_admin">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        required />
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
                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>