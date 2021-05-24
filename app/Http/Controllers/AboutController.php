<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homeAbout() {

        $abouts = About::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function addAbout() {

        return view('admin.about.create');
    }

    public function createAbout(Request $request) {

        $validated = $request->validate([
            'title' => 'required|min:5',
            'short_desc' => 'required|max:50',
            'long_desc' => 'required'
        ]
        );

        $about = new About();
        $about->title = $request->title;
        $about->short_desc = $request->short_desc;
        $about->long_desc = $request->long_desc;
        $about->save();

        return redirect()->route('home.about')->with('success', 'About inserted successfully');
    }

    public function updateAbout($id) {
        $about = About::find($id);
        return view('admin.about.update', compact('about'));
    }

    public function editAbout(Request $request, $id) {

        $validated = $request->validate([
            'title' => 'required|min:5',
            'short_desc' => 'required|max:50',
            'long_desc' => 'required',
        ],
        );

        $about = About::find($id)->update([
            'title' => $request->title,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc
        ]);

        return redirect()->route('home.about')->with('success', 'About updated successfully');

    }
    
    public function deleteAbout($id) {
        
        $about = About::find($id)->delete();

        return redirect()->route('home.about')->with('success','About deleted successfully');
    }
}
