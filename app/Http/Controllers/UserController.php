<?php

namespace App\Http\Controllers;

use App\UseCase\UserUseCase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = UserUseCase::getUsersAll();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        User::validateIsUniqueEmail($request->email);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'ユーザーが登録されました。');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        User::validateIsUniqueEmail($request->email, $user->id);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'ユーザー情報が更新されました。');
    }

    public function destroy(User $user)
    {
        if (User::count() <= 1) {
            return redirect()->route('users.index')->with('error', '最後のユーザーは削除できません。');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'ユーザーが削除されました。');
    }
}
