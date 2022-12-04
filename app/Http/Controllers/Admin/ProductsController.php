<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ProductsController extends Controller{
    public function __construct(){
        $this->middleware(['auth']);
    } 

    public function manage(Request $request){
        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => 'products'],
        ];
        $data['addRecord'] = ['href' => route('products.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data  = Product::with(['category', 'user'])->orderBy('id', 'asc')->get();

            return Datatables::of($data)
            ->editColumn('flag',function($row){
                $btn  = '';
                $row->flag == 1 ? $btn = 'Price' : $btn = 'Price After Discount'; 
                return $btn;
            })->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })->editColumn('image',function($row){
                return '<a href="'.$row->image_url.'" target="_blank"><img src="'.$row->image_url.'" width="50px" height="50px" style="border-radius: 10% !important;"></a>';
            })->escapeColumns([])
            ->addColumn('index', function($row){
                $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
                return $btn;
            })
            ->addColumn('action', function ($user) {
                $btn = '';
                $btn .= '<a data-id='. $user->id. ' class="btn btn-sm btn-clean btn-icon edit_item_btn" > <i class="la la-edit"></i></a>';
                $btn .= '<a data-action="destroy" data-id='. $user->id. 'class="btn btn-xs red tooltips" ><i class="fa fa-times" aria-hidden="true"></a>';
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
        return view('admin.products.manage', [
            'data' => $data
        ]);
    }

    public function create(){
        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => "Products Management"],
            ['title' => "Products"],
            ['title' => 'Add Product'],
        ];
       
        $html= view('admin.products.create')->with(['data'=>$data, 'products'=> Product::get(),'categories' => Category::get(), 'users' => User::where('type', 2)->get()])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK', 'html'=>$html ]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'price_after_discount' => 'required',
            'flag' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'validator' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
       $item  = new Product;
       $item->name = $request->name;
       $item->description = $request->description;
       $item->category_id = $request->category_id;
       $item->user_id = $request->user_id;
       $item->price = $request->price;
       $item->price_after_discount = $request->price_after_discount;
       $item->flag = $request->flag;
       $item->save();
        return response()->json([
            'message' => 'ok',
            'data' => $item
        ]);
    }
    public function edit($id){
        $data['activePage'] = ['products' => 'products'];
        $data['breadcrumb'] = [
            ['title' => "Products Management"],
            ['title' => "Products"],
            ['title' => 'Edit Product'],
        ];
        $product = Product::whereId($id)->first();
        $html= view('admin.products.edit')->with(['data'=>$data,'item' =>$product, 'categories' => Category::get(), 'users' => User::where('type', 2)->get()])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK', 'item' =>$product,'html'=>$html ]);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'price' => 'required',
            'price_after_discount' => 'required',
            'flag' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'validator' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $item = Product::whereId($id)->first();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category_id;
        $item->user_id = $request->user_id;
        $item->price = $request->price;
        $item->price_after_discount = $request->price_after_discount;
        $item->flag = $request->flag;
        $item->save();
        return response()->json([
            'message' => 'ok',
            'data' => $item
        ]);
    }
    public function show($id){
        $item = PRoduct::whereId($id)->first();
        $images_new  = collect([]);
        $new['url'] =  $item->image_url;
        $new['name'] = $item->image;
        $images_new->push($new);
        return response()->json($images_new,200);
    }

    public function addImage(Request $request){
        $id = $request->userId;
        $item = Product::whereId($id)->first();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $item->image !== null ?Storage::disk('public')->delete($item->image): '';
            $uploadedFile = $request->file('file');
            $image = $uploadedFile->store('/', 'public');
            $item->image = $image;
            $item->save();
            return response()->json(['message' => 'ok']);
        }
    }

  

}
