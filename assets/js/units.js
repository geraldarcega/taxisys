$(document).ready(function() {
    $('[rel="tooltip"]').tooltip()
    
    $("#tbl_all_units").tablesorter({
        headers: { 
             0: { sorter: false }
            ,4: { sorter: 'shortDate' }
            ,5: { sorter: 'shortDate' }
            ,7: { sorter: false } 
        } 
    });

    $('#resealing_date1_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#resealing_date2_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#franchise_until_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#renew_by_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#year_model_dp').datetimepicker({format: "YYYY",viewMode: "years"});

    if( $('#frmModalUnits').length )
    {
        $('#frmModalUnits').validate({
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
    }
    
    if( $('#frmModalMaintenance').length )
    {
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
    }

    if( !$.isEmptyObject(maintenance_data) )
    {
        var options = '<option value=""> --- </option>'
        $.each( maintenance_data, function( i, v ){
            options += '<option value="'+i+'">'+v.name+'</option>'
        } )
        $('#maintenance').html(options)
    }
    $('#parts_included').hide()
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

$('#maintenance').on( 'change', function(){
    $('#tbl_maintenance_parts tbody').html('')
    if( $(this).val() != '' )
    {
        $.getJSON( base_url+'dashboard/units/ajax', { action: "get_parts", maintenance_id: $(this).val() } )
        .done(function( data ) {
            if( data.success )
            {
                if( !$.isEmptyObject(data.result) )
                {
                    var details = ''
                    $.each( data.result, function( i, v ){
                        details += '<tr><td>'+v.name+'</td><td>'+v.count+'</td></tr>'
                    } )
                    $('#tbl_maintenance_parts tbody').html(details)
                    $('#parts_included').slideDown("fast")
                }
            }
        });
    }
    else
    {
        $('#parts_included').slideUp("fast")
    }
} )