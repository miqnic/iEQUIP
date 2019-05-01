document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category3');

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
        { id: 'a', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0001' },
        { id: 'b', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0002' },
        { id: 'c', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0003' },
        { id: 'd', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0004' },
        { id: 'e', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0005' },
        { id: 'f', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0006' },
        { id: 'g', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0007' },
        { id: 'h', itemName: 'Xbox One X Console', title: 'XBOONE0001' },
        { id: 'i', itemName: 'Xbox One X Console', title: 'XBOONE0002' },
        { id: 'j', itemName: 'Xbox One X Console', title: 'XBOONE0003' },
        { id: 'k', itemName: 'Xbox One X Console', title: 'XBOONE0004' },
        { id: 'l', itemName: 'Xbox One X Console', title: 'XBOONE0005' },
        { id: 'm', itemName: 'Xbox One X Console', title: 'XBOONE0006' },
        { id: 'n', itemName: 'Xbox One X Console', title: 'XBOONE0007' },
        { id: 'q', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0001' },
        { id: 'r', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0002' },
        { id: 's', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0003' },
        { id: 't', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0004' },
        { id: 'u', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0005' },
        { id: 'v', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0006' },
        { id: 'w', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0007' },
    ]
    });

    calendar.render();
    });