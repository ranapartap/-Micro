<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Striped Table with Hover</h4>
                <p class="category">Here is a subtitle for this table</p>
            </div>

            <div class="content table-responsive">
                <table id="dt-users" class="table table-hover table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>

                        <?php foreach ($this->users as $key => $user) : ?>
                        <tr>
                            <td><?=$user['id']?></td>
                            <td><?=$user['username']?></td>
                            <td><?=$user['fullname']?></td>
                            <td><?=$user['mobile']?></td>
                            <td><?=$user['email']?></td>
                            <td><?= \Micro\Controller\AdminUserController::USER_STATUS_ARRAY[$user['status']]?></td>
                            <td>
                                <a href="<?= admin_url('user/').$user['id']; ?>" class="btn btn-sm btn-info btn-fill ">Edit</a>

                                <?php if ($user['status'] == \Micro\Controller\AdminUserController::USER_STATUS_ACTIVE) { ?>
                                    <a href="<?= admin_url('user/block/').$user['id'].'/'.\Micro\Controller\AdminUserController::USER_STATUS_BLOCKED ?>" class="btn btn-sm btn-success btn-fill ">Block</a>
                                <?php } else { ?>
                                    <a href="<?= admin_url('user/block/').$user['id'].'/'.\Micro\Controller\AdminUserController::USER_STATUS_ACTIVE ?>" class="btn btn-sm btn-danger btn-fill ">Activate</a>
                                <?php } ?>

                                <button class="btn btn-sm btn-danger btn-fill ">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>


        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#dt-users').DataTable( );
} );
</script>