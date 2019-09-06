var Modal = (function(){

	function Model(){

	}

	function View(btnOpen, modalId, btnSave){
		this.btnOpen = $(btnOpen);
		this.modalId = $('#' + modalId);
		this.modalbox = this.modalId.find('.rwd-modal');
		this.btnClose = this.modalId.find('.btn_modal_close');
		if(btnSave){
			this.btnSave = $(btnSave);
		}
		this.confirm = this.modalId.find('.confirm');
		this.decline = this.modalId.find('.decline');
	}

	function Modal(obj){
		this.view = new View(obj.btnOpen, obj.modalId, obj.btnSave);
		this.model = new Model();
		var thisModal = this;
		this.view.btnOpen.on('click', function(e){
			var data = $(this).data();
			thisModal.setData('open_btn_event', e);
			thisModal.setData('open_btn_instance', this);
			for (var key in data) {
				thisModal.setData(key, data[key]);
			}
			thisModal.openModal();
		});
		this.beforeOpen = obj.beforeOpen;
		this.beforeClose = obj.beforeClose;
		this.saveChanges = obj.saveChanges;
		this.confirm = obj.confirm;
		this.decline = obj.decline;

		this.view.btnClose.on('click', function(){
			thisModal.closeModal();
		});
		this.view.modalId.on('click', function(e){
			if( $(e.target).hasClass('modal-container') ){
				thisModal.closeModal();
			}
		});

		if(obj.hasOwnProperty('btnSave')){
			this.view.btnSave.on('click', function(){
				thisModal.saveChanges(function(){
					thisModal.view.modalId.fadeOut(300);
				});
			});
		}

		if(obj.hasOwnProperty('confirm')){
			this.view.confirm.on('click', function(){
				thisModal.confirm(function(){
					thisModal.view.modalId.fadeOut(300);
				});
			});
		}

		if(obj.hasOwnProperty('decline')){
			this.view.decline.on('click', function(){
				thisModal.decline(function(){
					thisModal.view.modalId.fadeOut(300);
				});
			});
		}
	}
	Modal.prototype.openModal = function() {
		var thisModal = this;
		if(this.beforeOpen){
			this.beforeOpen(function(){
				thisModal.view.modalId.fadeIn(300);
			});
		}else{
			thisModal.view.modalId.fadeIn(300);
		}
	};
	Modal.prototype.closeModal = function(){
		var thisModal = this;
		if(this.beforeClose){
			this.beforeClose(function(){
				thisModal.view.modalId.fadeOut(300);
				thisModal.view.modalId.removeClass('is_open');
			});
		}else{
			thisModal.view.modalId.fadeOut(300);
			thisModal.view.modalId.removeClass('is_open');
		}
	};
	Modal.prototype.startLoading = function(loadingClass){
		this.view.modalbox.addClass(loadingClass);
	}
	Modal.prototype.stopLoading = function(loadingClass){
		this.view.modalbox.removeClass(loadingClass);
	}
	Modal.prototype.setData = function(dataName, dataValue){
		return this.view.modalId.data(dataName, dataValue);
	}
	Modal.prototype.getData = function(dataName){
		return this.view.modalId.data(dataName);
	}

	return Modal;

})();