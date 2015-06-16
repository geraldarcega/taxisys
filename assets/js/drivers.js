$(document).ready(function() {
    $("#tbl_drivers").tablesorter({
        headers: { 
             0: { sorter: false }
            ,5: { sorter: false } 
        } 
    });

    $('#dob').datetimepicker({ 'format': 'MMM DD, YYYY' });

    $('#frmModalDriver').validate({
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
                        $('#btnModalDriversave').button('loading')
                    },
                    success: function(data){
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalDriversave').button('reset')
                            $('#failed_msg span').html( data.msg )
                            $('#failed_msg').show()
                        }
                    }
                });
            }

            return false
        }
    })
});

$('#driversModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3];
    
    $('.driver-field').val('')
    $('#driversModalLabel').html('CREATE NEW DRIVER')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')
    $('#driver_id', this).val('')

    if( typeof drivers_data[data_id['value']] !== "undefined" )
    {
        $('#driversModalLabel').html('UPDATE DRIVER')
        $('#action').val('update')
        $('#driver_id').val(data_id['value'])
        $.each( drivers_data[data_id['value']], function( i, v ){
            if( $('#'+i).length )
            {
                if( i.indexOf('status') > -1 ){
                    if( v == "1" )
                        $('#'+i).bootstrapSwitch( 'state', true )
                    else
                        $('#'+i).bootstrapSwitch( 'state', false )
                }

                if( i.indexOf('dob') > -1 )
                    $('#'+i).val( readableDate(v) )
                else
                {
                    $('#'+i).val( v )
                }
            }

            if( i == 'unit_id' )
            {
                $('#unit').val( v )
            }
        })
    }
})