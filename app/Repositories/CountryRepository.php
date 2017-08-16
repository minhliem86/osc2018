<?php
namespace App\Repositories;

use App\Repositories\Contract\RestfulInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Country;

class CountryRepository extends BaseRepository implements RestfulInterface{

    public function getModel()
    {
        return get_class(new Country);
    }
  // END
}
