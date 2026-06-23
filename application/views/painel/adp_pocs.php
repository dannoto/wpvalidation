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

                            <button data-toggle="modal" data-target="#mode_add_poc" class="btn btn-primary mr-5"><i class="fa fa-edit"></i></button>

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
                                    <th style="font-size: 12px;text-align:center" scope="col">SLUG</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">VERSION</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">TYPE</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">VERTIFIED</th>
                                    <th style="font-size: 12px;text-align:center" scope="col">TYPE</th>
                            
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (strlen($this->input->get('query')) > 0) { ?>

                                  



                                <?php } else { ?>

                                    <?php foreach ($this->poc_model->get_pocs() as $poc) { ?>
                                        <tr>
                                            <td style="text-align: center;font-size:12px" title="<?= $poc->wp_description ?>" ><?= $poc->wp_slug ?></td>
                                            <td style="text-align: center;font-size:12px" ><?= $poc->wp_version ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $poc->wp_type ?></td>
                                            <td style="text-align: center;font-size:12px"> <?php if ($poc->wp_verified == 1) {echo "<i class='fa fa-check text-success' ></i>"; } else { echo "<i class='fa fa-close text-danger' ></i>"; } ?></td>
                                            <td style="text-align: center;font-size:12px"><?= $poc->vuln_type ?></td>
                                            
                                            <td>
                                                 <button id="<?=$poc->id?>" type="button" class="btn btn-primary open_mode_update_poc" data-toggle="modal" data-target="#mode_update_poc">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button onclick="" id="<?= $poc->id ?>" title="INAPTO" type="button" class="btn btn-danger open_delete_poc">
                                                            <i class="fas fa-close"></i>
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


    <div class="modal fade" id="mode_update_poc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title">EDITAR POC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div>
                        
                        <form id="form_update_poc" action="">

                            <input class="form-control" required name="wp_id" type="hidden" id="update_wp_id">

                            <label for="">WP-SLUG</label>
                            <input class="form-control" required name="wp_slug" type="text" id="update_wp_slug">
                            <br>
                            
                              <label for="">POC DESCRIPTION</label>
                              <textarea class="form-control" required name="wp_description" type="text" id="update_wp_description" ></textarea>
                            <br>
                            
                              <label for="">WP VERSION</label>
                            <input class="form-control" required name="wp_version" type="text" id="update_wp_version">
                            <br>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">WP TYPE</label>
                                    <select class="form-control"  name="wp_type" id="update_wp_type">
                                                                      <option value="plugin">PLUGIN</option>
    
                                    <option value="theme">THEME</option>
                                    <option value="core">CORE</option>
                                  </select>
    
                                <br>
                                </div>
                                
                                  <div class="col-md-6">
                                      
                                      <label for="">WP VERIFIED</label>
                                      <select class="form-control"  name="wp_verified" id="update_wp_verified">
                                        <option value="1">SIM</option>
                                        <option value="0">NÃO</option>
                                      </select>
        
                                    <br>
                                    
                                </div>
                            </div>
                            
                            
                              <label for="">POC TYPE</label>
                                        <select class="form-control"  name="vuln_type" id="update_vuln_type">
                                        <option value="sql-injection">SQL INJECTION</option>
                                        <option value="lfi">LFI</option>
                                        <option value="xss-reflected">XSS REFLECTED</option>
                                        <option value="xss-stored">XSS STORED</option>
                                        <option value="csrf">CSRF</option>
                                        <option value="rce">RCE</option>
                                        <option value="information-disclosure">INFORMATION DISCOSURE</option>
                                        <option value="ssrf">SSRF</option>
                                        <option value="broken-access-control">BROKEN ACCESS CONTROL</option>
                                        <option value="broken-authentication">BROKEN AUTHENTICATION</option>
                                      </select>                            
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

    <div class="modal fade" id="mode_add_poc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adp_title">ADICIONAR POC</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div>
                        
                        <form id="form_add_poc" action="">


                            <label for="">WP-SLUG</label>
                            <input class="form-control" required name="wp_slug" type="text" id="wp_slug">
                            <br>
                            
                              <label for="">POC DESCRIPTION</label>
                              <textarea class="form-control" required name="wp_description" type="text" id="wp_description" ></textarea>
                            <br>
                            
                              <label for="">WP VERSION</label>
                            <input class="form-control" required name="wp_version" type="text" id="wp_version">
                            <br>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">WP TYPE</label>
                                    <select class="form-control"  name="wp_type" id="wp_type">
                                                                      <option value="plugin">PLUGIN</option>
    
                                    <option value="theme">THEME</option>
                                    <option value="core">CORE</option>
                                  </select>
    
                                <br>
                                </div>
                                
                                  <div class="col-md-6">
                                      
                                      <label for="">WP VERIFIED</label>
                                      <select class="form-control"  name="wp_verified" id="wp_verified">
                                        <option value="1">SIM</option>
                                        <option value="0">NÃO</option>
                                      </select>
        
                                    <br>
                                    
                                </div>
                            </div>
                            
                            
                              <label for="">POC TYPE</label>
                                        <select class="form-control"  name="vuln_type" id="vuln_type">
                                        <option value="sql-injection">SQL INJECTION</option>
                                        <option value="lfi">LFI</option>
                                        <option value="xss-reflected">XSS REFLECTED</option>
                                        <option value="xss-stored">XSS STORED</option>
                                        <option value="csrf">CSRF</option>
                                        <option value="rce">RCE</option>
                                        <option value="information-disclosure">INFORMATION DISCOSURE</option>
                                        <option value="ssrf">SSRF</option>
                                        <option value="broken-access-control">BROKEN ACCESS CONTROL</option>
                                        <option value="broken-authentication">BROKEN AUTHENTICATION</option>
                                      </select>                            
                                <br>
                            
                            
                             
                            
                            

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
    
        $('.open_mode_update_poc').on('click', function(e) {

            var wp_id = $(this).attr('id')

            $.ajax({
                url: '<?= base_url() ?>painel/act_get_poc',
                type: 'POST',
                data: {
                    id: wp_id
                },
                success: function(data) {

                    var resp = JSON.parse(data)

                    if (resp.status != "false") {
                        
                        console.log(resp)

                        $('#update_wp_id').val(resp.id)
                        $('#update_wp_slug').val(resp.wp_slug)
                        $('#update_wp_description').val(resp.wp_description)
                        $('#update_wp_version').val(resp.wp_version)
                        $('#update_wp_type').val(resp.wp_type)
                        $('#update_wp_verified').val(resp.wp_verified)
                        $('#update_vuln_type').val(resp.vuln_type)

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

        $('#form_update_poc').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                url: '<?= base_url() ?>painel/act_update_poc',
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
        
        $('#form_add_poc').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
                url: '<?= base_url() ?>painel/act_add_poc',
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

        $('.open_delete_poc').on('click', function(e) {

            var wp_id = $(this).attr('id')
            
             swal({
                title: "Tem certeza?",
                text: "Você confirma que deseja excluir a POC?",
                icon: "warning",
                buttons: [
                    'Não, cancelar!',
                    'Sim, confirmo!'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                 if (isConfirm) {

                    $.ajax({
                        url: '<?= base_url() ?>painel/act_delete_poc',
                        type: 'POST',
                        data: {
                            id: wp_id
                        },
                        success: function(data) {
        
                            var resp = JSON.parse(data)
        
                            if (resp.status == "true") {
        
                               swal({
                                    title: 'Opa!',
                                    text: resp.message,
                                    confirmButtonText: 'Entendi'
                                }).then((resp) => {
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
            
                }
            })

        })
       
    </script>


</body>

</html>