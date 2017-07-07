<div class="row">
    <div class="col-md-8">
        <div class="card">

            <div class="header">
                <h4 class="title"><?= $this->pageTitle ?></h4>
            </div>

            <div class="content">
                <form id="frmUser" method="post" data-toggle="validator" role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username<?= ($this->method == METHOD_PUT) ? '(disabled)' : '' ?></label>
                                <input required data-validate="false" data-error="Username length 5-20 characters" type="text" <?= ($this->method == METHOD_PUT) ? '' : 'name="username" id="username"' ?> class="form-control" <?= ($this->method == METHOD_PUT) ? 'disabled' : '' ?> placeholder="Username" value="<?= $this->data['username'] ?>">
                                <span class="help-block with-errors"></span>
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
                                <input required type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= $this->data['email'] ?>">
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input  type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?= $this->data['mobile'] ?>">
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
                    <button disabled type="submit" class="btn btn-info btn-fill btn-submit-form"><?= ($this->method == METHOD_POST) ? 'Create Now' : 'Update Profile' ?></button>

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

<script>

var valid_username;
var valid_email;

$('#username, #email').on('blur', function(){
    var el =  this;
    var field = $(this).attr('id');
    $(this).parent('.form-group').children('.help-block').text('Checking '+$(this).attr('id')+'...').removeClass('hidden').removeClass('text-danger').removeClass('text-success').addClass('text-info');
    $(this).parent('.form-group').removeClass('has-error');

     $.ajax({
        type: "post",
        url: currenturl+'/validateusercreate',
        data: { _method: "<?= METHOD_POST ?>",
                field: $(this).attr('id'),
                value: $(this).val()
            },
        dataType: "json",
        success: function (data) {}
    }).done(function (data) {
        console.log(data);

        if (data.error) {
            window['valid_'+field] = false;
            $(el).parent('.form-group').addClass('has-error');
            $(el).parent('.form-group').children('.help-block').text(data.error).addClass('text-danger').removeClass('text-info');
        } else {
            window['valid_'+field] = true;
            $(el).parent('.form-group').children('.help-block').text(data.success).addClass('text-success').removeClass('text-info');
        }
        enable_submit();
    }).error(function (data) {
            window['valid_'+field] = false;
        enable_submit();
        $(el).parent('.form-group').children('.help-block').text('Server Error').addClass('text-danger').removeClass('text-info');
    });
});

function enable_submit() {
    if (!valid_username || !valid_email) return;
    $('.btn-submit-form').removeAttr('disabled');

}

$(document).ready(function() {

// $('#frmUser').validator();
 $('#frmUser').validator(
            {
                custom: {
                    validateuser: function ($el, $ev) {
                        var matchValue = $el.data("username") // foo
                        if ($el.val() !== matchValue) {
                            return "Hey, that's not valid! It's gotta be " + matchValue
                        }
                    }
                }

            });
})
</script>
