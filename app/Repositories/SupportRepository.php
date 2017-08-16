<?php
namespace App\Repositories;

use App\Repositories\Contract\RestfulInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Support;

class SupportRepository extends BaseRepository implements RestfulInterface{

    public function getModel()
    {
        return Support::class;
    }

    public function getSupportOnLeftPanel()
    {
        return $this->model->where('status', 1)->orderBy('order','ASC')->get();
    }
  // END
}
