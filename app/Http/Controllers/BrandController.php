<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allBrand() {

        // Show Brand table on database to page
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function storeBrand(Request $request) {

        // Validate fill data
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:5',
            'brand_img' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Brand name must be fill',
            'brand_name.min' => 'Brand name must at least 5 characters'
        ]
        );

        // To request the file data
        $brand_img = $request->file('brand_img');
        
        /** 
        *
        * To Insert image without intervention
        *
        */
        // $name_gen = hexdec(uniqid()); //214321421421421421
        // $img_ext = strtolower($brand_img->getClientOriginalExtension()); // jpg,png,jpeg
        // $img_name = $name_gen.'.'.$img_ext; //21312321321.jpg
        // $up_location = 'images/brand/'; // To navigate the location file
        // $last_img = $up_location.$img_name; // To get the image from the location
        // $brand_img->move($up_location,$img_name); // To move file img to the location

        $name_gen = hexdec(uniqid()).'.'.$brand_img->getClientOriginalExtension(); //2143214214214.jpg
        $image = Image::make($brand_img)->resize(300,200); // To resize Image
        $image->save('images/brand/'.$name_gen); // To save pict to the location

        $last_img = 'images/brand/'.$name_gen;

        // Save data to database (table's Brands)
        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_img = $last_img;
        $brand->save();

        $notification = array(
            'message' => 'Brand inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    }

    public function updateBrand($id) {
        $brands = Brand::find($id);
        return view('admin.brand.update', compact('brands'));
    }

    public function editBrand(Request $request, $id) {

        $validated = $request->validate([
            'brand_name' => 'required|min:5',
            'brand_img' => 'mimes:jpg,jpeg,png'
        ],
        [
            'brand_name.required' => 'Brand name must be fill',
            'brand_name.min' => 'Brand name must be fill at least 5 characters'
        ]
        );

        // Old image link
        $old_img = $request->old_brand_img;
        // To request the file data
        $brand_img = $request->file('brand_img');

        if($brand_img) {
            // Without Intervetion
            // $name_gen = hexdec(uniqid()); //214321421421421421
            // $img_ext = strtolower($brand_img->getClientOriginalExtension()); // jpg,png,jpeg
            // $img_name = $name_gen.'.'.$img_ext; //21312321321.jpg
            // $up_location = 'images/brand/'; // To navigate the location file
            // $last_img = $up_location.$img_name; // To get the image from the location
            // $brand_img->move($up_location,$img_name); // To move file img to the location

            $name_gen = hexdec(uniqid()).'.'.$brand_img->getClientOriginalExtension(); //2143214214214.jpg
            $image = Image::make($brand_img)->resize(300,200); // To resize Image
            $image->save('images/brand/'.$name_gen); // To save pict to the location

            $last_img = 'images/brand/'.$name_gen;

            unlink($old_img);
            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_img' => $last_img
            ]);
            
            return redirect()->route('all.brands')->with('success', 'Brand updated successfully');
        }else {
            $brands = Brand::find($id)->update([
                'brand_name' => $request->brand_name,
            ]);

            return redirect()->route('all.brands')->with('success', 'Brand updated successfully');
        }
    }

    public function deleteBrand($id) {
        $image = Brand::find($id);
        $old_img = $image->brand_img;

        unlink($old_img);
        $brand = Brand::find($id)->delete();
        
        return redirect()->back()->with('success','Brand deleted successfully');
    }

    // For Multi Pictures
    public function multiPic() {

        $images = Multipic::all();
        return view('admin.multiPic.index', compact('images'));
    }

    public function storePic(Request $request) {
        $image = $request->file('image');

        foreach ($image as $multi_image) {

            $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension(); //2143214214214.jpg
            $images = Image::make($multi_image)->resize(300,300); // To resize Image
            $images->save('images/multi/'.$name_gen); // To save pict to the location
            
            $last_img = 'images/multi/'.$name_gen;
            
            // Save data to database (table's Multipic)
            $multiImg = new Multipic;
            $multiImg->image = $last_img;
            $multiImg->save();
        }

        return redirect()->back()->with('success', 'Images inserted successfully');
    }
}
