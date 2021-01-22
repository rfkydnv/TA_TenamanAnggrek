@extends('template.layout')

@section('app_title','GAZI Core')

@section('module_title',$module_title)

@section('container')

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Record Selection
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="/" class="btn btn-clean btn-icon-sm">
                        <i class="la la-long-arrow-left"></i>
                        Back
                    </a>
                    &nbsp;
                    <a href="/mahasiswa/add" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Jenis Kelamin</td>
                            <td>Action
                            </td>
                        </tr>
                        @foreach ($mahasiswa as $rows)
                            <tr>
                                <td>{{$rows->mahasiswa_id}}</td>
                                <td>{{$rows->mahasiswa_nama}}</td>
                                <td>
                                    @if ($rows->mahasiswa_jenis_kelamin == "L")
                                        Laki-laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('detailMahasiswa',$rows->mahasiswa_id) }}">detail</a> | 
                                    <a href="{{ route('editMahasiswa',$rows->mahasiswa_id) }}">edit</a> |
                                    <form action="/mahasiswa/action_delete" method="POST">
                                        @csrf
                                        <input type="hidden" name="mahasiswa_id" value="{{$rows->mahasiswa_id}}">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
