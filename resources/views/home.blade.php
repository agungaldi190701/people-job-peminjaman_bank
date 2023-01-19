@php
    $title = 'Dashboard';
    
    $total_nasabah = DB::table('nasabahs')->count();
    $total_admin = DB::table('users')->count();
    $setoran = DB::table('setorans')
        ->join('users', 'users.id', '=', 'setorans.users_id')
        ->join('nasabahs', 'nasabahs.id', '=', 'setorans.nasabahs_id')
        ->join('peminjaman', 'peminjaman.id', '=', 'setorans.peminjaman_id')
        ->select(['*'])
        ->get();
@endphp
@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="fs-5 fw-bold">Nasabah</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ $total_nasabah }} Orang
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="fs-5 fw-bold">Admin</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ $total_admin }} Orang
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul Pinjaman</th>
                        <th>Jumlah Setoran</th>
                        <th>Tanggal Setoran</th>
                        <th>Bertanggung jawab</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($setoran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->tujuan_pinjaman }}</td>
                            <td>Rp. {{ number_format($item->jumlah_setoran) }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_setoran)->isoFormat('D MMMM Y') }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if ($item->status == 'belum lunas')
                                    <span class="badge rounded-pill bg-danger">{{ $item->status }}</span>
                                @else
                                    <span class="badge rounded-pill bg-success">{{ $item->status }}</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session()->has('success'))
        <script>
            toastr.success(`{{ session('success') }}`);
        </script>
    @endif
    @if (session()->has('logout'))
        <script>
            toastr.success(`{{ session('logout') }}`);
        </script>
    @endif
    @if (session()->has('loginErorr'))
        <script>
            toastr.error(`{{ session('loginErorr') }}`);
        </script>
    @endif
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
