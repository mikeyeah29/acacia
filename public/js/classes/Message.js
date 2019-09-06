function Message(msg, isError, container){

	// this. = $('') <div class="ajax-msg"><p></p><span class="x"><i class="icon icon-close"></i></span></div>

	this.msg = msg;

	this.elem = $($('<div class="ajax-msg"><p></p><span class="x"><i class="icon icon-close"></i></span></div>')[0]);

	//console.log(this.elem[0]);

	this.elem.find('p').html(msg);

	this.elem.removeClass('error_msg');

	if(isError){
		this.elem.addClass('error_msg');
	}

	var thisMsg = this;

	this.elem.find('.x').on('click', function(){
		console.log('bhj');
		thisMsg.hideMsg();
	});

	this.elem.appendTo(container);

}

Message.prototype.display = function(persist){

	this.elem.addClass("slideup");

	thisMsg = this;

	if(persist != true){
		setTimeout(function() {
	    	thisMsg.hideMsg();
	    }, 6000);
	}

};

Message.prototype.hideMsg = function(){
	// $(this.elem).removeClass("slideup");
	$(this.elem).remove();
};