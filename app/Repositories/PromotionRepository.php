<?php
namespace App\Repositories;

use App\Repositories\Contract\RestfulInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\Testimonial;

class TestimonialRepository extends BaseRepository implements RestfulInterface{

    public function getModel()
    {
        return get_class(new Testimonial);
    }
  // END
}
