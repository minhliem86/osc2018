<?php
namespace App\Repositories;

use Excel;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\LogCreateUser;
use Carbon\Carbon as Carbon;

class ImportUserRepository{

  protected $customer;
  protected $log;

  public function __construst(Customer $customer, LogCreateUser $log)
  {
    $this->customer = $customer;
    $this->log = $log;
  }

  public function importUser($file)
  {
    $last_item = LogCreateUser::orderBy('id','DESC')->first();
    if(count($last_item)){
      $last_id = $last_item->id;
    }
    $excel = Excel::selectSheets('Sheet1')->load($file, function($reader){})->get();
    $data_log = [];
    $data = [];
    if(!$excel->isEmpty() && $excel->count()){
      $chu_excel = $excel->chunk(2);
      foreach($chu_excel as $item){
        foreach($item as $data_item){
          $username = \Unicodenospace::make($data_item->name).$data_item->dob;
          $password = 'abc123456';
          $email =  '' ;
          $name = $data_item->name;
          $tour_id = round($data_item->code);
          $obj_log = [
            'username' => $username,
            'init_password' => $password,
            'email' => $email,
            'name' => $name,
          ];
          array_push($data_log, $obj_log);

          $data []= [
            'username'=> $username,
            'password' => bcrypt($password),
            'email' => $email,
            'name' => $name,
            'tour_id' => $tour_id
          ];
        }
      }
      for($i = 0 ; $i<count($data); $i++){
        LogCreateUser::create($data_log[$i]);
        Customer::create($data[$i]);
      }
      if(isset($last_id)){
        $list_export = LogCreateUser::select('name', 'username', 'init_password')->where('id', '>', $last_id )->get();
        $time = Carbon::now();
        Excel::create('account_'.$time, function($excel) use($list_export){
          $excel->sheet('Sheet 1', function($sheet) use ($list_export){
            $sheet->cells('A1:C1', function($cell){
              $cell->setBackground('#76b7bf');
              $cell->setFontSize(14);
              $cell->setFontWeight('bold');
            });
            $sheet->fromArray($list_export);
          });
        })->export('xlsx');
      }
      return true;
    }else{
      return "File rỗng";
    }
  }


}
