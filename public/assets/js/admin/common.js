// JavaScript Document
"use strict";
var baseUrl = APP_URL + "/";
var flashstatus = $("span.flashstatus").text();
var flashmessage = $("span.flashmessage").text();
var pagetype = jQuery('input[name="pagetype"]').val();
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(document).ready(function (e) {
    $(".passwordHideShow").on("click", function () {
        $(this).find(".passwordHidden,.passwordShowed").toggleClass("d-none");
        var input = $(this).closest(".relative").find(".passwordField");
        input.attr("type") == "password"
            ? input.attr("type", "text")
            : input.attr("type", "password");
    });

    if ($.isFunction($.fn.tooltip)) {
        $('[data-toggle="tooltip"]').tooltip();
    }
    if (flashstatus == "SUCCESS") {
        $.toast({
            heading: "Success",
            text: flashmessage,
            loader: true,
            icon: "success",
            position: TOAST_POSITION,
        });
    }

    if (flashstatus == "ERROR") {
        $.toast({
            heading: "Error",
            text: flashmessage,
            loader: true,
            icon: "error",
            position: TOAST_POSITION,
        });
    }

    if (flashstatus == "INFORMATION") {
        $.toast({
            heading: "Information",
            text: flashmessage,
            loader: true,
            icon: "info",
            position: TOAST_POSITION,
        });
    }

    if (flashstatus == "WARNING") {
        $.toast({
            heading: "Warning",
            text: flashmessage,
            loader: true,
            icon: "warning",
            position: TOAST_POSITION,
        });
    }

    //toggle password

    $(document).on("click", ".toggle-password, #psd", function () {
        $(this).toggleClass("showPsd");

        var input = $("#password");
        input.attr("type") === "password"
            ? input.attr("type", "text")
            : input.attr("type", "password");
    });

    $(document).on("click", ".reload", function (e) {
        console.log("this is reload");
        location.reload();
    });
    $(document).on("click", ".addBtn", function (e) {
        var $this = $(this);
        var modalName = $this.data('modalname');
        $('#' + modalName).modal('show');
        $("#" + modalName).find('form.formsubmit').trigger('reset');
        $("#" + modalName).find('form .form-control').removeClass('is-invalid');
        $("#" + modalName).find('form .err_message').remove();
        $("#" + modalName).find('.action-name').html('Add');
    });
    $(document).on("click", ".editbtn", function (e) {
        var $this = $(this);
        var modalName = $this.data('modalname');
        $('#' + modalName).modal('show');
        $("#" + modalName).find('form.formsubmit').trigger('reset');
        $("#" + modalName).find('.action-name').html('Edit');
    });

    $("form.formsubmit").on("submit", function (e) {
        e.preventDefault();
        var $this = $(this);
        /* console.table($this); */
        var formActionUrl = $this.prop("action");
        if ($($this).hasClass("fileupload")) {
            var fd = new FormData(document.getElementById($($this).attr("id")));
        } else {
            var fd = $($this).serialize();
        }
        var $button = $(this).find('button[type="submit"]');
        var orgButtonHtml = $button.html();
        $button.prop('disabled', true); // Button Disabled after submission the form
        $button.html('<span class="spinner-border spinner-border-sm" style="color: #ff5722" role="status" aria-hidden="true"></span><span style="color: #ff5722"> Processing...</span>');
        // console.log(formActionUrl);
        let commonOption = {
            type: "post",
            url: formActionUrl,
            data: fd,
            dataType: "json",
        };
        if ($($this).hasClass("fileupload")) {
            commonOption["cache"] = false;
            commonOption["processData"] = false;
            commonOption["contentType"] = false;
        }
        // console.log(commonOption);
        // return false;
        // console.log($($this).attr('id'));
        $.ajax({
            ...commonOption,
            beforeSend: function () {},
            success: function (response) {
                $button.prop('disabled', false); // Loader Disabled
                $button.html(orgButtonHtml);
                if (response.status) {
                    if (response.data.redirect_url) {
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(function () {
                            $(location).attr(
                                "href",
                                response.data.redirect_url
                            );
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.message || "We are facing some technical issue now.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            statusCode: {
                404: function() {
                  // Handle 404 error (Not Found)
                  console.log("404 error - Resource not found");
                  Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                500: function() {
                  // Handle 500 error (Internal Server Error)
                //   console.log("500 error - Internal Server Error");
                    Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                // Add more status codes and corresponding functions as needed
              },
            error: function (response) {
                console.log(response);
                $button.prop('disabled', false); // Loader Disabled
                $button.html(orgButtonHtml);
                let responseJSON = response.responseJSON;
                $(".err_message").removeClass("d-block").hide();
                $("form .form-control").removeClass("is-invalid");
                $.each(responseJSON.errors, function (index, valueMessage) {
                    $("#" + index).addClass("is-invalid");
                    $("#" + index).after(
                        "<p class='d-block text-danger err_message'>" +
                            valueMessage +
                            "</p>"
                    );
                });

                // Swal.fire({
                //     icon: 'error',
                //     title: 'We are facing some technical issue now. Please try again after some time',
                //     showConfirmButton: false,
                //     timer: 1500
                // })
            },
            /* ,
            complete: function(response){
                location.reload();
            } */
        });
    });

    $(document).ready(function () {
        $("#country_name").on("change", function () {
            var country_name = this.value;
            $("#state_name").html("");
            $.ajax({
                type: "post",
                url: baseUrl + "ajax/get-states-by-country",
                data: {
                    country_name: country_name,
                },
                dataType: "json",
                success: function (result) {
                    $("#state_name").html(
                        '<option value="">Select State</option>'
                    );
                    $.each(result.states, function (key, value) {
                        $("#state_name").append(
                            '<option value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                    $("#city_name").html(
                        '<option value="">Select State First</option>'
                    );
                },
            });
        });
        $("#country").on("change", function () {
            var country_name = this.value;
            $("#states_name").html("");
            $.ajax({
                type: "post",
                url: baseUrl + "ajax/get-states-by-country",
                data: {
                    country_name: country_name,
                },
                dataType: "json",
                success: function (result) {
                    $("#states_name").html(
                        '<option value="">Select State</option>'
                    );
                    $.each(result.states, function (key, value) {
                        $("#states_name").append(
                            '<option value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                    $("#cities_name").html(
                        '<option value="">Select State First</option>'
                    );
                },
            });
        });
        $("#state_name").on("change", function () {
            var state_name = this.value;
            $("#city_name").html("");
            $.ajax({
                url: baseUrl + "ajax/get-cities-by-state",
                type: "post",
                data: {
                    state_name: state_name,
                },
                dataType: "json",
                success: function (result) {
                    $("#city_name").html(
                        '<option value="">Select City</option>'
                    );
                    $.each(result.cities, function (key, value) {
                        $("#city_name").append(
                            '<option value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                },
            });
        });
        $("#states_name").on("change", function () {
            var state_name = $("#states_name").val();
            console.log($("#states_name").val());
            $("#cities_name").html("");
            $.ajax({
                url: baseUrl + "ajax/get-cities-by-state",
                type: "post",
                data: {
                    states_name: state_name,
                },
                dataType: "json",
                success: function (result) {
                    $("#cities_name").html(
                        '<option value="">Select City</option>'
                    );
                    $.each(result.cities, function (key, value) {
                        $("#cities_name").append(
                            '<option value="' +
                                value.name +
                                '">' +
                                value.name +
                                "</option>"
                        );
                    });
                },
            });
        });
    });

    $(".close-btn").click(function (e) {
        $(".formsubmit").trigger("reset");
        $(".slide-from-right").removeClass("show-side-form");
    });

    $(".card-table").on("click", ".changeStatus", function (e) {
        var $this = $(this);
        var uuid = $this.data("uuid");
        var value = $this.data("value");
        var find = $this.data("table");
        var actionUrl = $this.data("action");
        var message = $this.data("message") ?? "test message";
        Swal.fire({
            title: "Are you sure you want to " + message + " it?",
            text: "The status will be changed to " + message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, " + message + " it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: baseUrl + "admin/ajax/update-status",
                    data: { uuid: uuid, find: find, value: value },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: "success",
                                title: "Status Updated!",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "We are facing some technical issue now.",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "error",
                            title: "We are facing some technical issue now. Please try again after some time",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    /* ,
                    complete: function(response){
                        location.reload();
                    } */
                });
            }
        });
    });
    $(".card-table").on("click", ".deleteData", function (e) {
        var $this = $(this);
        var uuid = $this.data("uuid");
        var find = $this.data("table");
        let actionUrl = $this.data("action");
        var message = $this.data("message") ?? "test message";
        Swal.fire({
            title: "Are you sure you want to delete it?",
            text: "You wont be able to revert this action!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: baseUrl + "admin/ajax/delete" ?? actionUrl,
                    data: { uuid: uuid, find: find },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (response) {
                        if (response.status) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "We are facing some technical issue now.",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "error",
                            title: "We are facing some technical issue now. Please try again after some time",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    },
                    /* ,
                    complete: function(response){
                        location.reload();
                    } */
                });
            }
        });
    });

    $(".this-div").on("click", ".deleteRecord", function (e) {
        let $this = $(this);
        let token = $this.data("token");
        let id = $this.data("id");
        let actionUrl = $this.data("action");

        Swal.fire({
            title: "Are you sure you want to delete it?",
            text: "You wont be able to revert this action!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then(function (value) {
            if (value.isConfirmed) {
                $.ajax({
                    url: actionUrl,
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: token,
                        id: id,
                    },
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: response.error,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }
        });
    });

    $(".card-table").on("click", ".editData", function (e) {
        var $this = $(this);
        var uuid = $this.data("uuid");
        var find = $this.data("table");
        var action = $this.data("action");
        var formModal = $this.data("form-modal");
        console.log(formModal)
        var message = $this.data("message") ?? "test message";

        $.ajax({
            type: "get",
            url: baseUrl + "admin/ajax/edit",
            data: { uuid: uuid, find: find },
            cache: false,
            dataType: "json",
            beforeSend: function () {},
            success: function (response) {
                if (response.status) {
                    let update = $("#" + formModal)
                        .find('button[type="submit"]')
                        .html("Update");
                        $("#" + formModal).find('.action_name').html('Edit');
                    $("#" + formModal)
                        .find('button[type="reset"]')
                        .html("Cancel");
                    // $("#" + formModal)
                    //     .find('button[type="reset"]')
                    //     .addClass("reload");
                    // $("#" + formModal)
                    //     .find('.form-section')
                    //     .html(response.data.html_view);
                    $("#" + formModal).modal('show');
                    $.each(response.data, function (index, valueMessage) {
                        // console.log(index);
                        $("#" + index).val(valueMessage);
                    });
                 
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "We are facing some technical issue now.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: "error",
                    title: "We are facing some technical issue now. Please try again after some time",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
            /* ,
            complete: function(response){
                location.reload();
            } */
        });
    });
    $(".formsubmit").on("change", ".getOption", function (e) {
        var $this = $(this);
        var action = $this.data("action");
        var targetSection = $this.data("target-section");
        var selectedValue =  $("#"+$this.data("selected-value")).val();
        $("#"+targetSection).html("");
        $.ajax({
            url: action,
            type: "get",
            data: {
                selected_value: selectedValue,
            },
            dataType: "json",
            success: function (result) {
                $("#"+targetSection).html(
                    '<option value="">--Select--</option>'
                );
                $.each(result.data.options, function (key, value) {
                    $("#"+targetSection).append(
                        '<option value="' +
                            value.value +
                            '">' +
                            value.name +
                            "</option>"
                    );
                });
            },
        });
    });
    $(".formsubmit").on("sumit", ".getReport", function (e) {
        e.preventDefault();
        var $this = $(this);
        /* console.table($this); */
        var formActionUrl = $this.prop("action");
            var fd = $($this).serialize();
        var $button = $(this).find('button[type="submit"]');
        var orgButtonHtml = $button.html();
        $button.prop('disabled', true); // Button Disabled after submission the form
        $button.html('<span class="spinner-border spinner-border-sm" style="color: #ff5722" role="status" aria-hidden="true"></span><span style="color: #ff5722"> Processing...</span>');
        // console.log(formActionUrl);
        let commonOption = {
            type: "post",
            url: formActionUrl,
            data: fd,
            dataType: "json",
        };      
        $.ajax({
            ...commonOption,
            beforeSend: function () {},
            success: function (response) {
                $button.prop('disabled', false); // Loader Disabled
                $button.html(orgButtonHtml);
                if (response.status) {
                    $("#" + formModal)
                    .find('.form-section')
                    .html(response.data.html_view);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: response.message || "We are facing some technical issue now.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            statusCode: {
                404: function() {
                  // Handle 404 error (Not Found)
                  console.log("404 error - Resource not found");
                  Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                500: function() {
                  // Handle 500 error (Internal Server Error)
                //   console.log("500 error - Internal Server Error");
                    Swal.fire({
                        icon: 'error',
                        title: 'We are facing some technical issue now. Please try again after some time',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                // Add more status codes and corresponding functions as needed
              },
            error: function (response) {
                console.log(response);
                $button.prop('disabled', false); // Loader Disabled
                $button.html(orgButtonHtml);
                let responseJSON = response.responseJSON;
                $(".err_message").removeClass("d-block").hide();
                $("form .form-control").removeClass("is-invalid");
                $.each(responseJSON.errors, function (index, valueMessage) {
                    $("#" + index).addClass("is-invalid");
                    $("#" + index).after(
                        "<p class='d-block text-danger err_message'>" +
                            valueMessage +
                            "</p>"
                    );
                });
            }
        });
    });
    $(".card-table").on("click", ".viewStatus", function (e) {
        var $this = $(this);
        var uuid = $this.data("uuid");
        console.log(uuid);
        var find = $this.data("table");
        var viewModal = $this.data("view-modal");
        var message = $this.data("message") ?? "test message";

        $.ajax({
            type: "get",
            url: baseUrl + "ajax/view-data",
            data: { uuid: uuid, find: find },
            cache: false,
            dataType: "json",
            beforeSend: function () {},
            success: function (response) {
                if (response.status) {
                    $("#" + viewModal).addClass("show-side-form");
                    $.each(response.data, function (index, valueMessage) {
                        console.log(index);
                        $("#" + index).val(valueMessage);
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "We are facing some technical issue now.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: "error",
                    title: "We are facing some technical issue now. Please try again after some time",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
            /* ,
            complete: function(response){
                location.reload();
            } */
        });
    });
});
function showToast(type, title, message) {
    $.toast({
        heading: title,
        text: message,
        loader: true,
        icon: type,
        position: "bottom-right",
    });
}
function getAjaxData(data, url) {
    $.ajax({
        url: url,
        type: "get",
        data: data,
        dataType: "json",
        success: function (result) {
            return result;
        },
    });
}
// Function to generate a slug from a given string
function slugify(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // Replace spaces with '-'
    str = str.replace(/\s+/g, '-');

    // Remove special characters
    str = str.replace(/[^\w-]+/g, '');

    return str;
}
let passwordInput = document.getElementById("password-login");
let eyeIcon = document.getElementById("show-pass");
if (eyeIcon) {
    eyeIcon.addEventListener("click", function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
}
