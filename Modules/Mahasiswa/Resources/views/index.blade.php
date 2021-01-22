@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title',$module_title)

@section('container')
<div class=" kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Data Mahasiswa
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
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-brand btn-elevate btn-icon-sm la la-plus">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable dataTable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Buat</th>
                        <th width="15%">Actions</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th><input type="text" id="nama" class="form-control">
                        <th><select class="form-control " title="Select" >
                                <option value="">Select</option>
                                <option value="Argentina">Laki - laki</option>
                                <option value="Austria">Perempuan</option>
                            </select>
                        </th>
                        <th><input type="text" name="datefilter" value="" id="datefilter" />
                            {{-- <div class="input-group date">
                            <input type="text" class="form-control form-control-sm kt-input" readonly="" placeholder="From" id="kt_datepicker_1" data-col-index="5">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
                            </div>
                            </div>
                            <div class="input-group date">
                                <input type="text" class="form-control form-control-sm kt-input" readonly="" placeholder="To" id="kt_datepicker_2" data-col-index="5">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="la la-calendar-o glyphicon-th"></i></span>
                                </div>
                            </div> --}}
                        </th>
                        <th><button class="btn btn-brand kt-btn btn-sm kt-btn--icon" id="search">
                            <span>
                              <i class="la la-search"></i>
                              <span>Search</span>
                            </span>
                          </button><button class="btn btn-secondary kt-btn btn-sm kt-btn--icon" id="reset">
                            <span>
                              <i class="la la-close"></i>
                              <span>Reset</span>
                            </span>
                          </button></th>
                    </tr>
                </thead>
               <tbody>

               </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>
@push('scripts')
{{-- <script src="{{ asset('js/home/homeApp.js') }}"></script> --}}
@endpush
<script>
        $(function () {
            console.log("ready");
            $.fn.dataTable.ext.errMode = 'none';
        
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

          var table = $('.dataTable').DataTable({
              bFilter:false,
              processing: true,
              serverSide: true,
    //   ajax: "{{ route('mahasiswa.datatable') }}",
        ajax: {
                  url:"{{ route('mahasiswa.datatable') }}",
                  type:'get',
                  data:function(data){
                      
                        data.nama = $('#nama').val(); 
                        data.tanggal = $('#datefilter').val();
                        
                  }
              },
              columns: [
                  // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: '', name: '', orderable: false, searchable: false},
                  {data: 'mahasiswa_nama'},
                  {data: 'mahasiswa_jenis_kelamin'},
                  {data: 'tanggal_buat', orderable: false, searchable: false},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
          $('#search').on('click', function (e) {
              table.draw();
          })

          $('#reset').on('click', function (e) {
            $('#nama').val("");
              table.clear().draw();
          })

       

        
        })
      </script>

<script>
    function tes(id){
        swal({
            title: 'Are you sure want to delete this data ?',
            type: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d44',
            confirmButtonText: 'Yes, Delete it!',
            showCancelButton: true
        },
        function(){
            window.location = ('{{url("")}}/master/mahasiswa/delete/'+id)
        });
    } 
</script>
@stop
@section("script")

  @stop