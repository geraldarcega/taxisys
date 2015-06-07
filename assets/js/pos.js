$(document).ready( function(){
    $('#frmModalPOS').validate({
        submitHandler: function(form) {
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
                $('#old_driver').show()
                $('#driver').hide()
                if( data.driver_id )
                {
                    $('#old_driver').val( data.driver_id )
                    $('#select_driver').val( data.driver_id )
                }
                break;
            default:
                $('#old_driver').hide()
                $('.onduty-input').show()
                $('#driver').show()
                if( data.driver_id )
                    $('#driver').html(data.fname+' '+data.lname)
        }



        $('#unitsModalLabel').html('UNIT - '+data.plate_number.toUpperCase())
        $('#action').val('update')
        $('#unit_id').val(data_id)

        $('#boundary').prop('placeholder', data.reg_rate)
        $('#status').val(data.status)
    }
})