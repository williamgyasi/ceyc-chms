/**
 *
 *
 * This first section is the section for filtering of the All Payments
 * Datatable table on the payments dashboard
 *
 *
 */


/**
 * Datatable filter for filtering the Amount Column.
 */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var amntFilter = parseInt( $('#amount-filter').val(), 10 );

        var amount = parseFloat( data[3] ) ; // use data for the age column

        if ( (isNaN( amntFilter )) || ( amntFilter == amount ) )
        {
            return true;
        }
    }
);


/**
 * Datatable filter for filtering by date column
 */
$.fn.dataTable.ext.search.push(
    // function( settings, data, dataIndex ) {
    //     var startDate =  $('#date').val();
    //     var endDate =  $('#end-date').val();
    //     var dateColumn =  data[7] ; // use data for the age column
    //
    //     if((endDate === '' && startDate === '') || (endDate === '' && startDate === dateColumn)
    //         || (startDate <= dateColumn && endDate > startDate)) {
    //         return true
    //     }
    //     return  false;
    // }
);



/**
 * Rerender table based on filtered values
 */
$(document).ready(function() {
    var table = $('#all-payments').DataTable();

    $('#amount-filter').keyup( function() {
        table.draw();
    } );

    $('#date').change( function() {
        table.draw();
    } );

    $('#end-date').change( function() {
        table.draw();
    } );
} );


/**
 * Datatable filter for filtering by payment status
 */
$(document).ready(function() {
    var table = $('#all-payments').DataTable();

    $('select#pay').change( function() {
        var status = $("select#pay")
            .children("option:selected").val();

        table.column(5).search(status).draw();
    } );
} );

/**
 * Datatable filter for filtering by payment reference
 */
$(document).ready(function() {
    var table = $('#all-payments').DataTable();

    $('select#reference').change( function() {
        var reference = $("select#reference")
            .children("option:selected").val();

        table.column(4).search(reference).draw();
    } );
} );


/*
/// End of Filtering for All Payments Datatable Table /////
*/
