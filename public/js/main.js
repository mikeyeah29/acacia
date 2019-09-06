var messageBox = $('#ajax_msg_list');
var api_token = $('#datablock').data('api_token');
var base_url = $('#datablock').data('base_url');

function showMessage(message, error){

    messageBox.empty();

    if(typeof message === 'object' && message !== null){
        // object
        if(message.hasOwnProperty('message')){
            message = message.message;
        }
        if(message.hasOwnProperty('error')){
            message = message.error;
        }
        if(message.hasOwnProperty('errors')){
            if(Array.isArray(message.errors)){
                message = message[0];
            }
        }
    }

    var msg = new Message(message, error, '#ajax_msg_list');
    msg.display();
    
}