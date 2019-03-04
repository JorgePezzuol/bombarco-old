
window.fbAsyncInit = function() {

    FB.init({
        appId: '710871632282896', // App ID
        channelUrl: 'http://bom-barco.azlabs.com.br/usuarios/index', // Channel File
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true, // parse XFBML
        oauth: true
    });
};

function facebookLogin() {

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // connected... enviar o id do usuário
            getProfileData(response.authResponse.userID);
        } else if (response.status === 'not_authorized') {
            //app not_authorized
            
            FB.login(function(response) {
                if (response && response.status === 'connected') {
                    getProfileData(response.authResponse.userID);
                }
            }, {scope: "email"});
        } else {
            // not_logged_in to Facebook
            FB.login(function(response) {
                if (response && response.status === 'connected') {
                    getProfileData(response.authResponse.userID);
                }
            }, {scope: "email"});
        }
    });
} // facebook login


function getProfileData(idUsuario) {

    FB.api('/me', function(response) {

        //var urlFoto = "http://graph.facebook.com/" + response.id + "/picture?width=180&height=180";
        var idFacebook = response.id
        var nome = response.name;
        var email = response.email
        var redeSocial = 'facebook';
        var baseURL = window.location.protocol + "//" + window.location.host;
        $.ajax({
           //url: 'http://bom-barco.azlabs.com.br/usuarios/redesocial',
           url: Yii.app.createUrl('usuarios/redesocial'),
           data: {nome: nome, email: email, id: idFacebook, redeSocial: redeSocial},
           type: 'post',
           
           success: function(respUrl) {
                //alert(respUrl);
                //alert(window.location.hostname);
                $(location).attr('href',baseURL+respUrl);
                
           },
           
           error: function(xhr, error, errorMessage) {
               alert(errorMessage);
           }
        });
    }, {scope: "email"});
}

// Load the SDK Asynchronously
(function(d) {
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));

