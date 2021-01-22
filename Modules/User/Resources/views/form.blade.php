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
                                            <validation-provider name="nama lengkap" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" v-model="form.user_fullname" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="nama panggilan" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Nama Panggilan</label>
                                                    <input type="text" v-model="form.user_username" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="email" rules="required" >
                                                <div slot-scope="{ errors }">
                                                    <label>Email</label>
                                                    <input type="email" v-model="form.user_email" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="password" rules="required">
                                                <div slot-scope="{ errors }">
                                                    <label>Password</label>
                                                    <input type="password" v-model="form.user_password" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <validation-provider name="konfirmasi" rules="required|password:password">
                                                <div slot-scope="{ errors }">
                                                    <label>Konfirmasi Password</label>
                                                    <input v-model="form.confirm" type="password" class="form-control">
                                                    <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group">
                                             <validation-provider name="role" rules="required">
                                                  <div slot-scope="{ errors }">
                                                    <label>Role</label>
                                                        <div class="input-group">
                                                            <select v-select-2 v-model="form.user_role_id" class="kt-select2 select2advance form-control" mydata-url="{{route('role.select')}}">
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                     <p>@{{ errors[0] }}</p>
                                                  </div>
                                             </validation-provider>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3">Status Aktif ?</label>
                                            <div class="col-md-3">
                                            <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                    <label>
                                                        <input type="checkbox" v-model="form.user_is_active">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-form__actions">
                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>
                                        <a href="{{ route("user.index") }}" class="btn btn-secondary myredirect">Kembali</a>
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