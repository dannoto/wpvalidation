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
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 d-flex">
                            <button data-toggle="modal" data-target="#modal_add_target" class="btn btn-primary mr-5"><i class="fa fa-plus"></i> <small>ADICIONAR</small></button>

                            <form action="<?= base_url() ?>painel/adp_prospection_list">
                                <div class="d-flex">
                                    <input name="query" value="<?= htmlspecialchars($this->input->get('query')) ?>" class="form-control" type="text">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-4 d-flex mt-3 mb-3">
                            <div class="d-flex">
                                <center>
                                    <span class="ml-2 mr-2" style="color:#FFF"><?= count($this->tung_model->get_adp_target())   ?></span>
                                </center>
                            </div>
                            <!-- <div class="d-flex">
                                <a href="<?= base_url() ?>painel/adp_prospection_list">
                                    <button class="mr-3 btn btn-outline-success"><i class="fa fa-check"></i> <small>APTOS</small></button>
                                </a>
                            </div>
                            <form action="<?= base_url() ?>painel/adp_prospection_list">
                                <div class="d-flex">
                                    <input name="inapto" value="1" class="form-control" type="hidden">
                                    <button class=" btn btn-outline-warning"><i class="fa fa-close"></i> <small>INAPTOS</small></button>
                                </div>
                            </form> -->
                        </div>
                    </div>
                    <div style="margin:50px;margin-top:10px">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;text-align:center" scope="col">NOME</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">PLATAFORMA</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">URL</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">EMAIL</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">CREDENCIAIS</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (strlen($this->input->get('query')) > 0) { ?>

                                    <?php foreach ($this->tung_model->search_adp_target(htmlspecialchars($this->input->get('query'))) as $adp) { ?>
                                        <tr>
                                            <td style="text-align: center;font-size:12px" title="<?= $adp->alvo_nome ?>"><?= substr($adp->alvo_nome, 0, 15); ?>...</td>
                                            <td style="text-align: center;font-size:12px"><?= getLabel($adp->alvo_plataforma) ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <a title="Site" href="https://<?= $adp->alvo_url ?>" target="_blank"><i class="fa fa-link"></i></a>
                                                <a title="Painel Administrador" href="https://<?= $adp->alvo_url ?>/wp-admin" target="_blank"><i style="color:red" class="fa fa-link"></i></a>
                                                <a title="Pagina de Vendas" href="<?= $adp->alvo_produto_link ?>" target="_blank"><i style="color:yellow" class="fa fa-link"></i></a>
                                            </td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->alvo_email ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <small><?= $adp->alvo_data ?></small><br>
                                                <?php if ($this->main_model->is_alvo_owned($adp->alvo_url)) { ?>


                                                    <?php echo ' <a target="_blank" href="' . base_url() . 'painel/adp_prospection_list_edit/' . $adp->id . '"><span class="badge badge-success"><i class="fa fa-check"></i>  ATIVO<span/></a> '; ?>

                                                <?php } else { ?>

                                                    <div class="d-flex">
                                                        <?php echo '<a target="_blank" href="' . base_url() . 'painel/adp_prospection_list_edit/' . $adp->id . '"><span class="badge badge-danger"><i class="fa fa-link"></i> PAYLOADS<span/> </a>'; ?>

                                                        <?php echo '<a target="_blank" href="' . base_url() . 'painel/adp_scanner/' . $adp->id . '"><span class="badge badge-primary"><i class="fa fa-link"></i> SCANNER<span/> </a>'; ?>

                                                    </div>

                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;font-size:12px">

                                                <?php if ($adp->inapto == 0) { ?>



                                                    <?php if (count($this->main_model->countCredenciaisByUrl($adp->alvo_url)) == 1) { ?>

                                                    <?php } else { ?>
                                                        <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_modal_update_target" data-toggle="modal" data-target="#modal_update_target">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <!-- <button onclick="inaptoTarget(<?= $adp->id ?>)" id=" <?= $adp->id ?>" title="INAPTO" type="button" class="btn btn-warning">
                                                            <i class="fas fa-close"></i>
                                                        </button> -->

                                                        <button onclick="deleteTarget(<?= $adp->id ?>)" id="<?= $adp->id ?>" title="EXCLUIR" type="button" class="btn btn-danger">
                                                            <i class="fas fa-close"></i>
                                                        </button>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_modal_update_target" data-toggle="modal" data-target="#modal_update_target">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>


                                        </tr>
                                    <?php } ?>

                                <?php } else { ?>

                                    <?php foreach ($this->tung_model->get_adp_target() as $adp) { ?>
                                        <tr>
                                            <td style="text-align: center;font-size:12px" title="<?= $adp->alvo_nome ?>"><?= substr($adp->alvo_nome, 0, 15); ?>...</td>
                                            <td style="text-align: center;font-size:12px"><?= getLabel($adp->alvo_plataforma) ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <a title="Site" href="https://<?= $adp->alvo_url ?>" target="_blank"><i class="fa fa-link"></i></a>
                                                <a title="Painel Administrador" href="https://<?= $adp->alvo_url ?>/wp-admin" target="_blank"><i style="color:red" class="fa fa-link"></i></a>
                                                <a title="Pagina de Vendas" href="<?= $adp->alvo_produto_link ?>" target="_blank"><i style="color:yellow" class="fa fa-link"></i></a>
                                            </td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->alvo_email ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <small><?= $adp->alvo_data ?></small><br>

                                                <?php if ($this->main_model->is_alvo_owned($adp->alvo_url)) { ?>
                                                    <?php echo ' <a target="_blank" href="' . base_url() . 'painel/adp_prospection_list_edit/' . $adp->id . '"><span class="badge badge-success"><i class="fa fa-check"></i>  ATIVO<span/></a> '; ?>
                                                <?php } else { ?>
                                                    <div class="d-flex">
                                                        <?php echo '<a target="_blank" href="' . base_url() . 'painel/adp_prospection_list_edit/' . $adp->id . '"><span class="badge badge-danger"><i class="fa fa-link"></i> PAYLOADS<span/> </a>'; ?>

                                                        <?php echo '<a target="_blank" href="' . base_url() . 'painel/adp_scanner/' . $adp->id . '"><span class="badge badge-primary"><i class="fa fa-link"></i> SCANNER<span/> </a>'; ?>

                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;font-size:12px">

                                                <?php if ($adp->inapto == 0) { ?>

                                                    <?php if ($this->main_model->is_alvo_owned($adp->alvo_url)) { ?>

                                                    <?php } else { ?>
                                                        <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_modal_update_target" data-toggle="modal" data-target="#modal_update_target">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <!-- <button onclick="inaptoTarget(<?= $adp->id ?>)" id=" <?= $adp->id ?>" title="INAPTO" type="button" class="btn btn-warning">
                                                            <i class="fas fa-close"></i>
                                                        </button> -->

                                                        <button onclick="deleteTarget(<?= $adp->id ?>)" id="<?= $adp->id ?>" title="EXCLUIR" type="button" class="btn btn-danger">
                                                            <i class="fas fa-close"></i>
                                                        </button>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_modal_update_target" data-toggle="modal" data-target="#modal_update_target">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                <?php } ?>
                                            </td>


                                        </tr>
                                    <?php } ?>

                                <?php } ?>
                            </tbody>
                        </table>
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
        $('.open_modal_update_target').on('click', function(e) {

            var target_id = $(this).attr('id')


            $.ajax({
                url: '<?= base_url() ?>painel/act_get_target',
                type: 'POST',
                data: {
                    target_id: target_id
                },
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        $('#update_target_id').val(resp.response.id)
                        $('#update_target_alvo_nome').val(resp.response.alvo_nome)
                        $('#update_target_alvo_url').val(resp.response.alvo_url)
                        $('#update_target_alvo_produto_link').val(resp.response.alvo_produto_link)
                        $('#update_target_alvo_email').val(resp.response.alvo_email)
                        $('#update_target_alvo_plataforma').val(resp.response.alvo_plataforma)
                        $('#update_target_alvo_email').val(resp.response.alvo_email)
                        $('#update_target_alvo_inapto').val(resp.response.inapto)

                    } else {

                        swal({
                            title: 'Opa!',
                            text: resp.message,
                            icon: 'success',
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

        // add target
        $('#form_add_target').on('submit', function(e) {

            e.preventDefault()

            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_add_alvo',
                data: $(this).serialize(),
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
                        }).then((e) => {
                            location.reload()
                        })
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                },
            });
        })

        // update target
        $('#form_update_target').on('submit', function(e) {

            e.preventDefault()

            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_update_alvo',
                data: $(this).serialize(),
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
                        }).then((e) => {
                            location.reload()
                        })
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                },
            });
        })


        // delete target
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
                        url: '<?= base_url() ?>alvos/act_delete_alvo',
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


        function inaptoTarget(target_id) {

            swal({
                title: "Tem certeza?",
                text: "Tem certeza que deseja inaptar?",
                icon: "warning",
                buttons: [
                    'Não, cancelar!',
                    'Sim, inaptar!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        method: 'POST',
                        url: '<?= base_url() ?>alvos/act_inapto_alvo',
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