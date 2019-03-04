    function logout()
    {
        gapi.auth.signOut();
        location.reload();
    }
    function login()
    {
        var myParams = {
            'clientid': '84406965848-9v3egkm12absc9it0i4gj4co684i1hpg.apps.googleusercontent.com',
            'cookiepolicy': 'single_host_origin',
            'callback': 'loginCallback',
            'approvalprompt': 'force',
            'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
        };
        gapi.auth.signIn(myParams);
    }

    function loginCallback(result)
    {

        if (result['status']['signed_in'])
        {
            var request = gapi.client.plus.people.get(
                    {
                        'userId': 'me'
                    });
            request.execute(function(resp)
            {

                var email = resp['emails'][0]['value'];
                var nome = resp['displayName'];
                var idUser = resp['id'];
                var redeSocial = 'googleplus';

                //var fotoUrl = resp['image']['url'];
                $.ajax({
                   //url: 'http://bom-barco.azlabs.com.br/usuarios/redesocial',
                   url: Yii.app.createUrl('usuarios/redesocial'),
                   data: {nome: nome, email: email, id:idUser, redeSocial: redeSocial},
                   type: 'post',
                   
                   success: function(respUrl) {
                        // transformar em objeto a resposta em json
                        //var usuario = JSON.parse(resp);

                        // setar os campos de login e senha para "forçar" o login do usuário
                        //$("#LoginForm_username").val(usuario.email);
                       // $("#LoginForm_password").val(usuario.senha);
                        //$("#LoginForm_submit").trigger("click");
                        $(location).attr('href','http://bom-barco.azlabs.com.br'+respUrl);
                   },
                   
                   error: function(xhr, error, errorMessage) {
                       alert(errorMessage);
                   }
                });
            
            });
        }
    }
    function onLoadCallback()
    {
        gapi.client.setApiKey('AIzaSyB8GHdoSMry2SdwlpwtRQ3kWb5Pw1JtU0Y');
        gapi.client.load('plus', 'v1', function() {
        });
    }

    (function() {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();

