@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
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
                                        Role Detail Form
                                    </h3>
                                </div>
                            </div>
                            
                            <form @submit.prevent="passes(action_form)"
                                    id="my-form"
                                    action="{{ @$action }}"
                                    action-type="{{ @$action_type }}"
                                    data-url="{{ @$getdata }}">
                                    
                                    <div class="kt-portlet__body">
                                        <div class="col-md-12 form-warning" style="display:none">
                                            @include('template.alert')
                                        </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                        <div class="kt-section kt-section--first">
                                                                <div class="form-group">
                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                        {{-- <validation-provider name="name" rules="required"> --}}
                                                                            {{-- <div slot-scope="{ errors }"> --}}
                                                                                <label>Nama Role</label>
                                                                                <input type="text" v-model="form.role_name" class="form-control">
                                                                                {{-- <p>@{{ errors[0] }}</p> --}}
                                                                            {{-- </div> --}}
                                                                        {{-- </validation-provider> --}}
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                    <label class="col-form-label col-lg- col-sm-12">Parent Menu</label>
                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                        <select-2-url v-model="form.menu" :selected="{{json_encode(@$role)}}" url="/master/roledetail/select2" name="menu" vee-validate="required"/>
                                                                    </div>
                                                                </div>

                                                                {{-- <div class="form-group">
                                                                    <div class=" col-lg-12 col-md-12 col-sm-12">
                                                                        <validation-provider name="role" rules="required">
                                                                            <div slot-scope="{ errors }">
                                                                            <label>Role</label>
                                                                                <div class="input-group">
                                                                                    <select v-select-2  id="xyz" v-model="form.menu_id" ojk="1:lorem ipsum" class="kt-select2 select2advance form-control" mydata-url="{{route('roledetail.select2')}}">
                                                                                        <option value="1" selected="selected">Lorem</option>
                                                                                    </select>
                                                                                </div>
                                                                                <p>@{{ errors[0] }}</p>
                                                                            </div>
                                                                        </validation-provider>
                                                                    </div>
                                                               </div> --}}

                                                                <div class="form-group row">
                                                                    <div class=" col-lg-4 col-md-9 col-sm-12">
                                                                        <label class="col-9 col-form-label">View</label>
                                                                            <div class="col-9">
                                                                                <div class="kt-radio-list">
                                                                                    <label class="kt-radio">
                                                                                        <input type="radio" v-model="form.roledetail_view" value="SELF"> SELF
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label class="kt-radio">
                                                                                        <input type="radio" v-model="form.roledetail_view" value="ALL"> ALL
                                                                                        <span></span>
                                                                                    </label>
                                                                                    <label class="kt-radio">
                                                                                        <input type="radio" v-model="form.roledetail_view" value="GROUP_OFFICE"> GROUP_OFFICE
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                    
                                                                        <div class="form-group row">
                                                                        <div class=" col-lg-4 col-md-9 col-sm-12">
                                                                            <label class="col-9 col-form-label">Access</label>
                                                                            <div class="col-9">
                                                                                <div v-if="form.tes == null">
                                                                                        <div class="kt-checkbox-list">
                                                                                            {{-- <label class="kt-checkbox">
                                                                                                <input type="checkbox" v-model="form.enable.view" @input="toggleCheckbox('view')" value="view"> VIEW
                                                                                                <span></span>
                                                                                            </label> --}}
                                                                                            <label class="kt-checkbox">
                                                                                                <input type="checkbox" v-model="form.isChecked" value="view"> VIEW
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="kt-checkbox">
                                                                                                <input type="checkbox" v-model="form.isChecked" value="create"> CREATE
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="kt-checkbox">
                                                                                                <input type="checkbox" v-model="form.isChecked" value="update"> UPDATE
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <label class="kt-checkbox">
                                                                                                <input type="checkbox" v-model="form.isChecked" value="delete"> DELETE
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div v-else>
                                                                                            <div class="kt-checkbox-list">
                                                                                                <label class="kt-checkbox">
                                                                                                    <input type="checkbox" v-model="form.tes" value="view"> VIEW
                                                                                                    <span></span>
                                                                                                </label>
                                                                                                <label class="kt-checkbox">
                                                                                                    <input type="checkbox" v-model="form.tes" value="create"> CREATE
                                                                                                    <span></span>
                                                                                                </label>
                                                                                                <label class="kt-checkbox">
                                                                                                    <input type="checkbox" v-model="form.tes" value="update"> UPDATE
                                                                                                    <span></span>
                                                                                                </label>
                                                                                                <label class="kt-checkbox">
                                                                                                    <input type="checkbox" v-model="form.tes" value="delete"> DELETE
                                                                                                    <span></span>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="kt-form__actions">
                                                                <button class="btn btn-primary"> {{ @$action_type == "add" ? "Simpan" : "Update" }} </button>
                                                                <a href="{{ route("role.index") }}" class="btn btn-secondary myredirect core-pjax">Kembali</a>
                                                            </div>
                                                </div>
                                                <div class="col-md-8">
                                                        <div class="kt-portlet__head kt-portlet__head--lg">
                                                                <div class="kt-portlet__head-label">
                                                                    <span class="kt-portlet__head-icon">
                                                                        <i class="kt-font-brand flaticon2-line-chart"></i>
                                                                    </span>
                                                                    <h3 class="kt-portlet__head-title">
                                                                        {{$module_title}}
                                                                    </h3>
                                                                </div>
                                                                <div class="kt-portlet__head-toolbar">
                                                                    <div class="kt-portlet__head-wrapper">
                                                                        <div class="kt-portlet__head-actions">
                                                                            <div class="dropdown dropdown-inline">
                                                                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="la la-download"></i> Export
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                    <ul class="kt-nav">
                                                                                        <li class="kt-nav__section kt-nav__section--first">
                                                                                            <span class="kt-nav__section-text">Choose an option</span>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link">
                                                                                                <i class="kt-nav__link-icon la la-print"></i>
                                                                                                <span class="kt-nav__link-text">Print</span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link">
                                                                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                                                                <span class="kt-nav__link-text">Copy</span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link">
                                                                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                                                <span class="kt-nav__link-text">Excel</span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link">
                                                                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                                                <span class="kt-nav__link-text">CSV</span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link">
                                                                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                                                <span class="kt-nav__link-text">PDF</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            &nbsp;
                                                                            <a id="find" class="btn btn-default btn-outline-primary btn-sm" title="Search Data">Find</a>
                                                                            <a class="btn btn-icon-only btn-default btn-outline-primary fullscreen la la-expand" data-original-title="" title="aktifkan mode tampilan layar penuh"></a>
                                                                            <a class="btn btn-icon-only btn-default btn-outline-primary reload la la-rotate-right" data-original-title="" title="Reload Data"></a>
                                                                            <a href="{{ route('roledetail.lihatdetail',$role_id)}}" class="btn btn-brand btn-elevate btn-icon-sm la la-plus" >
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div class="table-responsive">
                                                                <table class="table table-striped-table-bordered table-hover table-checkable dataTable" id="kt_table_1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Menu</th>
                                                                            <th>Link</th>
                                                                            <th>Segment</th>
                                                                            <th>View</th>
                                                                            <th>Access</th>
                                                                            <th width=15% >Actions</th>
                                                                        </tr>
                                                                        
                                                                    </thead>
                                                                </table>
                                                        </div>
                                                </div>
                                            </div>
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

        <script type="text/javascript">

            KTUtil.ready(function() {
                document.addEventListener("turbolinks:click", function() {
                    App.blockUI();
                })
                // $.fn.dataTable.ext.errMode = 'none';
                var url = "{{route('roledetail.datatable')}}";
                url += '?role_id={{$role_id}}';
                var targetRender = {
                    '0':{'type' : '', 'orderable': false },
                    '-1':{'type' : 'actions','orderable': false}
                };
                var filter = {
                    'Link':{'name':'link','type':'text','id':'link'},
                    'Segment':{'name':'segment','type':'text','id':'segment'},
                };
                // var order   = [[0, "asc"]];
                CoreDataTables.init(url,targetRender,filter,null);
            }); 

        </script>
       
@stop
