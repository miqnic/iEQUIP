document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('category2');

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
        { id: 'a', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0001' },
        { id: 'b', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0002' },
        { id: 'c', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0003' },
        { id: 'd', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0004' },
        { id: 'e', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0005' },
        { id: 'f', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0006' },
        { id: 'g', itemName: 'Canon EOS 80D DSLR Camera', title: 'CANCAM0007' },
        { id: 'h', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0001' },
        { id: 'i', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0002' },
        { id: 'j', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0003' },
        { id: 'k', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0004' },
        { id: 'l', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0005' },
        { id: 'm', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0006' },
        { id: 'n', itemName: 'Nikon D3200 DSLR Camera', title: 'NIKCAM0007' },
        { id: 'q', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0001' },
        { id: 'r', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0002' },
        { id: 's', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0003' },
        { id: 't', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0004' },
        { id: 'u', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0005' },
        { id: 'v', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0006' },
        { id: 'w', itemName: 'Zhiyun Crane 2 Stabilizer', title: 'ZHISTA0007' },
    ]
    });

    calendar.render();
    });