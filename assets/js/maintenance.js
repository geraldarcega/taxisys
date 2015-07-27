$(document).ready(function() {
    $('[rel="tooltip"]').tooltip()
    
    $("#tbl_all_maintenance").tablesorter({
        headers: { 
             0: { sorter: false }
            ,4: { sorter: false }
        } 
    });

    // $('#parts').multiselect({includeSelectAllOption: true});

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
                        $('#btnModalMaintenanceSave').button('loading')
                    },
                    success: function(data){
                        if( data.success )
                            location.reload()
                        else
                        {
                            $('#btnModalMaintenanceSave').button('reset')
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

$('#maintenanceModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3]['value'];
    $('.unit-field').val('')
    $('#maintenanceModalLabel').html('ADD NEW MAINTENANCE ITEM')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')

    if( typeof maintenance_data[data_id] !== "undefined" )
    {
    	$('#parts_wrapper').html('');
        $('#maintenanceModalLabel').html('UPDATE MAINTENANCE ITEM')
        $('#action').val('update')
        $('#maintenance_id').val(data_id)

        $.each( maintenance_data[data_id], function( i, v ){
            if( $('#'+i).length && i != 'is_scheduled' )
                $('#'+i).val( v )

            if( i == 'name' )
                $('#m_type').val( v )

            if( i == 'is_scheduled' )
            	$('#is_scheduled').bootstrapSwitch('state', v == 1 ? true : false)

            if( i == 'parts_id' )
            {
                $.ajax({
                    type: 'POST',
                    url: base_url+'dashboard/maintenance/ajax',
                    data: { 'action' : 'get_parts', 'parts_id' : v },
                    dataType: "JSON",
                    success: function(data){
                        if( data.success )
                        {
                            $('#parts_wrapper').html('')
                            $.each( data.result, function( key, val ) {
                                add_parts( val.id, maintenance_data[data_id].count )
                            })
                        }
                    }
                });
            }
        })
    }
})

function add_parts( parts, count ) {
    var input_id = 'parts_'+$('#parts_wrapper .row').length
    var parts_select = '';
    var parts_stock = '';

    if( typeof parts_data === "object" )
    {
        $.each( parts_data, function( key, val ) {
            parts_select += '<option value="'+key+'">'+val.name+'</option>'
        })
    }
    
    var parts_input = '<div id="'+input_id+'" class="row" style="margin-top: 10px;">\
                            <div class="col-xs-7">\
                                <select name="parts[]" class="form-control parts-select" required>\
                                    <option value="">---</option>\
                                    '+parts_select+'\
                                </select>\
                            </div>\
                            <div class="col-xs-3">\
                                <select name="parts_count[]" class="form-control parts-stock-select" required>\
                                    <option value="">---</option>\
                                    '+parts_stock+'\
                                </select>\
                            </div>\
                            <div class="col-xs-2">\
                                <a href="javascript:remove_parts(\''+input_id+'\');" rel="tooltip" data-original-title="Remove"><i class="fa fa-times"></i></a>\
                            </div>\
                        </div>';
    $('#parts_wrapper').append( parts_input )

    $('.parts-select').on( 'change', function(){
        var max = parts_data[$(this).val()].stock
        var parent = $(this).parent().parent().prop('id')
        var parts_select = '<option value="">---</option>'

        for (var i = 1; i <= max; i++) {
            parts_select += '<option value="'+i+'">'+i+'</option>'
        };
        $('#'+parent+' .parts-stock-select').html(parts_select)
    } )

    if( parts != '' && count != '' )
    {
        $('#'+input_id+' .parts-select').val(parts)
        $('.parts-select').change()
        $('#'+input_id+' .parts-stock-select').val(count)
    }
}

function remove_parts( input_id ) {
    var ans = confirm('Remove this parts?')
    
    if(ans)
        $('#'+input_id).remove()
}