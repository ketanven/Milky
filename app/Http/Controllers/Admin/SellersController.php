<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellersController extends Controller
{
    public function index()
    {
        $sellers = Seller::orderBy('created_at', 'desc')->paginate(15);
        return view('Admin.sellers.index', compact('sellers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|confirmed|min:6',
            'store_name' => 'required|string|max:255',
            'shop_address' => 'nullable|string',
            'gst_number' => 'nullable|string|max:30',
            'pan_number' => 'nullable|string|max:30',
            'phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Seller::create($data);

        return redirect()->back()->with('success', 'Seller added successfully.');
    }

    public function update(Request $request, Seller $seller)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:sellers,email,{$seller->id}",
            'password' => 'nullable|confirmed|min:6',
            'store_name' => 'required|string|max:255',
            'shop_address' => 'nullable|string',
            'gst_number' => 'nullable|string|max:30',
            'pan_number' => 'nullable|string|max:30',
            'phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $seller->update($data);

        return redirect()->back()->with('success', 'Seller updated successfully.');
    }

    public function destroy(Seller $seller)
    {
        $seller->delete();
        return redirect()->back()->with('success', 'Seller deleted successfully.');
    }

    public function toggleStatus(Seller $seller)
    {
        $seller->is_active = !$seller->is_active;
        $seller->save();

        return redirect()->back()->with('success', 'Seller status updated successfully.');
    }
}
