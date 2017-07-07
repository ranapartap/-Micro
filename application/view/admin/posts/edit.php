<div class="row">
    <div class="col-md-8">
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
                                <input type="text" class="form-control" disabled placeholder="title" value="<?= $this->data['title'] ?>">
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
                                <label>About Me</label>
                                <textarea rows="5" name="content" class="form-control" placeholder="Post content" value=""><?= $this->data['content'] ?></textarea>
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