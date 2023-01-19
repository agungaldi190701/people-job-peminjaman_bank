@php
    $title = 'Edit - Nasabah';
    $persyaratan = DB::table('syarat_pinjaman')
        ->where('nasabahs_id', '=', $nasabah->id)
        ->first();
    $peminjamans = DB::table('peminjaman')
        ->where('nasabahs_id', '=', $nasabah->id)
        ->where('users_id', '=', Auth::user()->id)
        ->get();
    
@endphp
@extends('layouts.main')
@section('content')
    <h1 class="mt-4">Data Nasabah {{ $nasabah->nama }}</h1>
    <br>

    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="data-diri" data-bs-toggle="tab" data-bs-target="#data_diri"
                        type="button" role="tab" aria-controls="data_diri" aria-selected="true">Biodata
                        Nasabah</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#persyaratan"
                        type="button" role="tab" aria-controls="persyaratan" aria-selected="false">Persyaratan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="peminjaman-tab" data-bs-toggle="tab" data-bs-target="#peminjaman"
                        type="button" role="tab" aria-controls="peminjaman" aria-selected="false">Peminjaman</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="data_diri" role="tabpanel" aria-labelledby="data-diri">
                    <form class="w-75" action="/data-nasabah/update/{{ $nasabah->id }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control " id="nama" name="nama"
                                placeholder="Masukan Nama..." value="{{ $nasabah->nama }}">
                        </div>

                        <div class="mb-3">
                            <label for="jk" class="form-label">Pilih Jenis Kelamin</label>
                            <select class="form-select" name="jk" id="jk">
                                <option value="{{ $nasabah->jk }}">{{ $nasabah->jk }}</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">Nomor Hp</label>
                            <input type="text" class="form-control" id="nohp" name="nohp"
                                placeholder="Masukan Nomor Hp..." value="{{ $nasabah->no_telp }}">
                        </div>
                        <div class="mb-3">
                            <label for="norek" class="form-label">Nomor Rekening</label>
                            <input type="number" class="form-control" id="norek" name="norek"
                                placeholder="Masukan Nomor Rekening..." value="{{ $nasabah->no_rekening }}">
                        </div>
                        <div class="mb-3">
                            <label for="saldo" class="form-label">Jumlah Saldo</label>
                            <input type="number" class="form-control" id="saldo" name="saldo"
                                value="{{ $nasabah->saldo }}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat">{{ $nasabah->alamat }}</textarea>
                        </div>
                        <div class="mb-3 float-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
                <div class="tab-pane fade" id="persyaratan" role="tabpanel" aria-labelledby="profile-tab">

                    @if ($persyaratan == null)
                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <h3> Data Masih Kosong !!!</h3>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"> <i class="fas fa-plus"></i> Tambah
                                        Data</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <br>
                        <form action="{{ url('/update-syarat/' . $persyaratan->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <img src="{{ asset('data_file/' . $persyaratan->surat_keterangan) }}" alt=""
                                        width="200px">
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="surat_keterangan"
                                        id="surat_keterangan" value="{{ $persyaratan->surat_keterangan }}">
                                </div>
                                <div class="col mb-3">
                                    <img src="{{ asset('data_file/' . $persyaratan->identitas) }}" alt=""
                                        width="200px">
                                    <br>
                                    <br>
                                    <input type="file" class="form-control" name="identitas" id="identitas"
                                        value="{{ $persyaratan->identitas }}">
                                </div>
                                <div class="col mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan"
                                        value="{{ $persyaratan->keterangan }}">
                                    <button type="submit" class="btn btn-success mt-3"> Update</button>
                                </div>
                            </div>
                    @endif
                    </form>
                </div>
                <div class="tab-pane fade" id="peminjaman" role="tabpanel" aria-labelledby="peminjaman-tab">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary  float-end" data-bs-toggle="modal"
                                        data-bs-target="#pinjaman"> <i class="fas fa-plus"></i> Tambah
                                        Data
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-responsive" id="example">
                                        <thead>
                                            <tr>
                                                <th>Jumlah Pinjaman</th>
                                                <th>Jumlah Angsuran</th>
                                                <th>Lama Pinjam</th>
                                                <th>Bunga</th>
                                                <th>Total Pinjaman</th>
                                                <th>Tujuan Pinjaman</th>
                                                <th>Status Pinjaman</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($peminjamans as $item)
                                                <tr>
                                                    <td>Rp. {{ number_format($item->jumlah_pinjaman) }}</td>
                                                    <td>Rp. {{ number_format($item->jumlah_angsuran) }}</td>
                                                    <td>{{ $item->lama_pinjam }} bulan</td>
                                                    <td>{{ $item->bunga }} %</td>
                                                    <td>Rp. {{ number_format($item->total_pinjaman) }}</td>
                                                    <td>{{ $item->tujuan_pinjaman }}</td>
                                                    <td>
                                                        @if ($item->status == 'belum lunas')
                                                            <span
                                                                class="badge rounded-pill bg-danger">{{ $item->status }}</span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill bg-success">{{ $item->status }}</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href="{{ url('lihat-setoran/' . $item->id . '/' . $nasabah->id) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-info"></i> Setoran</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Persyaratan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/upload-syarat/' . $nasabah->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="surat_keterangan" class="form-label">Surat Keterangan</label>
                            <input type="file" class="form-control" name="surat_keterangan" id="surat_keterangan">
                        </div>
                        <div class="mb-3">
                            <label for="identitas" class="form-label">Identitas</label>
                            <input type="file" class="form-control" name="identitas" id="identitas">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="pinjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pinjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/upload-pinjaman') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="tujuan_pinjaman" class="form-label">Tujuan Pinjaman</label>
                            <input type="text" class="form-control" name="tujuan_pinjaman" id="tujuan_pinjaman">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                            <input type="number" class="form-control" name="jumlah_pinjaman" id="jumlah_pinjaman">
                        </div>

                        <div class="mb-3">
                            <label for="lama_pinjam" class="form-label">Lama Pinjam (bulan)</label>
                            <input type="number" class="form-control" name="lama_pinjam" id="lama_pinjam">
                        </div>
                        <div class="mb-3">
                            <label for="bunga" class="form-label">Bunga (%)</label>
                            <input type="number" class="form-control" name="bunga" id="bunga"
                                onchange="lihatTotal()">
                        </div>
                        <div class="mb-3">
                            <label for="total_pinjaman" class="form-label">Total Pinjaman</label>
                            <input type="number" class="form-control" name="total_pinjaman" id="total_pinjaman">
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_angsuran" class="form-label">Jumlah Angsuran</label>
                            <input type="number" class="form-control" name="jumlah_angsuran" id="jumlah_angsuran">
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="nasabahs_id" value="{{ $nasabah->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-warning" onclick="lihatTotal()">Lihat total</button> --}}
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
    @if (session()->has('status'))
        <script>
            toastr.success(`{{ session('status') }}`);
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
    <script>
        $(document).ready(function() {
            $('#setoranNasabah').DataTable();
        });
    </script>


    <script>
        function lihatTotal() {
            var jumlah_pinjaman = document.getElementById('jumlah_pinjaman').value;
            var lama_pinjam = document.getElementById('lama_pinjam').value;
            var bunga = document.getElementById('bunga').value;

            var angsuran = jumlah_pinjaman / lama_pinjam;

            var total_bunga = jumlah_pinjaman * (bunga / 100);
            var total = parseInt(jumlah_pinjaman) + parseInt(total_bunga);

            document.getElementById('jumlah_angsuran').value = Math.ceil(angsuran);
            document.getElementById('total_pinjaman').value = Math.ceil(total);



        }
    </script>
@endsection
