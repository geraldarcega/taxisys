$(document).ready(function() {
    $("#tbl_garrage").tablesorter({
        headers: { 
             0: { sorter: false }
            ,3: { sorter: false }
        } 
    });

    $('#frmModalGarrage').validate({
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
                        $('#btnModalGarrageSave').button('loading')
                    },
                    success: function(data){
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalGarrageSave').button('reset')
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

$('#garrageModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3];
    
    $('.unit-field').val('')
    $('#garrageModalLabel').html('CREATE NEW GARRAGE')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')

    if( typeof garrage_data[data_id['value']] !== "undefined" )
    {
        $('#garrageModalLabel').html('UPDATE GARRAGE')
        $('#action').val('update')
        $('#unit_id').val(data_id['value'])
        $.each( garrage_data[data_id['value']], function( i, v ){
            if( $('#'+i).length )
            {
                $('#'+i).val( v )
            }
        })
    }
})