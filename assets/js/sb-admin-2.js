$(function() {
    $('#side-menu').metisMenu();
    $(".bs-switch").not("[data-switch-no-init]").bootstrapSwitch();

    // $.get( base_url+"static/filter.html", function( data ) { $('#filter_wrapper').html(data) })
    
    $('.BSswitch').bootstrapSwitch();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse')
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse')
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    })
})

function readableDate( date ){
	if( date == null )
		return null

    var d =new Date(date);
    var month_name=new Array(12);
    month_name[0]="Jan"
    month_name[1]="Feb"
    month_name[2]="Mar"
    month_name[3]="Apr"
    month_name[4]="May"
    month_name[5]="Jun"
    month_name[6]="Jul"
    month_name[7]="Aug"
    month_name[8]="Sep"
    month_name[9]="Oct"
    month_name[10]="Nov"     
    month_name[11]="Dec"

    return month_name[d.getMonth()]+" "+d.getDate()+", "+d.getFullYear();
}

function formatNumber( num ) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function ucwords(str) {
	return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
		return $1.toUpperCase();
	});
}

function show_alert_msg(msg, success) {
    if( success )
        $('#top_message').addClass('alert-info').removeClass('alert-danger')
    else
        $('#top_message').addClass('alert-danger').removeClass('alert-info')

    $('#top_message span.msg').html(msg)
    $('#top_message').slideDown().delay(10000).slideUp()
}

function dateAdd(date, interval, units) {
  var ret = new Date(date); //don't change original date
  switch(interval.toLowerCase()) {
    case 'year'   :  ret.setFullYear(ret.getFullYear() + units);  break;
    case 'quarter':  ret.setMonth(ret.getMonth() + 3*units);  break;
    case 'month'  :  ret.setMonth(ret.getMonth() + units);  break;
    case 'week'   :  ret.setDate(ret.getDate() + 7*units);  break;
    case 'day'    :  ret.setDate(ret.getDate() + units);  break;
    case 'hour'   :  ret.setTime(ret.getTime() + units*3600000);  break;
    case 'minute' :  ret.setTime(ret.getTime() + units*60000);  break;
    case 'second' :  ret.setTime(ret.getTime() + units*1000);  break;
    default       :  ret = undefined;  break;
  }
  return ret;
}

function show_filter(){
    if( $('#filter_wrapper').is(':visible') )
    {
        $('#filter_wrapper').slideUp('fast');
        $('#filter').html('<i class="fa fa-filter"></i> Filter')
    }
    else
    {
        $('#filter_wrapper').slideDown('slow');
        $('#filter').html('<i class="fa fa-times-circle"></i> Close Filter')
    }
}

function remove_filter( uri ) {
    window.location = base_url+uri
}

function show_maintenance_info(maintenance_id) {
    if( !$('#maintenance_info_'+maintenance_id).is(':visible') )
    {
        $('.maintenance-info').hide()
        $('#m_info_link_'+maintenance_id+' i').removeClass('fa-info-circle').addClass('fa-times-circle')
    }
    else
        $('#m_info_link_'+maintenance_id+' i').removeClass('fa-times-circle').addClass('fa-info-circle')

    $('#maintenance_info_'+maintenance_id).slideToggle()
}