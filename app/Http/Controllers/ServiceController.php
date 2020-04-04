<?php

namespace App\Http\Controllers;

use App\User;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $services = Service::all();

        return view('pages.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all();

        return view('pages.services.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validatedAttributes =  $this->validate($request, [
            'name'                =>  'required',
            'start_time'          =>  'nullable',
            'end_time'            =>  'nullable',
            'pastorial_assistant' =>  'required',
            'service_admin'       =>  'required'
        ]);

        $service = Service::create($validatedAttributes);

        if ($service->save()) {

            $request->session()->flash('success', ' ' .$service->name.' Service Successfully Added To Portal.');

            return redirect()->route('services.index');

        } else {

            return redirect()->back()->wthError()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Service $service
     * @return Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
