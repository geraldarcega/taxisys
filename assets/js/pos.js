var current_data
var current_unit

$(document).ready( function(){
    init()

    $('#pos_alert').hide()

    $('#frmModalPOS').validate({
        submitHandler: function(form) {
            if( $('#action').val() == 's_update' )
            {
                if( $('#old_driver').val() == $('#select_driver').val() )
                {
                    if( $('#old_status').val() == $('#status').val() )
                    {
                        alert('No changes has been made. Update some details to proceed.')
                        return false;
                    }
                }
            }

            var ans = confirm('Continue saving?')

            if( ans )
            {
                $.ajax({
                    type: $(form).attr("method"),
                    url: $(form).attr("action"),
                    data: $(form).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#btnModalUnitsave').button('loading')
                    },
                    success: function(data){
                    	$('#btnModalUnitsave').button('reset')
						$('#old_status').val( $('#status').val() )
						$('#taxi_'+current_data.unit_id+' .panel-nametag').html( drivers_json[current_unit][$('#select_driver').val()].nickname )
						$('#'+data.taxi+' a.panel-side-link').attr('data-type', data.element.data_type)
						$('#'+data.taxi).hide()
							 .removeClass(data.element.old_class)
							 .addClass(data.element.new_class)
							 .fadeIn(1000)

	                     $('#unitsModal').modal('hide')
	
	                     $('#top_message .msg').html(data.msg.text)
		                 $('#top_message').addClass(data.msg.class)
		                    .show()
		                    .fadeOut(5000)
	
	                     init()
                    }
                });
            }

            return false
        }
    })

    $('#status').on('change', function(){
        if( $(this).val() != '1' )
        {
            $('#select_driver').tooltip('hide')
            $('#select_driver').rules('remove', 'required')
            $('#select_driver').removeAttr('required')
        }
        else
        {
            $('#select_driver').rules('add', 'required')
        }
    })
    
    $('input[type="radio"]').on('change', function() {
    	if( current_data != '' )
        {
    		if( $(this).val() == "4" )
    			$('#boundary').attr('placeholder', current_data.holiday_rate)
    		else
    			$('#boundary').attr('placeholder', current_data.reg_rate)    			
        }
    });
})

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4]['value']
    var data_type = e.relatedTarget.attributes[5]['value']
    var data_coding = e.relatedTarget.attributes[6]['value']
    
    current_unit = data_id
    current_data = (typeof pos_json[data_id] !== "undefined") ? pos_json[data_id] : '';
    
    init()
    
    if( current_data != '' )
    {
    	generate_drivers_select()
    	
        switch( data_type ) {
            case '2':
            	$('.onduty-input').hide()
                $('#select_driver').show()
                $('#driver').hide()
                
                if( current_data.driver_id )
                {
                    $('#old_driver').val( current_data.driver_id )
                    $('#select_driver').val( current_data.driver_id )
                }

                $('#status option[value="1"]').show()
                $('#status').val(data_type)
                $('#old_status').val( data_type )
                $('#action').val('s_update')
                break;
            case '3':
            	$('#maintenance_notification', this).show()
            	$('#maintenance_notification a', this).attr('href', dashboard_url+'/units/maintenance/scheduled/'+data_id)
            	$('#frmModalPOS').hide()
            	$('.modal-footer', this).hide()
                break;
            default:
//                $('#select_driver').hide()
            	$('#old_driver').val( current_data.driver_id )
            	$('#select_driver').val(current_data.driver_id)
                $('.onduty-input').show()
//                $('#driver').show()
//                if( current_data.driver_id )
//                {
//                    $('#old_driver').val( current_data.driver_id )
//                    $('#driver').html(current_data.first_name+' '+current_data.last_name)
//                }
                
                $('#status option[value="1"]').hide()
                $('#status').val('')
                $('#action').val('u_update')
        }
        
        if( data_type == "1" && data_coding === "yes" )
    	{
    		$('#rate_input .btn-group').hide();
    		$('#rate_type input[type="radio"]').prop('checked', false)
    		$('#rate_input .coding').show()
    	}

        $('#unitsModalLabel').html('UNIT: '+current_data.plate_number.toUpperCase())
        $('#unit_id').val(data_id)
        $('#coding_day').val(current_data.coding_day)
        $('#boundary').prop('placeholder', current_data.reg_rate)
    }
})

$('#unitsModal').on('hidden.bs.modal', function (e) {
	$('#maintenance_notification', this).hide()
	$('#maintenance_notification a', this).attr('href', '')
	$('#frmModalPOS').show()
	$('.modal-footer', this).show()
})

function init() {
    $('#select_driver').tooltip('hide')

    $('#frmModalPOS input[type="text"]').val('')
    $('#frmModalPOS textarea').val('')
    $('#frmModalPOS #select_driver').val('')
    
    $('#rate_input .btn-group').show();
	$('#rate_input .coding').hide()
}

function cancel_pos() {
	var ans = confirm('Cancel this transaction?')

    if( ans )
    {
        $.ajax({
            type: "POST",
            url: base_url+'pos/ajax',
            data: { 'action' : 'cancel', 'unit_id' : current_unit, 'status' : '2', 'driver_id' : $('#select_driver').val() },
            dataType: "JSON",
            beforeSend: function() {
                $('#btnModalUnitCancel').button('loading')
            },
            success: function(data){
            	console.log(data)
            	$('#btnModalUnitCancel').button('reset')
				$('#old_status').val( $('#status').val() )

				if( $('#select_driver').val() != '' )
					$('#taxi_'+current_data.unit_id+' .panel-nametag').html( drivers_json[$('#select_driver').val()].nickname )
					
				$('#'+data.taxi+' a.panel-side-link').attr('data-type', data.element.data_type)
				$('#'+data.taxi).hide()
					 .removeClass('panel-green')
					 .addClass('panel-yellow')
					 .fadeIn(1000)

                 $('#unitsModal').modal('hide')

                 $('#top_message .msg').html(data.msg.text)
                 $('#top_message').addClass(data.msg.class)
                    .show()
                    .fadeOut(5000)

                 init()
            }
        });
    }
}

function generate_drivers_select( ) {
	$('#select_driver').find("option:gt(0)").remove();
	$('#select_driver optgroup').remove();
	
	var assigned = '<optgroup label="Assigned">'
	var reserved = '<optgroup label="Reserved">'
	$.each( drivers_json, function( i, drivers ){
		$.each( drivers, function( key, v ){
			if( current_unit == v.unit_id )
				assigned += '<option value="'+v.id+'" '+(current_data.driver_id == v.id ? 'selected' : '')+'>'+v.first_name+' '+v.last_name+'</option>'
			else
				reserved += '<option value="'+v.id+'">'+v.first_name+' '+v.last_name+'</option>'
		})
	})
	assigned += '</optgroup>'
	reserved += '</optgroup>'

	$('#select_driver option:first').after( assigned )
	$('#select_driver optgroup:first').after( reserved )
}