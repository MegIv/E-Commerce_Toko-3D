<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Halaman Dashboard Admin / Verifikasi Toko
    public function index()
    {
        // Pastikan hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Ambil semua toko yang statusnya 'pending'
        $pendingStores = Store::where('status', 'pending')->with('user')->get();

        return view('admin.verify-stores', compact('pendingStores'));
    }

    // Logika Menyetujui Toko
    public function approve(Store $store)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $store->update([
            'status' => 'approved',
            'is_verified' => true // Opsional: jika masih pakai kolom lama untuk kompatibilitas
        ]);

        return redirect()->back()->with('success', 'Store has been approved successfully!');
    }

    // Logika Menolak Toko
    public function reject(Store $store)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $store->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Store has been rejected.');
    }
}