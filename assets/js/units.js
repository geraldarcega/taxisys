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

    $('#date_from').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#time_from').datetimepicker({ 'format': 'hh:mm A' });
    $('#date_to').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#time_to').datetimepicker({ 'format': 'hh:mm A' });
    $('#registration_date').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#resealing_date1').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#resealing_date2').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#franchise_until').datetimepicker({'format': 'MMM DD, YYYY' });
    $('#renew_by').datetimepicker({ 'format': 'MMM DD, YYYY' });
    $('#year_model').datetimepicker({format: "YYYY",viewMode: "years"});
    
    $('#franchise_until').on('dp.change', function(e){
        var renew_by = readableDate(dateAdd(e.date._d, 'month', -8))
        $('#renew_by').val( renew_by )
    })

    $('#year_model').on('click', function(event){
        event.preventDefault();
        $('#datetimepicker').click();
    });
    
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
    $('#allday').bootstrapSwitch('state', false)
    $('#frmModalMaintenance .update-flds').hide()

    $('.btnUpdateOdo').on( 'click', function() {
        var unit_id = $(this).attr('data-id')
        var new_odometer = $('#new_odometer_'+unit_id).val()
        var rx = new RegExp(/^\d+$/);
        console.log(unit_id, new_odometer)
        if( new_odometer == '' || !rx.test(new_odometer) )
        {
            alert('Please enter valid number for odometer')
            return false
        }
        
        $.ajax({
            type: 'POST',
            url: base_url+'dashboard/units/ajax',
            data: { 'action' : 'update_odometer','unit_id' : unit_id, 'odometer' : new_odometer },
            dataType: "JSON",
            beforeSend: function() {
                $('.btnUpdateOdo').button('loading')
            },
            success: function(data){
                if( data.success )
                {
                    $('#odometer_'+unit_id).html(formatNumber(new_odometer))
                    $('.btnUpdateOdo').button('reset')
                    show_odometer(unit_id)
                    show_alert_msg('Unit odometer has been updated.', true);
                }
            }
        });
    })
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
                if( i.indexOf('date') > -1 || i == 'franchise_until' || i == 'renew_by' )
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
	var suffix_title = ''
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
    console.log(unit_maintenance, unit_id, data_id)
    init_unit_maintenance()
    if( typeof unit_maintenance !== "undefined" && unit_maintenance != "" )
    {
    	$('#action').val('update_applied_maintenance')
    	$('#unit_maintenance_id').val(unit_maintenance.id)
    	$('#date_from').val( readableDate(unit_maintenance.date_from) )
    	$('#time_from').val( unit_maintenance.time_from )
    	
    	if( unit_maintenance.allday == '1' )
		{
    		$('#allday').bootstrapSwitch('state', true)
    		$('.time_field').hide()
		}
		else
		{
			$('#allday').bootstrapSwitch('state', false)
			$('.time_field').show()
		}

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
    else
    	$('.status-fld').hide()
    	
    $('#maintenanceModalLabel').html(suffix_title+'SET-UP MAINTENANCE: '+maintenance_data[data_id].name.toUpperCase())
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
	            	$('#btnModalMaintenanceSave').button('reset')
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
	$('#allday').bootstrapSwitch('state', false)
}

$('input[name="multi_day"]').on('switchChange.bootstrapSwitch', function(event, state) {
	if( $(this).is(':checked') === true )
		$('.datetime_to').show()
	else
		$('.datetime_to').hide()
})

$('#allday').on('switchChange.bootstrapSwitch', function(event, state) {
	if( $(this).is(':checked') === true )
		$('.time_field').hide()
	else
		$('.time_field').show()
})

function archive(id, plate_number) {
	var ans = confirm('Archive '+plate_number+'?')
	
	if( ans )
	{
		$.ajax({
	        type: $('#frmModalMaintenance').attr('method'),
	        url: $('#frmModalMaintenance').attr('action'),
	        data: { 'action' : 'archive', 'unit_id' : id },
	        dataType: "JSON",
	        beforeSend: function() {
	            $('#archive_'+id+' i').removeClass('fa-archive').addClass('fa-spin fa-cog')
	        },
	        success: function(data){
	            if( data.success )
            	{
	            	$('#archive_'+id+' i').removeClass('fa-spin fa-cog').addClass('fa-archive')
	            	location.reload()
            	}
	        }
	    });
	}
}