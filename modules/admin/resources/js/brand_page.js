$(document).ready(function(){
    Brand_page.run();
});

var Brand_page = {
    scope_id: "#brand_scope",
    eventHandle: function(){
    	var that = this;
    	var popup = $(that.scope_id).find('.brand-delete-model');
    	//click button delete brand to show popup content
        $(document).on('click','.btn-brand-del-record-model',function(){
		  	var brand_name = $(this).data('brand-name');
		  	var brand_id = $(this).data('brand-id');
		   	popup.find('.text-brand-name').text(brand_name);
		   	popup.find('.btn-brand-del-record-confirm').attr('data-id',brand_id);
		   	popup.find('.message-alert').html('');

		   	popup.modal('show');
		});

		$(document).on('click','.btn-brand-del-record-confirm',function(){
			Admin.loading(true);
		  	var id = $(this).data('id');
		  	var url = $('#base_url').val() + 'admin/brands/destroy';
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
		        	window.location = $('#base_url').val() + 'admin/brands';
		        }
	        });

		});
    },
    run: function(){
        this.eventHandle();
    }
}