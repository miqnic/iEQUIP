document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category1');

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
        { id: 'a', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0001' },
        { id: 'b', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0002' },
        { id: 'c', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0003' },
        { id: 'd', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0004' },
        { id: 'e', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0005' },
        { id: 'f', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0006' },
        { id: 'g', itemName: 'Wacom CINTIQ 13HD Tablet', title: 'WACCIN0007' },
        { id: 'h', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0001' },
        { id: 'i', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0002' },
        { id: 'j', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0003' },
        { id: 'k', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0004' },
        { id: 'l', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0005' },
        { id: 'm', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0006' },
        { id: 'n', itemName: 'Wacom Intuos Pro Tablet', title: 'WACINT0007' },
        { id: 'q', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0001' },
        { id: 'r', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0002' },
        { id: 's', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0003' },
        { id: 't', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0004' },
        { id: 'u', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0005' },
        { id: 'v', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0006' },
        { id: 'w', itemName: 'Wacom Bamboo Ink Stylus', title: 'WACBAM0007' },
    ]
    });

    calendar.render();
    });