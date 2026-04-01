<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Week;

class WeekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return week::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'min_hrs' => 'required|integer|min:0',
            'max_hrs' => 'required|integer|gte:min_hrs',
            //'total_assigned_hrs' => 'required|integer|min:0'
        ]);

        $week = Week::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'min_hrs' => $request->min_hrs,
            'max_hrs' => $request->max_hrs,
            //'total_assigned_hrs' => $request->total_assigned_hrs,
        ]);

        return response()->json($week);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $week = Week::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $week,
            'message' => 'semaine retrouvée avec succès'
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $week = Week::FindOrFail($id);

        $validate = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'min_hrs' => 'sometimes|integer|min:0',
            'max_hrs' => 'sometimes|integer|gte:min_hrs',
            //'total_assigned_hrs' => 'sometimes|integer|min:0'
        ]);

        $week->update($validate);

        return response()->json([
            'status' => true,
            'data' => $week,
            'message' => 'semaine crée avec succès'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $week = Week::findOrFail($id);
        $week->delete();
        return response()->json([
            'message' => 'week delete succesfully'
        ], 200);
    }
}
