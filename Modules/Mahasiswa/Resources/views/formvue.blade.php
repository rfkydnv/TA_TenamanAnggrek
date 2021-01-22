@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
    <!-- begin:: Content -->
   
    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid" id="my-vue">
            <div class="alert alert-light alert-elevate" role="alert" >
                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                    <div class="alert-text">
                        <div class="errors" v-if="errors" style="text-align: left">
                            <ul>
                                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                    <strong>@{{ fieldsError.join('\n ')}}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        
        <form @submit.prevent="submit" id="my-form">

        
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Mahasiswa Form
                            </h3>
                        </div>
                    </div>
                        {{ csrf_field() }}
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <label>Nama Mahasiswa</label>
                                    <input type="text" name="name" v-model="form.name" class="form-control" maxlength="5" >
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select class="form-control" id="jk" name="jk" v-model="form.jk">
                                        <option value="L" selected>Laki - laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                            </div>
                                
                            </div>
                            <div class="kt-form__actions">
                                <button class="btn btn-primary" >Submit</button>
                                {{-- <a href="{{route('mahasiswa.index')}}" class="btn btn-secondary">Kembali</a> --}}
                                <a href="/master/mahasiswa" class="btn btn-secondary core-pjax">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>   
@stop

@section("script")
<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
            var id = "#edwintes";
            var input = {
                name:null,
                jk:null
            };
            var errors = null;
            var methods = 'post';
            var redirect = '/master/mahasiswa';
            var url = "{!!route('mahasiswa.store')!!}";
            var validasi = {
                    name:{required : true , maxlength : 3},
                    jk:{required : true},
                };
            var idvue = "#tes-vue"
            var form = {name,jk};
            
            CoreFormControls.init(id, input, validasi, methods,url, redirect, errors, idvue,form);
    });
</script>
  @stop