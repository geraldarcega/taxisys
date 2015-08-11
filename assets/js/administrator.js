$(document).ready(function() {
    $("#tbl_garage").tablesorter({
        headers: { 
             0: { sorter: false }
            ,3: { sorter: false }
        } 
    });

    $('#frmModalGarage').validate({
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
                        $('#btnModalGarageSave').button('loading')
                    },
                    success: function(data){
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalGarageSave').button('reset')
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

$('#garageModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3];
    
    $('.unit-field').val('')
    $('#garageModalLabel').html('CREATE NEW GARRAGE')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')

    if( typeof garage_data[data_id['value']] !== "undefined" )
    {
        $('#garageModalLabel').html('UPDATE GARRAGE')
        $('#action').val('update')
        $('#unit_id').val(data_id['value'])
        $.each( garage_data[data_id['value']], function( i, v ){
            if( $('#'+i).length )
            {
                $('#'+i).val( v )
            }
        })
    }
})