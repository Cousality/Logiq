<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('userID', auth()->user()->userID)->get();

        return view('Frontend.dashboard.your_address', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipientFirstName' => 'required|string|max:100',
            'recipientLastName'  => 'required|string|max:100',
            'phone'              => 'required|string|max:20',
            'addressLine1'       => 'required|string|max:255',
            'addressLine2'       => 'nullable|string|max:255',
            'city'               => 'required|string|max:100',
            'postCode'           => 'required|string|max:20',
        ]);

        $isFirst = !Address::where('userID', auth()->user()->userID)->exists();

        Address::create([
            'userID'             => auth()->user()->userID,
            'recipientFirstName' => $request->recipientFirstName,
            'recipientLastName'  => $request->recipientLastName,
            'phone'              => $request->phone,
            'addressLine1'       => $request->addressLine1,
            'addressLine2'       => $request->addressLine2,
            'city'               => $request->city,
            'postCode'           => $request->postCode,
            'isDefault'          => $isFirst,
        ]);

        return redirect()->route('yourAddress')->with('success', 'Address saved successfully.');
    }

    public function update(Request $request, Address $address)
    {
        if ($address->userID !== auth()->user()->userID) {
            abort(403);
        }

        $request->validate([
            'recipientFirstName' => 'required|string|max:100',
            'recipientLastName'  => 'required|string|max:100',
            'phone'              => 'required|string|max:20',
            'addressLine1'       => 'required|string|max:255',
            'addressLine2'       => 'nullable|string|max:255',
            'city'               => 'required|string|max:100',
            'postCode'           => 'required|string|max:20',
        ]);

        $address->update([
            'recipientFirstName' => $request->recipientFirstName,
            'recipientLastName'  => $request->recipientLastName,
            'phone'              => $request->phone,
            'addressLine1'       => $request->addressLine1,
            'addressLine2'       => $request->addressLine2,
            'city'               => $request->city,
            'postCode'           => $request->postCode,
        ]);

        return redirect()->route('yourAddress')->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        if ($address->userID !== auth()->user()->userID) {
            abort(403);
        }

        $address->delete();

        return redirect()->route('yourAddress')->with('success', 'Address deleted successfully.');
    }
}
