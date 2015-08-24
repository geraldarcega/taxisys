$(function() {
    $('#side-menu').metisMenu();
    $(".bs-switch").not("[data-switch-no-init]").bootstrapSwitch();

    $.get( base_url+"static/drivers/filter.html", function( data ) {
        $('#filter').popover({
                                 'html' : true
                                ,'content' : data
                            })
    })
    
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

    return month_name[d.getMonth()]+" "+d.getDate()+" , "+d.getFullYear();
}

function formatNumber( num ) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function ucwords(str) {
	return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
		return $1.toUpperCase();
	});
}