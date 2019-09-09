(function(){

	var attribute_main = $('.attribute_main');
	var steps = [];
	var currentStep = 0;
	var totalPrice = 0;

	var attributes = $('.options-overview__option');
	var attr_title = $('.attr_title');
	var options_list = $('.option-list');

	var btn_prev = $('.btn-prev');
	var btn_next = $('.btn-next');
	var btn_complete = $('.btn-complete');
	var elem_price = $('.elem_price');
	var errorBox = $('.orderformError');
	var errorTxt = $('.orderformError__display');

	var order_table = $('#order_table');

	function showError(error){
		errorTxt.text(error);
		errorBox.show();
	}

	function loadAttribute(attId, cb){
		attribute_main.addClass('ajax_loading');
		$.ajax({
			url: 'api/attributes/' + attId,
			method: 'get',
			data: {
				api_token: $('#datablock').data('api_token')
			},
			success: function(data){
				console.log(data);
				attribute_main.removeClass('ajax_loading');
				current_attr_id = data.attribute.id;
				updateAttributeView(data.attribute);
				cb();
			},
			error: function(a, b, c){
				console.log(a, b, c);
				attribute_main.removeClass('ajax_loading');
				showMessage(a.responseJSON.message, true);
			}
		});
	}

	function optionSelected(optionName){
		var selected = '';
		if(optionName == steps[currentStep].option){
			selected = 'selected';
		}

		console.log(optionName, ' == ', steps[currentStep].option);

		return selected;
	}

	function updateAttributeView(attribute){
		
		attr_title.text(attribute.name);
		options_list.empty();

		var str = '';

		for(i=0;i<attribute.options.length;i++){
			var cost = '$' + attribute.options[i].cost;
			if(cost == '$0'){
				cost = '(standard)';
			}
			str += 	'<div class="option-box ' + optionSelected(attribute.options[i].name) + '" data-cost="' + attribute.options[i].cost + '">';
				if(attribute.options[i].image_path != 'notyet'){
					str += 	'<img src="storage/' + attribute.options[i].image_path + '">';
				}
				// }else{
				// 	str += 	'<div class="no_img"></div>';
				// }
		        str += 	'<div class="mt-2 d-flex justify-content-start align-items-start option-box__title" data-name="' + attribute.options[i].name + '">';
		        	str += 	'<div class="option-box__circle"></div>';
			        str += 	'<p class="option-box__name"><span>' + attribute.options[i].name + '</span><span class="option-box__cost"> ' + cost + '</span></p>';
		        str += 	'</div>';
	        str += '</div>';
		}

		options_list.append(str);

	}

	function is_option_selected(){
		var selected = false;
		$('.option-box').each(function(){
			if($(this).hasClass('selected')){
				selected = true;
			}
		});
		return selected;
	}

	function nextStep(){

		errorBox.hide();

		if(is_option_selected()){
			if(currentStep < steps.length - 1){
				// load the next step
				// move step up
				currentStep++;
				loadAttribute(steps[currentStep].id, function(){
					var attributeElements = $('.options-overview__option');
					attributeElements.removeClass('is_active');
					// mark current step as done
					$(attributeElements[currentStep - 1]).addClass('is_done');
					steps[currentStep - 1].selected = true;
					// make step active
					$(attributeElements[currentStep]).addClass('is_active');
					stepChanged();
				});
			}
		}else{
			// show message
			showError('Please select an option for ' + attr_title.text());
		}
		
	}

	function prevStep(){

		errorBox.hide();

		if(currentStep > 0){
			// load the prev step
			// move step up
			currentStep--;
			loadAttribute(steps[currentStep].id, function(){
				var attributeElements = $('.options-overview__option');
				attributeElements.removeClass('is_active');
				// make step active
				$(attributeElements[currentStep]).addClass('is_active');
				stepChanged();
			});
		}

	}

	function loadStep(stepIndex){

		currentStep = stepIndex;
		// loadAttribute 
		loadAttribute(steps[currentStep].id, function(){
			// add is_active class to correct step
			attributes.removeClass('is_active');
			$(attributes[currentStep]).addClass('is_active');
			stepChanged();
		});

	}

	function stepChanged(){
		if(currentStep == 0){
			btn_prev.hide();
		}else{
			btn_prev.show();
			if(currentStep == steps.length - 1){
				btn_next.hide();
				btn_complete.show();
			}else{
				btn_next.show();
				btn_complete.hide();
			}
		}
	}

	function selectOption(optionBox){
		$('.option-box').removeClass('selected');
		optionBox.addClass('selected');
		steps[currentStep].cost = optionBox.data('cost');
		steps[currentStep].option = optionBox.find('.option-box__title').data('name'); 
		updatePrice();
	}

	function updatePrice(){
		totalPrice = 0;
		for(i=0;i<steps.length;i++){
			totalPrice += steps[i].cost;
		}
		elem_price.text(totalPrice);
	}

	function buildSummeryTable(){
		order_table.empty();
		var str = '';
		for(i=0; i<steps.length;i++) {
			str += '<tr>';
				str += '<th scope="row">' + steps[i].attribute + '</th>';
           	 	str += '<td>' + steps[i].option + '</td>';
            	str += '<td>' + steps[i].cost + '</td>';
			str += '<tr>';
		}
		order_table.append(str);
	}

	function getNextRequiredStep(){
		var step = steps[0];
		for(i=0; i<steps.length;i++) {
			if(steps[i].selected){
				step = steps[i + 1];
			}
		}
		console.log(step);
		return step;
	}

	function sendForm(cb){

	}

	/*
	*   Lets Go
	*-------------------------------------*/

	btn_prev.hide();
	btn_complete.hide();

	$('.options-overview__option').each(function(){
		steps.push({
			attribute: $(this).text(),
			id: $(this).data('attr_id'),
			selected: false,
			option: '',
			cost: 0
		});
	});

	if(steps.length > 0){
		loadAttribute(steps[0].id, function(){});
	}

	$('.option-list').on('click', '.option-box', function(){
		selectOption($(this));
	});

	btn_next.on('click', function(){
		nextStep();
	});

	btn_prev.on('click', function(){
		prevStep();
	});

	$('.options-overview__option').on('click', function(){

		var attrIndex = $(this).index();

		if(attrIndex == 0){
			loadStep(attrIndex);
		}else{
			if(steps[attrIndex].selected){
				loadStep(attrIndex);
			}else{
				
				if(steps[attrIndex - 1].selected){	
					loadStep(attrIndex);
				}else{
					showError(getNextRequiredStep().attribute + ' selection must be made next');
				}
			}
		}
			
	});

	var orderValidator = new FormValidator([
			{ id: 'q_name', validation: '' },
			{ id: 'q_email', validation: '' }
		]);

	var summaryModal = new Modal({
		btnOpen: '.btn-complete',
		modalId: 'rwd-modal--order-summery',
		btnSave: '#modal-send-order',
		beforeOpen: function(done){

			errorBox.hide();

			if(is_option_selected()){
				buildSummeryTable();
				done();
			}else{
				// show message
				showError('Please select an option for ' + attr_title.text());
			}
	
		},
		saveChanges: function(done){
			
			if(orderValidator.isValid()){
				var thisModal = this;
				thisModal.startLoading('ajax_loading');
				sendForm(function(error){
					if(!error){
						thisModal.stopLoading('ajax_loading');
					}
				});
			}else{
				showError(orderValidator.message);
			}
			
		}
	});

})();