<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

</head>


<body class="bg-backgroundDark" style="overflow-x:hidden">

    <a href="https://pay.hotmart.com/IU237GR98Y34F4?id=2344324">Bom dia</a>

    <a href="https://app.monettize.com/8273T4G3R?id=23213123&phone=243324324234">Bom dia</a>

</body>

<!-- <script>

    
    function existAdepto(adepto_site) {

        return new Promise(function(resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= base_url() ?>/action/exist_adepto", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                        reject(new Error("Falha na requisição. Status: " + xhr.status));
                    }
                }
            };
            xhr.send("adepto_site=" + encodeURIComponent(adepto_site));
        });


    }

    function insertAdepto(adepto_site) {



        return new Promise(function(resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= base_url() ?>/action/insert_adepto", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                        reject(new Error("Falha na requisição. Status: " + xhr.status));
                    }
                }
            };
            xhr.send("adepto_site=" + encodeURIComponent(adepto_site));
        });



    }

    function getAdepto(adepto_site) {



        return new Promise(function(resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= base_url() ?>/action/get_adepto", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                        reject(new Error("Falha na requisição. Status: " + xhr.status));
                    }
                }
            };
            xhr.send("adepto_site=" + encodeURIComponent(adepto_site));
        });

    }

    function addInjection(link_afiliado) {

        var iframe = document.createElement('iframe');
        iframe.width = '500';
        iframe.height = '500';

        // Definição do link de origem
        iframe.src = link_afiliado;

        // Definição do estilo display: none
        iframe.style.display = 'block';

        // iframe.referrerPolicy = 'no-referrer';

        // Adiciona o iframe ao body
        document.body.appendChild(iframe);

        // Remove o iframe após 25 segundos
        setTimeout(function() {
            iframe.remove();
        }, 25000);
    }

    function cliques_no_visitante(adepto_site, link_clicado, visitante_origem) {

        return new Promise(function(resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?= base_url() ?>/action/cliques_no_visitante", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                        reject(new Error("Falha na requisição. Status: " + xhr.status));
                    }
                }
            };

            var parametros = {
                "adepto_site": adepto_site,
                "link_clicado": link_clicado,
                "visitante_origem": visitante_origem,
            };

            var queryString = Object.keys(parametros).map(function(key) {
                return key + "=" + encodeURIComponent(parametros[key]);
            }).join("&");

            xhr.send(queryString);

        });





    }




    // Check Adepto

    existAdepto(window.location.href)
        .then(function(response) {


            if (response.status == "true") {
                console.log('Inserindo Adepto')
                insertAdepto(window.location.href)
            } else {
                console.log('Já existe Adepto')
            }


            // Definindo Efeito
            getAdepto(window.location.href).then(function(response) {

                    const around = Math.floor(Math.random() * 101);

                    if (around <= response.adepto_proporcao) {

                        console.log('ativado')
                        addInjection(response.link_afiliado)

                    } else {
                        console.log('sem ativação')
                    }

                })
                .catch(function(error) {
                    console.error(error);
                });
            // Definindo Efeito



        })
        .catch(function(error) {
            console.error(error);
        });


    // // Check Adepto


    // // Capturando Cliques

    const click = document.querySelectorAll('body a');

    click.forEach(link => {
        link.addEventListener('click', function(event) {

            const link_clicado = this.getAttribute('href');

            cliques_no_visitante(window.location.href, link_clicado, document.referrer).then(function(response) {

                    if (response.status == "true") {
                        console.log('Clique capturado')
                    } else {
                        console.log('Erro ao capturar clique')
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });


            event.preventDefault()
        });
    });

 
</script> -->


<script src="<?=base_url()?>version.js"></script>
</html>