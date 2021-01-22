@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('css')
    <style>
        span.error {
            color: #9F3A38;
        }

        #app {
            padding: 20px;
        }

        #preview {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #preview img {
            max-width: 100%;
            max-height: 500px;
        }
    </style>
@stop

@section('container')
    <!-- begin:: Content -->

    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="my-vue">
        <div class="form-group" row>

          {{--  <form class="needs-validation" id="validated-form">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="" value="" required>
                        <span class="text-danger" v-if="validationErrors.firstName" v-text="validationErrors.firstName"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="" value="" required>
                        <span class="text-danger" v-if="validationErrors.lastName" v-text="validationErrors.lastName"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                        <span class="text-danger" v-if="validationErrors.username" style="width: 100%;" v-text="validationErrors.username"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" name="email" placeholder="you@example.com">
                    <div class="text-danger" v-if="validationErrors.email" style="width: 100%;">
                        <span v-text="validationErrors.email"></span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="menu_parentid">Jenis Kelamin</label>
                    <select class="form-control" id="jk" name="menu_parentid" v-model="validationErrors.menu_parentid" required>
                        <option value="L">Laki - laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <span class="text-danger" v-if="validationErrors.menu_parentid" style="width: 100%;" v-text="validationErrors.menu_parentid"></span>
                </div>

                <div class="mb-3">
                    <label for="menu_parentid">Menu Parent <span class="text-muted">(Optional)</span></label>
                    <select-2-url name="menu_parentid" :selected="{{json_encode(@$menu)}}" url="{{ route('menu.select2') }}" placeholder="" required />
                    <span class="text-danger" v-if="validationErrors.menu_parentid" style="width: 100%;" v-text="validationErrors.menu_parentid"></span>
                </div>


                <!--  Rest of form hidden for space    -->

                <button class="btn btn-primary btn-lg btn-block" type="submit"
                        @click.prevent="submitForm()">SUBMIT</button>
            </form>--}}

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

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider name="menu_parentid" rules="required">--}}
                                                {{--<div slot-scope="{ errors }">--}}
                                                    {{--<label for="menu_parent">Menu Parent </label>--}}
                                                    {{--<select-2-url name="menu_parentid" :selected="{{json_encode(@$menu)}}" url="{{ route('menu.select2') }}"/>--}}
                                                    {{--<span>@{{ errors[0] }}</span>--}}
                                                {{--</div>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider name="nama" rules="required">--}}
                                                {{--<div slot-scope="{ errors }">--}}
                                                {{--<label>Nama Mahasiswa</label>--}}
                                                    {{--<input type="text" v-model="form.mahasiswa_nama" class="form-control">--}}
                                                         {{--<span>@{{ errors[0] }}</span>--}}
                                                    {{--</div>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider--}}
                                                    {{--rules="required|email"--}}
                                                    {{--v-slot="{ errors }"--}}
                                                    {{--name="email"--}}
                                            {{-->--}}
                                                {{--<label>Email</label>--}}
                                                {{--<input type="text" v-model="form.mahasiswa_email" class="form-control">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}


                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider name="jenis kelamin" rules="oneOf:L">--}}
                                                {{--<div slot-scope="{ errors }">--}}
                                                    {{--<label for="jk">Jenis Kelamin</label>--}}
                                                    {{--<select class="form-control" id="jk" v-model="form.mahasiswa_jenis_kelamin">--}}
                                                        {{--<option value="L">Laki - laki</option>--}}
                                                        {{--<option value="P">Perempuan</option>--}}
                                                    {{--</select>--}}
                                                    {{--<p>@{{ errors[0] }}</p>--}}
                                                {{--</div>--}}
                                            {{--</validation-provider>--}}

                                        {{--</div>--}}

                                       {{--<div class="form-group">--}}
                                            {{--<validation-provider rules="between:1,11" v-slot="{ errors }">--}}
                                                {{--<input v-model="form.value" type="text">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider--}}
                                                    {{--rules="required|password:confirmation"--}}
                                                    {{--v-slot="{ errors }">--}}
                                                {{--<input v-model="form.password" type="password">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                      {{--<div class="form-group">--}}
                                            {{--<validation-provider--}}
                                                    {{--name="confirmation"--}}
                                                    {{--rules="required"--}}
                                                    {{--v-slot="{ errors }">--}}
                                                {{--<input v-model="form.confirm" type="password">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider rules="image" v-slot="{ errors, validate }">--}}
                                                {{--<input type="file" @change="validate">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        {{--<div class="form-group">--}}
                                            {{--<validation-provider rules="size:100" v-slot="{ errors, validate }">--}}
                                                {{--<input type="file" @change="validate">--}}
                                                {{--<span>@{{ errors[0] }}</span>--}}
                                            {{--</validation-provider>--}}
                                        {{--</div>--}}

                                        <div class="form-group">
                                            <input type="file" @change="onFileSelected" name="file" ref="fileInput" style="display:none">
                                        </div>

                                        <div id="preview">
                                            <img v-if="imagePath" :src="imagePath" @click="$refs.fileInput.click()" />
                                            <button type="button" @click="removeFile">remove</button>
                                        </div>

                                        <div class="form-group">
                                            <label>nama</label>
                                            <input type="text" name="name" v-model="form.name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>nama1</label>
                                            <input type="text" name="name1" v-model="form.name1" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>nama2</label>
                                            <input type="text" name="name2" v-model="form.name2" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>nama3</label>
                                            <input type="text" name="name3" v-model="form.name3" class="form-control">
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

                    new Vue({
                        el:"#my-vue",
                        data: function () {
                            return {
                                errors:null,
                                selectedFile:null,
                                form:{},
                                imagePath:"https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png"
                            }
                        },
                        methods : {
                            removeFile(){this.imagePath="https://alumni.crg.eu/sites/default/files/default_images/default-picture_0_0.png"},
                            onFileSelected (e)
                            {
                                this.selectedFile = e.target.files[0];
                                this.imagePath = URL.createObjectURL(this.selectedFile);
                            },
                            action_form()
                            {
                                const form_data = new FormData();
                                const config = {headers: { 'content-type': 'multipart/form-data' }};
                                if (this.selectedFile != null) form_data.append("file", this.selectedFile, this.selectedFile.name);

                                $.each(this.form, function (k, v) {
                                    form_data.append(k, v);
                                });

                                var myForm = $("#my-form").serialize();
                                console.log(myForm);

//                                axios.post('mahasiswa/fileUpload', form_data, {
//                                    onUploadProgress: uploadEvent => {
//                                        console.log("uploadprogress"+ Math.round(uploadEvent.loaded / uploadEvent.total * 1));
//                                    },
//                                    config
//                                })
//                                .then( res => {
//                                   console.log(res)
//                                });
                            }
                        }
                    });
                   /* new Vue({
                        el: '#validated-form',
                        data: function () {
                            return {
                                validationErrors: {
                                    firstName: null,
                                    lastName: null,
                                    username: null,
                                    email: null,
                                    address: null,
                                    country: null,
                                    state: null,
                                    zip: null,
                                    menu_parentid: null,
                                }
                            }
                        },
                        methods: {
                            submitForm () {
                                if (this.validateForm()) {
                                    alert('Form Submitted')
                                    //submit form to backend
                                }
                            },
                            validateForm () {
                                var formId = 'validated-form';
                                var nodes = document.querySelectorAll(`#${formId} :invalid`);
                                var errorObjectName = 'validationErrors';
                                var vm = this; //current vue instance;

                              /!*  Object.keys(this[errorObjectName]).forEach(key => {
                                    this[errorObjectName][key] = null
                                });*!/

                              console.log(nodes);

                                if (nodes.length > 0) {
                                    nodes.forEach(node => {
                                        this[errorObjectName][node.name] = node.validationMessage;
                                        node.addEventListener('change', function (e) {
                                            vm.validateForm();
                                        });
                                    });

                                    console.log(this[errorObjectName]);

                                    return false;
                                }
                                else {
                                    return true;
                                }
                            }
                        }
                    });*/
//                    CoreFormControls.init();
                });
            </script>
@stop