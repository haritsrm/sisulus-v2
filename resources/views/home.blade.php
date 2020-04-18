@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($user->tempat != null && $user->tl != null && $user->nis != null && $user->nisn != null && $user->no_un != null && $user->komp != null)
                        <p>Berikut ini adalah bioadata anda, silahkan di cek terlebih dahulu sebelum mencetak.</p>
                        <p><strong>Nama</strong> : {{$user->name}}</p>
                        <p><strong>TTL</strong> : {{$user->tempat}}, {{$user->tl}}</p>
                        <p><strong>NIS/NISN</strong> : {{$user->nis}} / {{$user->nisn}}</p>
                        <p><strong>No UN</strong> : {{$user->no_un}}</p>
                        <p><strong>Kompetensi Keahlian</strong> : {{$user->komp}}</p>
                        Jika biodata salah anda bisa mengupdatenya disini 
                        <a href="{{route('profile')}}" class="btn btn-primary ml-2">Update Biodata</a>
                        <hr>
                        Cetak surat kelulusan disini!
                        <a href="{{route('print')}}" class="btn btn-success ml-2">Cetak</a>
                    @else
                        Harap lengkapi biodata anda terlebih dahulu!
                        <a href="{{route('profile')}}" class="btn btn-primary ml-2">Lengkapi Biodata</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
