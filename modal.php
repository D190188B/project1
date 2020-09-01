<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script type="text/javascript">
    //change imge
    $(document).ready(function(e) {

      let $uploadfile = $('#register .modal .modal-dialog .modal-content .modal-body input[type="file"]');

      $uploadfile.change(function() {
        readURL(this);
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
          $("#register .modal .modal-dialog .modal-content .modal-body .img").attr('src', e.target.result);
          $("#register .modal .modal-dialog .modal-content .modal-body .img").css({
            opacity: "100%"
          });
          $("#register .modal .modal-dialog .modal-content .modal-body .camera-icon").css({
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
<section id="register">
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLongTitle" style="color:rgb(34, 19, 48)">Register Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="inverse">
            <img class="camera-icon" src="images/camera-solid.svg" alt="camera">
            <img src="images/profile/beard.png" style="width: 200px; height: 200px;margin-bottom:10px;opacity:20%" class="img rounded-circle" alt="profile" id="image">
            <small class="form-text text-black-50" style="text-align:center;padding-right:10px;">Choose Image</small>
            <input type="file" class="form-control-file" name="profileUpload" id="upload-profile" form="reg-form">
          </div>

          <form id="reg-form" method="POST" enctype="multipart/form-data" class="need-validation" novalidate>

            <div class="row" style="margin-top:30px;">
              <div class="col">
                <h4 style="color:rgb(34, 19, 48);margin-left: 18px;">First Name</h4>
                <input type="text" required name="firstname" id="firstname" class="form-control" placeholder="first name" style="max-width: 250px;margin-left: 15px;">
                <div class="valid-feedback" style="margin-left:15px;">Valid.</div>
                <div class="invalid-feedback" style="margin-left:15px;">Please fill out this field.</div>
              </div>

              <div class="col">
                <h4 style="color:rgb(34, 19, 48)">Last Name</h4>
                <input type="text" required name="lastName" id="lastName" class="form-control" placeholder="last name" style="max-width: 250px;">
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Birthday</h4>
              <input type="date" required name="birth" id="birth" class="form-control">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Phone</h4>
              <input type="tel" required name="phone" id="phone" class="form-control" placeholder="010-1234567" pattern="[0-9]{3}-[0-9]{7}">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please follow properly.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Address</h4>
              <input type="text" required name="address" id="address" class="form-control" placeholder="address">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">City</h4>
              <input type="text" required name="city" id="city" class="form-control" placeholder="city">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Post Code</h4>
              <input type="text" required name="postCode" id="postCode" class="form-control" placeholder="post code">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">State</h4>
              <input type="text" required name="state" id="state" class="form-control" placeholder="state">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Email</h4>
              <input type="email" required name="reEmail" id="reEmail" class="form-control" placeholder="email">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Password</h4>
              <input type="password" required name="rePassword" id="rePassword" class="form-control" placeholder="password">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
            </div>

            <div class="col">
              <h4 style="color:rgb(34, 19, 48)">Confirm Password</h4>
              <input type="password" required name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="confirm password">
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill out this field.</div>
              <small id="confirm_error" class="text-danger"></small>
            </div>

            <div class="col" style="margin-top:20px;">
              <input type="checkbox" style="margin-left:10px;margin-top:3px;" name="agreement" style="padding-left:30px;" class="form-check-input" required>
              <label for="agreement" style="padding-left: 40px;padding-bottom:5px;" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term, conditions, and policy </a>(*) </label>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Check this checkbox to continue.</div>
            </div>


            <div class="modal-footer">
              <input type="submit" class="form-control" name="submit" value="Register" id="submit">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Disable form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('need-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() == false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</section>
