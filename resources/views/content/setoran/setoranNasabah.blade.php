@php
    $title = 'Data - Riwayat Setoran';
    
    $date = date('Y-m-d');
    
@endphp
@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#setoranUser">
                        <i class="fas fa-plus"></i> Setoran
                    </button>

                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="setoranNasabah">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jumlah Setoran</th>
                                <th>Tanggal Setoran</th>
                                <th>Total Pinjaman</th>
                                <th>Bertanggung jawab</th>
                                <th>Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setoran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Rp. {{ number_format($item->jumlah_setoran) }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tanggal_setoran)->isoFormat('D MMMM Y') }}</td>
                                    <td>Rp. {{ number_format($item->total_pinjaman) }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td></td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="bg-dark text-white">Total Setoran</th>
                                <th>Rp. {{ number_format($total_setoran) }}</th>
                                <th class="bg-secondary text-white">Selisih Pinjaman</th>
                                <th>Rp.
                                    {{ number_format($total_pinjaman->total_pinjaman - $total_setoran) }}
                                </th>
                                @php
                                    if ($total_setoran >= $total_pinjaman->total_pinjaman) {
                                        DB::table('peminjaman')
                                            ->where('id', $total_pinjaman->id)
                                            ->update([
                                                'status' => 'lunas',
                                            ]);
                                    } else {
                                        DB::table('peminjaman')
                                            ->where('id', $total_pinjaman->id)
                                            ->update([
                                                'status' => 'belum lunas',
                                            ]);
                                    }
                                @endphp
                                <th colspan="1"></th>
                                <th>
                                    @if ($total_pinjaman->status == 'belum lunas')
                                        <span class="badge rounded-pill bg-danger">{{ $total_pinjaman->status }}</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">{{ $total_pinjaman->status }}</span>
                                    @endif
                                </th>


                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="setoranUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Setoran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('upload-setoran') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="jumlah_setoran" class="form-label">Jumlah Setoran</label>
                            <input type="number" class="form-control" name="jumlah_setoran" id="jumlah_setoran">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_setoran" class="form-label">Jumlah Setoran</label>
                            <input type="date" class="form-control" name="tanggal_setoran" id="tanggal_setoran"
                                value="{{ $date }}">
                        </div>
                        <input type="hidden" name="users_id" id="users_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="nasabahs_id" id="nasabahs_id" value="{{ $idN }}">
                        <div class="mb-3">
                          <input type="hidden" name="peminjaman_id" value="{{ $id }}">
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
@endsection
@section('scripts')
@endsection
