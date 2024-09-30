(function ($) {
    'use strict';
    $(function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          }
        });
    });

    $(document).ready(function(){
        if($('#categoriesList').length) var table = new DataTable("#categoriesList");
        if($('#itemsList').length) var table = new DataTable("#itemsList");
    });
    
    $(document).on('click', '#saveCategory', function(e){
        e.preventDefault(); 
        if(validCategory()){
            $.ajax({
                type: 'POST',
                url: "/saveCat",
                cache: false,
                dataType: "json",
                data: {
                    "categoryID"    : $('#catID').val(),
                    "categoryName"  : $('#catName').val() , 
                    "categoryDescription": $('#catDesc').val(),
                    "categoryCode"  : $('#catCode').val() ,
                    "_token"        : $("input[name='_token'").val()         
                },  
                success: function (data) {
                    if($('#catID').val() == '' && data.result==1) resetCategoryForm();
                    showAlert({'type': (data.result==1)?'success':'warning', 'msg': data.msg});
                    setTimeout(function(){window.location.href="/manageCategory";},300);
                }, 
                error: function (jqXHR, textStatus, errorThrown) {
                    showAlert({'type': 'warning', 'msg': errorThrown});
                }
            });
        }    
    });

    $(document).on('click', '.edit-category', function(e){
        e.preventDefault(); 
        var catID = $(this).attr('cat-id');
        window.location.href="/editCatForm/"+catID;
    });

    $(document).on('click', '.delete-category', function(e){
        $('#p_catID').val($(this).attr('cat-id'));
    });

    $(document).on('click', '#deleteCategory', function(e){
        e.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: "/deleteCat",
            cache: false,
            dataType: "json",
            data: {
                "catID" :$('#p_catID').val(),
            },  
            success: function (data) {
                if(data.result>0){
                    showAlert({'type': (data.result>0)?'success':'warning', 'msg': data.msg});
                    $('#categoriesList').dataTable({
                        destroy: true,
                        responsive: true,
                        bStateSave: true,
                        processing: true,
                        ajax: {
                            url: '/listCats',
                            type: 'POST'
                        },
                        columns: [
                            { data: 'id' },
                            { data: 'name' },
                            { data: 'description' },
                            { data: 'code' },
                            { data: 'created_at' },
                            { data: null, render : function(data , type , full){
                                return '<button cat-id="'+data.id+'" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit-category">'+
                                        '<iconify-icon icon="lucide:edit"></iconify-icon></button>' +
                                    '<button cat-id="'+data.id+'" data-bs-toggle="modal" data-bs-target="#confirmDeleteCategory" '+ 
                                        'class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete-category">'+
                                        '<iconify-icon icon="mingcute:delete-2-line"></iconify-icon></button>';
                            } }
                        ],
                    });
                } else {
                    showAlert({'type':'warning', 'msg': 'Error in deleting Category'});
                }
            }, 
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert({'type': 'warning', 'msg': errorThrown + ' - ' + 'Error in deleting Category'});
            }
        });
        $('#confirmDeleteCategory').modal('hide');
    });

    $(document).on('click', '#saveItem', function(e){
        e.preventDefault(); 
        if(validItem()){
            $('#itemForm').submit();
        }    
    });

    $('#itemForm').on('submit', function(e){
        e.preventDefault(); 
        var fd = new FormData(this);
        $.ajax({
            method:"POST",
            url:'/saveItem',    
            data: fd,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,   
            success: function(data){
                showAlert({'type': (data.result==1)?'success':'warning', 'msg': data.msg});
                setTimeout(function(){window.location.href="/manageItems";},300);
            },
            error: function(xhr, status, errorThrown) {
                showAlert({'type': 'warning', 'msg': errorThrown});
            }  
        });
    });
    
    $(document).on('click', '.edit-item', function(e){
        e.preventDefault(); 
        var itemID = $(this).attr('item-id');
        window.location.href="/editItemForm/"+itemID;
    });
     
    $(document).on('click', '.delete-item', function(e){
        $('#p_itemID').val($(this).attr('item-id'));
    });

    $(document).on('click', '#deleteItem', function(e){
        e.preventDefault(); 
        $.ajax({
            type: 'POST',
            url: "/deleteItem",
            cache: false,
            dataType: "json",
            data: {
                "itemID" :$('#p_itemID').val(),
            },  
            success: function (data) {
                showAlert({'type': (data.result>0)?'success':'warning', 'msg': data.msg});
                if(data.result>0){
                    $('#itemsList').dataTable({
                        destroy: true,
                        responsive: true,
                        bStateSave: true,
                        processing: true,
                        ajax: {
                            url: '/listItems',
                            type: 'POST'
                        },
                        columns: [
                            { data: 'id' },
                            { data: 'name' },
                            { data: 'category_name' },
                            { data: null, render: function(data , type , full){
                                if(data.picture.length){
                                    return '<img src="data:'+data.picType+';base64,'+data.picture+'" class="h-60-px w-60-px flex-shrink-0 me-12 radius-8">';
                                } else {
                                    return '<label class="upload-file h-60-px w-60-px border input-form-light radius-8 overflow-hidden border-dashed bg-neutral-50 d-flex align-items-center flex-column justify-content-center gap-1">' +
                                                '<iconify-icon icon="solar:camera-outline" class="text-xl text-secondary-light"></iconify-icon></label>';
                                }
                            } },
                            { data: 'created_at' },
                            { data: null, render : function(data , type , full){
                                return '<button item-id="'+data.id+'" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit-item">'+
                                        '<iconify-icon icon="lucide:edit"></iconify-icon></button>' +
                                    '<button item-id="'+data.id+'" data-bs-toggle="modal" data-bs-target="#confirmDeleteItem" '+ 
                                        'class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete-item">'+
                                        '<iconify-icon icon="mingcute:delete-2-line"></iconify-icon></button>';
                            } }
                        ],
                    });
                }
            }, 
            error: function (jqXHR, textStatus, errorThrown) {
                showAlert({'type': 'warning', 'msg': errorThrown});
            }
        });
        $('#confirmDeleteItem').modal('hide');
    });
    
})(jQuery);