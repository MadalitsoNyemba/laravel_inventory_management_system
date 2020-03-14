<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products as products;
use App\categories as categories;
use App\User as User;
use App\product_calculations as product_calculations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;

class UsersController extends Controller
{
    public function __construct(products $products,categories $categories,product_calculations $product_calculations,User $User)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->product_calculations = $product_calculations;
        $this->User = $User;
    }
    public function index()
    {
        $data = [];
        $data['users'] = User::all();
        return view('users.index',$data);
    }

    public function history()
    {
        $data = [];
        $data['history'] = product_calculations::with('products')->with('User')->orderby('id','desc')->get();
        return view('users.history',$data);
    }

    public function profile()
    {
        $data = [];
        $data['history'] = product_calculations::with('products')->orderby('id','desc')->where('responsible',Auth::user()->id)->get();
        return view('users.profile',$data);
    }
    public function edit_profile(User $user,ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return redirect()->back();
    }

    public function edit_password(User $user,PasswordRequest $request)
    {
        if(Hash::check($request->old_password,Auth::user()->password)){
            if($request->password==$request->password_confirmation){
                auth()->user()->update(['password' => Hash::make($request->get('password'))]);
                return redirect()->back()->withStatus(__('Password changed successfully.'));
            }
            else{
                return redirect()->back()->withStatus(__('Password not changed.'));
            }
        }


        return redirect()->back()->withStatus(__('Password not changed as old password is not right.'));
    }

    public function admin_actions(User $user,Request $request)
    {
        if($request->to_do=='make_admin'){
        $data = User::find($request->user_id);
        $data->isAdmin = '1';
        $data->save();
        return redirect()->back()->withStatus(__('New admin'));
        }elseif($request->to_do=='remove_admin'){
            $data = User::find($request->user_id);
            $data->isAdmin = '0';
        $data->save();
            return redirect()->back()->withStatus(__('Admin removed'));
        }elseif($request->to_do=='delete'){

        }
        elseif($request->to_do=='add_user'){
        $data = [];
        $data["name"] =  $request->name;
        $data["email"] =  $request->email;
        $data["password"] =  Hash::make($request->password);
        if($request->isAdmin == 'on'){
            $data["isAdmin"] =  '1';
        }else{
            $data["isAdmin"] =  '0';
        }
        $user->insert($data);
        return redirect()->back()->withStatus(__('New user added'));

        }
    }
    public function reverse_transaction(Request $request)
    {
        $product = product_calculations::find($request->hist_id);
        $product->forcedelete();
        return redirect()->back();
    }
}
