$(document).ready(function() {
    $('#startdate').datetimepicker({ 'format': 'MMM DD, YYYY', 'selectWeek' : true });
    $('#frmBoundaryFilter').validate()
});

function save()
{
    $('#frmModalUnits').submit()
}