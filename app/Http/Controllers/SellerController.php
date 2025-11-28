<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class SellerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::class::user();

        // dd($user->name);

        // Pastikan hanya role seller yang bisa akses
        if (!$user->isSeller()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah user ini sudah punya data toko?
        $store = Store::where('user_id', $user->id)->first();

        // Skenario 1: Belum punya toko sama sekali -> Arahkan ke Form Buat Toko
        if (!$store) {
            return view('seller.create-store');
        }

        // Skenario 2: Toko ada, tapi statusnya Pending atau Rejected
        // Kita tampilkan halaman status (bukan dashboard utama)
        if ($store->status === 'pending') {
            return view('seller.status-pending');
        }

        if ($store->status === 'rejected') {
            return view('seller.status-rejected');
        }

        // Skenario 3: Toko Approved -> Masuk Dashboard Utama Seller
        // Di sini nanti kita tampilkan ringkasan penjualan, jumlah produk, dll.
        return view('seller.dashboard', compact('store'));
    }

    // Fungsi untuk menyimpan Toko Baru (Skenario 1)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'about' => 'required|string',
            // Validasi file logo sederhana dulu
            'logo' => 'required|image|max:2048', 
            'city' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        // Upload Logo
        $logoPath = $request->file('logo')->store('store-logos', 'public');

        // Buat Data Toko
        Store::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'about' => $request->about,
            'logo' => $logoPath,
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'address_id' => '0', // Sementara hardcode atau sesuaikan kebutuhan
            'status' => 'pending', // Default pending
        ]);

        return redirect()->route('seller.dashboard');
    }
}