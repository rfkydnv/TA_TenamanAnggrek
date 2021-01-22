@extends('template.layout')

@section('app_title',env('APP_NAME'))

@section('module_title','Kantor')

@section('container')
<div class="kt-portlet kt-portlet--mobile" data-display="1" id="element" >
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
					&nbsp;
					<a id="find" class="btn btn-default btn-outline-primary btn-sm" title="Search Data">Find</a>
					<a class="btn btn-icon-only btn-default btn-outline-primary fullscreen la la-expand" data-original-title="" title="aktifkan mode tampilan layar penuh"></a>
					<a class="btn btn-icon-only btn-default btn-outline-primary reload la la-rotate-right" data-original-title="" title="Reload Data"></a>
					<a href="{{ route('kantor.create') }}" class="btn btn-brand btn-elevate btn-icon-sm la la-plus" >
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body">

		<!--begin: Datatable -->
		<div class="table-responsive">
			<table class="table table-striped-table-bordered table-hover table-checkable dataTable" id="kt_table_1">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Tipe</th>
						<th>Lokasi</th>
						<th width=15% >Actions</th>
					</tr>
					
				</thead>
			</table>
		</div>
	</div>

</div>

@stop

@section("script")
<script>
		KTUtil.ready(function() {

            document.addEventListener("turbolinks:click", function() {
                App.blockUI();
            })
            // $.fn.dataTable.ext.errMode = 'none';
			var url = "{{ route('kantor.datatable') }}";
			var targetRender = {
				'0':{'type' : '', 'orderable': false },
				'-1':{'type' : 'actions','orderable': false}
			};
			var filter = {
				'Nama':{'name':'nama','type':'text','id':'nama'},
				'Tipe':{'name':'tipe','type':'text','id':'tipe'},
				'Lokasi':{'name':'lokasi','type':'text','id':'lokasi'},
			};
			// var order   = [[0, "asc"]];
			CoreDataTables.init(url,targetRender,filter,null);
		}); 
		
	
	</script>
@stop
