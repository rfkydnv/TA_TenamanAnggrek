@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
    <!-- begin:: Content -->

    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="my-vue">
        <div class="form-group" row>
            <validation-observer v-slot="{ passes }" >

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        Kantor Form
                                    </h3>
                                </div>
                            </div>
                            
                            <form @submit.prevent="passes(action_form)"
                                  id="my-form"
                                  action="{{ @$action }}"
                                  action-type="{{ @$action_type }}"
                                  data-url="{{ @$getdata }}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="col-md-12 form-warning" style="display:none">
                                            @include('template.alert')
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="nama jabatan" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Nama Jabatan</label>
                                                    <input type="text" v-model="form.jabatan_nama" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="keterangan" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Keterangan</label>
                                                    <input type="text" v-model="form.jabatan_keterangan" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                    </div>
                                    <div class="kt-form__actions">
                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>
                                        <a href="{{ route("jabatan.index") }}" class="btn btn-secondary myredirect core-pjax">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </validation-observer>
        </div>
        @stop

        @section("script")
            <script type="text/javascript">
                KTUtil.ready(function() {
                     CoreFormControls.init();
                });
            </script>
@stop