<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class BaseController extends Controller
{
    public function __construct(protected $service) {}


    public function index()
    {
        return $this->service->list();
    }


    public function show($id)
    {
        return $this->service->get($id);
    }


    public function store(Request $req)
    {
        return $this->service->store($req->all());
    }


    public function update(Request $req, $id)
    {
        return $this->service->update($id, $req->all());
    }


    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
