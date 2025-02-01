let advisers = $('#adviserTable').DataTable( {
    info: false,
    ordering: false,
    paging: false,
    searching: false,
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
            target: 8,
            visible: false,
        }
    ]
    
} );


const $targetEl = document.getElementById('drawer-js-example');

// options with default values
const options = {
    placement: 'right',
    backdrop: true,
    bodyScrolling: false,
    edge: false,
    edgeOffset: '',
    backdropClasses:
        'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-30',
    onHide: () => {
        console.log('drawer is hidden');
    },
    onShow: () => {
        console.log('drawer is shown');
    },
    onToggle: () => {
        console.log('drawer has been toggled');
    },
};

// instance options object
const instanceOptions = {
  id: 'drawer-js-example',
  override: true
};

const drawer = new Drawer($targetEl, options, instanceOptions);

drawer.show()