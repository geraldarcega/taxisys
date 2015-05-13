$(document).ready(function() {
    $('#startdate_dp').datetimepicker({ 'format': 'MMM DD, YYYY', 'selectWeek' : true });
    $('#frmBoundaryFilter').validate()
});

function save()
{
    $('#frmModalUnits').submit()
}