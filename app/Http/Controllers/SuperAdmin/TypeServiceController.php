<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SuperAdmin\TypeServiceFormRequest;
use App\Models\TypeService;

class TypeServiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TypeService::class, 'type_service');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('SuperAdmin.TypeService.types-services');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('SuperAdmin.TypeService.type-service-form', [
            'typeService' => new TypeService(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeServiceFormRequest $request) : RedirectResponse
    {
        TypeService::create($request->validated());
        return
            redirect()
            ->route('super-admin.type-service.index')
            ->with('success', 'Le Type de Service a été crée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeService $typeService) : View
    {
        return view('SuperAdmin.TypeService.type-service', compact('typeService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeService $typeService) : View
    {
        return view('SuperAdmin.TypeService.type-service-form', [
            'typeService' => $typeService,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeServiceFormRequest $request, TypeService $typeService) : RedirectResponse
    {
        $typeService->update($request->validated());
        return
            redirect()
            ->route('super-admin.type-service.index')
            ->with('success', 'Le Type de Service a été modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeService $typeService)
    {
        $typeService->delete();
        return
            redirect()
            ->route('super-admin.type-service.index')
            ->with('success', 'Le Type de Service a été supprimé avec succès.');
    }
}
