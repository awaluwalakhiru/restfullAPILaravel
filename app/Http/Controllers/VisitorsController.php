<?php

namespace App\Http\Controllers;

use App\Http\Resources\Visitors as VisitorsResources;
use App\Visitor;
use Illuminate\Http\Request;

class VisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::orderBy('created_at', 'desc')->paginate(10);

        return VisitorsResources::collection($visitors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->email = $request->input('email');
        $visitor->address = $request->input('address');

        if ($visitor->save()) {
            return new VisitorsResources($visitor);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);

        return new VisitorsResources($visitor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $visitor = Visitor::findOrFail($request->id);
        $visitor->name = $request->input('name');
        $visitor->email = $request->input('email');
        $visitor->address = $request->input('address');

        if ($visitor->save()) {
            return new VisitorsResources($visitor);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);

        if ($visitor->delete()) {
            return new VisitorsResources($visitor);
        }
    }
}
