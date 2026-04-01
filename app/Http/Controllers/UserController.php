<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return user::all();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'utilisateur retrouvé avec succès'
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
        $user = User::FindOrFail($id);

        $validate = $request->validate([
        'employe_number' => 'sometimes|string|max:150',
        'password' => 'sometimes|min:4'
        ]);

        // hash password si envoyé
        if (isset($validate['password'])) {
            $validate['password'] = bcrypt($validate['password']);
        }

        $user->update($validate);

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'utilisateur retrouvé avec succès'
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
        //$user = User::findOrFail($id);
        $user = User::find($id);
        if(!$user){
            return response()->json([
                'message'=> 'user not found'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'message' => 'user delete succesfully'
        ], 200);
    }
}
