<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class ProductsTransactionController extends Controller{
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'message' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $product = Product::whereId($request->product_id)->first();
        if(!$product){
            return response()->json(['status' => false, 'code' => 200,'message' =>'This Product Not Found' ],403);
        }
        $item  = new ProductTransaction();
        $item->product_id = $request->product_id;
        $item->quantity = $request->quantity ?? 1;
        $item->price = $product->price;
        $item->status ='bought';
        $item->total = $product->price * ($request->quantity ?? 1);
        $item->save();
        return response()->json(['status' => true, 'code' => 200,'message' =>'Thank You For Buy' ]);

    }

    public function manage(Request $request){
        $data['activePage'] = ['product_transaction' => 'product_transaction'];
        $data['breadcrumb'] = [
            ['title' => 'product_transaction'],
        ];
        if ($request->ajax()) {
            $data  = ProductTransaction::with(['product', 'user'])->orderBy('id', 'asc')->get();
            return Datatables::of($data)
            ->setRowId(function ($row) {
                return 'tr-'.$row->id;
            })
            ->escapeColumns([])
            ->addColumn('index', function($row){
                $btn =view('admin.core.table_index')->with(['row'=>$row])->render();
                return $btn;
            })
            ->rawColumns(['action','index'])
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
        return view('admin.product_transaction.manage', [
            'data' => $data
        ]);
    }
}
