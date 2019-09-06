(function(){

	var optionVue = new Vue({
		el: '.option-list',
		data: {
			options: []
		},
		methods: {
			removeOption: function(option){
				aysDeleteOptionModal.setData('option_id', option.id);
				aysDeleteOptionModal.openModal();
			}
		}
	});

	// var attrVue = new Vue({
	// 	el: '.attributes-list',
	// 	data: {
	// 		attributes: []
	// 	},
	// 	methods: {
	// 		loadAttribute: function(attId){
	// 			page.addClass('ajax_loading');
	// 			$.ajax({
	// 				url: 'api/attributes/' + attId,
	// 				method: 'get',
	// 				data: {
	// 					api_token: $('#datablock').data('api_token'),
	// 					name: inpt_name.val()
	// 				},
	// 				success: function(data){
	// 					console.log(data);
	// 					page.removeClass('ajax_loading');
	// 					current_attr_id = data.attribute.id;
	// 					updateAttributeView(data.attribute);
	// 				},
	// 				error: function(a, b, c){
	// 					console.log(a, b, c);
	// 					page.removeClass('ajax_loading');
	// 					showMessage(a.responseJSON.message, true);
	// 				}
	// 			});
	// 		}
	// 	}
	// });

	/*
	*	VARIABLES
	*============================*/

	var btn_add_new = $('#btn_add_new');
	var inpt_name = $('#inpt_name');
	var page = $('.page_attributes');

	var current_attr = $('.attribute_section');
	var attr_elements = $('.attributes-list__item');
	var current_attr_id = -1;

	var attr_title = $('.attr_title');
	var attr_options = $('#attr_options');

	current_attr.hide();

	/*
	*	FUNCTIONS
	*============================*/

	// Ajax

	function getAttributeList(cb){
		page.addClass('ajax_loading');
		$.ajax({
			url: 'api/attributes',
			method: 'get',
			data: {
				api_token: $('#datablock').data('api_token')
			},
			success: function(data){

				page.removeClass('ajax_loading');

				updateAttributeList(data.attributes);
				cb(data.attributes);
				
			},
			error: function(a, b, c){
				console.log(a, b, c);
				page.removeClass('ajax_loading');
				showMessage(a.responseJSON.message, true);
			}
		});
	}

	function loadAttribute(attId){
		page.addClass('ajax_loading');
		$.ajax({
			url: 'api/attributes/' + attId,
			method: 'get',
			data: {
				api_token: $('#datablock').data('api_token'),
				name: inpt_name.val()
			},
			success: function(data){
				console.log(data);
				page.removeClass('ajax_loading');
				current_attr_id = data.attribute.id;
				updateAttributeView(data.attribute);
			},
			error: function(a, b, c){
				console.log(a, b, c);
				page.removeClass('ajax_loading');
				showMessage(a.responseJSON.message, true);
			}
		});
	}

	function updateAttribute(cb){
		$.ajax({
			url: 'api/attributes/' + current_attr_id,
			method: 'post',
			data: {
				api_token: $('#datablock').data('api_token'),
				name: $(attr_title[0]).text()
			},
			success: function(data){
				console.log(data);
				getAttributeList(function(){
					showMessage(data.message, false);
					cb();
				});
			},
			error: function(a, b, c){
				console.log(a, b, c);
				cb();
				showMessage(a.responseJSON.message, true);
			}
		});
	}

	function addOption(cb){
		var formData = new FormData(document.getElementById('form_add_option'));
		formData.append('api_token', $('#datablock').data('api_token'));
		$.ajax({
			url: 'api/attributes/' + current_attr_id + '/options',
			method: 'post',
			data: formData,
			contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
			processData: false, // NEEDED, DON'T OMIT THIS
			success: function(data){
				console.log(data);
				showMessage(data.message, false);
				cb();
			},
			error: function(a, b, c){
				console.log(a, b, c);
				showMessage(a.responseJSON.message, true);
				cb();
			}
		});
	}

	function deleteAttribue(cb){
		$.ajax({
			url: 'api/attributes/' + current_attr_id,
			method: 'delete',
			data: {
				api_token: $('#datablock').data('api_token')
			},
			success: function(data){
				console.log(data);
				if(attr_elements.length > 0){
					loadAttribute($(attr_elements[0]).data('att_id'));
				}else{
					emptyAttribute();
				}
				showMessage(data.message, false);
				cb();
			},
			error: function(a, b, c){
				console.log(a, b, c);
				showMessage(a.responseJSON.message, true);
				cb();
			}
		});
	}

	function deleteOption(option_id, cb){
		$.ajax({
			url: 'api/attributes/' + current_attr_id + '/options/' + option_id,
			method: 'delete',
			data: {
				api_token: $('#datablock').data('api_token')
			},
			success: function(data){
				console.log(data);
				loadAttribute(current_attr_id);
				showMessage(data.message, false);
				cb();
			},
			error: function(a, b, c){
				console.log(a, b, c);
				showMessage(a.responseJSON.message, true);
				cb();
			}
		});
	}

	// View

	function updateAttributeView(attribute){
		current_attr.show();
		attr_title.text(attribute.name);
		optionVue.options = attribute.options;
	}

	function updateAttributeList(attributes){

		var attrList = $('.attributes-list');
		attrList.empty();

		var str = '';

		for(i=0;i<attributes.length;i++){
			var attr = attributes[i];
			str += '<div class="attributes-list__item d-flex justify-content-between align-items-center" draggable="true" data-att_id="' + attr.id + '">';
				str += '<span>' + attr.name + '</span>';
				str += '<div class="icon icon-grab"></div>';
			str += '</div>';
		}
		
		attrList.append(str);

		$('.attributes-list__item').on('click', function(){
			loadAttribute($(this).data('att_id'));
		});
                	
	}

	function emptyAttribute(){
		current_attr.hide();
		attr_title.text('');
		optionVue.options = [];
		current_attr_id = -1;
	}

	/*
	*	LETS GO
	*============================*/

	var addAttributeFormValidation = new FormValidator([
			{ id: 'inpt_name', validation: '' }
		]);

	var addAttributeModal = new Modal({
		btnOpen: '#btn_add_new',
		modalId: 'rwd-modal--add-attr'
	});

	if($(addAttributeModal.view.modalId).hasClass('still_open')){
		addAttributeModal.openModal();
	}

	var addOptionModal = new Modal({
		btnOpen: '#btn_add_option',
		modalId: 'rwd-modal--add-option',
		btnSave: '#modal-save-add-option',
		saveChanges: function(done){
			var thisModal = this;
			thisModal.startLoading('ajax_loading');
			addOption(function(){
				loadAttribute(current_attr_id);
				thisModal.stopLoading('ajax_loading');
				done();
			});
		}
	});

	var aysDeleteModal = new Modal({
		btnOpen: '.btn_delete_attr',
		modalId: 'lb-modal--ays-delete-attr',
		confirm: function(done){
			var thisModal = this;
			thisModal.startLoading('ajax_loading');
			deleteAttribue(current_attr_id, function(){
				thisModal.stopLoading('ajax_loading');
				done();
			});
		},
		decline: function(done){
			done();
		}
	});

	var aysDeleteOptionModal = new Modal({
		btnOpen: '.btn_del_option_attr',
		modalId: 'lb-modal--ays-del_option-attr',
		confirm: function(done){
			var thisModal = this;
			thisModal.startLoading('ajax_loading');
			deleteOption(thisModal.getData('option_id'), function(){
				thisModal.stopLoading('ajax_loading');
				done();
			});
		},
		decline: function(done){
			done();
		}
	});

	getAttributeList(function(attributes){

		if(attributes.length > 0){
			current_attr_id = attributes[0].id;
			updateAttributeView(attributes[0]);
			loadAttribute(current_attr_id);
		}else{
			emptyAttribute();
		}

	});	

	$('.attr_title_edit').on('click', function(){

		var editBtn = $(this);

		if(editBtn.hasClass('icon-save')){

			var attrCont = attr_title.parent();
			attrCont.addClass('ajax_loading');
			updateAttribute(function(){
				editBtn.removeClass('icon-save');
			 	attrCont.removeClass('ajax_loading');
			 	attr_title.attr('contenteditable', false);
			});

		}else{
			editBtn.addClass('icon-save');
			attr_title.attr('contenteditable', true);
		}
	});

	attr_title.on('blur', function(){

		var attrCont = attr_title.parent();
		attrCont.addClass('ajax_loading');
		updateAttribute(function(){
			$('.attr_title_edit').removeClass('icon-save');
		 	attrCont.removeClass('ajax_loading');
		 	attr_title.attr('contenteditable', false);
		});

	});

})();