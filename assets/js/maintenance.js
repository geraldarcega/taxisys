$(document).ready(function() {
    $('[rel="tooltip"]').tooltip()
    
    $("#tbl_all_maintenance").tablesorter({
        headers: { 
             0: { sorter: false }
            ,3: { sorter: false }
        } 
    });

    // $('#resealing_date1_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });

    $('#frmModalMaintenance').validate({
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
});

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3];
    
    $('.unit-field').val('')
    $('#unitsModalLabel').html('CREATE NEW UNIT')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')

    if( typeof units_data[data_id['value']] !== "undefined" )
    {
        $('#unitsModalLabel').html('UPDATE UNIT')
        $('#action').val('update')
        $('#unit_id').val(data_id['value'])
        $.each( units_data[data_id['value']], function( i, v ){
            if( $('#'+i).length )
            {
                if( i.indexOf('date') > -1 )
                    $('#'+i).val( readableDate(v) )
                else
                    $('#'+i).val( v )
            }

            if( i == 'plate_number' )
            {
                var plate_number = v.split(' ')

                $('#'+i+'1').val( plate_number[0].toUpperCase() )
                $('#'+i+'2').val( plate_number[1] )
            }
        })
    }
})