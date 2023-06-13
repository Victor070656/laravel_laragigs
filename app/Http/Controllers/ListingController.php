<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //
    public function index()
    {
        // dd(request()->tag);
        return view('listings.index', ["listings" => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)]);
    }

    public function show($id)
    {
        return view('listings.show', ["listings" => Listing::findOrFail($id)]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formField = $request->validate([
            // 'title' => ['required', Rule::unique('listings', 'title')],
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        Listing::create($formField);

        return redirect('/')->with('message', 'Listing Created Successfully');
    }

    public function edit(Listing $listing)
    {
        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        // $listings = Listing::findOrFail($id);
        // dd($listings->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {

        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }

        $formField = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }



        $listing->update($formField);

        return back()->with('message', 'Listing Updated Successfully');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->user()->id) {
            abort(403, 'Unauthorized');
        }
        $listing->delete();

        return redirect('/')->with('message', 'Listing Deleted Successfully');
    }

    // manage posts
    public function manage()
    {
        // dd(auth()->user()->id);
        return view('listings.manage', ['listings' => auth()->user()->listing]);
    }
}
