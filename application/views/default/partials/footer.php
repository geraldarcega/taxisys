	</div>
	<!-- scripts -->
	<script src="<?php echo JS_DIR; ?>jquery-2.1.3.min.js" type="text/javascript" language="javascript"></script>
    <script src="<?php echo JS_DIR; ?>bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo JS_DIR; ?>plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Calendar Plugin JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js"></script>

    <!-- BS Date Picker JavaScript -->
    <script src="<?php echo JS_DIR; ?>bootstrap-datetimepicker.js"></script>

    <?php /*
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo JS_DIR; ?>plugins/morris/raphael.min.js"></script>
    <script src="<?php echo JS_DIR; ?>plugins/morris/morris.min.js"></script>
    <script src="<?php echo JS_DIR; ?>plugins/morris/morris-data.js"></script>
    */ ?>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo JS_DIR; ?>sb-admin-2.js"></script>
    <script src="<?php echo JS_DIR; ?>users.js"></script>

    <script type="text/javascript">
       $(document).ready(function() {
            $('#releasing_date1').datetimepicker({ 'format': 'MMM DD, YYYY' });
            $('#releasing_date2').datetimepicker({ 'format': 'MMM DD, YYYY' });
            $('#franchise_until').datetimepicker({ 'format': 'MMM DD, YYYY' });
            $('#year_model').datetimepicker({format: "YYYY",viewMode: "years"});

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: '2015-02-12',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2015-02-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2015-02-07',
                        end: '2015-02-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2015-02-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2015-02-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2015-02-11',
                        end: '2015-02-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2015-02-12T10:30:00',
                        end: '2015-02-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2015-02-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2015-02-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2015-02-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2015-02-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2015-02-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2015-02-28'
                    }
                ],
                 eventClick: function(calEvent, jsEvent, view) {
                    console.log( calEvent, jsEvent, view )
                },
                 dayClick: function(date, jsEvent, view) {
                    console.log( date, jsEvent, view )
                }
            });
            
        });
    </script>
</body>
</html>