<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;
use Prophecy\Call\Call;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCat() {

        // JOIN DATA With QueryBuilder
        // $categories = DB::table('categories')
        //             ->join('users', 'categories.user_id', 'users.id')
        //             ->select('categories.*', 'users.name')
        //             ->latest()->paginate(5);
        // To Call Read Data From latest with paginate 5
        $categories = Category::latest()->paginate(5);
        $softDeleteCategory = Category::onlyTrashed()->latest()->paginate(3);
        // Same Like Read Data but with QueryBuilder
        // $categories = db::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'softDeleteCategory'));
    }

    public function addCat(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Category must be fill'
        ]
        );
    
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category inserted successfully');
    }

    public function updateCat($id) {

        $categories = Category::find($id); // ORM
        // $categories = DB::table('categories')->where('id', $id)->first(); // DB
        return view('admin.category.update', compact('categories'));
    }

    public function editCat(Request $request, $id) {

        $validated = $request->validate([
            'category_name' => 'required|max:255',
        ],
        [
            'category_name.required' => 'Category must be fill'
        ]
        );

        // ORM
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);
        // DB
        // $updateData = array();
        // $updateData['category_name'] = $request->category_name;
        // $updateData['user_id'] = Auth::user()->id;
        // DB::table('categories')->where('id',$id)->update($updateData);

        return redirect()->route('all.category')->with('success', 'Category updated successfully');
    }

    public function deleteCat($id) {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function restoreCat($id) {
        $restoreData = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category has been restored');
    }

    public function deletePermanentCat($id) {
        $deletePermanent = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category permanently Deleted');
    }
}
