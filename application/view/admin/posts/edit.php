<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="header">
                <h4 class="title">Edit Post</h4>
            </div>

            <div class="content">
                <form  method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="title" value="<?= $this->data['title'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control"  placeholder="slug" value="<?= $this->data['slug'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <div class="summernote-theme-1">
                                    <textarea class="edit-content" cols="30" name="content"><?= esc_html_decode($this->data['content']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="_method" value="<?= $this->method ?>" />
                    <a href="<?= admin_url('posts') ?>" class="btn btn-danger btn-fill">Cancel</a>
                    <button type="submit" class="btn btn-info btn-fill">Update</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var summernote = '.edit-content';

    $(document).ready(function () {
        $(summernote).summernote({
             height: 300
        });

        $('.note-codable').on('blur', function() {
            if ($(summernote).summernote('codeview.isActivated')) {
                $(summernote).val($(summernote).summernote('code'));
            }
        });
    });
</script>