<?php

use App\Http\Requests\ValoTed\ValorTedStoreRequest;
use App\Http\Requests\ValoTed\ValorTedUpdateRequest;
use App\Services\ValorTedService;

class ValorTedController extends Controller
{
    public function __construct(private ValorTedService $service) {}

    public function index()
    {
        return $this->service->list();
    }

    public function show(int $id)
    {
        return $this->service->get($id);
    }

    public function store(ValorTedStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(ValorTedUpdateRequest $request, int $id)
    {
        return $this->service->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
