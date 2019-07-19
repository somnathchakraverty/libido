
$(document).ready(function () {
    
    jQuery.fn.dataTableExt.oSort['string-case-asc'] = function (x, y) {
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    jQuery.fn.dataTableExt.oSort['string-case-desc'] = function (x, y) {
        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };


 var t = $('#basicDataTable').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
        
        "ajax": {
            "url": SITE_URL + '/admin/user/newsletter-subscriptions-ajax',

            error: function ($xhr) {
             if ($xhr.status === 401) {
                    window.location = '/';
                }
            }
        },

        search: {
            caseInsensitive: true
        },
        columns: [
            {data: 'email', name: 'email'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'}
        ]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

//
//    var datatable;
//    
//    datatable = $('#basicDataTable').DataTable({
//
//        "pagingType": "full_numbers",
//        "serverSide": true,
//        "paging": true,
//
//        "info": false,
//
//        "processing": true,
// 
//        
//        "ajax": {
//            "url": SITE_URL + '/admin/user/newsletter-subscriptions-ajax',
//
//            error: function ($xhr) {
//             if ($xhr.status === 401) {
//                    window.location = '/';
//                }
//            }
//        },
//
//        search: {
//            caseInsensitive: true
//        },
//        columns: [
//            {data: 'email', name: 'email'},
//            {data: 'created_at', name: 'created_at'}
//        ]
//    });

});