$("document").ready(function(){

  $("#Motores_motor_fabricantes_id").change(function(){
    $.post(Yii.app.createUrl("utils/loadMotorModelos"), {motor_fabricantes_id: $(this).val()}, function(response){
        response = $.parseJSON(response);
        $("#Motor_modelos").empty();
        $("#Motor_modelos").append($("<option/>").attr({"value":"0"}).text("selecione o modelo"))
        for(var a in response){
          $("#Motor_modelos").append($("<option/>").attr({"value":response[a].id}).text(response[a].titulo));
        }
      }
    );
  })
  //$("#Conteudos_data").datepicker({"format":"dd/mm/yyyy"});
  $(".table .delete").click(function(){
    elem = $(this);
    $.post($(this).attr("href"),{},function(){
      elem.closest("tr").slideUp(function(){
        $(this).remove();
      });
    });
    return false;
  });
  $(".openMenu").click(function(){
    if($(this).hasClass("open")){
      $(this).removeClass("open fa-remove").addClass("fa-bars");
      $(".side-nav").removeClass("open");
    }else{
      $(this).removeClass("fa-bars").addClass("open fa-remove");
      $(".side-nav").addClass("open");
    }
    return false;
  });
  
});
