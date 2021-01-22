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
                                    <div class="kt-section kt-section--first col-md-12 row">
                                        <div class="col-md-12 form-warning" style="display:none">
                                            @include('template.alert')
                                        </div>
                                            <div class="form-group row col-md-4">
                                                <div class="col-lg-12">
                                                    <input type="file" id="file" @change="onFileSelected" name="file" ref="fileInput" style="display:none" disabled>
                                                    <div id="preview">
                                                    <img style="width: 100%;height: 100%" v-if="imagePath" :src="imagePath" @click="$refs.fileInput.click()" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="text" v-model="form.karyawan_nik" class="form-control text-center" style="border:none;font-size: medium" readonly>
                                                </div>
                                            </div>
                                        <div class="col-md-8 row">
                                            <div class="form-group col-md-7">
                                                <label>Nama Lengkap</label>
                                                <input type="text" v-model="form.karyawan_fullname" class="form-control" disabled>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label>Nama Panggilan</label>
                                                <input type="text" v-model="form.karyawan_username" class="form-control" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Jenis Kelamin</label>
                                                <div class="input-group">
                                                            <select v-model="form.karyawan_jenis_kelamin" class="form-control" disabled>
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="P">Perempuan</option>
                                                            </select>
                                                        </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Tempat Lahir</label>
                                                <input type="text" v-model="form.karyawan_tempat_lahir" class="form-control" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label>Tanggal Lahir</label>
                                            <div>
                                                <date-picker id="tgl_lahir" v-model="form.karyawan_tgl_lahir" :date="form.karyawan_tgl_lahir" :disabled="true">
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row">
                                            <div class="form-group col-md-5">
                                                <label>No. Identitas</label>
                                                <input type="number" v-model="form.karyawan_no_identitas" min="0" class="form-control noarrow" disabled>
                                            </div>
                                             <div class="form-group col-md-5">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                        <input type="email" v-model="form.karyawan_email" class="form-control" disabled>
                                                        </div>
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label>Agama</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_agama" class="form-control" disabled>
                                                                <option value="ISLAM">ISLAM</option>
                                                                <option value="HINDU">HINDU</option>
                                                                <option value="BUDHA">BUDHA</option>
                                                                <option value="KATOLIK">KATOLIK</option>
                                                                <option value="KONGHUCU">KONGHUCU</option>
                                                                <option value="PROTESTAN">PROTESTAN</option>
                                                            </select>
                                                        </div>
                                        </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-5">
                                                        <label>Alamat</label>
                                                         <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-home"></i></span></div>
                                                        <input type="text" v-model="form.karyawan_alamat" class="form-control" disabled>
                                                         </div>
                                            </div>
                                             <div class="form-group col-md-4">
                                                        <label>Telp</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                        <input v-model="form.karyawan_telp" type="number" min="0" class="form-control maxlength noarrow" maxlength="13" disabled>
                                                        </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                        <label>Password</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                                                        <input type="password" v-model="form.karyawan_password" class="form-control" disabled>
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                        <div class="form-group col-md-4">
                                                <label>Hak Akses</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_role_id" :selected="{{json_encode(@$role)}}" url="/master/karyawan/selectrole" name="role" vee-validate="required" disabled/>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label>Jabatan</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_jabatan_id" :selected="{{json_encode(@$jabatan)}}" url="/master/karyawan/selectjabatan" name="jabatan" vee-validate="required" disabled/>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label>Kantor</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_kantor_id" :selected="{{json_encode(@$kantor)}}" url="/master/karyawan/selectkantor" name="kantor" vee-validate="required" disabled/>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                <label>Kantor Yang Dikelola</label>
                                                <div>
                                                    <multi-select  v-model="form.karyawan_kantor_kelola" :selected="{{json_encode(@$kantorkelola)}}" url="/master/karyawan/selectkantor" name="kantor" vee-validate="required" disabled/>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                                    <label>NPWP</label>
                                                    <input v-model="form.karyawan_npwp" type="number" min="0" class="form-control noarrow" disabled>
                                         </div>
                                        <div class="form-group col-md-4">
                                                    <label>Alamat NPWP</label>
                                                    <input v-model="form.karyawan_npwp_alamat" type="text" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-3">
                                                        <label>Tanggal Masuk</label>
                                                            <div>
                                                                <date-picker id="tgl_masuk" v-model="form.karyawan_tgl_masuk" :date="form.karyawan_tgl_masuk" :disabled="true" >
                                                            </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Tanggal Keluar</label>
                                                    <div>
                                                        <date-picker id="tgl_keluar" v-model="form.karyawan_tgl_keluar" :date="form.karyawan_tgl_keluar" :disabled="true" >
                                                    </div>
                                                </div>
                                        <div class="form-group col-md-3">
                                                    <label>Tipe</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_tipe" class="form-control" disabled>
                                                                <option value="TETAP">TETAP</option>
                                                                <option value="LEPAS">LEPAS</option>
                                                            </select>
                                                        </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                                    <label>Status</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_is_active" class="form-control" disabled>
                                                                <option value="1">Aktif</option>
                                                                <option value="0">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="kt-form__actions d-flex justify-content-end">
                                        <a href="{{ route("karyawan") }}" class="btn btn-secondary myredirect core-pjax">Kembali</a>
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
     var $mixin = {
         data() {
                return {
                    form: JSON.parse('{!!@$data!!}')
                }
            }
     }
    $( document ).ready(function() {
        CoreFormControls.init();
        });
    </script>
@stop