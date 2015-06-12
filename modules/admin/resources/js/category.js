$(document).ready(function(){
    Category_page.run();
    Category_create.run();
});

var Category_page = {
    scope_id: "#category_scope",
    eventHandle: function(){
    	var that = this;
    	var popup = $(that.scope_id).find('.category-delete-model');
    	//click button delete category to show popup content
        $(document).on('click','.btn-category-del-record-model',function(){
		  	var category_name = $(this).data('category-name');
		  	var category_id = $(this).data('category-id');
		   	popup.find('.text-category-name').text(category_name);
		   	popup.find('.btn-category-del-record-confirm').attr('data-id',category_id);
		   	popup.find('.message-alert').html('');

		   	popup.modal('show');
		});

		$(document).on('click','.btn-category-del-record-confirm',function(){
			Admin.loading(true);
		  	var id = $(this).data('id');
		  	var url = $('#base_url').val() + 'admin/categories/destroy';
		  	var data = {
		  		id:id
		  	}

		  	var ajax = $.ajax({
	            url: url,
	            data: data,
	            method: 'POST',
	            dataType: 'json',
	            statusCode: {
	                404: function () {
	                    Admin.loading(false);
	                    console.log("page not found");
	                },
	                500: function (data) {
	                    Admin.loading(false);
	                    console.log("Server error",data);
	                }
	            }
	        });

	        ajax.done(function (obj) {
	        	Admin.loading(false);
		        if ((obj.status== 'failure')){
		        	popup.find('.message-alert').html(obj.message);
		        }
		        if ((obj.status== 'success')){
		        	popup.modal('hide');
		        	window.location = $('#base_url').val() + 'admin/categories';
		        }
	        });

		});
    },
    run: function(){
        this.eventHandle();
    }
}

var Category_create = {
    eventHandle: function(){
    	$(document).on('click','#btn_category_store',function(e){
    		e.preventDefault();
    		$('#form_category_action').submit();
    	});
    },
    run: function(){
        this.eventHandle();
    }
}