@php
    $title = 'Data - Riwayat Setoran';
    $total_nasabah = DB::table('nasabahs')->count();
@endphp
@extends('layouts.main')

@section('content')
    <h1 class="mt-4">Data Riwayat Setoran Semua Nasabah</h1>
    <br>
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="card-body">
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
        </div>
    </div>
@endsection
@section('scripts')
    @if (session()->has('success'))
        <script>
            toastr.success(`{{ session('success') }}`);
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
