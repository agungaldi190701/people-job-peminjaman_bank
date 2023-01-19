<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class setoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setoran = DB::table('setorans')
            ->join('users', 'users.id', '=', 'setorans.users_id')
            ->join('nasabahs', 'nasabahs.id', '=', 'setorans.nasabahs_id')
            ->join('peminjaman', 'peminjaman.id', '=', 'setorans.peminjaman_id')
            ->select([
                '*'
            ])->get();

        return view('content.setoran.index', ['setoran' => $setoran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nasabahs_id' => 'required',
            'users_id' => 'required',
            'tanggal_setoran' => 'required',
            'jumlah_setoran' => 'required',
            'peminjaman_id' => 'required',
        ]);

        DB::table('setorans')->insert([
            'nasabahs_id' => $request->nasabahs_id,
            'users_id' => $request->users_id,
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_setoran' => $request->tanggal_setoran,
            'jumlah_setoran' => $request->jumlah_setoran,
            'status' => '',
        ]);

        return back()->with('status', 'Setoran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idN)
    {
        $setoran = DB::table('setorans')
            ->join('users', 'users.id', '=', 'setorans.users_id')
            ->join('nasabahs', 'nasabahs.id', '=', 'setorans.nasabahs_id')
            ->join('peminjaman', 'peminjaman.id', '=', 'setorans.peminjaman_id')
            ->select(['*'])
            ->where('setorans.users_id', '=', Auth::user()->id)
            ->where('setorans.nasabahs_id', '=', $idN)
            ->where('setorans.peminjaman_id', '=', $id)
            ->get();

        $total_setoran = DB::table('setorans')
            ->where('users_id', '=', Auth::user()->id)
            ->where('nasabahs_id', '=', $idN)
            ->where('peminjaman_id', '=', $id)
            ->sum('jumlah_setoran');

        $total_pinjaman = DB::table('peminjaman')
            ->where('nasabahs_id', '=', $idN)
            ->where('users_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->first();
        $peminjamans = DB::table('peminjaman')
            ->where('nasabahs_id', '=', $idN)
            ->where('users_id', '=', Auth::user()->id)
            ->get();
        return view('content.setoran.setoranNasabah', [
            'setoran' => $setoran,
            'total_setoran' => $total_setoran,
            'total_pinjaman' => $total_pinjaman,
            'idN' => $idN,
            'id' => $id,
            'peminjamans' => $peminjamans,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
