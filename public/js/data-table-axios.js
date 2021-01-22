"use strict";
var KTDatatablesExtensionButtons = function(){

    var initTable1 = function(url_) {
        // begin first table
        var table = $('#kt_table_1').DataTable({
            responsive: true,
            bFilter:false,
            // Pagination settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            buttons: [ 'print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
            processing: true,
            serverSide: true,
            ajax: {url: url_},
            columnDefs: [],
        });


    };

    return {
        init:function(url){
            initTable1(url);
        }
    }
}();
