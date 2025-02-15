console.log("hii")


$(document).ready(function() {
    $('#chatIcon').click(function() {
        $('#chatbox').toggle();
    });
    $('#closeChatbox').click(function() {
        $('#chatbox').hide();
    });
    $('#chatbox').draggable({
        handle: '#chatboxHeader'
    });
});