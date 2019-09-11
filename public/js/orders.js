(function(){

	function deleteOrder(orderid, cb){
		$.ajax({
			url: 'api/orders/' + orderid,
			method: 'delete',
			data: {
				api_token: $('#datablock').data('api_token')
			},
			success: function(data){
				location.href = 'orders';
				cb();
			},
			error: function(a, b, c){
				console.log(a, b, c);
				showMessage(a.responseJSON.message, true);
				cb();
			}
		});
	}

	var aysDeleteModal = new Modal({
		btnOpen: '.btn_delete',
		modalId: 'lb-modal--ays-delete-attr',
		beforeOpen: function(done){
			var orderid = $(aysDeleteModal.getData('open_btn_instance')).data('orderid');
			this.setData('orderid', orderid);
			done();
		},
		confirm: function(done){
			var thisModal = this;
			thisModal.startLoading('ajax_loading');
			var orderid = this.getData('orderid');
			deleteOrder(orderid, function(){
				thisModal.stopLoading('ajax_loading');
				done();
			});
		},
		decline: function(done){
			done();
		}
	});

})();