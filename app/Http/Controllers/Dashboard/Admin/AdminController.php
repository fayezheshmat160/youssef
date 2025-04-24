<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Helpers\File;
use App\Helpers\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use AdminHelpers;

    public function __construct()
    {
        $this->middleware(['permission:admins'], ['only' => 'index']);
        $this->middleware(['permission:create admin'], ['only' => 'store']);
    }

    // Admins Page
    public function index()
    {

        // Path To Image


        // /**
        //  * Get Data
        //  */
        // $rows = DB::table($admin->table);


        // /**
        //  * Sorting Data
        //  */
        // $sort_default = "DESC";
        // $sort = strtoupper(request('sort'));

        // if ($sort != 'ASC' && $sort != 'DESC') {
        //     $sort = $sort_default;
        // }

        // // Get
        // $rows = $rows->orderBy('id', $sort)->get();

        $admins = DB::table($this->table())->orderByDesc('id')->get();

        return view('dashboard.admin.all', [
            'admins' => $admins,
            'coverPath' => $this->coverPath,
            'avatarPath' => $this->avatarPath
        ]);
    }

    public function store(Request $request)
    {
        // Validate Row
        $data = $request->validate([
            'f_name'   => 'required|max:20|min:2',
            'l_name'   => 'required|max:20|min:2',
            'email'    => 'required|email|max:255|unique:' . $this->table() . ',email,' . adminId(),
            'password' => 'required|min:8|max:255'
        ]);


        // Change To HeadLine Text Format
        $data['f_name']  = Str::headline($request->f_name);
        $data['l_name']  = Str::headline($request->l_name);

        // Set Full Name
        $data['full_name'] = $data['f_name'] . ' ' . $data['l_name'];

        // Password Hash
        $data['password'] = Hash::make($data['password']);


        // Create
        $insert = $this->model()->create($data);
        $insert->assignRole(1);

        $this->createAdminTables($insert->id);

        return Response::success('Successful Create New Admin', ['style' => 'toastr', 'reset' => true]);
    }

    // Edit View
    public function edit($id)
    {
        return view('dashboard.admin.profile.edit');
    }

    public function changeAdminPassword(Request $request)
    {
        $id = $this->getAdminIdFromRequest();

        if ($id != adminId()) {

            $request->validate([
                'password' => 'required|min:8|max:255',
            ]);

            $update = $this->model()->where('id', $id)->update([
                'password' => Hash::make($request->password),
            ]);

            if ($update > 0) {
                return Response::success('Password Updated Successfully', ['style' => 'toastr']);
            }
        } else {
            return Response::warning('This operation is not authorized', ['style' => 'toastr']);
        }
    }


    public function activeAccount(string $status = '1')
    {
        $adminId = request('id');

        if ($adminId == '1') {
            return abort(404);
        }
        // Check IF Admin Exist IN DB
        $row = $this->model()->where('id', $adminId)->count();

        if ($row > 0) {

            $this->model()->where('id', $adminId)->update([
                'status' => $status
            ]);

            return response([
                'account_status' => $status,
                'closed' => 'Closed',
                'activate' => 'Activate',
                'deactivate' => 'DeActivate'
            ]);
        } else {
            return abort(404);
        }
    }

    public function closedAccount()
    {
        return $this->activeAccount('0');
    }

    // Search
    public function search(Request $request, Admin $admin)
    {
        $q = $request->name;
        $rows = DB::table($admin->table)->where('full_name', 'like', "%$q%")->get(['full_name', 'email', 'id', 'phone']);
        return response($rows);
    }

    public function destroy()
    {
        $adminId = $this->getAdminIdFromRequest();

        // Check IF Exist
        $row = $this->model()->where('id', $adminId)->select(['avatar', 'cover'])->first();

        if (!empty($row)) {

            // Delete Attech
            File::delete($this->avatarPath, $row->avatar);
            File::delete($this->avatarPath, $row->cover);


            // Delete From DB
            $this->model()->where('id', $adminId)->delete();
        }

        // Redirect
        return redirect(adminUrl('admins'));
    }
}
