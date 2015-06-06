$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4]
    var data_type = e.relatedTarget.attributes[5]
    var data      = (typeof pos_json[data_id['value']] !== "undefined") ? pos_json[data_id['value']] : ''

    if( data != '' )
    {
        switch( data_type['value'] ) {
            case 'garrage':
            case 'maintenance':
                $('.onduty-input').hide()
                break;
            default:
                $('.onduty-input').show()
                
        }

        $('#driver').html('-- Unassigned --')
        if( data.driver_idFK )
            $('#driver').html(data.fname+' '+data.lname)

        $('#boundary').prop('placeholder', data.reg_rate)
        $('#status').val(data.status)
    }
})