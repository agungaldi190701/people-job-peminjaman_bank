<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class pinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->all()  );
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak sama',

        ];

        $this->validate(
            request(),
            [
                'tujuan_pinjaman' => 'required',
                'jumlah_pinjaman' => 'required',
                'jumlah_angsuran' => 'required',
                'lama_pinjam' => 'required',
                'bunga' => 'required',
                'total_pinjaman' => 'required',
                'user_id' => 'required',
                'nasabahs_id' => 'required',

            ],
            $pesan
        );




        Peminjaman::create(
            [
                'users_id' => request('user_id'),
                'nasabahs_id' => request('nasabahs_id'),
                'jumlah_pinjaman' => request('jumlah_pinjaman'),
                'jumlah_angsuran' => request('jumlah_angsuran'),
                'lama_pinjam' => request('lama_pinjam'),
                'bunga' => request('bunga'),
                'total_pinjaman' => request('total_pinjaman'),
                'tujuan_pinjaman' => request('tujuan_pinjaman'),
                'status' => 'belum lunas'

            ]
        );

        return back()->with('success', 'Pinjaman Berhasil!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Peminjaman::where('id', $id)->update(
            [
                'status' => request('status'),
                ]
        );

        return back()->with('success', 'Data Berhasil Diubah!!');
        
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
