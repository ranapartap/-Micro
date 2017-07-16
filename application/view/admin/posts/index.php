<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Manage Posts <a href="<?= admin_url('post') ?>" class="btn btn-xs btn-success btn-fill ">Add New Post</a></h4>
                <!--<p class="category">Any subtitle here</p>-->
            </div>

            <div class="dataTableWrapper content table-responsive">
                <?php

                Micro\Core\GridView::show(
                    $this->posts,
                    ['id' => "dt-posts", 'class' => 'table table-hover table-striped display dataTable dtr-inline'],
                    [
                        ['label' => 'Id', 'value' => 'id'],
                        ['label' => 'Type', 'value' => function($m) {
                                return POST_TYPE_ARRAY[$m->post_type];
                            }
                        ],
                        ['label' => 'Title', 'value' =>function($m) {
                            ob_start(); ?>

                            <?= $m->title ?>
                             <div class="edit-buttons">
                                <div class="edit-buttons-wrapper">

                                    <a href="<?= admin_url('post/') . $m->id; ?>">Edit</a>
                                    <?php if ($m->status == \Micro\Controller\AdminPostController::POST_STATUS_PUBLISHED) { ?>
                                        | <a href="<?= admin_url('post/block/') . $m->id . '/' . \Micro\Controller\AdminPostController::POST_STATUS_DISABLED ?>" >Mark <?= \Micro\Controller\AdminPostController::POST_STATUS_ARRAY[\Micro\Controller\AdminPostController::POST_STATUS_DISABLED] ?></a>

                                    <?php } else { ?>
                                        | <a href="<?= admin_url('post/block/') . $m->id . '/' . \Micro\Controller\AdminPostController::POST_STATUS_PUBLISHED ?>" ><?= \Micro\Controller\AdminPostController::POST_STATUS_ARRAY[\Micro\Controller\AdminPostController::POST_STATUS_PUBLISHED] ?> Post</a>

                                    <?php } ?>
                                    | <a href="javascript:;" class="delete-post" id="<?= $m->id ?>">Delete</a>

                                    | <a  target="_blank" href="<?= admin_url('post/view/') . $m->id; ?>">View</a>

                                </div>
                            </div>
                            <?php $str = ob_get_clean();
                            return $str;
                            }
                        ],
                        ['label' => 'Slug', 'value' => 'slug'],
                        ['label' => 'Status', 'value' => function($m) {
                                return \Micro\Controller\AdminPostController::POST_STATUS_ARRAY[$m->status];
                            }],
                        ['label' => 'Created On', 'value' => function($m) {
                                return date_format_view($m->updated_on, DATE_FORMAT_NO_SECONDS);
                            }],
                        ['label' => 'Updated On', 'value' => function($m) {
                                return date_format_view($m->updated_on, DATE_FORMAT_NO_SECONDS);
                            }],
                    ]
                );

                ?>
            </div>


        </div>
    </div>
</div>

<?php ob_start(); ?>
<script>
    $(document).ready(function () {
        var datatable = $('#dt-posts').DataTable({
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
            jQuery('#dt-posts').
                    on('mouseover', 'tr', function () {
                        jQuery(this).find('.edit-buttons').show();
                    }).
                    on('mouseout', 'tr', function () {
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
<?php
$script = ob_get_clean();

JSRegister('myscript', $script);
?>
