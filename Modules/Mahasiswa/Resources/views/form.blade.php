@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
    <!-- begin:: Content -->
    
    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Mahasiswa Form
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form id="my-form">
                     <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                            <label >mask currency</label>
                                            <input type="text" class="form-control app-number-forma mask mask-money"> 
                                            <span class="help-block"></span>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                            <label>max length</label>
                                        <input type='text' class="form-control maxlength" maxlength="10" placeholder="Top right" type="text" />
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                            <label>Current Date</label> 
                                            <div class="input-group date"> 
                                                <input type="text" class="form-control date-picker" placeholder="Select date"/> 
                                                <div class="input-group-append"> 
                                                    <span class="input-group-text"> 
                                                        <i class="la la-calendar"></i> 
                                                    </span> 
                                                </div>  
                                            </div>
                                         </div> 
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                            <label >Current Time</label>
                                        <div class="input-group timepicker">
                                            <input class="form-control time-picker" placeholder="Select time" type="text" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-clock-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label col-lg-3 col-sm-12">Select2</label>
                                    <div class=" col-lg-4 col-md-9 col-sm-12">
                                        <div class="input-group">
                                            <select class="kt-select2 select2advance form-control" mydata-url="{{route('mahasiswa.select2')}}">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
        
                    </div>
                    </form>

                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@stop
@section("script")

  @stop