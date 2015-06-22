$(document).ready(function() {
    $('[rel="tooltip"]').tooltip()
    
    $("#tbl_all_parts").tablesorter({
        headers: { 
             0: { sorter: false }
            ,5: { sorter: 'shortDate' }
            ,6: { sorter: false }
        } 
    });

    $('#purchase_date_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });

    $('#frmModalParts').validate({
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
                        $('#btnModalPartsSave').button('loading')
                    },
                    success: function(data){
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalPartsSave').button('reset')
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

$('#partsModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3]['value'];
    
    init()
    $('#maintenanceModalLabel').html('ADD NEW PARTS')
    $('#action').val('create')

    if( typeof parts_data[data_id] !== "undefined" )
    {
        $('#maintenanceModalLabel').html('UPDATE PARTS DETAILS')
        $('#action').val('update')
        $('#parts_id').val(data_id)

        $.each( parts_data[data_id], function( i, v ){
            if( $('#'+i).length )
            {
                if( i.indexOf('purchase_date') > -1 )
                    $('#'+i).val( readableDate(v) )
                else
                    $('#'+i).val( v )
            }
        })
    }
})

function init()
{
    $('.form-control').tooltip('hide')
    $('.form-control').val('')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
}