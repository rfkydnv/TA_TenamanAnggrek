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
                                            <div class="form-group row col-md-4" style="margin:0 auto;">
                                                <div class="col-lg-12">
                                                    <input type="file" id="file" @change="onFileSelected" name="file" ref="fileInput" style="display:none">
                                                    <div id="preview">
                                                        <img style="width: 100%; height: auto; border: none;" :src="imagePath" @click="$refs.fileInput.click()" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 row"> 
                                                    <div class="form-group col-md-12"> 
                                                            <validation-provider name="nama" rules="required"> 
                                                            <div slot-scope="{ errors }"> 
                                                            <label>Nama</label> 
                                                            <input type="text" v-model="form.anggrek_nama" class="form-control"> 
                                                            <p>@{{ errors[0] }}</p> 
                                                        </div> </validation-provider> 
                                                    </div> 
                                                </div>
                                            </div>
                                        
                                        
                                        </div>
                                    </div>
                                    <div class="kt-form__actions d-flex justify-content-end">
                                        <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>&nbsp;
                                        <a href="{{ route("anggrek.index") }}" class="btn btn-secondary myredirect">Kembali</a>
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
