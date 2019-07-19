
var userService = {};

$(document).ready(function () {

    jQuery.fn.dataTableExt.oSort['string-case-asc'] = function (x, y) {
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['string-case-desc'] = function (x, y) {
        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };


    var t = $('#basicDataTable').DataTable({
        "pageLength": 100,
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
        "order": [[1, 'asc']],
        "serverSide": true,
        "ajax": {
            "url": SITE_URL + '/condom/condom-list-ajax',

            error: function ($xhr) {
                if ($xhr.status === 401) {
                    window.location = SITE_URL + '/';
                }
            }
        },

        search: {
            caseInsensitive: true
        },
        columns: [
//            {data: 'id', name: 'id'},
            {data: 'DT_Row_Index', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', 'searchable': false, 'bSortable': false},
        ]
    });
    t.on('order.dt', function () {
        console.log('aaa');
        t.column(0, {order: 'applied'}).nodes().each(function (cell, i) {
            //console.log(i);
            //console.log(cell);
            cell.innerHTML = i + 1;
        }); 
        
    }).draw();
    t.on('search.dt', function () {
        console.log('bbb');
        t.column(0, {search: 'applied'}).nodes().each(function (cell, i) {
            console.log(cell);
            //console.log(i);
            cell.innerHTML = 22;
            //console.log(cell.innerHTML);
        }); 
    }).draw();

    //hide error after 3 seconds
    setTimeout(function () {
        $('.alert-danger').fadeOut('fast');
        $('.alert-success').fadeOut('fast');
    }, 3000);
});