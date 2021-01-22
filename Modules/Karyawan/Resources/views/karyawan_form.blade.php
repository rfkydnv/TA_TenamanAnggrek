@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('css')
<style>
        .noarrow::-webkit-inner-spin-button, 
        .noarrow::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
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
                                    <div class="kt-section kt-section--first col-md-12 row">
                                        <div class="col-md-12 form-warning" style="display:none">
                                            @include('template.alert')
                                        </div>
                                            <div class="form-group row col-md-4" >
                                                <div class="col-lg-12">
                                                    <input type="file" id="file" @change="onFileSelected" name="file" ref="fileInput" style="display:none">
                                                    <div id="preview">
                                                        <img style="width: 100%; height: auto; border: none;" :src="imagePath" @click="$refs.fileInput.click()" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="text" v-model="form.karyawan_nik" class="form-control text-center" style="border:none;font-size: medium" readonly>
                                                </div>
                                            </div>
                                        <div class="col-md-8 row">
                                            <div class="form-group col-md-7">
                                                <validation-provider name="nama lengkap" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" v-model="form.karyawan_fullname" class="form-control">
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <validation-provider name="nama panggilan" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Nama Panggilan</label>
                                                        <input type="text" v-model="form.karyawan_username" class="form-control">
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <validation-provider name="jenis kelamin" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Jenis Kelamin</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_jenis_kelamin" class="form-control">
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="P">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <p>@{{ errors[0] }}</p>
                                                  </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <validation-provider name="tempat lahir" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Tempat Lahir</label>
                                                        <input type="text" v-model="form.karyawan_tempat_lahir" class="form-control">
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <validation-provider name="tanggal lahir" rules="required"> 
                                                     <div slot-scope="{ errors }">
                                                         <label>Tanggal Lahir</label>
                                                         <div>
                                                             <date-picker id="tgl_lahir" v-model="form.karyawan_tgl_lahir" :date="form.karyawan_tgl_lahir" >
                                                         </div>
                                                        <p>@{{ errors[0] }}</p>
                                                  </div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row">
                                            <div class="form-group col-md-5">
                                                <validation-provider name="nomor identitas" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>No. Identitas</label>
                                                        <input type="number" v-model="form.karyawan_no_identitas" min="0" class="form-control noarrow">
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                             <div class="form-group col-md-5">
                                                <validation-provider name="email" rules="required" >
                                                    <div slot-scope="{ errors }">
                                                        <label>Email</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                        <input type="email" v-model="form.karyawan_email" class="form-control">
                                                        </div>
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-2">
                                             <validation-provider name="agama" rules="required">
                                                  <div slot-scope="{ errors }">
                                                    <label>Agama</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_agama" class="form-control">
                                                                <option value="ISLAM">ISLAM</option>
                                                                <option value="HINDU">HINDU</option>
                                                                <option value="BUDHA">BUDHA</option>
                                                                <option value="KATOLIK">KATOLIK</option>
                                                                <option value="KONGHUCU">KONGHUCU</option>
                                                                <option value="PROTESTAN">PROTESTAN</option>
                                                            </select>
                                                        </div>
                                                     <p>@{{ errors[0] }}</p>
                                                  </div>
                                             </validation-provider>
                                        </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="form-group col-md-5">
                                                <validation-provider name="alamat" rules="required" >
                                                    <div slot-scope="{ errors }">
                                                        <label>Alamat</label>
                                                         <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-home"></i></span></div>
                                                        <input type="text" v-model="form.karyawan_alamat" class="form-control">
                                                         </div>
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                             <div class="form-group col-md-4">
                                                <validation-provider name="telp" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Telp</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                        <input v-model="form.karyawan_telp" type="number" min="0" class="form-control maxlength noarrow" maxlength="12">
                                                        </div>
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <validation-provider name="password" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Password</label>
                                                        <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-key"></i></span></div>
                                                        <input type="password" v-model="form.karyawan_password" class="form-control">
                                                        </div>
                                                        <p>@{{ errors[0] }}</p>
                                                    </div>
                                                </validation-provider>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                        <div class="form-group col-md-4">
                                             <validation-provider name="hak akses" rules="required">
                                                <div slot-scope="{ errors }">
                                                <label>Hak Akses</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_role_id" :selected="{{json_encode(@$role)}}" url="/master/karyawan/selectrole" name="role" vee-validate="required"/>
                                                </div>
                                                  <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <validation-provider name="jabatan" rules="required">
                                                <div slot-scope="{ errors }">
                                                <label>Jabatan</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_jabatan_id" :selected="{{json_encode(@$jabatan)}}" url="/master/karyawan/selectjabatan" name="jabatan" vee-validate="required"/>
                                                </div>
                                                 <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <validation-provider name="kantor" rules="required">
                                                <div slot-scope="{ errors }">
                                                <label>Kantor</label>
                                                <div>
                                                    <select-2-url v-model="form.karyawan_kantor_id" :selected="{{json_encode(@$kantor)}}" url="/master/karyawan/selectkantorsingle" name="kantor" vee-validate="required"/>
                                                </div>
                                                 <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group col-md-4">
                                             <validation-provider name="kantor kelola" rules="required">
                                                <div slot-scope="{ errors }">
                                                <label>Kantor Yang Dikelola</label>
                                                <div>
                                                    <multi-select  v-model="form.karyawan_kantor_kelola" :selected="{{json_encode(@$kantorkelola)}}" url="/master/karyawan/selectkantor" name="kantor" vee-validate="required"/>
                                                </div>
                                              <p>@{{ errors[0] }}</p>
                                                </div>
                                            </validation-provider>
                                        </div>
                                        <div class="form-group col-md-4">
                                                    <label>NPWP</label>
                                                    <input v-model="form.karyawan_npwp" type="number" min="0" class="form-control noarrow">
                                                 
                                        </div>
                                        <div class="form-group col-md-4">
                                                    <label>Alamat NPWP</label>
                                                    <input v-model="form.karyawan_npwp_alamat" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                                <validation-provider name="tanggal masuk" rules="required">
                                                    <div slot-scope="{ errors }">
                                                        <label>Tanggal Masuk</label>
                                                            <div>
                                                                <date-picker id="tgl_masuk" v-model="form.karyawan_tgl_masuk" :date="form.karyawan_tgl_masuk" >
                                                            </div>
                                                            <p>@{{ errors[0] }}</p>
                                                    </div>
                                                    </validation-provider>
                                                </div>
                                                <div class="form-group col-md-3">
                                                            <label>Tanggal Keluar</label>
                                                            <div>
                                                                <date-picker id="tgl_keluar" v-model="form.karyawan_tgl_keluar" :date="form.karyawan_tgl_keluar" >
                                                            </div>
                                                </div>
                                        <div class="form-group col-md-3">
                                             <validation-provider name="tipe" rules="required">
                                                  <div slot-scope="{ errors }">
                                                    <label>Tipe</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_tipe" class="form-control">
                                                                <option value="TETAP">TETAP</option>
                                                                <option value="LEPAS">LEPAS</option>
                                                            </select>
                                                        </div>
                                                     <p>@{{ errors[0] }}</p>
                                                  </div>
                                             </validation-provider>
                                        </div>
                                        <div class="form-group col-md-3">
                                             <validation-provider name="status" rules="required">
                                                  <div slot-scope="{ errors }">
                                                    <label>Status</label>
                                                        <div class="input-group">
                                                            <select v-model="form.karyawan_is_active" class="form-control">
                                                                <option value="1">Aktif</option>
                                                                <option value="0">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                     <p>@{{ errors[0] }}</p>
                                                  </div>
                                             </validation-provider>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="kt-form__actions d-flex justify-content-end">
                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>&nbsp;
                                        <a href="{{ route("karyawan") }}" class="btn btn-secondary myredirect">Kembali</a>
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
     var $mixin = {
         data() {
                return {
                    form: JSON.parse('{!!@$data!!}'),
                    imagePath: "https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png"
                }
            }
     }
    CoreFormControls.init($mixin);
    });
    </script>
@stop
