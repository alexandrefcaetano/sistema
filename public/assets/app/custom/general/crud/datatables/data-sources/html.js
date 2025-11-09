"use strict";
var KTDatatablesDataSourceHtml = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');
		// begin first table
		table.DataTable();

	};

    var initTable2 = function() {
        var table = $('#kt_table_123');
        // begin first table
        table.DataTable();
    };

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
            initTable2();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceHtml.init();
});
