<?php  namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Permission;
use Hash;
use Auth;
use Validator;
use Notification;

class CustomerController extends AdminController{

  protected $customer;
  protected $admin;

  public function __construct(Customer $customer, AdminController $admincontroller){
    $this->admin = $admincontroller;
    $this->auth = Auth::client();
    $this->customer = $customer;
  }

  public function index()
  {
    $list = $this->customer->where('super',1)->get();
    return view('Admin::pages.customer.list', compact('list'));
  }

  public function create()
  {
    return view('Admin::pages.customer.create')
  }
}
