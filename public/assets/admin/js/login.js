var SnippetLogin = function() {
    var e = $("#m_login"),
        i = function(e, i, a) {
            var t = $('<div class="m-alert m-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            e.find(".alert").remove(), t.prependTo(e), t.animateClass("fadeIn animated"), t.find("span").html(a)
        },
        a = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signin"), e.addClass("m-login--signup"), e.find(".m-login__signup").animateClass("flipInX animated")
        },
        t = function() {
            e.removeClass("m-login--forget-password"), e.removeClass("m-login--signup"), e.addClass("m-login--signin"), e.find(".m-login__signin").animateClass("flipInX animated")
        },
        r = function() {
            e.removeClass("m-login--signin"), e.removeClass("m-login--signup"), e.addClass("m-login--forget-password"), e.find(".m-login__forget-password").animateClass("flipInX animated")
        },
        n = function() {
            $("#m_login_forget_password").click(function(e) {
                e.preventDefault(), r()
            }), $("#m_login_forget_password_cancel").click(function(e) {
                e.preventDefault(), t()
            }), $("#m_login_signup").click(function(e) {
                e.preventDefault(), a()
            }), $("#m_login_signup_cancel").click(function(e) {
                e.preventDefault(), t()
            })
        },
        l = function() {
            $("#m_login_signin_submit").click(function(e) {
                e.preventDefault();
                var a = $(this),
                    t = $(this).closest("form");
                t.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        }
                    },
                    messages: {

                        email: {
                            required: "Введите email",
                            email: "Введите корректный email"
                        },
                        password: {
                            required: "Введите пароль"
                        }
                    }
                }),
                        t.valid() && (t.submit())
                /*
                t.valid() && (a.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0), t.ajaxSubmit({
                    url: "",
                    success: function(e, r, n, l) {
                        setTimeout(function() {
                            a.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1), i(t, "danger", "Incorrect username or password. Please try again.")
                        }, 2e3)
                    }
                }))
                */
            })
        },

        o = function() {
            $("#m_login_forget_password_submit").click(function(a) {
                 a.preventDefault();
                var r = $(this),
                    n = $(this).closest("form");

                n.validate({
                    rules: {
                        recover_phone: {
                            required: !0
                        }
                    },
                    messages: {
                            recover_phone: {
                                    required: "Введите номер телефона"
                            }
                    },
                });

                if(n.valid()) {


                    $.ajax({
                            type: 'POST',
                            url: n.attr('action'),
                            data: n.serialize(),
                            beforeSend: function () {
                                    console.log('before');
                                    r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0)
                            },
                            success: function (data) {
                                    var recover_frm = $('#recover_pwd_modal form');
                                    $('input[name="phone"]', recover_frm).val(n.find('input[name="recover_phone"]').val());
                                    $('#recover_pwd_modal').modal('show');
                            },
                            error: function (xhr, data) {
                                var data = xhr.responseJSON;

                                $.each(data.errors, function(index, item) {
                                        i(n, "danger", item)
                                })
                            },
                            complete: function () {
                                    r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1)
                            },
                            dataType: 'json'
                    });
                }

                /*
                a.preventDefault();
                var r = $(this),
                    n = $(this).closest("form");
                n.validate({
                    rules: {
                        email: {
                            required: !0,
                            email: !0
                        }
                    }
                }), n.valid() && (r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0),
                    n.ajaxSubmit({
                        url: "",
                        success: function(a, l, s, o) {
                            setTimeout(function() {
                                r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1),
                                    n.clearForm(), n.validate().resetForm(), t();
                                var a = e.find(".m-login__signin form");
                                a.clearForm(), a.validate().resetForm(), i(a, "success", "Cool! Password recovery instruction has been sent to your email.")
                            }, 2e3)
                        }
                    }))*/
            });

            $('#confirm_recover_code').click(function(e) {
                e.preventDefault();

                var m = $('#recover_pwd_modal');
                var r = $(this);
                //r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                
                var n = m.find("form");

                n.validate({
                    rules: {
                        recover_code: {
                            required: !0,
                        },
                        password: {
                            required: !0,
                            minlength: 6
                        }
                    },
                    messages: {

                        recover_code: {
                            required: "Введите код"
                        },
                        password: {
                            required: "Введите пароль",
                            minlength: jQuery.validator.format("Пароль должен быть не менее {0} символов.")
                        }
                    }
                });

                if(n.valid()) {
                    $.ajax({
                            type: 'POST',
                            url: n.attr('action'),
                            data: n.serialize(),
                            beforeSend: function () {
                                    r.addClass("m-loader m-loader--right m-loader--light").attr("disabled", !0);
                            },
                            success: function (data) {
                                n.clearForm(), n.validate().resetForm(), t();
                                var a = $(".m-login__signin form");
                                a.clearForm(), a.validate().resetForm();
                                //console.log(data);

                                $.each(data.messages, function(index, item) {
                                        i(a, "success", item)
                                })

                            },
                            error: function (xhr, data) {
                                var data = xhr.responseJSON;

                                $.each(data.errors, function(index, item) {
                                        i(n, "danger", item)
                                })
                            },
                            complete: function () {
                                r.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", !1);
                                m.modal('hide');
                            },
                            dataType: 'json'
                    });
                }


            });
        };
    return {
        init: function() {
            n(), l(), o()
        }
    }
}();
jQuery(document).ready(function() {
    SnippetLogin.init();
});
/*

$(document).ready(function() {
        $('#login_form').submit(function() {
                var $form = $(this);

                $.ajax({
                        url: $form.attr('action'),
                        type: 'post',
                        data: $form.serialize(),
                      success: function(data) {
                         // handle the successful response
                              if(data.url) {
                                      window.location = url;
                              }
                      },
                      error: function(data){
                        toastr.error(data.message);
                      }
                });

                return false;
        });
});
        */