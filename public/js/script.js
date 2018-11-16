$(document).ready(function () {
   var template_tags = $('#template-tag');
   var template_participants = $('#template-participants');
   var template_protocolContent = $('#template-protocolContent');

   //$('#template-participants').html(
   var button_1 = $('<div class="btn btn-info btn-sm rounded"><i class="icofont-ui-add"></i></div>');
   var button_2 = $('<div class="btn btn-info btn-sm rounded"><i class="icofont-ui-add"></i></div>');
   var button_3 = $('<div class="btn btn-info btn-sm rounded"><i class="icofont-ui-add"></i></div>');

   var participnatContainer = $('#protocol_participants').html(button_1);
   var tagContainer = $('#protocol_tags').html(button_2);
   var contentContainer = $('#protocol_protocolContent').html(button_3);

   template_tags.detach();
   template_protocolContent.detach();
   template_participants.detach();

   button_1.click(function () {
       var elem = template_participants.clone();
       elem.removeClass('template');
       button_1.parent().append(elem.removeClass('template'));
       addAutocomplete(participnatContainer, '/participant/list');
   });

    button_2.click(function () {
        var elem = template_tags.clone();
        elem.removeClass('template');
        button_2.parent().append(elem);
        addAutocomplete(tagContainer, '/tag/list/');
    });

    button_3.click(function () {
        var elem = template_protocolContent.clone();
        elem.removeClass('template');
        button_3.parent().append(elem);
    });
    $('#test').autocomplete({
        source: ['test', 'aaa']
    });
});
function addAutocomplete(element, url) {
    var inputs = element.find('input');
    inputs.each(function (index, input) {
        if(!$(input).hasClass('autocomplete')) {
            console.log('if');
            $(input).autocomplete({source: url});
            $(input).addClass('autocomplete');
        }
    });
    // input.autocomplete({
    //     source: ['test', 'aaa']
    // });
    // input.attr('autocomplete', 'off');
};