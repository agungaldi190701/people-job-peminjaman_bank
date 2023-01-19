<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class syaratController extends Controller
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
    public function store(Request $request, $id)
    {

        // dd($request->all()  );

        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak sama',
            'mimes' => ':attribute harus berupa file gambar (png,jpg,jpeg)'

        ];

        $this->validate(
            request(),
            [
                'surat_keterangan' => 'required|mimes:png,jpg,jpeg',
                'identitas' => 'required|mimes:png,jpg,jpeg',
                'keterangan' => 'required',
            ],
            $pesan
        );

        $surat_keterangan = $request->file('surat_keterangan');
        $identitas = $request->file('identitas');

        $nama_surat_keterangan = time() . "_" . $surat_keterangan->getClientOriginalName();
        $nama_identitas = time() . "_" . $identitas->getClientOriginalName();

        $tujuan_upload = 'data_file';
        $surat_keterangan->move($tujuan_upload, $nama_surat_keterangan);
        $identitas->move($tujuan_upload, $nama_identitas);

        $syarat = new \App\Models\SyaratPinjaman();
        $syarat->nasabahs_id = $id;
        $syarat->surat_keterangan = $nama_surat_keterangan;
        $syarat->identitas = $nama_identitas;
        $syarat->keterangan = $request->keterangan;
        $syarat->save();

        return back()->with('status', 'Data Berhasil Ditambahkan');
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
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah terdaftar',
            'same' => ':attribute tidak sama',
            'mimes' => ':attribute harus berupa file gambar (png,jpg,jpeg)'

        ];

        $this->validate(
            request(),
            [
                'surat_keterangan' => 'mimes:png,jpg,jpeg',
                'identitas' => 'mimes:png,jpg,jpeg',
                'keterangan' => 'required',
            ],
            $pesan
        );

        if ($request->hasFile('surat_keterangan') || $request->hasFile('identitas')) {
            $surat_keterangan = $request->file('surat_keterangan');
            $identitas = $request->file('identitas');

            $nama_surat_keterangan = time() . "_" . $surat_keterangan->getClientOriginalName();
            $nama_identitas = time() . "_" . $identitas->getClientOriginalName();

            $tujuan_upload = 'data_file';
            $surat_keterangan->move($tujuan_upload, $nama_surat_keterangan);
            $identitas->move($tujuan_upload, $nama_identitas);

            $syarat = \App\Models\SyaratPinjaman::find($id);
            $syarat->surat_keterangan = $nama_surat_keterangan;
            $syarat->identitas = $nama_identitas;
            $syarat->keterangan = $request->keterangan;
            $syarat->save();

            return back()->with('status', 'Data Berhasil Diubah');
        } else {
            $syarat = \App\Models\SyaratPinjaman::find($id);
            $syarat->keterangan = $request->keterangan;
            $syarat->save();

            return back()->with('status', 'Data Berhasil Diubah');
        }
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
