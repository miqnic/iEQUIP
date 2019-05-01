document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category4');

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
        { id: 'a', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0001' },
        { id: 'b', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0002' },
        { id: 'c', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0003' },
        { id: 'd', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0004' },
        { id: 'e', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0005' },
        { id: 'f', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0006' },
        { id: 'g', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0007' },
        { id: 'h', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0001' },
        { id: 'i', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0002' },
        { id: 'j', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0003' },
        { id: 'k', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0004' },
        { id: 'l', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0005' },
        { id: 'm', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0006' },
        { id: 'n', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0007' },
        { id: 'q', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0001' },
        { id: 'r', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0002' },
        { id: 's', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0003' },
        { id: 't', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0004' },
        { id: 'u', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0005' },
        { id: 'v', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0006' },
        { id: 'w', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0007' },
    ]
    });

    calendar.render();
    });