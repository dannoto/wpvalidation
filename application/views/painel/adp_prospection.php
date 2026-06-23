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
                    <div class="row">
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-4 d-flex">

                            <button data-toggle="modal" data-target="#update_proportion_all" class="btn btn-primary mr-5"><i class="fa fa-edit"></i></button>

                            <form action="<?= base_url() ?>painel/adp_prospection">
                                <div class="d-flex">
                                    <input name="query" value="<?= htmlspecialchars($this->input->get('query')) ?>" class="form-control" type="text">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div style="margin:50px">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;text-align:center" scope="col">SITE</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">DATE</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">PROPORTION</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">STATUS</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">COLLIGATE</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">ID</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (strlen($this->input->get('query')) > 0) { ?>

                                    <?php foreach ($this->tung_model->search_adp_prospection(htmlspecialchars($this->input->get('query'))) as $adp) { ?>
                                        <tr>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_site ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_data ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_proportion ?></td>
                                            <td style="text-align: center;font-size:12px">

                                                <?php
                                                if ($adp->adp_active == 0) {
                                                    echo '<span class="badge badge-danger">INACTIVE<span/>';
                                                } else if ($adp->adp_active == 1) {
                                                    echo '<span class="badge badge-success">ACTIVE<span/>';
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center;font-size:12px">
                                                <?php
                                                if (strlen($adp->adp_colligate) > 0) {
                                                    echo '<a target="_blank" href=" ' . $adp->adp_colligate . '">VISIT</a>';
                                                } else {
                                                    echo '-';
                                                }
                                                ?> </td>
                                            <td style="text-align: center;font-size:12px"><?php
                                                                                            if (strlen($adp->adp_id) > 0) {
                                                                                                echo '<a target="_blank" href="' . base_url() . 'painel/test_adp_id?adp_id=' . $adp->adp_id . '">TEST</a>';
                                                                                            } else {
                                                                                                echo '-';
                                                                                            }
                                                                                            ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_update_modal" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>


                                            </td>

                                        </tr>
                                    <?php } ?>




                                <?php } else { ?>

                                    <?php foreach ($this->tung_model->get_adp_prospection() as $adp) { ?>
                                        <tr>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_site ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_data ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $adp->adp_proportion ?></td>
                                            <td style="text-align: center;font-size:12px">

                                                <?php
                                                if ($adp->adp_active == 0) {
                                                    echo '<span class="badge badge-danger">INACTIVE<span/>';
                                                } else if ($adp->adp_active == 1) {
                                                    echo '<span class="badge badge-success">ACTIVE<span/>';
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center;font-size:12px">
                                                <?php
                                                if (strlen($adp->adp_colligate) > 0) {
                                                    echo '<a target="_blank" href=" ' . $adp->adp_colligate . '">VISIT</a>';
                                                } else {
                                                    echo '-';
                                                }
                                                ?> </td>
                                            <td style="text-align: center;font-size:12px"><?php
                                                                                            if (strlen($adp->adp_id) > 0) {
                                                                                                echo '<a target="_blank" href="' . base_url() . 'painel/test_adp_id?adp_id=' . $adp->adp_id . '">TEST</a>';
                                                                                            } else {
                                                                                                echo '-';
                                                                                            }
                                                                                            ?></td>
                                            <td style="text-align: center;font-size:12px">
                                                <button id="<?= $adp->id ?>" type="button" class="btn btn-primary open_update_modal" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>


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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="form_update_prospection" action="">

                            <input class="form-control" required name="id" type="hidden" id="update_id">
                            <input class="form-control" required name="adp_helper_code" type="hidden" id="update_adp_helper_code">

                            <br>
                            <label for="">PROPORTION</label>
                            <input class="form-control" required name="adp_proportion" type="number" id="update_adp_proportion">
                            <br>
                            <label for="">COLLIGATE</label>
                            <input class="form-control" type="text" name="adp_colligate" id="update_adp_colligate">
                            <br>
                            <label for="">STATUS</label>
                            <select class="custom-select" name="adp_active" id="update_adp_active">
                                <option value="0">INATIVO</option>
                                <option value="1">ATIVO</option>
                            </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-primary">SALVAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_proportion_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title">Atualizar Proporção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="form_update_prospection_proportion" action="">


                            <label for="">PROPORTION</label>
                            <input class="form-control" required name="adp_proportion" type="number" id="all_proportion">
                            <br>

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

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.open_update_modal').on('click', function(e) {

            var adp_id = $(this).attr('id')


            $.ajax({
                url: '<?= base_url() ?>painel/act_get_adepto',
                type: 'POST',
                data: {
                    id: adp_id
                },
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        $('#adp_title').text(resp.response.adp_site)
                        $('#update_id').val(resp.response.id)
                        $('#update_adp_helper_code').val(resp.response.adp_helper_code)
                        $('#update_adp_proportion').val(resp.response.adp_proportion)
                        $('#update_adp_colligate').val(resp.response.adp_colligate)
                        $('#update_adp_active').val(resp.response.adp_active)

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

        $('#form_update_prospection').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                url: '<?= base_url() ?>painel/act_update_adp_prospection',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status == "true") {


                        swal({
                            title: 'Sucesso!',
                            text: resp.message,
                            confirmButtonText: 'Entendi'
                        }).then((e) => {
                            location.reload()
                        })

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

        $('#form_update_prospection_proportion').on('submit', function(e) {

            var proportion = $('#all_proportion').val()

            e.preventDefault()
            $.ajax({
                url: '<?= base_url() ?>painel/act_update_adp_prospection_proportion',
                type: 'POST',
                data: {
                    adp_proportion: proportion
                },
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status == "true") {


                        swal({
                            title: 'Sucesso!',
                            text: resp.message,
                            confirmButtonText: 'Entendi'
                        }).then((e) => {
                            location.reload()
                        })

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