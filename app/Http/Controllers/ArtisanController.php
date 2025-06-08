<?php

namespace App\Http\Controllers;

use App\UseCase\ArtisanUseCase;
use App\Models\Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    public function index()
    {
        $artisans = ArtisanUseCase::getArtisansAll();
        return view('artisans.index', compact('artisans'));
    }

    public function create()
    {
        return view('artisans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:artisans',
        ]);

        Artisan::create([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

        return redirect()->route('artisans.index')->with('success', '職人が登録されました。');
    }

    public function show(Artisan $artisan)
    {
        return view('artisans.show', compact('artisan'));
    }

    public function edit(Artisan $artisan)
    {
        return view('artisans.edit', compact('artisan'));
    }

    public function update(Request $request, Artisan $artisan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:artisans,email,' . $artisan->id,
        ]);

        $artisan->update([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        return redirect()->route('artisans.index')->with('success', '職人情報が更新されました。');
    }

    public function destroy(Artisan $artisan)
    {
        $artisan->delete();
        return redirect()->route('artisans.index')->with('success', '職人が削除されました。');
    }
}
