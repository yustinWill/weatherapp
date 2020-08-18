"use strict";
jQuery(document).ready(function() {
	var table = $('#kt_datatable1').DataTable({
            aaSorting: [],
            responsive: true,
			// DOM Layout settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
            <'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

			// lengthMenu: [5, 10, 25, 50],

			// pageLength: 10,

            language: {
                "lengthMenu": "Menampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Data tidak tersedia",
                "infoFiltered": "(terfilter dari _MAX_ total data)"
            },

			// Order settings
			order: [[1, 'desc']],

			// headerCallback: function(thead, data, start, end, display) {
			// 	thead.getElementsByTagName('th')[0].innerHTML = `
            //         <label class="checkbox checkbox-single">
            //             <input type="checkbox" class="group-checkable"/>
            //             <span></span>
            //         </label>`;
			// },
			// columnDefs: [
			// 	{
			// 		targets: 0,
			// 		width: '30px',
			// 		className: 'dt-left',
			// 		orderable: false,
			// 		render: function(data, type, full, meta, row) {
            //             console.log(data.comment_id);
			// 			return '<label class="checkbox checkbox-single"><input type="checkbox" value="" name="comment_id[]" class="checkable"/><span></span></label>';
			// 		},
			// 	}
			// ],
		});

		// table.on('change', '.group-checkable', function() {
		// 	var set = $(this).closest('table').find('td:first-child .checkable');
		// 	var checked = $(this).is(':checked');

		// 	$(set).each(function() {
		// 		if (checked) {
		// 			$(this).prop('checked', true);
		// 			$(this).closest('tr').addClass('active');
		// 		}
		// 		else {
		// 			$(this).prop('checked', false);
		// 			$(this).closest('tr').removeClass('active');
		// 		}
		// 	});
		// });

		// table.on('change', 'tbody tr .checkbox', function() {
		// 	$(this).parents('tr').toggleClass('active');
		// });
    table.buttons().remove();
});
