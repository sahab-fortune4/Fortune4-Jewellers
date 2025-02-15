console.log("hii")


define([
    'jquery'
], function ($) {
    'use strict';
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
});