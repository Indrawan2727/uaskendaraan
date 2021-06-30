<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KendaraanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $kendaraans = Kendaraan::latest()->paginate(10);
        return view('kendaraan.index', compact('kendaraans'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nopol'     => 'required',
            'merk'     => 'required',
            'tipe'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/kendaraans', $image->hashName());

        $kendaraan = Kendaraan::create([
            'nopol'     => $request->nopol,
            'merk'     => $request->merk,
            'tipe'   => $request->tipe,
            'image'     => $image->hashName()
        ]);

        if($kendaraan){
            //redirect dengan pesan sukses
            return redirect()->route('kendaraan.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kendaraan.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

        /**
     * edit
     *
     * @param  mixed $kendaraan
     * @return void
     */
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

        /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $kendaraan
     * @return void
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $this->validate($request, [
            'nopol'  => 'required',
            'merk'   => 'required',
            'tipe'   => 'required'
        ]);

        //mengambil data kendaraain by id
        $kendaraan = Kendaraan::findOrFail($kendaraan->id);

        if($request->file('image') == "") {

            $kendaraan->update([
                'nopol'     => $request->nopol,
                'merk'   => $request->merk,
                'tipe'   => $request->tipe
            ]);

        } else {

            //hapus gambar lama
            Storage::disk('local')->delete('public/kendaraans/'.$kendaraan->image);

            //upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/kendaraans', $image->hashName());

            $kendaraan->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);

        }

        if($kendaraan){
            //redirect dengan pesan sukses
            return redirect()->route('kendaraan.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kendaraan.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

        /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
    $kendaraan = Kendaraan::findOrFail($id);
        Storage::disk('local')->delete('public/kendaraans/'.$kendaraan->image);
        $kendaraan->delete();

        if($kendaraan){
            //redirect dengan pesan sukses
            return redirect()->route('kendaraan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('kendaraan.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    public function cetak_pdf()
    {
    	$kendaraan = Kendaraan::all();
 
    	$pdf = PDF::loadview('kendaraan_pdf',['kendaraan'=>$kendaraan]);
    	return $pdf->download('laporan-kendaraan-pdf');
    }
}
