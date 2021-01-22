<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Laravel</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Action</td>
                                </tr>
                                <form action="/mahasiswa/action_proses" method="POST">
                                    @csrf
                                <tr>
                                    <td>
                                        <input type="hidden" name="mahasiswa_id" value="{{@$detail->mahasiswa_id}}">
                                        <input type="text" name="mahasiswa_nama" id="" value="{{@$detail->mahasiswa_nama}}">
                                    </td>
                                    <td>
                                        <select name="mahasiswa_jenis_kelamin" id="">
                                            @foreach ($jenis_kelamin as $key => $value)
                                                @php
                                                    $strSelected = $key == @$detail->mahasiswa_jenis_kelamin ? "selected='true'" : "";
                                                @endphp
                                                <option value="{{$key}}" {{$strSelected}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" value="Update">
                                    </td>
                                    </form>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
