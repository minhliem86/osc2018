<div class="wrap-all-img" style="margin-bottom:10px;">
    @if(!$photo->isEmpty())
        @foreach ($photo->chunk(4) as $item_chunk)
            <div class="row">
                @foreach ($item_chunk as $value)
                    <div class="col-sm-3">
                        <div class="each-img" style="margin-bottom:10px">
                            <img src="{!!$value->img_url!!}" class="img-responsive" alt="">
                            {!!Form::textarea('title',$value->title, ['class' =>'form-control', 'rows' => 3, 'data-id'=>$value->id])!!}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
<div class="wrap-btn text-center">
    <button type="button" class="btn btn-primary" id="btn-edit">Save Changes</button>
</div>
