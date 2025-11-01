<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampañasController extends Controller
{
    //
    public function index()
    {
        return view('admin/campaña/viewCampaña');
        
    }

    public function create()
    {
        return view('admin/campaña/newCampaña');
    }

    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
