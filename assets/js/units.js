$(document).ready(function() {
    $('#filter').popover({
                             'html' : true
                            ,'content' : '<form class="form-horizontal"><div class="form-group"><div class="col-xs-12"><input type="text" class="form-control" id="search" name="search" placeholder="Search here.."></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">In</label><div class="col-xs-8"><select id="coding_day" name="coding_day" class="form-control"><option value="">----</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">Sort by</label><div class="col-xs-8"><select id="coding_day" name="coding_day" class="form-control"><option value="">----</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></div></div><div class="form-group"><label for="reg_rate" class="col-xs-4 control-label">Direction</label><div class="col-xs-8"><label><input type="radio" name="sort_order" id="sort_order_asc" value="asc" checked>Asc</label>&nbsp;&nbsp;<label><input type="radio" name="sort_order" id="sort_order_desc" value="dec">Desc</label></div></div><div class="form-group"><div class="col-xs-12" style="text-align: center;"><button type="button" class="btn btn-primary">Filter</button>&nbsp;&nbsp;<button type="button" class="btn btn-warning" onclick="$(\'#filter\').popover(\'hide\')">Close</button></div></div></form>'
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
                        console.log(data)
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

    populate_tbl();
});

function populate_tbl() {
    if( typeof units_data !== 'undefined' )
    {
        if( units_data.length )
        {
            $('#tbl_loading').show()
            var num = 0;
            $.each( units_data, function(i, v) {
                num++;

                var htm = '<tr id="unit_'+v.unit_id+'"><td>'+num+'</td><td>'+v.plate_number.toUpperCase()+'</td><td>'+v.year_model+'</td><td>'+v.coding_day+'</td><td>'+readableDate(v.franchise_until)+'</td><td>'+readableDate(v.renew_by)+'</td><td><a href="#"><i class="fa fa-eye"></i></a></td></tr>'
                $('#tbl_all_units').append(htm);
            })
            $('#tbl_loading').hide()
        }
    }
}