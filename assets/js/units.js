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

    $('#date_from_dp').datetimepicker({ 'minDate': new Date(), 'format': 'MMM DD, YYYY' });
    $('#time_from_dp').datetimepicker({ 'format': 'hh:mm A' });
    $('#date_to_dp').datetimepicker({ 'minDate': new Date(), 'format': 'MMM DD, YYYY' });
    $('#time_to_dp').datetimepicker({ 'format': 'hh:mm A' });
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
            	apply_maintenance()

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
    
    $('#multi_day').bootstrapSwitch('state', false)
    $('#frmModalMaintenance .update-flds').hide()
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
    var data_id = e.relatedTarget.attributes[3]['value']
    var unit_id = unit_data.unit_id
    var unit_maintenance

    $('.datetime_to').hide()
	try{
		unit_maintenance = unit_data.maintenance.ongoing[unit_id][data_id]
	}catch(e){
		unit_maintenance = ''
	}

    $('#maintenance_id').val(data_id)
    console.log(unit_maintenance)
    init_unit_maintenance()
    if( typeof maintenance_data[data_id] !== "undefined" )
    {
    	var suffix_title = ''
        if( typeof unit_maintenance !== "undefined" )
    	{
        	$('#action').val('update_applied_maintenance')
        	$('#unit_maintenance_id').val(unit_maintenance.id)
        	$('#date_from').val( readableDate(unit_maintenance.date_from) )
        	$('#time_from').val( unit_maintenance.time_from )
        	if( unit_maintenance.date_to != null )
    		{
        		$('#date_to').val( readableDate(unit_maintenance.date_to) )
            	$('#time_to').val( unit_maintenance.time_to )
            	$('#multi_day').bootstrapSwitch('state', true)
    		}
        	$('textarea#notes').val( unit_maintenance.notes )
        	
        	$('#frmModalMaintenance .update-flds').show()
        	suffix_title = 'UPDATE '
    	}
        $('#maintenanceModalLabel').html(suffix_title+'SET-UP MAINTENANCE: '+maintenance_data[data_id].name.toUpperCase())
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

function apply_maintenance() {
	var ans = confirm('Are you sure you want to apply this maintenance?')
	
	if( ans )
	{
		$.ajax({
	        type: $('#frmModalMaintenance').attr('method'),
	        url: $('#frmModalMaintenance').attr('action'),
//	        data: { 'action' : 'apply_maintenance', 'unit_id' : $('#m_unit_id').val(), 'maintenance_id' : maintenance_id, 'odometer' : $('#current_odometer').val() },
	        data: $('#frmModalMaintenance').serialize(),
	        dataType: "JSON",
	        beforeSend: function() {
	            $('#btnModalMaintenanceSave').button('loading')
	        },
	        success: function(data){
	            if( data.success )
            	{
	            	$('#btnModalMaintenanceSave').button('resest')
	            	location.reload()
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

function init_unit_maintenance() {
	$('#frmModalMaintenance .update-flds').hide()
	$('#notes').val('')
    $('#date_from').val( '' )
	$('#time_from').val( '' )
	$('#date_to').val( '' )
	$('#time_to').val( '' )
	$('#multi_day').bootstrapSwitch('state', false)
}

$('input[name="multi_day"]').on('switchChange.bootstrapSwitch', function(event, state) {
	if( $(this).is(':checked') === true )
		$('.datetime_to').show()
	else
		$('.datetime_to').hide()
})