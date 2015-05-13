function init_popover() {
	if( $('.popover').length ) {
		$('[aria-describedby]').each( function(i, v){
			$('#'+$(v).attr('id')).popover('destroy')
		})
		$('.popover').each( function(i, v){
			$('#'+$(v).attr('id')).popover('destroy')
		})
	}
}

function set_popover_alert( element, place, msg ) {
	var pop_alert = $( element ).data( 'bs.popover' )
	if( typeof pop_alert === 'undefined' ) {
		$( element ).popover({
			 container	: $(element).parent()
			,viewport	: element
			,placement	: place
			,trigger	: 'manual'
			,content	: msg
			,html		: true
			,template	: '<div class="popover popover-alert-div" role="tooltip"><div class="pa-arrow arrow"></div><div class="popover-content popover-alert-content"></div></div>'
		})
		$( element ).popover('show')
	} else {
		$( element ).attr( 'data-content', msg )
		pop_alert.setContent()
		pop_alert.$tip.addClass(place).show
	}
}

function check_pop_alert( element ) {
	// console.log('checking -> ',element)
	var pop_alert = $( element ).data( 'bs.popover' )
	if( typeof pop_alert !== 'undefined' ) {
		if( typeof pop_alert.$tip.css !== 'undefined' )
			if( pop_alert.$tip.css('display') == 'block' )
				return true
	}

	return false
}