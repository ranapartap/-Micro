<div class="row">
    <div class="col-md-8">
        <div class="card">

            <div class="header">
                <h4 class="title">Edit User</h4>
            </div>

            <div class="content">
                <form  method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                               <label>Username(disabled)</label>
                                <input type="text" class="form-control" disabled placeholder="Username" value="<?= $this->data['username'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fullname</label>
                                <input type="text" name="fullname" class="form-control"  placeholder="Fullname" value="<?= $this->data['fullname'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $this->data['email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?= $this->data['mobile'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Home Address" value="<?= $this->data['address'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>About Me</label>
                                <textarea rows="5" name="about" class="form-control" placeholder="Here can be your description" value="Mike"><?= $this->data['about'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_method" value="<?= $this->method ?>" />
                    <a href="<?= admin_url('users') ?>" class="btn btn-danger btn-fill">Cancel</a>
                    <button type="submit" class="btn btn-info btn-fill">Update Profile</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
            </div>
            <div class="content">
                <div class="author">
                    <a href="#">
                        <img class="avatar border-gray" src="assets/img/faces/face-3.jpg" alt="..."/>

                        <h4 class="title"><?= $this->data['fullname'] ?><br />
                            <small><?= $this->data['username'] ?></small>
                        </h4>
                    </a>
                </div>
                <p class="description text-center"> Email : <?= $this->data['email'] ?> <br>
                    Mobile : <?= $this->data['mobile'] ?><br>
                </p>
            </div>
            <hr>
            <div class="text-center">
                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

            </div>
        </div>
    </div>

</div>