@extends('layout.app')


@section('title','Dashboard')


@section('content')


<div class="card">

<div class="card-body">


<h2>
Selamat Datang,
{{ Auth::user()->name }}
</h2>


<hr>


<h4>
Sistem Informasi Rekapitulasi Administrasi Tahura
</h4>


<p>
Silakan pilih menu pada sidebar untuk mengelola data.
</p>


</div>

</div>


@endsection