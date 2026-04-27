<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:membership,pt',
            'price' => 'required|integer',
            'promo_price' => 'nullable|integer',
            'description' => 'required|string',
            'is_best_deal' => 'boolean',
            'badge_text' => 'nullable|string|max:50',
        ]);

        $data['is_best_deal'] = $request->has('is_best_deal');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui!');
    }
}
