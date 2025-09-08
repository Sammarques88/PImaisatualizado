<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Exibe o formulário de edição de perfil.
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Atualiza as informações do perfil do usuário.
     */
    public function update(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Processa o upload da imagem de perfil
        if ($request->hasFile('profile_image')) {
            // Apaga a imagem antiga, se existir
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            // Salva a nova imagem e obtém o caminho
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $userData['profile_image'] = $path;
        }

        // Atualiza a senha se uma nova for fornecida
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
}