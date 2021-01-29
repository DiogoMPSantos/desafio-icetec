<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::with('skills')->get()->toArray();
        return $candidates;
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
        $candidate = new Candidate([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'old' => $request->input('old'),
            'url' => $request->input('url'),
        ]);
        $candidate->save();
        $canditate_id = $candidate->id;
        foreach ($request->input('skills') as $key => $skill) {
            $skills = new Skill([
                'name' => $skill,
                'candidate_id' => $canditate_id
            ]);
            $skills->save();
        }

        return response()->json('The candidate successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return response()->json($candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::find($id);
        $candidate->update($request->except('skills'));
        $canditate_id = $candidate->id;
        Skill::where('candidate_id',$canditate_id)->delete();
        foreach ($request->input('skills') as $key => $skill) {
            $skills = new Skill([
                'name' => $skill,
                'candidate_id' => $canditate_id
            ]);
            $skills->save();
        }

        return response()->json('The candidate successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        $candidate->delete();

        return response()->json('The candidate successfully deleted');
    }
}
