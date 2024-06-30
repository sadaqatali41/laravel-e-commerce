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
            $data = User::select(['id', 'name', 'email', 'mobile', 'address', 'city', 'state', 'zip', 'ip', 'status']);
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('manage', function($row){
                                    return '<a href="'.route('admin.user.edit', $row->id).'"><i class="fa fa-edit"></i></a>';
                                })
                                ->editColumn('status', function($row){
                                    if($row->status === 'A') {
                                        return '<span class="badge badge-success">Active</span>';
                                    } else {
                                        return '<span class="badge badge-danger">Inactive</span>';
                                    }
                                })                                
                                ->escapeColumns([])
                                ->rawColumns(['manage'])
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

        return redirect()->back()->with('success', 'User is created successfully.');
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

        return redirect()->back()->with('success', 'User is updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
