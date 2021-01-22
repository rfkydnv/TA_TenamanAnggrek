@extends('template.layout')

@section('app_title',env('APP_NAME'))

{{-- @section('module_title',$module_title) --}}

@section('container')
    <div class="col-xl-12 col-lg-12 order-lg-12 order-xl-1">
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid" id="my-vue">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Config
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                            @php $x=0; @endphp
                            @foreach(@$company_data as $k => $v)
                                <li class="nav-item">
                                    <a class="nav-link {{$x == 0 ? 'active' : ''}}" aria-selected="true" href="{{'#'.strtolower($k)}}" data-toggle="tab">{{$k}}</a>
                                </li>
                            @php $x++; @endphp
                            @endforeach
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="company">
                        <div class="kt-widget4">
                            <validation-observer v-slot="{ passes }" >
                                <form @submit.prevent="passes(simpan)"
                                id="my-form"
                                action="{{ route('konfig.action_edit') }}"
                                action-type="{{ @$action_type }}"
                                >
                                    <div v-for="(items, key, index) in dataconfigs">
                                        <div v-if="key === 'COMPANY'" >
                                            <div v-for="(x, y) in items" >
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-3 col-form-label" style="text-align: left">@{{ x.config_finance_title}} PERUSAHAAN</label>
                                                    <div class="col-9">
                                                        <input type="hidden" name="config_id[]" v-model="x.config_id">
                                                        <input class="form-control" type="text" name="config_value[]" v-model="x.config_value">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-10">
                                                    <button class="btn btn-success">Simpan</button>
                                                    <a href="{{ route("konfig.index") }}" class="btn btn-secondary myredirect">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                        </div>
                    </div>


                    <div class="tab-pane" id="app">
                        <div class="kt-widget4">
                            <validation-observer v-slot="{ passes }" >
                                <form @submit.prevent="passes(simpan)"
                                id="my-form"
                                action="{{ route('konfig.action_edit') }}"
                                action-type="{{ @$action_type }}"
                                >
                                    <div v-for="(items, key, index) in dataconfigs">
                                        <div v-if="key === 'APP'" >
                                            <div v-for="(x, y) in items" >
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-3 col-form-label" style="text-align: left">@{{ x.config_finance_title}} PERUSAHAAN</label>
                                                    <div class="col-9">
                                                        <input type="hidden" name="config_id[]" v-model="x.config_id">
                                                        <input class="form-control" type="text" name="config_value[]" v-model="x.config_value">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-10">
                                                        <button class="btn btn-success">Simpan</button>
                                                    <a href="{{ route("konfig.index") }}" class="btn btn-secondary myredirect">Kembali</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </validation-observer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section("script")
    <script type="text/javascript">
        KTUtil.ready(function() {
            new Vue({
                el: "#my-vue",
                data() {
                    return {
                        dataconfigs: [],
                        x : [],
                        form: {isChecked: []},
                        err: {
                            menu_parentid: null
                        },
                        errors: null
                    }
                },
                methods: {
                    simpan() {
                            var form_ = $("#my-form");
                            var action = form_.attr('action');
                            var warning = $('.form-warning');
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
                                        axios.post("master/konfig/action_edit", this.dataconfigs)
                                            .then((res) => {
                                                unblockUI();
                                                customToast();
                                                toastr.success(res.data.message, "Sukses");
                                                if ($('.myredirect').length) {
                                                    $('.myredirect')[0].click();
                                                }
                                            })
                                            .catch((err) => {
                                                unblockUI();
                                                // if (err.response.status == 422) this.errors = err.response.data.errors;
                                                showWarn();
                                                customToast();
                                                toastr.error("Gagal Memproses Data!", "Gagal");

                                            })
                                    }
                                })
                        },
                },
                mounted: function () 
                {
                    let $vm = this;
                    let myform = $("#my-form");
                    let url = myform.attr('data-url');
                    let action = myform.attr('action-type');

                    App.blockUI();
                    axios.get("master/konfig/getConfig")
                    .then(function (resp) {
                        $vm.$data.dataconfigs = resp.data;
                        App.unblockUI();
                    })
                    .catch(function (err) {
                        customToast();
                        toastr.error("Gagal Mengambil Data!", "Gagal");
                        App.unblockUI();
                    });
                }
            })
            // CoreFormControls.init();
        });

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
    </script>
@stop
