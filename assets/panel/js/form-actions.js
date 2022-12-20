$(function () {
    "use strict";
    
    $('.uploadavater').on("change", function (event) {
        // Stop form from submitting normally
        $('#avatar-error').hide();
        event.preventDefault();
        var $form = $(this),
        actionurl = $form.attr("action");
        //
        var errorhandle = document.querySelector('#avatar-error');

         $.ajax({
            url: actionurl,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) { 
                
                 var obj = JSON.parse(data);
                 if(obj.error == true)
                 {
                   if (obj.type == "loginRequired") {
                    window.location = "login";
                   }
                    errorhandle.innerHTML = "";
                    errorhandle.classList.add("alert-danger");
                    errorhandle.innerHTML = obj.message;
                    $('#avatar-error').show();
                 }
                 else
                 {
                    $('.useravatar').attr('src',obj.message);
                    $('.uploadavater').trigger("reset");
                 }
            },
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false
            
          });
        return false;

    });
     

    $('.showSales').on("submit", function (event) {
        event.preventDefault();
        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#showSales").html("Generating...");
        $('#showSales').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                 console.log(data);
                $("#showSales").html("Show Sales");
                $('#showSales').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.saleReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#showSales").html("Show Sales");
                    $('#showSales').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });

    $('.newSales').on("submit", function (event) {
        event.preventDefault();
        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#newSales").html("Clearing...");
        $('#newSales').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                 console.log(data);
                $("#newSales").html("New Sales");
                $('#newSales').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.saleReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#newSales").html("New Sales");
                    $('#newSales').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });

    $('.purchaseSale').on("submit", function (event) {
        event.preventDefault();
        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#purchaseSale").html("Purchasing...");
        $('#purchaseSale').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                 console.log(data);
                $("#purchaseSale").html("Purchase");
                $('#purchaseSale').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.saleReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                   $("#purchaseSale").html("Purchase");
                    $('#purchaseSale').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });

    $('.saveSales').on("submit", function (event) {
        event.preventDefault();
        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#saveSales").html("Saving...");
        $('#saveSales').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function (data) {
                 console.log(data);
                $("#saveSales").html("Save");
                $('#saveSales').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.saleReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#saveSales").html("Save");
                    $('#saveSales').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });


    $('.showService').on("submit", function (event) {
        event.preventDefault();
        var form = $('.ServiceForm')[0];
        var fData = new FormData(form);
        fData.append("saleid", $("#saleid").val());


        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#showService").html("Generating...");
        $('#showService').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            success: function (data) {
                 console.log(data);
                $("#showService").html("Show Service");
                $('#showService').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.serviceReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#showService").html("Show Service");
                    $('#showService').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: fData,
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });


    $('.newService').on("submit", function (event) {
        event.preventDefault();
        var form = $('.ServiceForm')[0];
        var fData = new FormData(form);
        fData.append("saleid", $("#saleid").val());


        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#newService").prop("value", "Clearing...");
        $('#newService').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            success: function (data) {
                 console.log(data);
                $("#newService").prop("value", "New Service");
                $('#newService').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.serviceReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#showService").html("New Service");
                    $('#showService').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: fData,
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });


    $('.addService').on("submit", function (event) {
        event.preventDefault();
        var form = $('.ServiceForm')[0];
        var fData = new FormData(form);
        fData.append("saleid", $("#saleid").val());


        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#addService").html("Adding...");
        $('#addService').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            success: function (data) {
                 console.log(data);
                $("#addService").html("Add Service");
                $('#addService').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.serviceReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#addService").html("Add Service");
                    $('#addService').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: fData,
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });

    $('.saveService').on("submit", function (event) {
        event.preventDefault();
        var form = $('.ServiceForm')[0];
        var fData = new FormData(form);
        fData.append("saleid", $("#saleid").val());


        var actionurl = $(this).attr("action");
        jQuery('.display_error').html('');
        $("#saveService").html("Saving...");
        $('#saveService').prop('disabled', true);
        var errorhandle = document.querySelector(".display_error");
        $.ajax({
            url: actionurl,
            type: 'POST',
            success: function (data) {
                 console.log(data);
                $("#saveService").html("Save");
                $('#saveService').prop('disabled', false);
                var obj = JSON.parse(data);
                if (!obj.error) {
                  jQuery('.serviceReceipt').html(obj.msg+'<br><br>');
                }else{
                  jQuery('.display_error').html(obj.msg+'<br><br>');
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#saveService").html("Save");
                    $('#saveService').prop('disabled', false);
                    errorhandle.classList.remove("hide");
                       $('<span>'+XMLHttpRequest.responseText+'</span><br><br>').appendTo(errorhandle);
            },
            data: fData,
            cache: false,
            contentType: false,
            processData: false
            
          });   
     });
 

     
});

