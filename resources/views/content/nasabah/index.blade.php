@php
    $title = 'Data - Nasabah';
    $total_nasabah = DB::table('nasabahs')
        ->where('users_id', '=', Auth::user()->id)
        ->count();
@endphp
@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Data Nasabah</h1>
    <br>
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


    </div>
    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="float-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i
                                class="fas fa-plus"></i> Tambah
                            Data</button>
                    </div>

                </div>
                <div class="card-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>No Rekening</th>
                                <th>Saldo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nasabah as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->jk }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->no_rekening }}</td>
                                    <td>{{ $item->saldo }}</td>
                                    <td class="d-flex mb-3">
                                        <a href="{{ url('data-nasabah/edit', $item->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ url('hapus-nasabah', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda Yakin Mengahus Data Ini ?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger"><i
                                                    class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Nasabah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('upload-nasabah') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukan Nama...">
                            </div>

                            <div class="mb-3">
                                <label for="jk" class="form-label">Pilih Jenis Kelamin</label>
                                <select class="form-select" name="jk" id="jk">
                                    <option selected>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nohp" class="form-label">Nomor Hp</label>
                                <input type="text" class="form-control" id="nohp" name="nohp"
                                    placeholder="Masukan Nomor Hp...">
                            </div>
                            <div class="mb-3">
                                <label for="norek" class="form-label">Nomor Rekening</label>
                                <input type="number" class="form-control" id="norek" name="norek"
                                    placeholder="Masukan Nomor Rekening...">
                            </div>
                            <div class="mb-3">
                                <label for="saldo" class="form-label">Jumlah Saldo</label>
                                <input type="number" class="form-control" id="saldo" name="saldo" value="0"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="sumbit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
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
