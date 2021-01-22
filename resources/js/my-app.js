var MyApp = function (){
    
    var initFormComponent = function () {
        $(function () {
            // init mask
            if ($('.mask').length > 0) {
                if ($('.mask-money').length > 0) {
                    $('.mask-money').inputmask('integer', {
                        autoGroup: true,
                        groupSeparator: '.',
                        unmaskAsNumber: true,
                        removeMaskOnSubmit: true
                    });
                }
                if ($('.mask-date').length > 0) {
                    $('.mask-date').inputmask("99-99-9999", {
                        "placeholder": "dd-mm-yyyy",
                        autoUnmask: true
                    });
                }
            }

            //init date pickers
            if ($('.date-picker').length) {
                $('.date-picker').datepicker({
                    rtl: KTUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left"
                });
            }
            //init time pickers
            if ($('.time-picker').length) {
                $('.time-picker').timepicker({
                    minuteStep: 1,
                    defaultTime: '',
                    showSeconds: true,
                    showMeridian: false,
                    snapToStep: true
                });
            }

            if ($('.maxlength').length) {
                $('.maxlength').maxlength({
                    alwaysShow: true,
                    threshold: 5,
                    placement: 'top-right',
                    warningClass: "kt-badge kt-badge--success kt-badge--rounded kt-badge--inline",
                    limitReachedClass: "kt-badge kt-badge--danger kt-badge--rounded kt-badge--inline"
                });
            }

        });
    }

    // Handle Select2 Dropdowns
    var handleSelect2 = function () {
        if ($().select2) {
            $('.select2me').select2({
                placeholder: "pilih...",
                allowClear: true
            });
        }

        if ($('.select2noclear').length > 0) {
            $('.select2noclear').select2({
                placeholder: "pilih...",
                theme: "bootstrap",
                allowClear: false
            });
        }

        if ($('.select2nosearch').length > 0) {
            var placeholder = $(this).attr('placeholder') != undefined ? $(this).attr('placeholder') : 'silahkan pilih...';
            $('.select2nosearch').select2({
                placeholder: placeholder,
                allowClear: false,
                minimumResultsForSearch: Infinity
            });
        }

        if ($('.select-filter').length > 0) {
            $('.select-filter').each(function (index, el) {
                var elem = $(this);
                elem.parent().find('.select2-selection__rendered').addClass('select2-filter');
            });
        }

        function formatRepo(repo) {
            if (repo.loading) return repo.text;

            if (repo.showDesc == true && (repo.desc != null && repo.desc != "" && repo.desc != undefined)) {
                var markup = '' +
                    '<div class="clearfix">' +
                    '<div class="col-md-6">' + repo.text + '</div>' +
                    '<div class="col-md-6">' + repo.desc + '</div>'
                '</div>' +
                    '';
            }
            else {
                var markup = '' +
                    '<div class="clearfix">' +
                    '<div class="col-md-12">' + repo.text + '</div>' +
                    '</div>' +
                    '';
            }

            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.text;
        }
        
        if ($('.select2advance').length > 0) {
            $('.select2advance').each(function (index, el) {
                var url = $(this).attr('mydata-url');
                var placeholder = $(this).attr('placeholder') != undefined ? $(this).attr('placeholder') : 'silahkan input lalu pilih...';
                var showDesc = $(this).attr('mydata-showdesc') != undefined ? $(this).attr('mydata-showdesc') : false;
                var exclude = $(this).attr('mydata-exclude-element');
                var ref = $(this).attr('mydata-ref-element');
                var parent = $(this).attr('mydata-parent-column');
                var parent_val = $(this).attr('mydata-parent-element');
                var insertTo = $(this).attr('mydata-insert-to');
                var minString = $(this).attr('mydata-min-length') != undefined ? $(this).attr('mydata-min-length') : 1;

                if (exclude != undefined || ref != undefined) {
                    url = url + '&exclude=';
                    if (exclude != undefined) {
                        var _exclude = encodeURIComponent(get_exsist(exclude));
                        url = url + _exclude;
                    }
                    if (ref != undefined) {
                        var _ref = $(ref).val();
                        url = (_ref != null) ? url + encodeURIComponent('-' + _ref) : url;

                    }
                }
                if (parent != undefined) {
                    url = url + '&parent_col=' + parent + '&parent_val=' + $(parent_val).val();
                }

                $(this).select2({
                    placeholder: placeholder,
                    allowClear: true,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                                page: params.page,
                                showDesc: showDesc
                            };
                        },
                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2.
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data
                            params.page = params.page || 1;
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    "language": {
                        "noResults": function () {
                            return 'data tidak ditemukan, silahkan coba kata kunci lain!';
                        },
                        inputTooShort: function () {
                            return placeholder;
                        }
                    },
                    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                    minimumInputLength: minString,
                    templateResult: formatRepo, // omitted for brevity, see the source of this page
                    templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
                });
            });
        }
    }

    var initImportExcel = function () {

        $(".myimportexcel").on('click', function (event) {
            // $("#import").val("");
            
            
            $("#import").trigger('click');
        });
        
        $(".myfileimportexcel").on('change', function (event) {
            var form = $("#my-form-importexcel");
            var elem = $(this);
            
            if (elem.val() != "") {

                var oFReader = new FileReader();
                oFReader.readAsDataURL(this.files[0]);
                var action = form[0].action;
                var file = elem[0].files;
                var filename = file[0].name;
                
                console.warn(elem);
                
                // var data = {};
                // data.filename = filename;
                // data.file = file;

                
                var allowedExtensions = ["xlsx"];
                extension = filename.substring(filename.lastIndexOf('.') + 1);
                
                oFReader.onload = function (oFREvent) {
                    
                    if ($.inArray(extension, allowedExtensions) == -1) {
                        CoreFormControls.customToast();
                        toastr.error("Format file tidak valid", "Gagal");
                        return false;
                    } else {
                        
                        swal.fire({
                            title: 'Yakin Import Data',
                            text: 'Sistem akan mengimport data file ' + filename + '. apakah anda yakin ingin melanjutkan proses ini?',
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak',
                        }).then((result) => {
                            if (result.value) {
                                CoreFormControls.blockUI();
                                axios.post(action, file)
                                .then((res) => {
                                    console.warn(res);
                                    CoreFormControls.unblockUI();
                                    CoreFormControls.customToast();
                                    toastr.success(res.data.message, "Sukses");
                                    if ($('.myredirect').length) {
                                        $('.myredirect')[0].click();
                                    }
                                })
                                     .catch((err) => {
                                         CoreFormControls.unblockUI();
                                         CoreFormControls.customToast();
                                         toastr.error("Gagal Mengimport Data!", "Gagal");
                                        })
                                    }
                                })
                                
                    }
                };
            }

        });

    }
    

        

    return {
        // public functions
        init: function () {
            initFormComponent();
            handleSelect2();  
            initImportExcel();
        }
    };
}();
