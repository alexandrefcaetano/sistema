<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ted\ComplementoStoreRequest;
use App\Http\Requests\Ted\ComplementoUpdateRequest;
use App\Services\TedService;

class TedController extends Controller
{
    public function __construct(private TedService $service) {}

    public function index()
    {
        return $this->service->list();
    }

    public function show(int $id)
    {
        return $this->service->get($id);
    }

    public function store(ComplementoStoreRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function update(ComplementoUpdateRequest $request, int $id)
    {
        return $this->service->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
