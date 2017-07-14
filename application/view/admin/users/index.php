<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Manage Users <a href="<?= admin_url('user') ?>" class="btn btn-xs btn-success btn-fill ">Add New User</a></h4>

                <!--<p class="category"></p>-->
            </div>

            <div class="dataTableWrapper content table-responsive">
                <table id="dt-users" class="table table-hover table-striped display dataTable dtr-inline">
                    <thead>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    </thead>

                    <tfoot>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    </tfoot>

                    <tbody>

                        <?php foreach ($this->users as $key => $user) : ?>

                            <tr  id="dt-row-<?= $user['id'] ?>" class="dt-row <?= $user['status'] == \Micro\Controller\AdminUserController::USER_STATUS_BLOCKED ? 'text-danger' : '' ?> ">

                                <td><?= $user['id'] ?></td>

                                <td><?= $user['username'] ?>

                                    <div class="edit-buttons">
                                        <div class="edit-buttons-wrapper">

                                            <a title="Edit user" href="<?= admin_url('user/') . $user['id']; ?>">Edit</a>

                                            <!--class="btn btn-xs btn-danger btn-fill "-->
                                            <?php if ($user['status'] == \Micro\Controller\AdminUserController::USER_STATUS_ACTIVE) { ?>
                                                | <a title="Block user" href="<?= admin_url('user/block/') . $user['id'] . '/' . \Micro\Controller\AdminUserController::USER_STATUS_BLOCKED ?>" >Block</a>

                                            <?php } else { ?>
                                                | <a title="Un-block user" href="<?= admin_url('user/block/') . $user['id'] . '/' . \Micro\Controller\AdminUserController::USER_STATUS_ACTIVE ?>" >Un-Block</a>

                                            <?php } ?>
                                            | <a title="Delete user" href="javascript:;" class="delete-user" fullname="<?= $user['fullname'] ?>" id="<?= $user['id'] ?>">Delete</a>

                                        </div>
                                    </div>

                                </td>

                                <td><?= $user['fullname'] ?></td>
                                <td><?= $user['mobile'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= \Micro\Controller\AdminUserController::USER_STATUS_ARRAY[$user['status']] ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>


        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var datatable = $('#dt-users').DataTable({
            responsive: true,
            pageLength: 25,
            columnDefs: [{targets: 'no-sort', orderable: false}],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    if ($(column.footer()).attr('class'))
                        return;
//                    console.log($(column.footer()).attr('class'));

                    var select = $('<select class="form-control input-xs no-padding-tb"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
//                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
//                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                                var val = $("<div>" + $(this).val() + "</div>").find("div.edit-buttons").remove().end().text().trim();
                                column.search(val).draw();
                            });
                    column.data().unique().sort().each(function (d, j) {
                        var dd = $("<div>" + d + "</div>").find("div.edit-buttons").remove().end().text().trim();
                        select.append('<option value="' + dd + '">' + dd + '</option>')
                    });
                });
            }
        });

        jQuery(document).ready(function () {
            jQuery('#dt-users').
                    on('mouseover', 'tr', function () {
                        jQuery(this).find('.edit-buttons').show();
                    }).
                    on('mouseout', 'tr', function () {
                        jQuery(this).find('.edit-buttons').hide();
                    });
        });

        $('.delete-user').click(function () {
            var user_id = $(this).attr('id');
            var datatable = $('#dt-users').DataTable( );
            var fullname = $(this).attr('fullname');

            swal({
                title: "Delete " + fullname + " ?",
                text: "Sure to delete this user?",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success btn-fill',
            }, function () {
                $.ajax({
                    type: "post",
                    url: currenturl + "/" + user_id,
                    data: {_method: "<?= METHOD_DELETE ?>"},
                    dataType: "json",
                    success: function (data) {}
                }).done(function (data) {
                    console.log(data);
                    if (data.success) {
                        swal("Deleted!", "User deleted successfully", "success");
                        datatable.row('#dt-row-' + user_id).remove().draw(false);
                    } else {
                        swal("Error!", data.error, "error");
                    }
                    $('#orders-history').load(document.URL + ' #orders-history');
                }).error(function (data) {
                    swal("Oops", "We couldn't connect to the server!", "error");
                });
            });
        });

    });
</script>