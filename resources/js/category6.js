document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category6');

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
        { id: 'a', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0001' },
        { id: 'b', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0002' },
        { id: 'c', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0003' },
        { id: 'd', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0004' },
        { id: 'e', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0005' },
        { id: 'f', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0006' },
        { id: 'g', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0007' },
        { id: 'h', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0001' },
        { id: 'i', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0002' },
        { id: 'j', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0003' },
        { id: 'k', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0004' },
        { id: 'l', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0005' },
        { id: 'm', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0006' },
        { id: 'n', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0007' },
        { id: 'q', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0001' },
        { id: 'r', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0002' },
        { id: 's', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0003' },
        { id: 't', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0004' },
        { id: 'u', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0005' },
        { id: 'v', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0006' },
        { id: 'w', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0007' },
    ]
    });

    calendar.render();
    });