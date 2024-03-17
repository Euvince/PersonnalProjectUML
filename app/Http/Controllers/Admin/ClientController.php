<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index() : View
    {
        return view('Admin.Client.clients');
    }

    public function show(User $user) : View
    {
        $this->authorize('showClient', $user);
        return view('Admin.Client.client', compact('user'));
    }

    public function recruter(User $user) : RedirectResponse
    {
        $this->authorize('recruter', $user);
        $user->update([
            'hotel_id' => Auth::user()->hotel_id
        ]);
        return
            redirect()
            ->route('admin.clients.index')
            ->with('success', 'Le client a été recruté avec succès.');
    }

    public function licencier(User $user) : RedirectResponse
    {
        $this->authorize('licencier', $user);
        $user->update([
            'hotel_id' => null
        ]);
        $user->syncRoles(['Client']);
        $user->syncPermissions(['Réserver une Chambre', 'Demander un Service']);
        return
            redirect()
            ->route('admin.users.index')
            ->with('success', 'Le client a été licencié avec succès.');
    }

}
