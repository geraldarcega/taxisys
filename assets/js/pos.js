$('#unitsModal').on('show.bs.modal', function (e) {
    var data_id   = e.relatedTarget.attributes[4];
    var data_type = e.relatedTarget.attributes[5];

    switch (data_type['value']) {
        case 'garrage':
            console.log('garrage', data_id['value'])
            break;
        case 'duty':
            console.log('duty', data_id['value'])
            break;
        case 'maintenance':
            console.log('maintenance', data_id['value'])
            break;
        default:
            console.log('walang laman')
            break;
    }
})