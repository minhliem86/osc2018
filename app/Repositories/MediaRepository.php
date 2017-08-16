<?php
namespace App\Repositories;

use App\Repositories\Contract\RestfulInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Media;

class MediaRepository extends BaseRepository implements RestfulInterface{

    public function getModel()
    {
        return get_class(new Media);
    }
    public function getBannerOnHome()
    {
        return $this->model->where('status', 1)->orderBy('order','ASC')->get();
    }
  // END
}
