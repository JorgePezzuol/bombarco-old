$(document).ready(function () {
    

    // offset
    var page = 1;

    $(".boxes-home-guia-gl").on("click", ".botao-carregar-guia-gl", function (e) {
        e.preventDefault();

        $limit = $(this).data("limit");

        data = {};
        data['page'] = page;
        data['categoria'] = $(this).data("categoria");
        data['localizacao'] = $(this).data("localizacao");
        data['termo'] = $(this).data("termo");
        data['ajax'] = true;

        //console.log(data);

        $.ajax({
            url: Yii.app.createUrl('empresas/Empresas'),
            data: data,
            type: 'GET',
            success: function (resp) {

                json = JSON.parse(resp.trim());
                //console.log(json);

                if (json.count > 0) {

                    //$(".categories-guia-gl").append(json.html);
                    $("#ul-carregar-mais").append(json.html);

                    // incrementar page
                    page++;

                    // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                    if (json.count < $limit) {
                        $(".div-botao-carregar-gl").empty();
                    }

                } else {
                    $(".div-botao-carregar-gl").empty();
                }

            },
            error: function (x, h, err) {
                alert('Ocorreu um erro inesperado! Tente novamente');
            }
        });

    });

});