<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body style="background-color:#000">

    <section class="" style="margin: 100px; margin-top:50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">

                    <!-- <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">Logo</span>
                    </div> -->

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form id="form_login" style="width: 23rem;">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" style="color:#fff" for="form2Example18">E-MAIL</label>
                                <input type="email" name="user_email" required class="form-control form-control-lg" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" style="color:#fff" for="form2Example28">PASSWORD</label>
                                <input type="password" name="user_password" required class="form-control form-control-lg" />
                            </div>

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block" type="submit"><SMALl>LOGIN</SMALl></button>
                            </div>
                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="<?= base_url() ?>assets/images/hero.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
        $('#form_login').on('submit', function(e) {

            e.preventDefault()

            $.ajax({
                url: '<?= base_url() ?>login',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status == "true") {


                     window.location.href = "<?=base_url()?>painel/adp_prospection";

                    } else {

                        swal({
                            title: 'Opa!',
                            text: resp.message,
                            confirmButtonText: 'Entendi'
                        })
                    }
                },
                error: function(xhr, status, error) {

                    swal({
                        title: 'Opa!',
                        text: 'Ocorreu um erro inesperado.',
                        confirmButtonText: 'Entendi'
                    })
                }
            });

        })
    </script>
</body>

</html>