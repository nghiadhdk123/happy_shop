<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserInfor;
use App\Models\Product;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\ResetPassRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {   
        $user = User::orderBy('id','DESC')->get();
        if(auth()->user()->hasAnyPermission(['create user','edit user','destroy user']))
        {
            if(isset($request->keyword))
            {
                $user = User::where('name', 'LIKE', '%'. $request->keyword .'%')
                            ->orWhere('email', 'LIKE', '%'. $request->keyword .'%')
                            ->orWhere('phone', 'LIKE', '%'. $request->keyword .'%')
                            ->orderBy('id','DESC')
                            ->get();
            }

            if(isset($request->active))
            {
                $user = User::where('is_active',$request->active)
                        ->orderBy('id','DESC')
                        ->get();
            }
            return view('admin.user.index',[
                'user' => $user,
            ]);
        }else{
            return view('admin.403.403');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::allows('role-user',User::class))
        if(auth()->user()->hasAnyPermission(['create user']))
        {
            return view('admin.user.create');
        }else{
            return view('admin.403.403');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
            $user = new User();

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->address = $request->get('address');
            $user->role = $request->get('role');
            $user->password = Hash::make('12345678');
            $user->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

            $save = $user->save();

            if($user)
            {
                $userInfo = new UserInfor();
                $userInfo->user_id = $user->id;
                $userInfo->save();
            }
            
            alert()->success('T???o m???i th??nh c??ng');

            // if($save)
            // {

               
            // }
            

            // Mail::send('admin.mail.send',[
            //         'name' => $request->name,
            //         'email' => $request->email,
            //         'password' => '12345678',
            //         ],function($mail) use($request){
            //         $mail->from('trandinhnghia555@gmail.com', 'AdminMyShop');
            //         $mail->to($request->email);
            //         $mail->subject('My Shop - T???o t??i kho???n th??nh vi??n');
            //     });

            return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.profile',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->hasAnyPermission(['edit user']))
        {
            $user = User::find($id);
            return view('admin.user.edit',[
                'user' => $user,
            ]);
        }else{
            return view('admin.403.403');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->role = $request->get('role');
        $user->gender = $request->get('gender');
        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $user->user_updated = Auth::user()->id;

        $save=$user->save();

       
        alert()->success('C???p nh???t th??nh c??ng');
        
        return redirect()->route('user.index');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //X??a vi???n v??nh
    public function destroy($id)
    {
        $user = User::find($id);

        if(auth()->user()->hasAnyPermission(['destroy user']))
        {
            // $user->delete();
            User::withTrashed()->where('id', $id)->forceDelete();
            $product = Product::where('user_id',$id)->get();
            $userInfo = UserInfor::where('user_id',$id)->forceDelete();

            foreach($product as $products)
            {
                $products->user_id = 1;
                $products->save();
            }

            alert()->success('X??a th??nh c??ng');
            return redirect()->back();
        }else{
            return view('admin.403.403');
        }
    }

    //L???y ra danh s??ch c??c t??i kho???n ???? x??a m???m
    public function list_delete()
    {
        if(auth()->user()->hasAnyPermission(['respone user']))
        {
            $user = User::onlyTrashed()->get();
            return view('admin.user.list-delete',[
                'user' => $user,
            ]);
        }else{
            return view('admin.403.403');
        }
        
    }

    public function delete($id)
    {
        if(auth()->user()->hasAnyPermission(['destroy user']))
        {
            $user = User::find($id);
            $user->is_active = 0;
            $user->save();

            User::destroy($id);


            return back()->with('success','X??a th??nh c??ng');
        }else{
            return view('admin.403.403');
        }
        
    }

    //Kh??i ph???c t??i kho???n ng?????i d??ng ???? x??a
    public function restore($id)
    {
        if(auth()->user()->hasAnyPermission(['respone user']))
        {
            User::withTrashed()->where('id', $id)->restore();

            return back()->with('success','Kh??i ph???c d??? li???u th??nh c??ng');
        }else{
            return view('admin.403.403');
        }
        

    }

    public function locktoggle($id)
    {
        $user = User::find($id);
        if(auth()->user()->hasAnyPermission(['lock user']))
        {
            if($user->is_active == 1)
            {
                $user->is_active = 0;
                $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $user->save();
                return redirect()->back()->with('success','???? kh??a');
            }else{
                $user->is_active = 1;
                $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                $user->save();
                return redirect()->back()->with('success','???? m??? kh??a');
            }
        }else{
            return view('admin.403.403');
        }
    }

     public function profile($id)
    {
        $user = User::find($id);

        // if(Gate::allows('profile-user', $user))
        if($user->id == Auth::user()->id)
        {
            return view('admin.user.edit-profile',[
                'user' => $user,
            ]);
        }else{
            abort(403);
        }
        
    }
 
    public function profileUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $data = $request->except('_token');

        $data['phone'] = $request->get('phone');
        $data['address'] = $request->get('address');
        $data['gender'] = $request->get('gender');
       
        
        $user->update($data);

        $userInfor = UserInfor::where('user_id',$user->id)->first();

        // if($request->has('key'))
        // {
        //     $key = $request->get('key');
        //     $val = $request->get('val');
        //     $list = [];
        //     $merge = [];
        //     for ($i = 0; $i < count($key); $i++) {
        //         $list = [$key[$i] => $val[$i]];
        //         $merge = array_merge($merge, $list);
        //     }
        //     $data['hobby'] = json_encode($merge, JSON_UNESCAPED_UNICODE);
        // }else{
        //     $data['hobby'] = null;
        // }
        
        $data['email_2'] = $request->get('email_2');
        $data['nickname'] = $request->get('nickname');
        $data['link_facebook'] = $request->get('link_facebook');
        $data['link_instagram'] = $request->get('link_instagram');
        $data['lover'] = $request->get('lover');
        $data['date'] = $request->get('date');

        
        $userInfor->update($data);

        return back()->with('success','C???p nh???t th??nh c??ng');
    }

    public function profileUpdateAvatar(Request $request,$id)
    {   
        $user = User::find($id);

        $data = $request->except('_token');

        $file = $request->file('image'); 

        if($request->hasFile('image'))
        {
            $data['avatar_url'] = NULL;
            $name = $file->getClientOriginalName();
            $path = Storage::disk('public')    //->L??u v??o trong th?? m???c public
                    ->putFileAs('avtar-user', $file, $name); 
            
            $data['avatar'] = $path;
            $data['path'] = 'public';
        }

        $user->update($data);

        return back()->with('success','C???p nh???t th??nh c??ng');
    }

    public function resetpass($id)
    {
        $user = User::find($id);
        return view('admin.user.resetpass',[
            'user' => $user,
        ]);
    }

    public function updateNewPass(ResetPassRequest $request, $id)
    {
        $user = User::find($id);
        
        if(Hash::check($request->get('old_password'), Auth::user()->password))        // Ki???m tra m???t kh???u hi???n t???i c?? tr??m kh???p kh??ng
        {
            if(strcmp($request->get('old_password'),$request->get('password')) == 0)         //Ki???m tra m???t kh???u c?? v?? m???t kh???u m???i c?? tr??m v???i nhau kh??ng
            {
                $request->session()->flash('same_pass', 'M???t kh???u m???i c???a b???n ??ang tr??ng v???i m???t kh???u hi???n t???i  ! Y??u c???u nh???p l???i.');
                return redirect()->back();
            }else{
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('login');
            }
        }else{
            $request->session()->flash('error_pass', 'M???t kh???u hi???n t???i kh??ng ????ng ! Y??u c???u nh???p l???i.');
            return redirect()->back();
        }
    }



    public function indexPremission($id)
    {
        if(auth()->user()->hasAnyPermission(['decentralization']))
        {
            $user = User::find($id);
            $permission = Permission::all();     //L???y ra danh s??ch c??c quy???n
            // $role = Role::find(3);

            // foreach($role->permissions as $value)
            // {
            //     echo $value->name;
            // }

            // dd($role);

            // foreach($user->permissions as $value)
            // {
            //     echo $value->name;
            // }
            // dd('STOP');
            return view('admin.permission.index',compact('permission','user'));
        }else{
            return view('admin.403.403');
        }
    }

    public function addPremissionforRole(Request $request,$id)
    {
        if(auth()->user()->hasAnyPermission(['decentralization']))
        {
            $data = $request->all();
            // $role = Role::find($id);
            $user = User::find($id);
            $permissions = Permission::all();

            if($request->permission == null)
            {
            foreach($permissions as $value)
            {
                $user->revokePermissionTo($value->name);
            }
            }else{
                $user->syncPermissions($data['permission']);
            }

            $exitCode = Artisan::call('cache:clear');
            // dd($data['permission']);
            return back()->with('success','C???p quy???n th??nh c??ng');
        }else{
            return view('admin.403.403');
        }
    }
}