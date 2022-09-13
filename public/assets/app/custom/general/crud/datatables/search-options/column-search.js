"use strict";
var KTDatatablesSearchOptionsColumnSearch = function () {

	$.fn.dataTable.Api.register('column().title()', function () {
		return $(this.header()).text().trim();
	});

	var initTable1 = function () {

		// begin first table
		var table = $('#kt_table_1').DataTable({
			responsive: true,

			// Pagination settings
			dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
			// read more: https://datatables.net/examples/basic_init/dom.html

			lengthMenu: [5, 10, 25, 50],

			pageLength: 10,

			language: {
				'lengthMenu': 'Display _MENU_',
			},

			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: {
				url: 'https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/server.php',
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'RecordID', 'OrderID', 'Country', 'ShipCity', 'CompanyAgent',
						'ShipDate', 'Status', 'Type', 'Actions',],
				},
			},
			columns: [
				{ data: 'RecordID' },
				{ data: 'OrderID' },
				{ data: 'Country' },
				{ data: 'ShipCity' },
				{ data: 'CompanyAgent' },
				{ data: 'ShipDate' },
				{ data: 'Status' },
				{ data: 'Type' },
				{ data: 'Actions', responsivePriority: -1 },
			],
			initComplete: function () {
				var thisTable = this;
				var rowFilter = $('<tr class="filter"></tr>').appendTo($(table.table().header()));

				this.api().columns().every(function () {
					var column = this;
					var input;

					switch (column.title()) {
						case 'Record ID':
						case 'Order ID':
						case 'Ship City':
						case 'Company Agent':
							input = $(`<input type="text" class="form-control form-control-sm form-filter kt-input" data-col-index="` + column.index() + `"/>`);
							break;

						case 'Country':
							input = $(`<select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="` + column.index() + `">
										<option value="">Select</option></select>`);
							column.data().unique().sort().each(function (d, j) {
								$(input).append('<option value="' + d + '">' + d + '</option>');
							});
							break;

						case 'Status':
							var status = {
								1: { 'title': 'Pending', 'class': 'kt-badge--brand' },
								2: { 'title': 'Delivered', 'class': ' kt-badge--danger' },
								3: { 'title': 'Canceled', 'class': ' kt-badge--primary' },
								4: { 'title': 'Success', 'class': ' kt-badge--success' },
								5: { 'title': 'Info', 'class': ' kt-badge--info' },
								6: { 'title': 'Danger', 'class': ' kt-badge--danger' },
								7: { 'title': 'Warning', 'class': ' kt-badge--warning' },
							};
							input = $(`<select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="` + column.index() + `">
										<option value="">Select</option></select>`);
							column.data().unique().sort().each(function (d, j) {
								$(input).append('<option value="' + d + '">' + status[d].title + '</option>');
							});
							break;

						case 'Type':
							var status = {
								1: { 'title': 'Online', 'state': 'danger' },
								2: { 'title': 'Retail', 'state': 'primary' },
								3: { 'title': 'Direct', 'state': 'success' },
							};
							input = $(`<select class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="` + column.index() + `">
										<option value="">Select</option></select>`);
							column.data().unique().sort().each(function (d, j) {
								$(input).append('<option value="' + d + '">' + status[d].title + '</option>');
							});
							break;

						case 'Ship Date':
							input = $(`
							<div class="input-group date">
								<input type="text" class="form-control form-control-sm kt-input" readonly placeholder="From" id="kt_datepicker_1"
								 data-col-index="` + column.index() + `"/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
								</div>
							</div>
							<div class="input-group date">
								<input type="text" class="form-control form-control-sm kt-input" readonly placeholder="To" id="kt_datepicker_2"
								 data-col-index="` + column.index() + `"/>
								<div class="input-group-append">
									<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
								</div>
							</div>`);
							break;

						case 'Actions':
							var search = $(`<button class="btn btn-brand kt-btn btn-sm kt-btn--icon">
							  <span>
							    <i class="la la-search"></i>
							    <span>Search</span>
							  </span>
							</button>`);

							var reset = $(`<button class="btn btn-secondary kt-btn btn-sm kt-btn--icon">
							  <span>
							    <i class="la la-close"></i>
							    <span>Reset</span>
							  </span>
							</button>`);

							$('<th>').append(search).append(reset).appendTo(rowFilter);

							$(search).on('click', function (e) {
								e.preventDefault();
								var params = {};
								$(rowFilter).find('.kt-input').each(function () {
									var i = $(this).data('col-index');
									if (params[i]) {
										params[i] += '|' + $(this).val();
									}
									else {
										params[i] = $(this).val();
									}
								});
								$.each(params, function (i, val) {
									// apply search params to datatable
									table.column(i).search(val ? val : '', false, false);
								});
								table.table().draw();
							});

							$(reset).on('click', function (e) {
								e.preventDefault();
								$(rowFilter).find('.kt-input').each(function (i) {
									$(this).val('');
									table.column($(this).data('col-index')).search('', false, false);
								});
								table.table().draw();
							});
							break;
					}

					if (column.title() !== 'Actions') {
						$(input).appendTo($('<th>').appendTo(rowFilter));
					}
				});

				// hide search column for responsive table
				var hideSearchColumnResponsive = function () {
					thisTable.api().columns().every(function () {
						var column = this
						if (column.responsiveHidden()) {
							$(rowFilter).find('th').eq(column.index()).show();
						} else {
							$(rowFilter).find('th').eq(column.index()).hide();
						}
					})
				};

				// init on datatable load
				hideSearchColumnResponsive();
				// recheck on window resize
				window.onresize = hideSearchColumnResponsive;

				$('#kt_datepicker_1,#kt_datepicker_2').datepicker();
			},
			columnDefs: [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function (data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">											<rect x="0" y="0" width="24" height="24"></rect>											<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#5d78ff" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>											<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#5d78ff" fill-rule="nonzero" opacity="0.3"></path>										</g>									</svg>
                        </a>`;
					},
				},
				{
					targets: 5,
					width: '150px',
				},
				{
					targets: 6,
					render: function (data, type, full, meta) {
						var status = {
							1: { 'title': 'Pending', 'class': 'kt-badge--brand' },
							2: { 'title': 'Delivered', 'class': ' kt-badge--danger' },
							3: { 'title': 'Canceled', 'class': ' kt-badge--primary' },
							4: { 'title': 'Success', 'class': ' kt-badge--success' },
							5: { 'title': 'Info', 'class': ' kt-badge--info' },
							6: { 'title': 'Danger', 'class': ' kt-badge--danger' },
							7: { 'title': 'Warning', 'class': ' kt-badge--warning' },
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: 7,
					render: function (data, type, full, meta) {
						var status = {
							1: { 'title': 'Online', 'state': 'danger' },
							2: { 'title': 'Retail', 'state': 'primary' },
							3: { 'title': 'Direct', 'state': 'success' },
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});

	};

	return {

		//main function to initiate the module
		init: function () {
			initTable1();
		},

	};

}();

jQuery(document).ready(function () {
	KTDatatablesSearchOptionsColumnSearch.init();
});