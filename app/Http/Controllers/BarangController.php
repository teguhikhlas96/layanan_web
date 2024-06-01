<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BarangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    // Menampilkan daftar barang
    public function index()
    {
         // Mengambil data barang dari API eksternal
         $response = Http::get('http://localhost:8001/api/barangs');

         if ($response->successful()) {
             $barangs = $response->json();
             return view('barangs.index', compact('barangs'));
         } else {
             return view('barangs.index')->with('error', 'Gagal mengambil data barang dari API.');
         }
    }

    // Menampilkan form untuk membuat barang baru
    public function create()
    {
        return view('barangs.create');
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {   
        // Mendapatkan token dari session
        $token = session('api_token');
        
        // Kirim permintaan ke API untuk menyimpan barang baru
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:8001/api/barangs', [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            // Alihkan ke halaman index jika berhasil
            return redirect()->route('barangs.index');
        } else {
            dd('error');
            // Kembalikan dengan pesan error jika gagal
            return back()->withErrors([
                'error' => 'Gagal menyimpan barang. Silakan coba lagi.',
            ]);
        }
    }

    // Menampilkan detail barang
    public function show($id)
    {
        // Mengambil data barang dari API eksternal
        $response = Http::get('http://localhost:8001/api/barangs/'.$id);
        if ($response->successful()) {
            $barang = $response->json();
            return view('barangs.show', compact('barang'));
        } else {
            return view('barangs.show')->with('error', 'Gagal mengambil data barang dari API.');
        }
   
    }

    // Menampilkan form untuk mengedit barang
    public function edit($id)
    {
        // $barang = Barang::findOrFail($id);
        return view('barangs.edit', compact('barang'));
    }

    // Mengupdate barang
    public function update(Request $request, $id)
    {
        // Validasi request dan update barang
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        // Barang::whereId($id)->update($validated);
        return redirect()->route('barangs.index');
    }

    // Menghapus barang
    public function destroy($id)
{
    // Mendapatkan token dari session
    $token = session('api_token');

    // Kirim permintaan ke API untuk menghapus barang
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->delete('http://localhost:8001/api/barangs/' . $id);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Alihkan ke halaman index jika berhasil
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    } else {
        // Ambil pesan error dari respons API jika ada
        $error_message = $response->json()['error'] ?? 'Gagal menghapus barang. Silakan coba lagi.';

        // Kembalikan dengan pesan error
        return redirect()->route('barangs.index')->withErrors([
            'error' => $error_message,
        ]);
    }
}
}
