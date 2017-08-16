<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Hash;
use Auth;
use Validator;
use Notification;

use App\Repositories\UserRepository;

class AdminController extends Controller {

	protected $userRepo;

	public function __construct(UserRepository $user){
		$this->auth = Auth::admin();
		$this->userRepo = $user;
		$this->middleware('checkLogin');
	}


	protected function validator(array $data)
    {
        return Validator::make($data, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
					'password' => 'required|min:3|confirmed',
					'password_confirmation' => 'required|min:3',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

	public function index()
	{
		return view('Admin::pages.dashboard.index');
	}

	public function getChangePass(){
		return view('Admin::auth.changepass');
	}

	public function postChangePass(Request $request){
		$oldpass = $request->input('oldpassword');
		if(Hash::check($oldpass, $this->auth->get()->password)){
			$validator = Validator::make($request->all(),[
				'newpassword' => 'required|confirmed|min:6',
			]);
			if($validator->fails()){
				return redirect()->back()->withErrors('Not match New Password!');
			}else{
				$user = $this->auth->get();
				$user->password = Hash::make($request->input('newpassword'));
				$user->save();
				$this->auth->logout();
				return redirect()->route('admin.getlogin');
			}
		}else{
			return redirect()->back()->withErrors('Wrong password!');
		}
	}

	/*CREATE USER*/
	public function getCreateUser(){
		return view('Admin::users.create');
	}

	public function postCreateUser(Request $request){
		$validator = $this->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		$user = $this->create($request->all());

		$role = Role::where('name',$request->input('role'))->first();
		if($role){
			$user->attachRole($role);
			$permission = Permission::find(1);
			$role->attachPermission($permission);
		}
		Notification::success('Create User Successfull.');
		return redirect()->route('admin.getCreateUser');
	}

	/*LIST USER*/
	public function getListUser(){
		$user = $this->userRepo->getList();
		return view ('Admin::users.list', compact('user'));
	}

	public function deleteUser($id){
		$this->userRepo->delete($id);
		Notification::success('Delete User Successfull.');
		return redirect()->route('admin.getListUser');
	}

	public function deleteAll(Request $request){
			if(!$request->ajax()){
					return view('404');
			}else{
					$data = $request->arr;
					if($data){
							$this->country->destroy($data);
							return response()->json(array('msg'=>'ok'));
					}else{
							return response()->json(array('msg'=>'error'));
					}
			}
	}




}
