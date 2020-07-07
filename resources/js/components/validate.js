// ==================================
// 入力項目のフロントバリデーション
// ==================================
$(function () {
    $('#form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parents('.js-validTarget'));
        },
        
    });
});