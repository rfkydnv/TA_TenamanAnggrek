@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('css')
    <style>
        span.error {
            color: #9F3A38;
        }
    </style>
    @stop

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
                                        {{ @$form_title }}
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
                                            <validation-provider name="menu_parentid" rules="">
                                                <div slot-scope="{ errors }">
                                                    <label>Parent Menu </label>
                                                    <select-2-url v-model="form.menu_parentid" :selected="{{json_encode(@$menu)}}" url="{{ route('menu.select2') }}" />
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>


                                        <div class="form-group">
                                            <validation-provider name="name" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Nama Mahasiswa</label>
                                                    <input type="text" v-model="form.mahasiswa_nama" class="form-control">
                                                    <span>@{{ errors[0] }}</span>
                                                </div>
                                            </validation-provider>
                                        </div>

                                        <div class="form-group">
                                            <validation-provider
                                                    rules="required|email"
                                                    v-slot="{ errors }"
                                            >
                                                    <label>Email</label>
                                                    <input type="text" v-model="form.mahasiswa_email" class="form-control">
                                                    <span>@{{ errors[0] }}</span>
                                            </validation-provider>
                                        </div>


                                        <div class="form-group">
                                            <validation-provider name="jk" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label for="jk">Jenis Kelamin</label>
                                                    <select class="form-control" id="jk" v-model="form.mahasiswa_jenis_kelamin">
                                                        <option value="L">Laki - laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>

                                        </div>

                                    </div>
                                    <div class="kt-form__actions">
                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>
                                        <a href="{{ route("mahasiswa.index") }}" class="btn btn-secondary myredirect core-pjax">Kembali</a>
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
                $( document ).ready(function() {
                     CoreFormControls.init();
                });
            </script>
@stop