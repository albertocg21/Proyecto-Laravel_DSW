<?php
//mensaje para poder subir las cosas a la rama

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Http\Resources\ReservaResource;
use App\Models\Reserva;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        // Obtener todas las reservas paginadas (15 por página por defecto)
        $reservas = Reserva::paginate(15);

        return ReservaResource::collection($reservas);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param StoreReservaRequest $request
     * @return JsonResponse
     */
    public function store(StoreReservaRequest $request): JsonResponse
    {
        // Los datos ya están validados por el StoreReservaRequest
        $reserva = Reserva::create($request->validated());

        // Retornar el recurso creado con código 201 (Created)
        return (new ReservaResource($reserva))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return ReservaResource
     */
    public function show(string $id): ReservaResource
    {
        // findOrFail lanza automáticamente una excepción 404 si no encuentra la reserva
        $reserva = Reserva::findOrFail($id);

        return new ReservaResource($reserva);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateReservaRequest $request
     * @param string $id
     * @return ReservaResource
     */
    public function update(UpdateReservaRequest $request, string $id): ReservaResource
    {
        // Buscar la reserva o lanzar 404
        $reserva = Reserva::findOrFail($id);

        // Actualizar con los datos validados
        $reserva->update($request->validated());

        // Retornar el recurso actualizado
        return new ReservaResource($reserva);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        // Buscar la reserva o lanzar 404
        $reserva = Reserva::findOrFail($id);

        // Eliminar la reserva
        $reserva->delete();

        // Retornar 204 No Content (éxito sin cuerpo de respuesta)
        return response()->json(null, 204);
    }
}
