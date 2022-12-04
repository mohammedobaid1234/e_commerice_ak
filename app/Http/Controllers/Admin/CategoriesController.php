<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\TypeOfVendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class CategoriesController extends Controller{

    public function manage(Request $request){
        $data['activePage'] = ['categories' => 'categories'];
        $data['breadcrumb'] = [
            ['title' => 'Categories'],
        ];
        $data['addRecord'] = ['href' => route('categories.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data  = Category::with(['type_of_vendor'])->orderBy('id', 'asc')->get();
            return Datatables::of($data)
            ->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('image',function($row){
                return '<a href="'.$row->image_url.'" target="_blank"><img src="'.$row->image_url.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
            })
            ->escapeColumns([])
            ->addColumn('index', function($row){
                $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
                return $btn;
            })
            ->addColumn('action', function ($item) {
                $btn = '';
                $btn .= '<a data-id='. $item->id. ' class="btn btn-sm btn-clean btn-icon edit_item_btn" > <i class="la la-edit"></i></a>';
                $btn .= '<a data-action="destroy" data-id='. $item->id. 'class="btn btn-xs red tooltips" ><i class="fa fa-times" aria-hidden="true"></a>';
                return $btn;
            })->rawColumns(['action','index'])
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && $request->get('name') != null) {
                    $query->where('name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('created_at') && $request->get('created_at') != null) {
                   $query->WhereCreatedAt($request->get('created_at')); 
                }
            })
            ->make(true);
        }
        return view('admin.categories.manage', [
            'data' => $data
        ]);
    }
    public function show($id){
        $category = Category::whereId($id)->first();
        $images_new  = collect([]);
        $new['url'] =  $category->image_url;
        $new['name'] = $category->image;
        $images_new->push($new);
        return response()->json($images_new,200);
    }
    public function create(){
        $data['activePage'] = ['categories' => 'categories'];
        $data['breadcrumb'] = [
            ['title' => "categories Management"],
            ['title' => "categories"],
            ['title' => 'Add Category'],
        ];
        // return  view('admin.categories.create')->with(['data'=>$data, 'categories'=> Category::get(), 'languages' => Language::get()]);
        $html= view('admin.categories.create')->with(['data'=>$data, 'type_of_vendors' => TypeOfVendor::get(), 'users' => User::where('type', 2)->get()])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK', 'html'=>$html ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',        
            'type_of_vendor' => 'required',        
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'message' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $item= new Category();
        $item->name = $request->name;
        $item->vendor_type = $request->type_of_vendor;
        $item->save();
        $message = __('ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'data' => $item]);
    }
    public function edit($id){
        $data['activePage'] = ['categories' => 'categories'];
        $data['breadcrumb'] = [
            ['title' => "categories Management"],
            ['title' => "categories"],
            ['title' => 'Edit category'],
        ];
        $item = Category::whereId($id)->first();
        $html= view('admin.categories.edit')->with(['data'=>$data, 'item' => $item, 'type_of_vendors' => TypeOfVendor::get()])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK','item' =>$item ,'html'=>$html ]);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',        
            'type_of_vendor' => 'required',        
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'message' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $item=  Category::whereId($id)->first();
        $item->name = $request->name;
        $item->vendor_type = $request->type_of_vendor;
        $item->save();
        $message = __('ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'data' => $item]);
    }

    public function addImage(Request $request){
        $id = $request->userId;
        $category = Category::whereId($id)->first();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $category->image !== null ?Storage::disk('public')->delete($category->image): '';
            $uploadedFile = $request->file('file');
            $image = $uploadedFile->store('/', 'public');
            $category->image = $image;
            $category->save();
            return response()->json(['message' => 'ok']);
        }
    }

    public function removeImage(Request $request, $id){
        $category = Category::where('image',$id)->first();
        $category->image !== null ?Storage::disk('public')->delete($category->image): '';
        $category->image = null;
        $category->save();
        return response()->json(['message' => 'ok']);
    }

    public function destroy($id){
        $item = Category::whereId($id)->delete();
        return response()->json(['message' => 'ok'],200);
    }

}
