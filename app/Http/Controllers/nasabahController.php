<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class nasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nasabah = DB::table("nasabahs")->where("users_id", Auth::user()->id)->get();
        return view('content.nasabah.index', ['nasabah' => $nasabah]);
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
                'nama' => 'required',
                'jk' => 'required',
                'nohp' => 'required',
                'norek' => 'required',
                'alamat' => 'required'

            ],
            $pesan
        );

        Nasabah::create(
            [
                'nama' => request('nama'),
                'jk' => request('jk'),
                'alamat' => request('alamat'),
                'no_telp' => request('nohp'),
                'no_rekening' => request('norek'),
                'users_id' => Auth::user()->id,
                'saldo' => '0'


            ]
        );

        return redirect('/data-nasabah')->with('success', 'Berhasil Registrasi');
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
        $nasabah = DB::table("nasabahs")
            ->where("id", $id)
            ->first();
        return view('content.nasabah.editNasabah', ['nasabah' => $nasabah]);
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

        ];

        $this->validate(
            request(),
            [
                'nama' => 'required',
                'jk' => 'required',
                'nohp' => 'required',
                'norek' => 'required',
                'alamat' => 'required'

            ],
            $pesan
        );

        Nasabah::where('id', $id)->update(
            [
                'nama' => request('nama'),
                'jk' => request('jk'),
                'alamat' => request('alamat'),
                'no_telp' => request('nohp'),
                'no_rekening' => request('norek'),
                'users_id' => Auth::user()->id,
                'saldo' => request('saldo')
                

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
        $file = Nasabah::findOrFail($id);
        $file_path = public_path('data_file/' . $file->file_pdf);
        File::delete($file_path);
        $file->delete();

        return back()->with(['success' => 'Data Berhasil Di Hapus']);
    }
}
