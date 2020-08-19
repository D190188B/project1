
    function show1() { //show Client Profile
        var i = document.getElementById("user");
        var y = document.getElementById("appointment");
        var p = document.getElementById("payment");
        i.style.fontWeight = "800";
        i.style.borderBottom = "1px solid black";
        i.style.borderRadius = "1px";

        y.style.borderBottom = "none";
        y.style.borderRadius = "none";
        y.style.fontWeight = "500";

        p.style.borderBottom = "none";
        p.style.borderRadius = "none";
        p.style.fontWeight = "500";

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
        i.style.borderBottom = "none";
        i.style.borderRadius = "none";
        i.style.fontWeight = "500";

        y.style.borderBottom = "1px solid black";
        y.style.borderRadius = "1px";
        y.style.fontWeight = "800";

        p.style.borderBottom = "none";
        p.style.borderRadius = "none";
        p.style.fontWeight = "500";

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
        i.style.borderBottom = "none";
        i.style.borderRadius = "none";
        i.style.fontWeight = "500";

        y.style.borderBottom = "none";
        y.style.borderRadius = "none";
        y.style.fontWeight = "500";

        p.style.borderBottom = "1px solid black";
        p.style.borderRadius = "1px";
        p.style.fontWeight = "800";

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
    let edit = document.querySelector('#editPlace');

    //Edit
    btnEdit.addEventListener('click',()=>{
        //create button
        let btnSubmit = document.createElement('button');
        btnSubmit.id="submit";
        btnSubmit.name="submit";
        btnSubmit.innerHTML="Save Changes";
        btnSubmit.setAttribute("value","Save Changes");
        btnSubmit.setAttribute("class","btn btn-outline-success");
        btnSubmit.setAttribute("form","save");
        edit.appendChild(btnSubmit);
        
        //hide the edit button
        btnEdit.style.display="none";

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
    });
    