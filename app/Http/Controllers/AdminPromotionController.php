<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPromotionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $promotions = Promotion::orderBy('created_at', 'desc')->paginate(20);
        return view('Frontend.dashboard.promotions.index', compact('promotions'));
    }

    public function create()
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        return view('Frontend.dashboard.promotions.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $rules = [
            'promotionCode' => 'required|string|max:50|unique:promotions,promotionCode',
            'discountType'  => 'required|in:percentage,fixed',
            'discountValue' => ['required', 'numeric', 'min:0'],
        ];

        if ($request->discountType === 'percentage') {
            $rules['discountValue'][] = 'max:100';
        }

        $validated = $request->validate($rules);

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion created successfully.');
    }

    public function edit(Promotion $promotion)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        return view('Frontend.dashboard.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $rules = [
            'promotionCode' => [
                'required', 'string', 'max:50',
                Rule::unique('promotions', 'promotionCode')->ignore($promotion->promotionID, 'promotionID'),
            ],
            'discountType'  => 'required|in:percentage,fixed',
            'discountValue' => ['required', 'numeric', 'min:0'],
        ];

        if ($request->discountType === 'percentage') {
            $rules['discountValue'][] = 'max:100';
        }

        $validated = $request->validate($rules);

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        if (!auth()->user()->admin) {
            abort(403);
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }
}
