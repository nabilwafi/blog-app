<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homeSlider() {

        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function addSlider() {

        return view('admin.slider.create');
    }

    public function createSlider(Request $request) {

        $validated = $request->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ],
        [
            'title.required' => 'Title name must be fill',
            'title.min' => 'Title name must be fill at least 5 characters'
        ]
        );

        $slider_img = $request->file('image');
        

        $name_gen = hexdec(uniqid()).'.'.$slider_img->getClientOriginalExtension();
        $image = Image::make($slider_img)->resize(1908,1088);
        $image->save('images/slider/'.$name_gen);

        $loc_img = 'images/slider/'.$name_gen;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $loc_img;
        $slider->save();

        return redirect()->route('home.slider')->with('success', 'Slider inserted successfully');
    }


    public function updateSlider($id) {

        $sliders = Slider::find($id);
        return view('admin.slider.update', compact('sliders'));
    }

    public function editSlider(Request $request, $id) {

        $validated = $request->validate([
            'title' => 'required|min:5',
            'image' => 'mimes:jpg,jpeg,png'
        ],
        [
            'title.required' => 'Title slider must be fill',
            'title.min' => 'Title slider must be fill at least 5 characters'
        ]
        );

        $old_image = $request->old_slider_img;

        $image = $request->file('image');

        if($image) {

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension(); //2143214214214.jpg
            $image = Image::make($image)->resize(1908,1088); // To resize Image
            $image->save('images/slider/'.$name_gen); // To save pict to the location

            $last_img = 'images/slider/'.$name_gen;

            unlink($old_image);

            $slider = Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img
            ]);

            return redirect()->route('home.slider')->with('success', 'Slider updated successfully');
        }else {
            $slider = Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);

            return redirect()->route('home.slider')->with('success', 'Slider updated successfully');
        }

    }

    public function deleteSlider($id) {
        $slider_image = Slider::find($id);
        $old_image = $slider_image->image;

        unlink($old_image);
        $slider = Slider::find($id)->delete();

        return redirect()->route('home.slider')->with('success','Slider deleted successfully');
    }

    public function portfolio() {
        
        $images = Multipic::all();
        return view('layouts.pages.portfolio', compact('images'));
    }
}
