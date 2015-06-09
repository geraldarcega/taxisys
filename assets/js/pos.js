$(document).ready( function(){
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
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalUnitsave').button('reset')
                            $('#failed_msg span').html( data.msg )
                            $('#failed_msg').show()
                        }
                    }
                });
            }

            return false
        }
    })
})

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4]['value']
    var data_type = e.relatedTarget.attributes[5]['value']
    var data      = (typeof pos_json[data_id] !== "undefined") ? pos_json[data_id] : ''

    if( data != '' )
    {
        switch( data_type ) {
            case 'garrage':
            case 'maintenance':
                $('.onduty-input').hide()
                $('#select_driver').show()
                $('#driver').hide()
                
                if( data.driver_id )
                {
                    $('#old_driver').val( data.driver_id )
                    $('#select_driver').val( data.driver_id )
                }

                $('#old_status').val( data.unit_status )
                $('#action').val('s_update')
                break;
            default:
                $('#select_driver').hide()
                $('.onduty-input').show()
                $('#driver').show()
                if( data.driver_id )
                    $('#driver').html(data.fname+' '+data.lname)
                
                $('#action').val('u_update')
        }



        $('#unitsModalLabel').html('UNIT: '+data.plate_number.toUpperCase())
        $('#unit_id').val(data_id)
        $('#boundary').prop('placeholder', data.reg_rate)
        $('#status').val(data.unit_status)
    }
})