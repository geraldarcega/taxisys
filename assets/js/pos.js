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
                    	$('#old_status').val( $('#status').val() )
                         $('#'+data.taxi+' a.panel-side-link').attr('data-type', data.element.data_type)
                         $('#'+data.taxi).hide()
                                         .removeClass(data.element.old_class)
                                         .addClass(data.element.new_class)
                                         .fadeIn(1000)

                         $('#unitsModal').modal('hide')

                         $('#pos_alert .msg').html(data.msg.text)
                         $('#pos_alert').addClass(data.msg.class)
                                        .show()
                                        .fadeOut(4000)

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
})

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4]['value']
    var data_type = e.relatedTarget.attributes[5]['value']
    var data_coding = e.relatedTarget.attributes[6]['value']
    var data      = (typeof pos_json[data_id] !== "undefined") ? pos_json[data_id] : ''

    init()
    if( data != '' )
    {
        switch( data_type ) {
            case '2':
            	$('.onduty-input').hide()
                $('#select_driver').show()
                $('#driver').hide()
                
                if( data.driver_id )
                {
                    $('#old_driver').val( data.driver_id )
                    $('#select_driver').val( data.driver_id )
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
            	$('#old_driver').val( data.driver_id )
            	$('#select_driver').val(data.driver_id)
                $('.onduty-input').show()
//                $('#driver').show()
//                if( data.driver_id )
//                {
//                    $('#old_driver').val( data.driver_id )
//                    $('#driver').html(data.first_name+' '+data.last_name)
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

        $('#unitsModalLabel').html('UNIT: '+data.plate_number.toUpperCase())
        $('#unit_id').val(data_id)
        $('#coding_day').val(data.coding_day)
        $('#boundary').prop('placeholder', data.reg_rate)
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
    
    $('#rate_input .btn-group').show();
	$('#rate_input .coding').hide()
}