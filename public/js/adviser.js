let advisers = $('#adviserTable').DataTable( {
    info: false,
    ordering: false,
    paging: false,
    searching: true,
    responsive: true,

    columnDefs: [
        {
            target: 1,
            visible: false,
            searchable: false
        },
        {
            target: 2,
            visible: false,
            searchable: false
        },
        {
            target: 3,
            visible: false,
            searchable: false
        },
        {
            target: 6,
            visible: true,
            searchable: false
        },
        {
            target: 7,
            visible: true,
            searchable: false
        },
        {
            target: 8,
            visible: true,
            searchable: false
        },
        {
            target: 9,
            visible: true,
            searchable: false
        },
    ]
    
} );