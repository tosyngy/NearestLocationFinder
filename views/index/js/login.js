
$(function () {
    var validaUser = function validaUser() {
        $("#login-form").on("submit", false);
        $.post("?signin=2", $("#login-form").serialize(), function (data) {
            data = $.trim(data);
            if (data === "1") {
                var url = "../dash/category.php";
                $(location).attr('href', url);
            } else {
                fadeContent("#err-login", "Invalid Username or Password");
            }
        });
    };
    $('#admin_login').on('click', function () {
        validaUser();
    });
});


$(function () {

    $(".signup").click(function (e) {
        e.preventDefault();
        $(".reg-form").on("submit", false);
        var i = 0;
        var cu = /^[A-Za-z]{2,50}$/;
        var value = /^[A-Za-z0-9_!@#$%^&*()]{6,299}$/;
        var usrn = $('.reg-username').val();
        var email = $('.reg-email').val();
        var pwd = $('.reg-password').val();
        var pwd1 = $('.reg-pass').val();
        var myNum = new Number(usrn.substring(0, 1));
        //        alert(email);
        //        alert(usrn2);
        //        alert(user_type);
        //        alert(country);
        //        alert(pwd); 
        //        alert(pwd1);
        if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
            //  $('.signup-test').replaceWith("<span class='signup-test'>Username must be between 5 to 15 Characters and must not begins with digit not with Special Symbol except underscore</span>");
            fadeContent(".reg-email-res", "Incorrect  email address, Enter a valid address");
            i = 1;
            $(".reg-email").focus();
            $(".reg-email").select();
            e.preventDefault();
            return;
        }
        if ((!usrn.match(cu) || !isNaN(myNum)) && (usrn.length<5)) {
            //  $('.signup-test').replaceWith("<span class='signup-test'>Username must be between 5 to 15 Characters and must not begins with digit not with Special Symbol except underscore</span>");
            fadeContent(".reg-username-res", "Username must be valid characters more than between 4");
            i = 1;
            $(".reg-username").focus();
            $(".reg-username").select();
            e.preventDefault();
            return;
        }
        
        if (pwd !== pwd1) {
            //     $('.signup-test').replaceWith("<span class='signup-test'>password does not match</span>");
            fadeContent(".reg-password-res", "password does not match");
            $('.reg-password').val("");
            $('.reg-pass').val("");
            i = 1;
            $('.reg-password').focus();
            $('.reg-password').select();
            e.preventDefault();
            return;
        }
        if (!pwd.match(value)) {
            //  $('.signup-test').replaceWith("<span class='signup-test'>Password must be upto 6 Characters<br /> NOTE: Some Special Sybmbols not allow, allowed Symbols are !@#$%^&*()_</span>");
            fadeContent(".reg-password-res", "Password must be up to 6 Characters");
            $('.reg-password').val("");
            $('.reg-pass').val("");
            i = 1;
            $(".reg-password").focus();
            $(".reg-password").select();
            e.preventDefault();
            return;
        }
        var val6 = /[0-9]/;
        var val5 = /[_!@#$%^&*()]/;
        var val4 = /[A-Z]/;
        var val3 = /[a-z]/;
        var pass = pwd;
        var test6 = (val6.test(pass) && val5.test(pass));
        var test5 = (val6.test(pass) && val4.test(pass));
        var test4 = (val6.test(pass) && val3.test(pass));
        var test3 = (val5.test(pass) && val4.test(pass));
        var test2 = (val5.test(pass) && val3.test(pass));
        var test1 = (val4.test(pass) && val3.test(pass));
        //
        //
        if (!test6 && !test5 && !test4 && !test3 && !test2 && !test1) {
            //   $('.signup-test').replaceWith("<span class='signup-test'>Password too weak Try to combine atleast two among this sets; alphabet,digit,or symbols to make a strong password</span>");
            fadeContent(".reg-password-res", "Password too weak combine atleast two sets");
            $('.reg-password').val("");
            $('.reg-pass').val("");
            i = 1;
            $('.reg-password').focus();
            $('.reg-password').select();
            e.preventDefault();
            return;
        }
        if (pwd.toLowerCase().match(usrn.toLowerCase())) {
            //  $('.signup-test').replaceWith("<span class='signup-test'>your password look like your username choose a new password please</span>");
            fadeContent(".reg-password-res", "your password look like your name");
            $('.reg-password').val("");
            $('.reg-pass').val("");
            i = 1;
            $('.reg-password').focus();
            $('.reg-password').select();
            e.preventDefault();
            return;
        }
       
        
        if (i === 0) {
            signupUser();
        }
        return;
    });
    var signupUser = function signupUser() {
        $.post("?signup=2", $("#reg-form").serialize(), function (data) {
            data = $.trim(data);
            if (data === "1") {                    
                var url = "../dash/category.php";
                $(location).attr('href', url);
            }
            else if (data === "0") {
                fadeContent(".reg-email-res", "Email already exist");
                $('.reg-email').val("");
                $(".reg-email").focus();
                $(".reg-email").select();
            }
            else if (data === "-1") {
                fadeContent(".reg-username-res", "Username already exist");
                $('.reg-username').val("");
                $(".reg-username").focus();
                $(".reg-username").select();
            }
        });
      
    };

});

function fadeContent(node, lebel) {
    $(node).text(lebel);
    $(node).css({
        display: 'block',
        "font-weight": 'bold',
        "color": "rgba(255,21,25,.8)",
        "text-shadow": "10",
        "text-align": "center",
        "font-size": "12px"
      
    });
    $(node).animate({
        top: ['-20', "swing"]
    }, 300);
    $(node).animate({
        left: ['-20', "swing"]
    }, 300);
    $(node).animate({
        left: ['20', "swing"]
    }, 300);
    $(node).animate({
        left: ['0', "swing"]
    }, 300);
    setTimeout(function () {
        $(node).fadeOut();
    }, 3000);
}