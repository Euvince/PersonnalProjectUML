<?php

namespace App\Http\Controllers\ServicePersonnal;

use Carbon\Carbon;
use App\Models\Service;
use App\Models\TypeService;
use Illuminate\Http\Request;
use App\Jobs\DemandeServiceJob;
use App\Jobs\EditDemandeServiceJob;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Jobs\AcceptDemandeServiceJob;
use App\Jobs\CancelDemandeServiceJob;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ServicePersonnal\DemandeServiceFormRequest;

class DemandeServiceController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Service::class, 'demande_service');
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('ServicePersonnal.DemandeService.demandes-services');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $demandeService = new Service();

        $demandeService->fill([
            'nom_client' => "AGOSSOU",
            'prenoms_client' => "Gilles",
            'email_client' => "gilles@gmail.com",
            'telephone_client' => "+229 65141420",
        ]);

       return view('ServicePersonnal.DemandeService.demande-service-form', [
            'demandeService' =>  $demandeService,
            'typesServices' => TypeService::all()->pluck('type', 'id'),
            'chambres' => Auth::user()->hotel->chambres->where('occupe', 1)/* ->sortBy('libelle') */->pluck('libelle', 'id'),
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeServiceFormRequest $request) : RedirectResponse
    {
        $service = Service::create(array_merge($request->validated(), [
            'user_id' => Auth::user()->id,
            'date_demande_service' => Carbon::now()
        ]));

        /* DemandeServiceJob::dispatch($service); */
        return
            redirect()
            ->route('service-personnal.demande-service.index')
            ->with('success', 'Votre demande de service a bien été crée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $demandeService) : View
    {
        return view('ServicePersonnal.DemandeService.demande-service', compact('demandeService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $demandeService) : View
    {
        return view('ServicePersonnal.DemandeService.demande-service-form', [
            'demandeService' => $demandeService,
            'typesServices' => TypeService::all()->pluck('type', 'id'),
            'chambres' => Auth::user()->hotel->chambres->where('occupe', 1)/* ->sortBy('libelle') */->pluck('libelle', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DemandeServiceFormRequest $request, Service $demandeService) : RedirectResponse
    {
        $demandeService->update($request->validated());
        EditDemandeServiceJob::dispatch($demandeService);
        return
            redirect()
            ->route('service-personnal.demande-service.index')
            ->with('success', 'La demande de service a été éditée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $demandeService) : RedirectResponse
    {
        $demandeService->delete();
        CancelDemandeServiceJob::dispatch($demandeService);
        return
            redirect()
            ->route('service-personnal.demande-service.index')
            ->with('success', 'La demande de service a été supprimée avec succès.');
    }

    public function confirmDemandeService(Service $demandeService) : RedirectResponse
    {
        $this->authorize('confirmDemandeService', $demandeService);
        if ($demandeService->isRendered()) {
            return
                redirect()
                ->route('service-personnal.demande-service.index')
                ->with('error', 'Le service est déjà marqué comme rendu.');
        }
        $demandeService->markAsRendered();
        AcceptDemandeServiceJob::dispatch($demandeService);
        return
            redirect()
            ->route('service-personnal.demande-service.index')
            ->with('success', 'Le service a été marqué comme rendu avec succès.');
    }

    public function cannotRenderedService(Service $demandeService) : RedirectResponse
    {
        $this->authorize('cannotRenderedService', $demandeService);
    }

}
