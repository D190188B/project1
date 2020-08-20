
    function show1() { //show Client Profile
        var i = document.getElementById("user");
        var y = document.getElementById("appointment");
        var p = document.getElementById("payment");
        var icon = document.getElementById("userIcon");
        var appo = document.getElementById("userAppointment");
        var pay = document.getElementById("userPayment");

        icon.style.color="black";
        appo.style.color="silver";
        pay.style.color="silver";

        i.style.borderBottom = "1px solid black";
        i.style.borderRadius = "1px";
        i.style.color="black";

        y.style.borderBottom = "none";
        y.style.borderRadius = "none";
        y.style.color="silver"

        p.style.borderBottom = "none";
        p.style.borderRadius = "none";
        p.style.color="silver";

        var t = document.getElementById("showInfo");
        var a = document.getElementById("showAppointment");
        var b = document.getElementById("showPayment");

        t.style.display = "block";
        a.style.display = "none";
        b.style.display = "none";
    }

    function show2() { // show Client Appointment History
        var i = document.getElementById("user");
        var y = document.getElementById("appointment");
        var p = document.getElementById("payment");
        var icon = document.getElementById("userIcon");
        var appo = document.getElementById("userAppointment");
        var pay = document.getElementById("userPayment");

        icon.style.color="silver";
        appo.style.color="black";
        pay.style.color="silver";

        i.style.borderBottom = "none";
        i.style.borderRadius = "none";
        i.style.color="silver"

        y.style.borderBottom = "1px solid black";
        y.style.borderRadius = "1px";
        y.style.color="black";

        p.style.borderBottom = "none";
        p.style.borderRadius = "none";
        p.style.color="silver";

        var t = document.getElementById("showInfo");
        var a = document.getElementById("showAppointment");
        var b = document.getElementById("showPayment");

        t.style.display = "none";
        a.style.display = "block";
        b.style.display = "none";
    }

    function show3() { //show Client Payment list
        var i = document.getElementById("user");
        var y = document.getElementById("appointment");
        var p = document.getElementById("payment");
        var icon = document.getElementById("userIcon");
        var appo = document.getElementById("userAppointment");
        var pay = document.getElementById("userPayment");

        icon.style.color="silver";
        appo.style.color="silver";
        pay.style.color="black";

        i.style.borderBottom = "none";
        i.style.borderRadius = "none";
        i.style.color="silver";

        y.style.borderBottom = "none";
        y.style.borderRadius = "none";
        y.style.color="silver";

        p.style.borderBottom = "1px solid black";
        p.style.borderRadius = "1px";
        p.style.color="black";

        var t = document.getElementById("showInfo");
        var a = document.getElementById("showAppointment");
        var b = document.getElementById("showPayment");

        t.style.display = "none";
        a.style.display = "none";
        b.style.display = "block";
    }


    let btnEdit = document.querySelector('#edit');
    let a =document.querySelector('#nameFirst');
    let b =document.querySelector('#nameLast');
    let c =document.querySelector('#email');
    let d =document.querySelector('#phone');
    let e =document.querySelector('#address');
    let f =document.querySelector('#state');
    let g =document.querySelector('#postCode');
    let h =document.querySelector('#birth');
    let i =document.querySelector('#changePro');
    let j =document.querySelector('#uploadProfile');
    let edit = document.querySelector('#editPlace');
    let btnSubmit = document.querySelector('#submit');
    let btnCancel = document.querySelector('#cancel');


    //Edit
    btnEdit.addEventListener('click',()=>{
        //create button
        
        //hide the edit button
        btnEdit.style.display="none";
        btnSubmit.style.display="block";
        btnCancel.style.display="block";

        //remove all the readonly
        a.removeAttribute('readonly');
        a.setAttribute("form","save");
        a.style.background="white";
        a.style.border="1px solid black";
        

        b.removeAttribute('readonly');
        b.setAttribute("form",("save"))
        b.style.background="white";
        b.style.border="1px solid black";

        d.removeAttribute('readonly');
        d.setAttribute("form","save");
        d.style.background="white";
        d.style.border="1px solid black";

        e.removeAttribute('readonly');
        e.setAttribute("form","save");
        e.style.background="white";
        e.style.border="1px solid black";

        f.removeAttribute('readonly');
        f.setAttribute("form","save");
        f.style.background="white";
        f.style.border="1px solid black";

        g.removeAttribute('readonly');
        g.setAttribute("form","save");
        g.style.background="white";
        g.style.border="1px solid black";

        i.style.display="block";
        j.style.display="block";
    });



    btnCancel.addEventListener('click',()=>{
        btnEdit.style.display="block";
        btnSubmit.style.display="none";
        btnCancel.style.display="none";

        a.setAttribute('readonly',true);
        a.removeAttribute("form");
        a.style.background="rgb(231, 231, 231)";
        a.style.border="none";

        b.setAttribute('readonly',true);
        b.removeAttribute("form");
        b.style.background="rgb(231, 231, 231)";
        b.style.border="none";

        d.setAttribute('readonly',true);
        d.removeAttribute("form");
        d.style.background="rgb(231, 231, 231)";
        d.style.border="none";

        e.setAttribute('readonly',true);
        e.removeAttribute("form");
        e.style.background="rgb(231, 231, 231)";
        e.style.border="none";

        f.setAttribute('readonly',true);
        f.removeAttribute("form");
        f.style.background="rgb(231, 231, 231)";
        f.style.border="none";

        g.setAttribute('readonly',true);
        g.removeAttribute("form");
        g.style.background="rgb(231, 231, 231)";
        g.style.border="none";
        

        i.style.display="none";
        j.style.display="none";
    });


    
    
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
          $("#user_image").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
