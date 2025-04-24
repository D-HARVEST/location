{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<script>
    function findAncestor(el, sel) {
        while ((el = el.parentElement) && !((el.matches || el.matchesSelector).call(el, sel)));
        return el;
    }

    $('.form-file').change(function(event) {
        const target = event.target
        if (target.files && target.files[0]) {

            const maxAllowedSize = 2 * 1024 * 1024;
            if (target.files[0].size > maxAllowedSize) {
                // Here you can ask your users to load correct file
                target.value = ''

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Le fichier choisi est trop volumineux Sa taille dépasse 2 Mo. \n',
                })
            } else {
                //target.parent.submit();
                //console.log('tt deb 11');

                var tt = findAncestor(target, 'form')
                console.log('tt deb');

                tt.submit();
                console.log('tt fin');

            }
        }
    });
    $('.form-file-sub').change(function(event) {
        const target = event.target
        if (target.files && target.files[0]) {

            const maxAllowedSize = 2 * 1024 * 1024;
            if (target.files[0].size > maxAllowedSize) {
                // Here you can ask your users to load correct file
                target.value = ''

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Le fichier choisi est trop volumineux Sa taille dépasse 2 Mo. \n',
                })
            } else {
                //target.parent.submit();
                var tt = findAncestor(target, 'form')
                tt.submit();

            }
        }
    });

    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cet action est irréversible",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });


    $('.show_info_banque').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        //event.preventDefault();
        let timerInterval
        Swal.fire({
            title: 'Information',
            html: "<ul style='text-align:start'> <li>Modifier juste la colonne du RIB</li><li>Ne Modifiez pas l'ordre des colonnes svp !</li> <li>Vous pourrez ajouter d'autres colonnes à la fin si besoin, elles seront ignoré</li> </ul>",
            icon: 'warning',

            // timer: 10000,
            // timerProgressBar: true,
            // didOpen: () => {
            //     Swal.showLoading()
            //     const b = Swal.getHtmlContainer().querySelector('b')
            //     timerInterval = setInterval(() => {
            //         b.textContent = Swal.getTimerLeft()
            //     }, 100)
            // },
            // willClose: () => {
            //     clearInterval(timerInterval)
            // }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
            return true;
        })

        // Swal.fire({
        //     title: 'Êtes-vous sûr ?',
        //     text: "Cet action est irréversible",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Supprimer',
        //     cancelButtonText: 'Annuler'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         form.submit();
        //     }
        // });


    });
    $('.back-btn').click(function(event) {
        //history.back()
        window.location = document.referrer;
        //window.location.reload(history.back());
    });



    $('.show_confirm2').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cet action est irréversible",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Double confirmation : Cet action est irréversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
            text - bold
        });


    });


    $(".card").addClass('border-radius-xl shadow');
</script>

<style>
    .text-bold {
        font-weight: 600;
    }

    .rounded {
        border-radius: 15px;
    }

    .rounded-05 {
        border-radius: 0.25rem !important;
        border-top-left-radius: !important;
        border-top-right-radius: !important;
        border-bottom-right-radius: !important;
        border-bottom-left-radius: !important;
    }
</style>
<style>
    .dtr-details li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        align-content: center
    }

    .dtr-data {
        text-align: right
    }
</style>
<style>
    .card-header {
        background-color: rgba(0, 0, 0, 0.1);

    }

    .form-control {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .bg-gray-200 {
        background-color: rgba(0, 0, 0, 0.1);

    }

    #uil li {
        /* border: none; */
    }

    .bgg {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.1);
        color: black;
        border-radius: 5px;

    }
</style>

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css"> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> --}}
{{--
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script> --}}

<script>
    // $('select').selectpicker();
    // $("select[multiple='multiple']").bsMultiSelect();
    // $("select[multiple='multiple']").bsMultiSelect({
    //           setSelected: function(option /*element*/, value /*true|false*/){
    //               if (value)
    //                   option.setAttribute('selected','');
    //               else
    //                   option.removeAttribute('selected');
    //               option.selected = value;
    //           }
    //       });

    var input = document.querySelector("#phone"),
        errorMsg = document.querySelector("#error-msg"),
        validMsg = document.querySelector("#valid-msg");

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var iti = window.intlTelInput(input, {
        utilsScript: "../../build/js/utils.js?1638200991544"
    });

    var reset = function() {
        input.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
    };

    // on blur: validate
    input.addEventListener('blur', function() {
        reset();
        if (input.value.trim()) {
            if (iti.isValidNumber()) {
                validMsg.classList.remove("hide");
            } else {
                input.classList.add("error");
                var errorCode = iti.getValidationError();
                errorMsg.innerHTML = errorMap[errorCode];
                errorMsg.classList.remove("hide");
            }
        }
    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
</script>
