$(function(){
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
	    eventLimit: true, // allow "more" link when too many events
		events: {
		    url: base_url+'dashboard/calendar/ajax',
		    type: 'POST',
		    data: { 'action' : 'get' },
		    error: function() {
		        alert('there was an error while fetching events!');
		    }
		},
	    eventClick: function(calEvent, jsEvent, view) {
	    	$('#calendarModalLabel').html( calEvent.title +' : '+ readableDate(calEvent.start._i) )
	    	$('#calendarModal #unit_id').val(calEvent.unitid)
	    	$('#calendarModal #notes').val(calEvent.notes)
	    	$('#calendarModal').modal('show')
	    },
	    dayClick: function(date, jsEvent, view) {
	    	console.log(date, jsEvent, view)
	    },
	    eventRender: function (event, element) {
	        element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());

	        element.find('a.fc-event').attr('id', event.id)
	        var tooltip = event.title
            $('#'+event.id).attr("data-original-title", tooltip)
            $('#'+event.id).popover({ container: "body" })
	    }
	});
	
	$('#calendar').fullCalendar('today')
})