<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <?php Flasher::flash();  ?>
                <form method="post" action="<?= baseurl ?>/admin/confirm/<?= $data['properties']['id'] ?>">
                    <div class="row">
                        <div class="col-10">
                            <h1>Confirm properties
                                <b><?= $data['properties']['name_property']?></b> ?
                            </h1>
                            <select class="form-control mb-3 w-25" name="slug_agent_name" required>
                                <option selected disabled>Choose agents</option>
                                <?php foreach($data['name_agents'] as $agent) : ?>
                                <option value="<?= $agent['slug_agent_name'] ?>"><?= $agent['agent_name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">
                                Confirm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>