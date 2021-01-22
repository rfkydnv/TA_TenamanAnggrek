"use strict";

var CoreDataTables = function () {

    //handleshowhide
    var handleFind = function () {
        $("#find").on("click", function () {

            var display = $(".filter").data("display");
            if (display == '0') {
                $(".filter").hide();
                $(".filter").data("display", 1);
            } else if (display == '1') {
                $(".filter").show();
                $(".filter").data("display", 0);
            }
        })
    }

    //handlefullscreen
    var handleFull = function () {
        $(".fullscreen").on("click", function (i) {
            var display = $("#element").data("display");
            if (display == '0') {
                document.getElementById("element");
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
                $("#element").data("display", 1);
            } else if (display == '1') {
                document.getElementById("element").requestFullscreen();
                $("#element").data("display", 0);
            }
        });
    }

    $.fn.dataTable.Api.register('column().title()', function () {
        return $(this.header()).text().trim();
    });
    var renderJenisKelamin = function (data) {
        var status = {
            'L': {
                'title': 'Laki-laki',
                'state': 'success'
            },
            'P': {
                'title': 'Perempuan',
                'state': 'primary'
            }
        };
        if (typeof status[data] === 'undefined') {
            return data;
        }
        return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
            '<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
    }


    var initCoreDatatables = function (url, targetRender = null, filter = null, order = null) {
        var columnRenders = [];

        order = order == undefined ? [
            [1, "asc"]
        ] : order;
        if (targetRender != null) {
            $.each(targetRender, function (index, value) {
                var orderable = true;
                if (value.orderable != undefined) {
                    orderable = value.orderable;
                }
                columnRenders.push({
                    targets: parseInt(index),
                    "orderable": orderable,
                    render: function (data, type, full, meta) {

                        switch (value.type) {
                            case 'jenis_kelamin':
                                return jenis_kelamin(data);
                                break;
                            case 'actions':
                                return actions(data);
                                break;
                            default:
                                return data;
                                break;
                        }

                    }
                })
            });
        }
        var jenis_kelamin = function (data) {
            var status = {
                'L': {
                    'title': 'Laki-laki',
                    'state': 'success'
                },
                'P': {
                    'title': 'Perempuan',
                    'state': 'primary'
                }
            };
            if (typeof status[data] === 'undefined') {
                return data;
            }
            return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
        }

        var actions = function (data) {
            var buttonActions = '<center>';

            if ('create_spj' in data) {
                buttonActions += '<a href="' + data.create_spj + '" title="Buat SPJ?" class="btn btn-sm btn-success btn-elevate"><i class="la la-truck"></i> Buat SPJ</a>';
            }

            if ('print_spj' in data) {
                buttonActions += '<a href="' + data.print_spj + '" target="_blank" title="Print SPJ ini?" class="btn btn-sm btn-success btn-elevate btn-icon la la-print core-pjax"></a> ';
            }

            if ('lihat_spj' in data) {
                buttonActions += '<a href="' + data.lihat_spj + '" target="_blank" title="Lihat SPJ ini?" class="btn btn-sm btn-info btn-elevate btn-icon la la-desktop"></a> ';
            }

            if ('view' in data) {
                buttonActions += '<a href="' + data.view + '" title="Lihat data ini?" class="btn btn-sm btn-success btn-elevate btn-icon la la-desktop"></a> ';
            }
            if ('spj' in data) {
                buttonActions += '<a href="' + data.spj + '" title="Proses SPJ transfer gudang?" class="btn btn-sm btn-info btn-elevate btn-icon la la-truck"></a> ';
            }

            if ('edit' in data) {
                buttonActions += '<a href="' + data.edit + '" title="Edit data ini?" class="btn btn-sm btn-warning btn-elevate btn-icon la la-edit"></a> ';
            }

            if ('delete' in data) {
                buttonActions += '<a href="" ' + data.delete + ' title="Hapus data ini?" class="btn btn-sm btn-danger btn-elevate btn-icon la la-trash mydeleteaction"></a> ';
            }

            if ('print' in data) {
                buttonActions += '<a href="' + data.print + '" target="_blank" title="Print data ini?" class="btn btn-sm btn-twitter btn-elevate btn-icon la la-print core-pjax"></a> ';
            }

            if ('proses' in data) {
                buttonActions += '<a href="' + data.proses + '" title="Proses data ini?" class="btn btn-sm btn-brand btn-elevate btn-icon la la-truck"></a> ';
            }

            if ('bayar' in data) {
                buttonActions += '<a href="' + data.bayar + '" title="Proses data ini?" class="btn btn-primary btn-sm"><i class="la la-money"></i> Bayar</a> ';
            }

            if ('regisJurnal' in data) {
                buttonActions += data.regisJurnal;
            }

            if ('customBtn' in data) {
                $.each(data.customBtn, function (key, value) {
                    buttonActions += value;
                });
            }
            buttonActions += "</center>";


            return buttonActions;
        }

        let resp = false;
        if ($(".table").hasClass("responsive")) resp = true;
        // console.log($(".table").hasClass("responsive"));
        var table = $('#kt_table_1').DataTable({

            bFilter: false,
            responsive: resp,
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                'lengthMenu': 'Display _MENU_',
            },
            dom: `<'row'<'col-sm-12't> <'col-sm-12 col-sm-6 text-right'B>>
			<'row'<'col-sm-12 col-md-6 text-left dataTables_pager' lp | i>>` +
                `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-6 text-left dataTables_pager' lp | i>>`,

            buttons: ['print', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
            searchDelay: 0,
            processing: true,
            serverSide: true,

            ajax: {
                url: url,
                type: 'GET',
                data: function (data) {
                    // parameters for custom backend script demo
                    // parameter dari kolom input search dilempar ke controller

                    $.each($('.filter :input').serializeArray(), function () {
                        data[this.name] = this.value;
                    });

                },
            },
            "order": order,

            columnDefs: columnRenders,
            initComplete: function () {
                var thisTable = this;
                var rowFilter = $('<tr class="filter" data-display="1" style="display:none"></tr>').appendTo($(table.table().header()));
                var coreFilter = $('.coreFilter');
                this.api().columns().every(function () {
                    var column = this;
                    var input;
                    if (column.title() in filter) {

                        switch (filter[column.title()].type) {
                            case 'text':
                                input = $(`<input type="text" name="` + filter[column.title()].name + `" id="` + filter[column.title()].name + `" class="form-control form-control-sm form-filter kt-input" data-col-index="` + column.index() + `"/>`);
                                break;

                            case 'number':
                                input = $(`<input type="text" name="` + filter[column.title()].name + `" id="` + filter[column.title()].name + `" class="form-control form-control-sm form-filter kt-input" data-col-index="` + column.index() + `"/>`);
                                break;

                            case 'select':
                                input = $(`<select name="` + filter[column.title()].name + `" class="form-control form-control-sm form-filter kt-input" title="Select" data-col-index="` + column.index() + `">
											<option value="">Select</option></select>`);
                                $.each(filter[column.title()].data, function (index, value) {
                                    $(input).append('<option value="' + index + '"  >' + value.label + '</option>');
                                });
                                break;

                            case 'date':

                                input = $(`
								<div class="input-group date">
									<input type="text" name="` + filter[column.title()].name + `" class="form-control form-control-sm kt-input" readonly placeholder="" id="kt_datepicker_1"
										data-col-index="` + column.index() + `"/>
									<div class="input-group-append">
										<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
									</div>
								</div>
								`);
									
							break;

							case 'month':

								input = $(`
								<div class="input-group date">
									<input type="text" name="`+ filter[column.title()].name + `" class="form-control form-control-sm kt-input" readonly placeholder="" id="kt_datepicker_7"
										data-col-index="` + column.index() + `"/>
									<div class="input-group-append">
										<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
									</div>
								</div>
								`);

								break;
							
							case 'range':
								var formDateRange = "";
								$.each(filter[column.title()].form, function(index,value){
										formDateRange += `<div class="input-group date">
											<input type="text" name="`+value.name+`" class="form-control form-control-sm kt-input" readonly placeholder="" id="kt_datepicker_1"
												data-col-index=""/>
											<div class="input-group-append">
												<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
											</div>
										</div>`;
                                });
                                input = $(formDateRange);
                                break;

                            case 'custom':
                                var customInput = "";
                                $.each(filter[column.title()].form, function (index, value) {
                                    if (value.type == "date") {
                                        customInput += `<div class="input-group date">
											<input type="text" name="` + value.name + `" class="form-control form-control-sm kt-input" readonly placeholder="" id="kt_datepicker_1"
												data-col-index=""/>
											<div class="input-group-append">
												<span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
											</div>
										</div> <br>`;
                                    } else if (value.type == "text") {
                                        let placeholder = "";
                                        if (value.placeholder != "undefined") placeholder = value.placeholder;
                                        customInput += `<input type="text" placeholder="` + placeholder + `" name="` + value.name + `" id="` + value.name + `" class="form-control form-control-sm form-filter kt-input" data-col-index="` + column.index() + `"/> <br>`;
                                    }
                                });
                                input = $(customInput);
                                break;
                        }
                    }

                    if (column.title() == 'Actions') {
                        var search = $(`<button class="btn btn-brand kt-btn btn-sm kt-btn--icon">
							  <span>
							    <i class="la la-search"></i>
							    <span>Search</span>
							  </span>
							</button><br>`);

                        var reset = $(`<button class="btn btn-secondary kt-btn btn-sm kt-btn--icon">
							  <span>
							    <i class="la la-close"></i>
							    <span>Reset</span>
							  </span>
							</button>`);

							$('<th>').append(search).append(reset).appendTo(rowFilter);

							$(search).on('click', function(e) {
								e.preventDefault();
								var params = {};
								$(rowFilter).find('.kt-input').each(function() {
									var i = $(this).data('col-index');
									if (params[i]) {
										params[i] += '|' + $(this).val();
									}
									else {
										params[i] = $(this).val();
									}
								});
								$.each(params, function(i, val) {
									// apply search params to datatable
									table.column(i).search(val ? val : '', false, false);
								});
								table.table().draw();
							});

							$(reset).on('click', function(e) {
								e.preventDefault();
								$(rowFilter).find('.kt-input').each(function(i) {
									$(this).val('');
									table.column($(this).data('col-index')).search('', false, false);
								});
								table.table().draw();
							});
					}
					
			
					if (column.title() !== 'Actions') {
						$(input).appendTo($('<th>').appendTo(rowFilter));
					}
				});

				$('#kt_datepicker_1,#kt_datepicker_2').datepicker({
					autoclose:true,
            		format: 'dd-mm-yyyy'
				});

				$('#kt_datepicker_7').datepicker({
					autoclose: true,
					format: 'm-yyyy',
					minViewMode: 'months'
				});
			}			
			
		});

		//reload with ajax
		$(".reload").on("click",function(){
			table.ajax.reload();
		});	
		
		$(".core-content-body").on('click', '.mydeleteaction', function (event) {
            event.preventDefault();

            console.log($(this).attr('mydata-url'));
            var data = {};
            var url = $(this).attr('mydata-url');
            var id = $(this).attr('mydata-id');
            var name = $(this).attr('mydata-name');
            var isdelete = $(this).attr('mydata-isdelete');
            data.name = name;
            data.isdelete = isdelete;

            swal.fire({
                title: 'Yakin Hapus Data',
                text: 'Data yang telah dihapus tidak dapat dikembalikan. apakah anda yakin ingin menghapus data ini?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    CoreFormControls.blockUI();
                    axios.post(url, data)
                        .then((res) => {
                            CoreFormControls.unblockUI();
                            CoreFormControls.customToast();
                            toastr.success(res.data.message, "Sukses");
                            table.ajax.reload();
                            if ($('.myredirect').length) {
                                $('.myredirect')[0].click();
                            }
                        })
                        .catch((err) => {
                            CoreFormControls.unblockUI();
                            CoreFormControls.customToast();
                            if (err.response.status == 400) {
                                CoreFormControls.customToast();
                                let message = "Gagal Memproses Data!";
                                if (err.response.data.message != "" || err.response.data.message != "undefined") {
                                    message = err.response.data.message;
                                }
                                toastr.error(message, "Gagal");
                            }
                        })
                }
            })
        });

        $(".core-content-body").on('click', '.regis-jurnal', function (event) {
            event.preventDefault();
            var url = $(this).attr('mydata-url');
            var jurnal_id = $(this).attr('mydata-id');
            var jurnal_no = $(this).attr('mydata-no');
            var jurnal_tgl = $(this).attr('mydata-tgl');
            var jurnal_sumber = $(this).attr('mydata-sumber');
            var jurnal_ket = $(this).attr('mydata-keterangan');

            var data = new FormData();
            data.append('jurnal_id', jurnal_id);
            data.append('jurnal_no', jurnal_no);
            data.append('jurnal_ket', jurnal_ket);
            data.append('jurnal_tgl', jurnal_tgl);
            data.append('jurnal_sumber', jurnal_sumber);

            swal.fire({
                title: 'Registrasi Jurnal ini?',
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#39dd00',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    CoreFormControls.blockUI();
                    axios.post(url, data)
                        .then((res) => {
                            CoreFormControls.unblockUI();
                            CoreFormControls.customToast();
                            toastr.success(res.data.message, "Sukses");
                            table.ajax.reload();
                            if ($('.myredirect').length) {
                                $('.myredirect')[0].click();
                            }
                        })
                        .catch((err) => {
                            CoreFormControls.unblockUI();
                            CoreFormControls.customToast();
                            if (err.response.status == 400) {
                                CoreFormControls.customToast();
                                let message = "Gagal Memproses Data!";
                                if (err.response.data.message != "" || err.response.data.message != "undefined") {
                                    message = err.response.data.message;
                                }
                                toastr.error(message, "Gagal");
                            }
                        })
                }
            })
        });
    }

    return {
        init: function (url, targetRender, filter, order) {
            initCoreDatatables(url, targetRender, filter, order);
            handleFind();
            handleFull();
        }
    }
}();
