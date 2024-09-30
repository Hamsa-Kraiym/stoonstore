// Functins 
function validCategory(){
    var valid = true ;
    if($('#catName').val() == ''){
        valid = false ;
        $(document).find("#catName").addClass('is-invalid');
        $("#catName").parent().find('.invalid-feedback').text('Please name the category');
    } else {
        $(document).find("#catName").removeClass('is-invalid');
        $("#catName").parent().find('.invalid-feedback').text('');
    }
    if($('#catDesc').val() == ''){
        valid = false ;
        $(document).find("#catDesc").addClass('is-invalid');
        $("#catDesc").parent().find('.invalid-feedback').text('Please descripe the category');
    } else {
        $(document).find("#catDesc").removeClass('is-invalid');
        $("#catDesc").parent().find('.invalid-feedback').text('');
    }
    if($('#catCode').val() == ''){
        valid = false ;
        $(document).find("#catCode").addClass('is-invalid');
        $("#catCode").parent().find('.invalid-feedback').text('Please code the category');
    } else {
        $(document).find("#catCode").removeClass('is-invalid');
        $("#catCode").parent().find('.invalid-feedback').text('');
    }
    return valid ;
}

function validItem(){
    var valid = true ;
    if($('#itemName').val() == ''){
        valid = false ;
        $(document).find("#itemName").addClass('is-invalid');
        $("#itemName").parent().find('.invalid-feedback').text('Please name the item');
    } else {
        $(document).find("#itemName").removeClass('is-invalid');
        $("#itemName").parent().find('.invalid-feedback').text('');
    }
    var ext = $('#itemImage').val().split('.').pop().toLowerCase();
    if($('#itemImage').val() != '' && $.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
        valid = false ;
        $(document).find("#itemImage").addClass('is-invalid');
        $("#itemImage").parent().find('.invalid-feedback').text('Please provide proper image type');
    } else {
        $(document).find("#itemImage").removeClass('is-invalid');
        $("#itemImage").parent().find('.invalid-feedback').text('');
    }
    return valid ;
}

function resetCategoryForm(){
    $('#categoryForm').find('input:text, textarea, input:hidden').val('');
}

function showAlert(alertData){
    $('#alert-pos').html('<div class="alert alert-'+alertData.type+' bg-'+alertData.type+'-100 text-'+alertData.type+
                '-600 border-'+alertData.type+'-100 px-24 py-11 mb-5 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between" role="alert">'+
                    '<div class="d-flex align-items-center gap-2">'+
                        '<iconify-icon icon="'+((alertData.type == 'success') ? 'akar-icons:double-check' : 'mdi:alert-circle-outline') +'" class="icon text-xl"></iconify-icon>'+
                        alertData.msg+'</div><button class="remove-button text-'+alertData.type+'-600 text-xxl line-height-1">'+
                        '<iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button></div>'); 
    $("#alert-pos").fadeIn(3000);
    $("#alert-pos").fadeOut(3000);
}