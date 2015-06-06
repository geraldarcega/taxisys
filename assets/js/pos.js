$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4]['value']
    var data_type = e.relatedTarget.attributes[5]['value']
    var data      = (typeof pos_json[data_id] !== "undefined") ? pos_json[data_id] : ''
    console.log(data)
    if( data != '' )
    {
        switch( data_type ) {
            case 'garrage':
            case 'maintenance':
                $('.onduty-input').hide()
                break;
            default:
                $('.onduty-input').show()
                
        }

        $('#unitsModalLabel').html('UNIT - '+data.plate_number.toUpperCase())
        $('#action').val('update')
        $('#unit_id').val(data_id)

        $('#driver').html('-- Unassigned --')
        if( data.driver_id )
            $('#driver').html(data.fname+' '+data.lname)

        $('#boundary').prop('placeholder', data.reg_rate)
        $('#status').val(data.status)
    }
})