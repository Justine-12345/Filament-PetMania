<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $animals = Animal::where('is_healthy', '=', '1')
        ->where('adoption_status', '=', 'Unadopted')
        ->with('category');
        $categories = Category::all()->pluck('name', 'id');

        $queryArray = [];

        foreach ($request->input() as $key => $value) {
            if ($key != "_token") {
                if ($value != "") {
                    if ($key == "name") {
                        $queryArray[] = $key . " LIKE '%" . $value . "%' ";
                    } elseif ($key == "min_age" || $key == "max_age") {
                        $queryArray[] =  "age BETWEEN " . $request->input()['min_age'] . " AND " . $request->input()['max_age'];
                    } else {
                        $queryArray[] = $key . " = '" . $value . "'";
                    }
                }
            }
        }

        if (count($queryArray)  >= 1) {
            $querString = implode( " AND ", $queryArray);
            $animals->whereRaw($querString);
        }


        // $animals->whereRaw('age BETWEEN 1 and 6 AND category_id = "3" ');


        return view('animal.index', ['animals' => $animals->get(), 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animal = Animal::where('id', '=', $id)->with('category')->first();
        return view('animal.show', ['animal' => $animal]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $animal = Animal::where('id', '=', $id)->update($request->except(['_token','_method']));
        $animalFind = Animal::where('id', '=', $id)->first();
        $animalFind->adopters()->attach(Auth::user()->id);
        $animalFind->save();
        return redirect()->route('animal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
