$(document).ready(function() {
    $('[rel="tooltip"]').tooltip()
    
    $("#tbl_all_units").tablesorter({
        headers: { 
             0: { sorter: false }
            ,4: { sorter: 'shortDate' }
            ,5: { sorter: 'shortDate' }
            ,8: { sorter: false } 
        } 
    });

    $('#schedule_dp').datetimepicker({ 'format': 'MMM DD, YYYY' });
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

//    if( !$.isEmptyObject(maintenance_data) )
//    {
//        var options = '<option value=""> --- </option>'
//        $.each( maintenance_data, function( i, v ){
//            options += '<option value="'+i+'">'+v.name+'</option>'
//        } )
//        $('#maintenance').html(options)
//    }
//    $('#parts_included').hide()
    
    $('#scheduled').bootstrapSwitch('state', false)
});

$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3]['value'];
    
    $('.unit-field').val('')
    $('#unitsModalLabel').html('CREATE NEW UNIT')
    $('#failed_msg span').html('')
    $('#failed_msg').hide()
    $('#action').val('create')

    if( typeof units_data[data_id] !== "undefined" )
    {
        $('#unitsModalLabel').html('UPDATE UNIT')
        $('#action').val('update')
        $('#unit_id').val(data_id)
        $.each( units_data[data_id], function( i, v ){
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

$('#maintenanceModal').on('show.bs.modal', function (e) {
    var data_id = e.relatedTarget.attributes[3]['value'];
    $('#m_unit_id').val(data_id)
    if( typeof units_data[data_id] !== "undefined" )
    {
        $('#maintenanceModalLabel').html( 'UNIT MAINTENANCE: '+units_data[data_id].plate_number.toUpperCase() )
        $('span#modalOdometer').html( $('#odometer_'+data_id).html() )
        $('#current_odometer').val(units_data[data_id].odometer)
    }
})

$('#maintenance').on( 'change', function(){
    $('#tbl_maintenance_parts tbody').html('')
    if( $(this).val() != '' )
    {
    	$('#interval').html( formatNumber(maintenance_data[$(this).val()].interval) )
    	$('#price').html( formatNumber(maintenance_data[$(this).val()].price) )
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
            else
            	$('#parts_included').slideUp("fast")
        });
    }
    else
    {
        $('#parts_included').slideUp("fast")
    }
} )

$('#btnUpdateOdo').on( 'click', function() {
    var rx = new RegExp(/^\d+$/);
    if( $('#odometer').val() == '' || !rx.test($('#odometer').val()) )
    {
        alert('Please enter valid number for odometer')
        return false
    }
    var new_odometer = $('#odometer').val()
    $.ajax({
        type: 'POST',
        url: base_url+'dashboard/units/ajax',
        data: { 'action' : 'update_odometer','unit_id' : $('#btnUpdateOdo').attr('data-id'), 'odometer' : new_odometer },
        dataType: "JSON",
        beforeSend: function() {
            $('#btnUpdateOdo').button('loading')
        },
        success: function(data){
            if( data.success )
            {
            	$('#odometer_'+$('#btnUpdateOdo').attr('data-id')).html(formatNumber(new_odometer))
                $('#btnUpdateOdo').button('reset')
                $('#odomsg').slideDown().delay(400).slideUp()
            }
        }
    });
})

function show_odometer( unit_id ) {
	var odometer = $('#input_odometer_'+unit_id)
	var opts = $('#units_opt_'+unit_id)

	if( odometer.is(":visible") == false )
	{
		odometer.slideDown("fast")
		opts.hide()
	}
	else
	{
		odometer.hide()
		opts.show()
	}
}

function apply_maintenance( maintenance_id ) {
	var ans = confirm('Are you sure you want to apply this maintenance?')
	
	if( ans )
	{
		$.ajax({
	        type: $('#frmModalMaintenance').attr('method'),
	        url: $('#frmModalMaintenance').attr('action'),
	        data: { 'action' : 'apply_maintenance', 'unit_id' : $('#m_unit_id').val(), 'maintenance_id' : maintenance_id, 'odometer' : $('#current_odometer').val() },
	        dataType: "JSON",
	        beforeSend: function() {
	            $('#apply_link_'+maintenance_id).removeClass('fa-caret-square-o-right').addClass('fa-cog fa-spin')
	        },
	        success: function(data){
	            if( data.success )
            	{
	            	$('#apply_link_'+maintenance_id).removeClass('fa-cog fa-spin').addClass('fa-gears')
	            	location.reload()
            	}
	            else
            	{
	            	$('#maintenanceModal #msg').removeClass('alert-success')
	            	$('#maintenanceModal #msg span').html(data.alert.msg)
	            	$('#maintenanceModal #msg').addClass(data.alert.class).fadeIn().fadeOut(5000)
            	}
	        	
	        }
	    });
	}
}

function show_maintenance_info(maintenance_id) {
	if( !$('#maintenance_info_'+maintenance_id).is(':visible') )
		$('.maintenance-info').hide()

	$('#maintenance_info_'+maintenance_id).slideToggle()
}

function complete_maintenance( id ){
	return false;
}