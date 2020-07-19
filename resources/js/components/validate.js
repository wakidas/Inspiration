// ==================================
// 入力項目のフロントバリデーション
// ==================================
$(function () {
    $('#form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parents('.js-validTarget'));
        },
        invalidHandler: function () {
            $('#js-validate__target').prop('disabled', false);
        }
        
    });
});