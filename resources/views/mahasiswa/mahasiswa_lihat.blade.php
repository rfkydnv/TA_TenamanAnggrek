@extends('template.layout')

@section('app_title','GAZI Core')

@section('module_title',$module_title)

@section('container')
<div class="row">
    <div class="col-12">
        <table class="table table-bordered">
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Jenis Kelamin</td>
            </tr>
            
                <tr>
                    <td>{{$detail->mahasiswa_id}}</td>
                    <td>{{$detail->mahasiswa_nama}}</td>
                    <td>
                        @if ($detail->mahasiswa_jenis_kelamin == 'L')
                            Laki-laki
                        @else
                            Perempuan
                        @endif

                    </td>
                </tr>
        </table>
        <a href="{{ url('/mahasiswa') }}">Kembali</a>
    </div>
</div>
@endsection
