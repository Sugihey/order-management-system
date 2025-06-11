<?php

namespace App\Http\Controllers;

use App\UseCase\ArtisanUseCase;
use App\Models\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ArtisanStoreRequest;
use App\Http\Requests\ArtisanUpdateRequest;
use Illuminate\Support\Str;

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

    public function store(ArtisanStoreRequest $request)
    {
        Artisan::validateIsUniqueEmail($request->email);
        $autoGenPassword = Str::random(10);
        Artisan::createOrRecover([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($autoGenPassword),
        ]);
        info('NewArtisan', ['name' => $request->name,'email'=>$request->email,'password'=>$autoGenPassword]);

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

    public function update(ArtisanUpdateRequest $request, Artisan $artisan)
    {
        Artisan::validateIsUniqueEmail($request->email, $artisan->id);
        $updateData = [
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        $artisan->update($updateData);

        return redirect()->route('artisans.index')->with('success', '職人情報が更新されました。');
    }

    public function destroy(Artisan $artisan)
    {
        $artisan->delete();
        return redirect()->route('artisans.index')->with('success', '職人が削除されました。');
    }
}
