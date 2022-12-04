<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeOfVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class TypeOfVendorsController extends Controller{
    public function manage(Request $request){
        $data['activePage'] = ['type_of_vendors' => 'type_of_vendors'];
        $data['breadcrumb'] = [
            ['title' => 'type_of_vendors'],
        ];
        $data['addRecord'] = ['href' => route('type_of_vendors.create'), 'class' => 'create_item_btn'];
        if ($request->ajax()) {
            $data  = TypeOfVendor::orderBy('id', 'asc')->get();
            return Datatables::of($data)
            ->setRowId(function ($row) {
                return 'tr-'.$row->id;
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
        return view('admin.type_of_vendors.manage', [
            'data' => $data
        ]);
    }
    public function create(){
        $data['activePage'] = ['type_of_vendors' => 'type_of_vendors'];
        $data['breadcrumb'] = [
            ['title' => "type_of_vendors Management"],
            ['title' => "type_of_vendors"],
            ['title' => 'Add Category'],
        ];
        // return  view('admin.type_of_vendors.create')->with(['data'=>$data, 'type_of_vendors'=> Category::get(), 'languages' => Language::get()]);
        $html= view('admin.type_of_vendors.create')->with(['data'=>$data])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK', 'html'=>$html ]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',        
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'validator' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $item= new TypeOfVendor();
        $item->name = $request->name;
        $item->save();
        $message = __('ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'data' => $item]);
    }

    public function edit($id){
        $data['activePage'] = ['type_of_Vendors' => 'type_of_Vendors'];
        $data['breadcrumb'] = [
            ['title' => "type_of_Vendors Management"],
            ['title' => "type_of_Vendors"],
            ['title' => 'Edit category'],
        ];
        $item = TypeOfVendor::whereId($id)->first();
        $html= view('admin.type_of_Vendors.edit')->with(['data'=>$data, 'item' => $item])->render();
        return response()->json(['status' => true, 'code' => 200, 'message' => 'OK','item' =>$item ,'html'=>$html ]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',        
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'code' => 200,'validator' =>implode("\n",$validator-> messages()-> all()) ],403);
        }
        $item=  TypeOfVendor::whereId($id)->first();
        $item->name = $request->name;
        $item->save();
        $message = __('ok');
        return response()->json(['status' => true, 'code' => 200, 'message' => $message,'data' => $item]);
    }

    public function destroy($id){
        $item = TypeOfVendor::whereId($id)->delete();
        return response()->json(['message' => 'ok'],200);
    }
}

