<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Manage Posts <a href="<?=admin_url('post')?>" class="btn btn-xs btn-success btn-fill ">Add New Post</a></h4>

                <!--<p class="category"></p>-->
            </div>

            <div class="dataTableWrapper content table-responsive">
                <table id="dt-posts" class="table table-hover table-striped display dataTable dtr-inline">
                    <thead>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                    </thead>

                    <tfoot>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                    <tbody>

                        <?php foreach ($this->posts as $key => $post) : ?>
                            <tr  id="dt-row-<?= $post['id'] ?>" class="dt-row">
                                <td><?= $post['id'] ?></td>
                                <td><?= POST_TYPE_ARRAY[$post['post_type']] ?></td>
                                <td><?= $post['title'] ?>
                                    <div class="edit-buttons">
                                        <a href="<?= admin_url('post/') . $post['id']; ?>">Edit</a>
                                                    <!--class="btn btn-xs btn-danger btn-fill "-->
                                    <?php if ($post['status'] == \Micro\Controller\AdminPostController::POST_STATUS_PUBLISHED) { ?>
                                        | <a href="<?= admin_url('post/block/') . $post['id'] . '/' . \Micro\Controller\AdminPostController::POST_STATUS_DISABLED ?>" >Un-publish</a>

                                    <?php } else { ?>
                                        | <a href="<?= admin_url('post/block/') . $post['id'] . '/' . \Micro\Controller\AdminPostController::USER_STATUS_ACTIVE ?>" >Publish</a>

                                    <?php } ?>
                                        | <a href="javascript:;" class="delete-post" id="<?= $post['id'] ?>">Delete</a>
                                    </div>
                                </td>
                                <td><?= \Micro\Controller\AdminPostController::POST_STATUS_ARRAY[$post['status']] ?></td>
                                <td><?= date_format_view($post['created_on'], DATE_FORMAT_SHORT)  ?></td>
                                <td><?= date_format_view($post['updated_on'], DATE_FORMAT_LONG) ?></td>
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
        var datatable = $('#dt-posts').DataTable({
            responsive: true,
            pageLength: 25,
            columnDefs: [{ targets: 'no-sort', orderable: false }],
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
                                var val = $("<div>"+$(this).val()+"</div>").find("div.edit-buttons").remove().end().text().trim();
                                column.search(val).draw();
                            });
                    column.data().unique().sort().each(function (d, j) {
                        var dd = $("<div>"+d+"</div>").find("div.edit-buttons").remove().end().text().trim();
                        select.append('<option value="' + dd + '">' + dd + '</option>')
                    });
                });
            }
        });

        jQuery(document).ready(function() {
            jQuery('#dt-posts').
              on('mouseover', 'tr', function() {
                  jQuery(this).find('.edit-buttons').show();
              }).
              on('mouseout', 'tr', function() {
                  jQuery(this).find('.edit-buttons').hide();
              });
        });

        $('.delete-post').click(function () {
            var post_id = $(this).attr('id');
            var datatable = $('#dt-posts').DataTable( );
            var fullname = $(this).attr('fullname');

            swal({
                title: "Delete " + fullname + " ?",
                text: "Sure to delete this post?",
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
                    url: currenturl + "/" + post_id,
                    data: {_method: "<?= METHOD_DELETE ?>"},
                    dataType: "json",
                    success: function (data) {}
                }).done(function (data) {
                    console.log(data);
                    if (data.success) {
                        swal("Deleted!", "Post deleted successfully", "success");
                        datatable.row('#dt-row-' + post_id).remove().draw(false);
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