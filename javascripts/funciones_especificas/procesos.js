$(function() {
	$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
    
    $(".chosen-select").chosen({allow_single_deselect: true, max_selected_options: 1});
});
