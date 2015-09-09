var current_data
var current_unit

$(document).ready( function(){
    init()
    
    $('#actual_date').datetimepicker({ 'format': 'MMM DD, YYYY' });

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
						$('#taxi_'+current_data.unit_id+' .panel-nametag').html( drivers_json[$('#select_driver').val()].nickname )
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
                $('#btnModalUnitLate').attr('onclick', 'show_payment_fields( 0, '+current_data.driver_id+', '+data_type+');')
                show_payment_fields( 2, current_data.driver_id, data_type)
            	// $('.onduty-input').hide()
             //    $('#select_driver').show()
             //    $('#driver').hide()
                
             //    if( current_data.driver_id )
             //    {
             //        $('#old_driver').val( current_data.driver_id )
             //        $('#select_driver').val( current_data.driver_id )
             //    }

             //    $('#status option[value="1"]').show()
             //    $('#status').val(data_type)
             //    $('#old_status').val( data_type )
             //    $('#action').val('s_update')
             //    $('#btnModalUnitLate').show()

                break;
            case '3':
            	$('#maintenance_notification', this).show()
            	$('#maintenance_notification a', this).attr('href', dashboard_url+'/units/maintenance/scheduled/'+data_id)
            	$('#frmModalPOS').hide()
            	$('.modal-footer', this).hide()
                break;
            default:
                $('#btnModalUnitLate').attr('onclick', 'show_payment_fields( 0, '+current_data.driver_id+', 0);')
                show_payment_fields( 1, current_data.driver_id, 0 )
//                $('#select_driver').hide()
            	// $('#old_driver').val( current_data.driver_id )
            	// $('#select_driver').val(current_data.driver_id)
             //    $('.onduty-input').show()
//                $('#driver').show()
//                if( current_data.driver_id )
//                {
//                    $('#old_driver').val( current_data.driver_id )
//                    $('#driver').html(current_data.first_name+' '+current_data.last_name)
//                }
                
                // $('#btnModalUnitLate').hide()
                // $('#status option[value="1"]').hide()
                // $('#status').val('')
                // $('#action').val('u_update')
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

    $('.tooltip').tooltip('hide')
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
            	$('#btnModalUnitCancel').button('reset')
				$('#old_status').val( $('#status').val() )

				if( $('#select_driver').val() != '' )
					$('#taxi_'+current_data.unit_id+' .panel-nametag').html( drivers_json[$('#select_driver').val()].nickname )

				$('#taxi_'+current_data.unit_id).attr('data-type', data.element.data_type)
				$('#taxi_'+current_data.unit_id).hide()
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
	// $.each( drivers_json, function( i, drivers ){
		$.each( drivers_json, function( key, v ){
			if( current_unit == v.unit_id )
				assigned += '<option value="'+v.id+'" '+(current_data.driver_id == v.id ? 'selected' : '')+'>'+v.first_name+' '+v.last_name+'</option>'
			else
				reserved += '<option value="'+v.id+'">'+v.first_name+' '+v.last_name+'</option>'
		})
	// })
	assigned += '</optgroup>'
	reserved += '</optgroup>'

	$('#select_driver option:first').after( assigned )
	$('#select_driver optgroup:first').after( reserved )
}

function show_payment_fields( type, driver_id, data_type ) {
    var is_visible = $('.onduty-input').is(':hidden');
    var condition = type == 0 ? is_visible : type == 1 ? 'onduty' : 'garrage';

    if( condition == true || condition == 'onduty' ) {
        $('#old_driver').val( driver_id )
        $('#select_driver').val(driver_id)
        $('.onduty-input').show()
        
        $('#status option[value="1"]').hide()
        $('#status').val('')
        $('#action').val('u_update')

        if( condition != 'onduty' )
        {
            $('#btnModalUnitLate').show()
            $('#btnModalUnitLate').html('Cancel Late Payment')
            $('#late_payment').val('1')
            $('#actual_date').show()
            $('#date_now').hide()
        }
        else
        {
            $('#actual_date').hide()
            $('#date_now').show()
            $('#btnModalUnitLate').hide()
            $('#late_payment').val('0')
        }
    }
    else
    {
        $('.onduty-input').hide()
        $('#select_driver').show()
        $('#driver').hide()
        
        if( driver_id )
        {
            $('#old_driver').val( driver_id )
            $('#select_driver').val( driver_id )
        }

        $('#status option[value="1"]').show()
        $('#status').val(data_type)
        $('#old_status').val( data_type )
        $('#action').val('s_update')

        $('#actual_date').hide()
        $('#date_now').show()
        if( condition != 'onduty' )
        {
            $('#btnModalUnitLate').show()
            $('#btnModalUnitLate').html('Late Payment')
            $('#late_payment').val('1')
        }
        else
        {
            $('#btnModalUnitLate').hide()
            $('#late_payment').val('0')
        }
    }
}