{{-- <style>
    .label-pw {
        position: relative;
    }

    .label-pw
    .password-icon {
        display: flex;
        align-items: center;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 20px;
        /* color: #f9f9f9; */
        transition: all 0.2s;
    }

    .label-pw .password-icon:hover {
        cursor: pointer;
        color: #ff4754;
    }

    .label-pw .password-icon .feather-eye-off {
        display: none;
    }
</style>
<script src="https://unpkg.com/feather-icons"></script>

<script>
    $(document).ready(function() {
        console.log("échargement fini")
    });
    feather.replace();

    const eye = document.querySelectorAll(".feather-eye");
    const eyeoff = document.querySelectorAll(".feather-eye-off");
    const passwordField = document.querySelectorAll("input[type=password]");

    eye.forEach(element => {
        element.addEventListener("click", (e) => {
            element.style.display = "none";
            let label = element.closest(".label-pw");
            label.querySelector(".feather-eye-off").style.display = "block";
            let label2 = element.closest(".label-pw");
            label2.querySelector("input[type=password]").type = "text";

            // console.log(p);
            // var p = element.closest(".feather-eye-off");
            // var p = element.parentNode.querySelector('.feather-eye-off');
            // p.style.display = "block";
            // var pass = element.parentNode.parentNode.querySelector('input[type=password]');
            // pass.type = "text";
        });
    });

    eyeoff.forEach(element => {
        element.addEventListener("click", () => {
            element.style.display = "none";
            let label = element.closest(".label-pw");
            let ee = label.querySelector(".feather-eye");
            ee.style.display = "block";

            let inp = element.closest(".label-pw").querySelector("input[type=password]");
            console.log(inp);
            inp.type = "text";


            // var p = element.parentNode.querySelector('.feather-eye');
            // p.style.display = "block";
            // var pass = element.parentNode.parentNode.querySelector('input[type=password]');
            // console.log(pass);
            // pass.type = "password";

            // eyeoff.style.display = "none";
            // eye.style.display = "block";
            // passwordField.type = "password";
        });
    });

    // const eye = document.querySelector(".feather-eye");
    // const eyeoff = document.querySelector(".feather-eye-off");
    // const passwordField = document.querySelector("input[type=password]");

    // eye.addEventListener("click", () => {
    //     eye.style.display = "none";
    //     eyeoff.style.display = "block";
    //     passwordField.type = "text";
    // });

    // eyeoff.addEventListener("click", () => {
    //     eyeoff.style.display = "none";
    //     eye.style.display = "block";
    //     passwordField.type = "password";
    // });
</script> --}}

<script>
    $(document).ready(function() {
        $('.pass_show_hide').append(
            ' <div class="password-icon"><i class="fa fa-eye"></i><i class="fa fa-eye-slash"></i></div>');
    });


    $(document).on('click', '.pass_show_hide .password-icon', function() {

        var isPass = $(this).parent().find('input').attr("type") == "password";

        if (isPass) {
            $(this).find(".fa-eye").hide();
            $(this).find(".fa-eye-slash").show();

        } else {
            $(this).find(".fa-eye").show();
            $(this).find(".fa-eye-slash").hide();
        }
        // $(this).text($(this).text() == "Show" ? "Hide" : "Show");
        $(this).parent().find("input").attr("type", isPass ? "text" : "password");
        // $(this).prev().attr('type', function(index, attr) {
        //     return attr == 'password' ? 'text' : 'password';
        // });

    });
</script>
<style>
    .pass_show_hide {
        position: relative
    }

    .pass_show_hide .ptxt {

        position: absolute;

        top: 50%;

        right: 10px;

        z-index: 1;

        color: #f36c01;

        margin-top: -10px;

        cursor: pointer;

        transition: .3s ease all;

    }

    .pass_show_hide .ptxt:hover {
        color: #333333;
    }

    .password-icon {
        display: flex;
        align-items: center;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        width: 20px;
        /* color: #f9f9f9; */
        transition: all 0.2s;
    }

    .password-icon:hover {
        cursor: pointer;
        color: #ff4754;
    }

    .password-icon .fa-eye-slash {
        display: none;
    }
</style>
