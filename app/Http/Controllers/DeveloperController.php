<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {

        $developers = Developer::where('approved',true)
            ->latest()
            ->get();


        return view(
            'developers.index',
            compact('developers')
        );

    }

    public function create()
    {

        return view('developers.create');

    }

    public function store(Request $request)
    {


        $data = $request->validate([

            'name'=>'required|string|max:255',

            'role'=>'required|string|max:255',

            'github'=>'nullable|url',

            'linkedin'=>'nullable|url',

            'website'=>'nullable|url',

            'bio'=>'nullable|string',

            'avatar'=>'nullable|image|max:2048',

        ]);





        if($request->hasFile('avatar')){


            $data['avatar'] = $request
                ->file('avatar')
                ->store('developers','public');

        }





        $data['user_id'] = auth()->id();

        Developer::create($data);




        return redirect()
            ->route('developers.index')
            ->with(
                'success',
                'Developer profile submitted!'
            );


    }

    public function show($id)
    {


        $developer = Developer::findOrFail($id);


        return view(
            'developers.show',
            compact('developer')
        );


    }

    public function join()
    {

        return redirect()->route('developers.create');

    }
}
