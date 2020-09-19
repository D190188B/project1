$(document).ready(function (e) {
    $(".thera").click(function () {
        var theraID = $(this).attr('data-theraid');
        var theraFName = $(this).attr('data-therafname');
        var theraLName = $(this).attr('data-theralname');
        var theraAbout = $(this).attr('data-theraabout');
        var theraGender = $(this).attr('data-theragender');
        var theraAge = $(this).attr('data-theraage');
        var theraEmail = $(this).attr('data-theraemail');
        var theraPhone = $(this).attr('data-theraphone');
        var theraIC = $(this).attr('data-theraic');
        var theraAddress = $(this).attr('data-theraaddress');
        var theraCity = $(this).attr('data-theracity');
        var theraPost = $(this).attr('data-therapost');
        var theraState = $(this).attr('data-therastate');
        var theraLicense = $(this).attr('data-theralicense');
        var theraResume = $(this).attr('data-theraresume');
        var theraProfile = $(this).attr('data-theraprofile');
        // var theraMalay = $(this).attr('data-theraMalay');
        // var theraMandarin = $(this).attr('data-theraMandarin');
        // var theraEnglish = $(this).attr('data-theraEnglish');


        $("#image").attr('src', theraProfile);
        $('#id').val(theraID);
        $('#firstname').val(theraFName);
        $('#lastName').val(theraLName);
        $('#email').val(theraEmail);
        $('#about').val(theraAbout);
        $('#gender').val(theraGender);
        $('#age').val(theraAge);
        $('#phone').val(theraPhone);
        $('#ic').val(theraIC);
        $('#address').val(theraAddress);
        $('#city').val(theraCity);
        $('#postCode').val(theraPost);
        $('#state').val(theraState);
        $('#license').val(theraLicense);
        $('#resume').attr('src', theraResume);
        $('#therapistDetail').modal("show");
    });


    $('#searchText').keyup(function () {
        var txt = $('#searchText').val();
        $.ajax({
            url: "insert.php",
            method: "post",
            data: {
                search: txt
            },
            dataType: "text",
            success: function (data) {
                $('#results').html(data);
            }
        });

    });

    $(".custom-select").change(function () {
        var license = $(".custom-select").val();
        $.ajax({
            url: "insert.php",
            method: "post",
            data: {
                getLicense: license
            },
            dataType: "text",
            success: function (data) {
                $('#results').html(data);
            }
        });

    });


    $(".thera").click(function () {
        var theraID = $(this).attr('data-theraid');
        var theraFName = $(this).attr('data-therafname');
        var theraLName = $(this).attr('data-theralname');
        var theraAbout = $(this).attr('data-theraabout');
        var theraGender = $(this).attr('data-theragender');
        var theraAge = $(this).attr('data-theraage');
        var theraEmail = $(this).attr('data-theraemail');
        var theraPhone = $(this).attr('data-theraphone');
        var theraIC = $(this).attr('data-theraic');
        var theraAddress = $(this).attr('data-theraaddress');
        var theraCity = $(this).attr('data-theracity');
        var theraPost = $(this).attr('data-therapost');
        var theraState = $(this).attr('data-therastate');
        var theraLicense = $(this).attr('data-theralicense');
        var theraResume = $(this).attr('data-theraresume');
        var theraProfile = $(this).attr('data-theraprofile');
        // var theraMalay = $(this).attr('data-theraMalay');
        // var theraMandarin = $(this).attr('data-theraMandarin');
        // var theraEnglish = $(this).attr('data-theraEnglish');

        $("#image").attr('src', theraProfile);
        $('#id').val(theraID);
        $('#firstname').val(theraFName);
        $('#lastName').val(theraLName);
        $('#email').val(theraEmail);
        $('#about').val(theraAbout);
        $('#gender').val(theraGender);
        $('#age').val(theraAge);
        $('#phone').val(theraPhone);
        $('#ic').val(theraIC);
        $('#address').val(theraAddress);
        $('#city').val(theraCity);
        $('#postCode').val(theraPost);
        $('#state').val(theraState);
        $('#license').val(theraLicense);
        $('#resume').attr('src', theraResume);
        $('#therapistDetail').modal("show");
    });


    $(".client").click(function() {
        var clientID = $(this).attr('data-clientid');
        var clientFName = $(this).attr('data-clientfname');
        var clientLName = $(this).attr('data-clientlname');
        var clientBirth = $(this).attr('data-clientbirth');
        var clientPhone = $(this).attr('data-clientphone');
        var clientAddress = $(this).attr('data-clientaddress');
        var clientCity = $(this).attr('data-clientcity');
        var clientPost = $(this).attr('data-clientpost');
        var clientState = $(this).attr('data-clientstate');
        var clientEmail = $(this).attr('data-clientemail');
        var clientImage = $(this).attr('data-clientimage');


        $("#image").attr('src', clientImage);
        $('#id').val(clientID);
        $('#firstname').val(clientFName);
        $('#lastName').val(clientLName);
        $('#birth').val(clientBirth);
        $('#email').val(clientEmail);
        $('#phone').val(clientPhone);
        $('#address').val(clientAddress);
        $('#city').val(clientCity);
        $('#postCode').val(clientPost);
        $('#state').val(clientState);
        $('#clientDetail').modal("show");
    });

});
