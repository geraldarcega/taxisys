$(document).ready(function() {
    $("#tbl_all_units").tablesorter({
        headers: { 
             0: { sorter: false }
            ,4: { sorter: 'shortDate' }
            ,5: { sorter: 'shortDate' }
            ,6: { sorter: false } 
        } 
    });

    $('#filter').popover({
                             'html' : true
                            ,'content' : '<form class="form-horizontal" method="get" action=""><div class="form-group"><div class="col-xs-12"><input type="text" class="form-control" id="search" name="search" placeholder="Search here.."></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">In</label><div class="col-xs-8"><select id="coding_day" name="coding_day" class="form-control"><option value="">----</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">optionursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">Sort by</label><div class="col-xs-8"><select id="sort" name="sort" class="form-control"><option value="">----</option><option value="plate_number">Plate #</option><option value="year_model">Year Model</option><option value="coding_day">Coding Day</option><option value="franchise_until">Franchise Until</option><option value="renew_by">Renew By</option><option value="status">Status</option></select></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">Direction</label><div class="col-xs-8"><label><input type="radio" name="sort_order" id="sort_order_asc" value="asc" checked>Asc</label>&nbsp;&nbsp;<label><input type="radio" name="sort_order" id="sort_order_desc" value="desc">Desc</label></div></div><div class="form-group"><div class="col-xs-12" style="text-align: center;"><button type="submit" class="btn btn-primary">Filter</button>&nbsp;&nbsp;<button type="button" class="btn btn-warning" onclick="$(\'#filter\').popover(\'hide\')">Close</button></div></div></form>'
                        })

    $('#releasing_date1_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#releasing_date2_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#franchise_until_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#renew_by_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#year_model_dp').datetimepicker({format: "YYYY",viewMode: "years"});

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
});

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3];
    
    $('.unit-field').val('')
    $('#unitsModalLabel').html('CREATE NEW UNIT')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()

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