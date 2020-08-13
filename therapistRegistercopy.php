<head>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {

            let $uploadfile = $('#registerThera .modal .modal-dialog .modal-content .modal-body input[type="file"]');

            $uploadfile.change(function() {
                readURL(this);
            });


            //   $("#reg-form").submit(function(event) {
            //     let $password = $("#password");
            //     let $confirm = $("#confirm_pwd");
            //     let $error = $("#confirm_error");
            //     if ($password.val() == $confirm.val()) {
            //       return true;
            //     } else {
            //       $error.text("Password not Match");
            //       event.preventDefault();
            //     }
            //   });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#registerThera .modal .modal-dialog .modal-content .modal-body .img").attr('src', e.target.result);
                    $("#registerThera .modal .modal-dialog .modal-content .modal-body .img").css({
                        opacity: "100%"
                    });
                    $("#registerThera .modal .modal-dialog .modal-content .modal-body .camera-icon").css({
                        display: "none"
                    });
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <style>
        #register img {
            margin-left: 283px
        }

        @media screen and (max-width:767px) {
            #register img {
                margin-left: 100px
            }
        }
    </style>
</head>
<section id="registerThera">
    <div class="modal fade" id="TheraReg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle" style="color:rgb(34, 19, 48)">Register Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="regthera-form" method="post" enctype="multipart/form-data">
                        <div class="inverse">
                            <img class="camera-icon" src="images/camera-solid.svg" alt="camera">
                            <img src="images/profile/beard.png" style="width: 200px; height: 200px;margin-bottom:10px;opacity: 20%;" class="img rounded-circle" alt="profile" id="image">
                            <small class="form-text text-black-50" style="text-align:center;padding-right:10px;">Choose Image</small>
                            <input type="file" class="form-control-file" name="profileUpload" id="upload-profile" form="regthera-form">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">About Yourself</h4>
                            <textarea required name="about" id="about" cols="100" rows="5"></textarea>
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Name</h4>
                            <input type="text" required name="name" id="name" class="form-control" placeholder="name">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Email</h4>
                            <input type="email" required name="email" id="email" class="form-control" placeholder="email">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Phone</h4>
                            <input type="tel" required name="phone" id="phone" class="form-control" placeholder="010-1234567" pattern="[0-9]{3}-[0-9]{7}">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">IC</h4>
                            <input type="tel" required name="ic" id="ic" class="form-control" placeholder="000123-01-1234" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Address</h4>
                            <input type="text" required name="address" id="address" class="form-control" placeholder="address">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">License Type</h4>
                            <select id="license" name="license" class="form-control" require>
                                <option value="phone">#</option>
                                <option value="online chat">#</option>
                            </select>
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Resume (include your certificate photo)</h4>
                            <input type="file" required name="certificate" id="certificate" class="form-control">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Password</h4>
                            <input type="password" required name="password" id="password" class="form-control" placeholder="password">
                        </div>

                        <div class="col">
                            <h4 style="color:rgb(34, 19, 48)">Confirm Password</h4>
                            <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="confirm password">
                            <small id="confirm_error" class="text-danger"></small>
                        </div>

                        <div class="col" style="margin-top:20px;">
                            <input type="checkbox" style="margin-left:10px;margin-top:7px;" name="agreement" style="padding-left:30px;" class="form-check-input" required>
                            <label for="agreement" style="padding-left:20px;padding-bottom:5px;" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
                        </div>


                        <div class="modal-footer">
                            <input type="submit" class="form-control" name="submit" value="Register" id="submit">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-top: 20px;">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <section>