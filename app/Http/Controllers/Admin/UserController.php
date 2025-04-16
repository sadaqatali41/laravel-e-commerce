<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = User::withCount('orders')
                            ->selectRaw('users.id, users.name, users.email, users.mobile, users.address, users.city, users.state, users.zip, users.ip, users.status');
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.user.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('name', function($row){
                                    return $row->name . ' <span class="badge badge-info">(' . $row->orders_count . ')</span>';
                                })
                                ->editColumn('status', function($row){
                                    if($row->status === 'A') {
                                        return '<span class="badge badge-success">Active</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Inactive</span>';
                                    }
                                })
                                ->filter(function($query) use ($request){                                    
                                    if($request->status) {
                                        $query->where('status', $request->status);
                                    }
                                }, true)                                
                                ->escapeColumns([])
                                ->rawColumns(['manage', 'name', 'status'])
                                ->make(true);
        }
        return view('admin.user.users', [
            'exp' => 'index',
            'title' => 'Manage User'
        ]);
    }

    public function create()
    {
        return view('admin.user.users', [
            'exp' => 'create',
            'title' => 'Create User'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile' => 'required',
            'password' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'company' => 'nullable',
            'gstin' => 'nullable',
            'status' => 'required',
        ]);

        $formFields = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'ip' => $request->ip(),
            'status' => $request->status,
        ];

        User::create($formFields);

        session()->flash('success', 'User is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user.users', [
            'user' => $user,
            'exp' => 'edit',
            'title' => 'Update User'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'mobile' => 'required',
            // 'password' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'company' => 'nullable',
            'gstin' => 'nullable',
            'status' => 'required',
        ]);

        $formFields = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            // 'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'company' => $request->company,
            'gstin' => $request->gstin,
            // 'ip' => $request->ip(),
            'status' => $request->status,
        ];

        $user->update($formFields);

        session()->flash('success', 'User is created successfully.');

        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        //
    }
}
