        let profileBtn = document.querySelector('#theraProfile');
        let profileIcon = document.querySelector('#profile_icon');
        let profile_h4 = document.querySelector('#profile_h4');

        let appointmentBtn = document.querySelector('#theraAppointment');
        let appointmentIcon = document.querySelector('#appointment_icon');
        let appointment_h4 = document.querySelector('#appointment_h4');

        let reportBtn = document.querySelector('#theraReport');
        let reportIcon = document.querySelector('#report_icon');
        let report_h4 = document.querySelector('#report_h4');

        let profilePage = document.querySelector('#Profile');
        let appointmentPage = document.querySelector('#Appointment');
        let reportPage = document.querySelector('#Report');


        let btnEdit = document.querySelector('#edit');
        let a = document.querySelector('#nameFirst');
        let b = document.querySelector('#nameLast');
        let e = document.querySelector('#phone');
        let f = document.querySelector('#address');
        let g = document.querySelector('#state');
        let h = document.querySelector('#postCode');
        let j = document.querySelector('#city');
        let about = document.querySelector('#about');
        let submit = document.querySelector('#submit');

        let camera_icon= document.querySelector('#camera_icon');


        let change_word =document.querySelector('#changePro');
        let changePhoto =document.querySelector('#uploadProfile');

        profileBtn.addEventListener('click', () => {

            profileIcon.style.color = "black";
            profile_h4.style.color = "black";

            appointmentIcon.style.color = "white";
            appointment_h4.style.color = "white";

            reportIcon.style.color = "white";
            report_h4.style.color = "white";


            profilePage.style.display = "block";
            appointmentPage.style.display = "none";
            reportPage.style.display = "none";

        });


        appointmentBtn.addEventListener('click', () => {

            profileIcon.style.color = "white";
            profile_h4.style.color = "white";



            appointmentIcon.style.color = "black";
            appointment_h4.style.color = "black";


            reportIcon.style.color = "white";
            report_h4.style.color = "white";



            profilePage.style.display = "none";
            appointmentPage.style.display = "block";
            reportPage.style.display = "none";

        });


        reportBtn.addEventListener('click', () => {

            profileIcon.style.color = "white";
            profile_h4.style.color = "white";


            appointmentIcon.style.color = "white";
            appointment_h4.style.color = "white";



            reportIcon.style.color = "black";
            report_h4.style.color = "black";



            profilePage.style.display = "none";
            appointmentPage.style.display = "none";
            reportPage.style.display = "block";

        });


       

        btnEdit.addEventListener('click', () => {
            a.removeAttribute('readonly');
            a.setAttribute("form", "thera_save");
            a.style.background = "white";
            a.style.border = "1px solid black";

            b.removeAttribute('readonly');
            b.setAttribute("form", "thera_save");
            b.style.background = "white";
            b.style.border = "1px solid black";

            e.removeAttribute('readonly');
            e.setAttribute("form", "thera_save");
            e.style.background = "white";
            e.style.border = "1px solid black";

            f.removeAttribute('readonly');
            f.setAttribute("form", "thera_save");
            f.style.background = "white";
            f.style.border = "1px solid black";

            g.removeAttribute('readonly');
            g.setAttribute("form", "thera_save");
            g.style.background = "white";
            g.style.border = "1px solid black";

            h.removeAttribute('readonly');
            h.setAttribute("form", "thera_save");
            h.style.background = "white";
            h.style.border = "1px solid black";

            j.removeAttribute('readonly');
            j.setAttribute("form", "thera_save");
            j.style.background = "white";
            j.style.border = "1px solid black";

            about.removeAttribute('readonly');
            about.setAttribute("form", "thera_save");
            about.style.background = "white";
            about.style.resize = "none";


            btnEdit.style.display = "none";
            submit.style.display = "block";
            submit.setAttribute("form", "thera_save");

            change_word.style.display="block";
            changePhoto.style.display="block";
            camera_icon.style.display="block";
        });


        let profile_Second = document.querySelector('#profile_iconSecond');
        let profileIcon_Second = document.querySelector('#profile_iconSecond');

        let appointment_Second = document.querySelector('#UserAppointmentSecond');
        let appointmentIcon_Second = document.querySelector('#appointment_iconSecond');

        let report_Second = document.querySelector('#UserReportSecond');
        let reportIcon_Second = document.querySelector('#report_iconSecond');




        profile_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "black";


            appointmentIcon_Second.style.color = "white";

            reportIcon_Second.style.color = "white";


            profilePage.style.display = "block";
            appointmentPage.style.display = "none";
            reportPage.style.display = "none";

        });

        appointment_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "white";


            appointmentIcon_Second.style.color = "black";

            reportIcon_Second.style.color = "white";



            profilePage.style.display = "none";
            appointmentPage.style.display = "block";
            reportPage.style.display = "none";

        });

        report_Second.addEventListener('click', () => {
            profileIcon_Second.style.color = "white";


            appointmentIcon_Second.style.color = "white";

            reportIcon_Second.style.color = "black";



            profilePage.style.display = "none";
            appointmentPage.style.display = "none";
            reportPage.style.display = "block";

        });

        let changeBtn = document.querySelector('#change_password');
        let password_oldPlace = document.querySelector('#password_oldPlace');
        let password_newPlace = document.querySelector('#password_newPlace');
        let password_confPlace = document.querySelector('#password_confPlace');

        changeBtn.addEventListener('click',()=>{
          changeBtn.style.display="none";
          password_oldPlace.style.display="block";
          password_newPlace.style.display="block";
          password_confPlace.style.display="block";
          
        });

        let password_feedback = document.querySelector('#password_feedback');
        let newPassword= document.querySelector('#password_new');
        let confPassword=document.querySelector('#password_confirm');
        let save_change = document.querySelector('#change');
        save_change.addEventListener('click',()=>{
          var getNewPassword= newPassword.value;
          var getConfPassword = confPassword.value;

          if(getNewPassword != getConfPassword){
            password_feedback.style.display="block";
            event.preventDefault();
          }
        });


            // change image
    $(document).ready(function(e) {
        let $uploadfile = $('#uploadProfile');
        $uploadfile.change(function() {
          readURL(this);
        });
      });
  
      function readURL(input){
        if (input.files && input.files[0]) {
          let reader = new FileReader();
          reader.onload = function(e) {
            $("#therapist_image").attr('src', e.target.result);
            $("#thera_profile #camera_icon").css({
                display: "none"
            });
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
