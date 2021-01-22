var $vm;
var $mixin = {};
var CoreFormControls = function () {
    // Private functions

    var handleActionn = function () {
        $(".core-content-body").on('click', '.deletemenu', function (event) {
            event.preventDefault();
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
                    axios.delete(url, data)
                        .then((res) => {
                            CoreFormControls.unblockUI();
                            CoreFormControls.customToast();
                            toastr.success(res.data.message, "Sukses");
                            if ($('.myredirect').length) {
                                $('.myredirect')[0].click();
                            }
                        })
                        .catch((err) => {
                            unblockUI();
                            CoreFormControls.customToast();
                            toastr.error("Gagal Menghapus Data!", "Gagal");
                        })
                }
            })
        });
    };

    var blockUI = function () {
        KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'primary',
            message: 'Processing...'
        });
    };

    var unblockUI = function () {
        KTApp.unblockPage();
    };

    var customToast = function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    };

    var InitVue = function (formMixin) {
        var vue = new Vue({
            el: "#my-vue",
            mixins: [formMixin],
            data() {
                return {
                    dataconfigs: [],
                    form: {
                        isChecked: [],
                        enable: {
                            view: false,
                            update: false,
                            create: false,
                            delete: false,
                        }
                    },
                    selectedFile: null,
                    imagePath: "https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png",
                    imageChanged: false,
                    err: {
                        menu_parentid: null
                    },
                    errors: null,
                    maskMoney: {
                        reverse: true
                    }
                }
            },
            props: {
                selected: {
                    type: Object,
                },
            },
            methods: {
                toggleCheckbox(args) {
                    console.warn(`toggle::view(${args})`);
                    this.form.enable[args] = !this.form.enable[args];
                },
                getImagePath(e) {
                    if (e != undefined) {
                        if (this.imageChanged) {
                            return this.imagePath;
                        } else {
                            return e;
                        }
                    } else {
                        return this.imagePath;
                    }
                },
                action_form() {
                    var form_ = $("#my-form");
                    var action = form_.attr('action');
                    var warning = $('.form-warning');

                    //build form data
                    if (this.selectedFile == null) delete this.form["file"];
                    let formData = this.jsonToFormData(this.form);

                    if (this.selectedFile == null) delete this.form['file'];
                    if (this.selectedFile != null) {
                        formData.append("file", this.selectedFile, this.selectedFile.name);
                    }

                    const options = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    };

                    warning.hide();

                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: "Pastikan data yang di masukan telah benar",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#75d61f',
                        cancelButtonColor: '#4b60dd',
                        confirmButtonText: 'Yes, Simpan Data!'
                    }).then((result) => {
                        if (result.value) {

                            blockUI();
                            App.blockUI();
                            axios.post(action, formData, options)
                                .then((res) => {
                                    unblockUI();
                                    App.unblockUI();
                                    if (res.data.status) {
                                        customToast();
                                        toastr.success(res.data.message, "Sukses");
                                        if ($('.myredirect').length) {
                                            $('.myredirect')[0].click();
                                        }
                                    }
                                }).catch((err) => {
                                    unblockUI();
                                    App.unblockUI();
                                    if (err.response.status == 422) {
                                        this.errors = err.response.data.errors;
                                        showWarn();
                                    } else if (err.response.status == 400) {
                                        customToast();
                                        let message = "Gagal Memproses Data!";
                                        if (err.response.data.message != "" || err.response.data.message != "undefined") {
                                            message = err.response.data.message;
                                        }
                                        toastr.error(message, "Gagal");
                                    }
                                })
                        }
                    })
                },
                onFileSelected(e) {
                    this.selectedFile = e.target.files[0];
                    this.imagePath = URL.createObjectURL(this.selectedFile);
                    this.imageChanged = true;
                },
                autocomplete() {
                    var input = document.getElementById('address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                },
                geocoding_btn() {

                    let $vm = this;
                    var cari = $('#address').val();
                    GMaps.geocode({
                        address: cari,
                        callback: function (results, status) {
                            if (status == 'OK') {
                                var latlng = results[0].geometry.location;
                                map = new GMaps({
                                    div: '#map',
                                    lat: latlng.lat(),
                                    lng: latlng.lng()
                                });

                                map.setCenter(latlng.lat(), latlng.lng());

                                map.addMarkers({
                                    draggable: true,
                                    lat: latlng.lat(),
                                    lng: latlng.lng()
                                });

                                var myLatlng = new google.maps.LatLng(latlng.lat(), latlng.lng());

                                var myOptions = {
                                    zoom: 15,
                                    center: myLatlng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                }

                                map = new google.maps.Map(document.getElementById("map"), myOptions);

                                var marker = new google.maps.Marker({
                                    draggable: true,
                                    position: myLatlng,
                                    map: map
                                });

                                document.getElementById("latitude").value = '';
                                document.getElementById("longitude").value = '';

                                /* document.getElementById("latitude").value = latlng.lat();
                                 document.getElementById("longitude").value = latlng.lng();*/

                                /*console.log($vm.$data.form);
                                 var arr_ = {'gudang_latitude':latlng.lat(), 'gudang_longitude':latlng.lat()};*/

                                $vm.$data.form.gudang_latitude = latlng.lat();
                                $vm.$data.form.gudang_longitude = latlng.lng();

                                // console.log($vm.$data.form);

                                google.maps.event.addListener(marker, 'dragend', function (event) {
                                    /*var arr = {'gudang_latitude':this.getPosition().lat(), 'gudang_longitude':this.getPosition().lng()};
                                    this.form.push(arr);*/
                                    $('#latitude').val(this.getPosition().lat());
                                    $('#longitude').val(this.getPosition().lng());
                                });

                            }
                        }
                    });
                },
                geocodingBtn(attr) {
                    if (!attr.hasOwnProperty("el")) {
                        attr["el"] = "#address";
                    }

                    if (!attr.hasOwnProperty("container")) {
                        attr["container"] = {};
                    }

                    if (!attr.container.hasOwnProperty("div")) {
                        attr["container"]["div"] = "map";
                    }

                    if (!attr.container.hasOwnProperty("lat")) {
                        attr["container"]["lat"] = "latitude";
                    }

                    if (!attr.container.hasOwnProperty("lng")) {
                        attr["container"]["lng"] = "longitude";
                    }

                    if ((attr.lat != undefined && attr.lat != "") && (attr.lng != undefined && attr.lng != "")) {
                        console.warn(attr);
                        let $vm = this;
                        var cari = $(attr.el).val();
                        GMaps.geocode({
                            address: cari,
                            callback: function (results, status) {
                                if (status == 'OK') {
                                    var latlng = results[0].geometry.location;
                                    map = new GMaps({
                                        div: `#${attr.container.div}`,
                                        lat: latlng.lat(),
                                        lng: latlng.lng()
                                    });

                                    map.setCenter(latlng.lat(), latlng.lng());

                                    map.addMarkers({
                                        draggable: true,
                                        lat: latlng.lat(),
                                        lng: latlng.lng()
                                    });

                                    var myLatlng = new google.maps.LatLng(latlng.lat(), latlng.lng());

                                    var myOptions = {
                                        zoom: 15,
                                        center: myLatlng,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    }

                                    map = new google.maps.Map(document.getElementById(attr.container.div), myOptions);

                                    var marker = new google.maps.Marker({
                                        draggable: true,
                                        position: myLatlng,
                                        map: map
                                    });

                                    // $(`#${attr.container.lat}`).val('');
                                    // $(`#${attr.container.lnt}`).val('');

                                    $vm.$data.form[attr.lat] = latlng.lat();
                                    $vm.$data.form[attr.lng] = latlng.lng();

                                    $(`#${attr.container.lat}`).val(latlng.lat());
                                    $(`#${attr.container.lng}`).val(latlng.lng());
                                }
                            }
                        });
                    } else {
                        console.warn("attr undefined");
                    }
                },
                buildFormData(formData, data, parentKey) {
                    if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
                        Object.keys(data).forEach(key => {
                            this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
                        });
                    } else {
                        const value = data == null ? '' : data;

                        formData.append(parentKey, value);
                    }
                },
                jsonToFormData(data) {
                    const formData = new FormData();

                    this.buildFormData(formData, data);

                    return formData;
                },
                checkbox(data) {
                    console.log(data);
                },
                inArray: (data, array) => {
                    let state = false;
                    if (array.includes(data)) {
                        state = true;
                    }
                    return state;
                },
                dataTable: (_url, _targetRender, _filter, _order, _params) => {
                    if (_params == undefined) {
                        _params = {};
                    }

                    let CoreDataTables = function () {

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

                            var actions = function (data) {
                                var buttonActions = '';

                                if ('create_spj' in data) {
                                    buttonActions += '<a href="' + data.create_spj + '" title="Buat SPJ?" class="btn btn-sm btn-success btn-elevate"><i class="la la-truck"></i> Buat SPJ</a>';
                                }

                                if ('print_spj' in data) {
                                    buttonActions += '<a href="' + data.print_spj + '" target="_blank" title="Print SPJ ini?" class="btn btn-sm btn-success btn-elevate btn-icon la la-print core-pjax"></a> ';
                                }

                                if ('view' in data) {
                                    buttonActions += '<a href="' + data.view + '" title="Lihat data ini?" class="btn btn-sm btn-success btn-elevate btn-icon la la-desktop"></a> ';
                                }
                                if ('spj' in data) {
                                    buttonActions += '<a href="' + data.spj + '" title="Lihat SPJ transfer gudang?" class="btn btn-sm btn-info btn-elevate btn-icon la la-truck"></a> ';
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


                                return buttonActions;
                            }
                            let footercallback = true;
                            let resp = false;
                            let destroy = footercallback != undefined ? true : false;
                            if ($(".table").hasClass("responsive")) resp = true;
                            // console.log($(".table").hasClass("responsive"));
                            var table = $('#kt_table_2').DataTable({
                                bFilter: false,
                                responsive: resp,
                                lengthMenu: [5, 10, 25, 50],
                                pageLength: 10,
                                language: {
                                    'lengthMenu': 'Display _MENU_',
                                },
                                dom: `<'row'<'col-sm-12't>>
                                <'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'lp>>` +
                                    `<'row'<'col-sm-12'tr>>
                                <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                                searchDelay: 0,
                                processing: true,
                                serverSide: true,

                                ajax: {
                                    url: url,
                                    type: 'GET',
                                    data: function (data) {
                                        // tg_awal: $("#tgl_awal").val(),
                                        // tg_akhir: $("#tgl_akhir").val(),
                                        // kd_rek: k,
                                        const kode_rek = $("#kode_rek").find(':selected');
                                        const k = kode_rek[0].value;

                                        data["tg_awal"] = $("#tgl_awal").val();
                                        data["tg_akhir"] = $("#tgl_akhir").val();
                                        data["kd_rek"] = k;
                                        // Object.keys(_params).forEach(function (key) {
                                        //     console.log(key, _params[key]);
                                        //     data[key] = _params[key];
                                        // });
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

                                                case 'range':
                                                    var formDateRange = "";
                                                    $.each(filter[column.title()].form, function (index, value) {
                                                        formDateRange += `<div class="input-group date">
                                                                <input type="text" name="` + value.name + `" class="form-control form-control-sm kt-input" readonly placeholder="" id="kt_datepicker_1"
                                                                    data-col-index=""/>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
                                                                </div>
                                                            </div>`;
                                                    });
                                                    input = $(formDateRange);
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

                                            $(search).on('click', function (e) {
                                                e.preventDefault();
                                                var params = {};
                                                $(rowFilter).find('.kt-input').each(function () {
                                                    var i = $(this).data('col-index');
                                                    if (params[i]) {
                                                        params[i] += '|' + $(this).val();
                                                    } else {
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
                                        }


                                        if (column.title() !== 'Actions') {
                                            $(input).appendTo($('<th>').appendTo(rowFilter));
                                        }
                                    });

                                    $('#kt_datepicker_1,#kt_datepicker_2').datepicker({
                                        autoclose: true,
                                        format: 'dd-mm-yyyy'
                                    });
                                }

                            });

                            //reload with ajax
                            $(".reload").on("click", function () {
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
                                                console.log("ini err");
                                                console.log(err.response);
                                                CoreFormControls.unblockUI();
                                                CoreFormControls.customToast();
                                                toastr.error("Gagal Menghapus Data!", "Gagal");
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
                                                toastr.error("Gagal Menghapus Data!", "Gagal");
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

                    if ($.fn.dataTable.isDataTable("#kt_table_2")) {
                        $("#kt_table_2").DataTable().draw();
                    } else {
                        CoreDataTables.init(_url, _targetRender, _filter, null);
                    }
                },
                strReplace: (search, replace, string) => {
                    return string.replace(search, replace);
                    // return string;
                },
                number: (e) => {
                    return accounting.formatMoney(e, "", 0, ".", ",");
                }
            },
            mounted: function () {
                let $vm = this;
                let myform = $("#my-form");
                let url = myform.attr('data-url');

                let action = myform.attr('action-type') != undefined ? myform.attr('action-type') : "";


                var myarray = ['edit', 'lihat', 'update'];

                if (jQuery.inArray(action.toLowerCase(), myarray) != '-1') {
                    App.blockUI();
                    axios.get(url)
                        .then(function (resp) {
                            let _temp = $vm.$data.form;

                            if (typeof resp.data.record !== 'undefined' || resp.data.record != null) {

                                $vm.$data.form = resp.data.record;
                                console.log($vm.$data.form.pelanggan);

                                $.each(resp.data.record, function (key, value) {
                                    if (key === 'file') $vm.$data.imagePath = value;
                                });
                            } else {
                                $vm.$data.form = resp.data;
                            }

                            Object.keys(_temp).forEach((key) => {
                                // dirubah keperluan order, order nya hilang
                                if (key != "order_detail") {
                                    $vm.$data.form[key] = _temp[key];
                                }
                            });


                            App.unblockUI();
                        })
                        .catch(function (err) {
                            customToast();
                            toastr.error("Gagal Mengambil Data!", "Gagal");
                            App.unblockUI();
                        });
                }
            }
        });

        $vm = vue;
    };

    return {
        // public functions
        init: function (formMixin = {}) {
            InitVue(formMixin);
            handleActionn();
        },
        blockUI: function () {
            blockUI();
        },
        unblockUI: function () {
            unblockUI();
        },
        customToast: function () {
            customToast();
        },
        handleAction: function () {
            handleActionn();
        },
        initWarn: function () {
            showWarn();
        }
    };

    function showWarn() {
        var warning = $('.form-warning');
        warning.find('.alert-outline-warning').find('.alert-text').first().text('Data yang anda isikan belum valid, silahkan diperiksa kembali');
        warning.show();
    }
}();
