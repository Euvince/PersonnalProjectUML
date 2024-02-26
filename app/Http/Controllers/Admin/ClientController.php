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

    public function recruter(User $user) : RedirectResponse
    {
        $user->update([
            'hotel_id' => Auth::user()->hotel_id
        ]);
        return
            redirect()
            ->route('admin.clients.index')
            ->with('success', 'Le Client a été recruté avec succès.');
    }

}