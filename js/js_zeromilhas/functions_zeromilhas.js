$(document).ready(function() {

    var d = new Date();
    var n = d.getHours();

    /* plugin whats app */
    if(n >= 8 && n <= 19) {

        console.log(n);
        /* plugin whats app */
        (function () {
            var options = {
                whatsapp: "+5511989698912", // WhatsApp number
                call_to_action: "Entrar em contato", // Call to action
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();

        /* */

    }
});

    /* */