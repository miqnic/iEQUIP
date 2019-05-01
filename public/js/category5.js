document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category5');

    var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
    plugins: [ 'resourceTimeline' ],
    header: {
        left: 'today prev,next',
        center: 'title',
        right: 'resourceTimelineDay,resourceTimelineWeek'
    },
    businessHours: {
        // xdays of week. an array of zero-based day of week integers (0=Sunday)
        dow: [ 1, 2, 3, 4 ,5, 6],

        startTime: '07:00',
        endTime: '21:30',
    },
    aspectRatio: 1.6,
    height: 600,
    defaultView: 'resourceTimelineDay',
    resourceGroupField: 'itemName',
    resources: [
        { id: 'a', itemName: 'Swivel Chair', title: 'SWICHA0001' },
        { id: 'b', itemName: 'Swivel Chair', title: 'SWICHA0002' },
        { id: 'c', itemName: 'Swivel Chair', title: 'SWICHA0003' },
        { id: 'd', itemName: 'Swivel Chair', title: 'SWICHA0004' },
        { id: 'e', itemName: 'Swivel Chair', title: 'SWICHA0005' },
        { id: 'f', itemName: 'Swivel Chair', title: 'SWICHA0006' },
        { id: 'g', itemName: 'Swivel Chair', title: 'SWICHA0007' },
        { id: 'h', itemName: 'Whiteboard Marker', title: 'WHIMAR0001' },
        { id: 'i', itemName: 'Whiteboard Marker', title: 'WHIMAR0002' },
        { id: 'j', itemName: 'Whiteboard Marker', title: 'WHIMAR0003' },
        { id: 'k', itemName: 'Whiteboard Marker', title: 'WHIMAR0004' },
        { id: 'l', itemName: 'Whiteboard Marker', title: 'WHIMAR0005' },
        { id: 'm', itemName: 'Whiteboard Marker', title: 'WHIMAR0006' },
        { id: 'n', itemName: 'Whiteboard Marker', title: 'WHIMAR0007' },
    ]
    });

    calendar.render();
    });