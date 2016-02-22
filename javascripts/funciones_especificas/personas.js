$(function() {
	$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
    $(".chosen-select").chosen({allow_single_deselect: true, max_selected_options: 1});
    $(".chosen-select-cargo").chosen({allow_single_deselect: true, max_selected_options: 1});
    $(".chosen-select-personal").chosen({allow_single_deselect: true, max_selected_options: 1});
    $(".chosen-select-empresa").chosen({allow_single_deselect: true, max_selected_options: 1});
    
    $("div#titulo_profesional_chosen").css('width','220px');
    $( "div[id^='tip_referencia_']" ).css('width', '170px');
    $( "div#cargo_chosen" ).css('width', '340px');
    $( "div#empresa_chosen" ).css('width', '340px');
    

});
