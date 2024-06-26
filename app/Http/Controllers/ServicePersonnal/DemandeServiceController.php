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
use App\Jobs\CannotRenderedServiceJob;
use App\Models\Chambre;

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
    public function create() : View | RedirectResponse
    {
        $demandeService = new Service();

        $demandeService->fill([
            'nom_client' => "AGOSSOU",
            'prenoms_client' => "Gilles",
            'email_client' => "gilles@gmail.com",
            'telephone_client' => "+229 65141420",
        ]);

        $auth_chambres = Auth::user()->hotel->chambres->where('occupe', 1)/* ->sortBy('libelle') */->pluck('libelle', 'id');
        if ($auth_chambres->isEmpty()) {
            return
                redirect()
                ->route('service-personnal.demande-service.index')
                ->with('error', 'Aucune chambre n\'est encore occupée pour que vous éffectuer cette action');
        }

       return view('ServicePersonnal.DemandeService.demande-service-form', [
            'demandeService' =>  $demandeService,
            'typesServices' => TypeService::all()->pluck('type', 'id'),
            'chambres' => $auth_chambres,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DemandeServiceFormRequest $request) : RedirectResponse
    {
        $reservation = Chambre::find($request->chambre_id)
            ->reservations
            ->where('confirme', 1)
            ->where('termine', 0)
        ->get();
        if ($reservation->nom_client !== $request->nom_client ||
            $reservation->email_client !== $request->email_client ||
            $reservation->prenoms_client !== $request-> prenoms_client ||
            $reservation->telephone_Client !== $request-> telephone_Client
        ) {
            return
                back()
                ->with('error', 'Revérifiez les informations du client occupant la chambre s\'il vous plaît.')
                ->withInput();
        }

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
        $reservation = Chambre::find($request->chambre_id)
            ->reservations
            ->where('confirme', 1)
            ->where('termine', 0)
        ->first();
        if ($reservation->nom_client !== $request->nom_client ||
            $reservation->email_client !== $request->email_client ||
            $reservation->prenoms_client !== $request-> prenoms_client ||
            $reservation->telephone_Client !== $request-> telephone_Client
        ) {
            return
                back()
                ->with('error', 'Revérifiez les informations du client occupant la chambre s\'il vous plaît.')
                ->withInput();
        }

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
        CannotRenderedServiceJob::dispatch($demandeService);
        return
            redirect()
            ->route('service-personnal.demande-service.index')
            ->with('success', 'Le client a bien été averti que le service ne pourra être rendu pour une raison.');
    }

}
