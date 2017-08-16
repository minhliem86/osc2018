@extends('Admin::layouts.layout')

@section('css')
<style>
  /* Mimic table appearance */
    div.album{
      margin:10px 0;
    }
    div#actions{
      margin-bottom:10px;
    }
   div.table {
     display: table;
   }
   div.table .file-row {
     display: table-row;
   }
   div.table .file-row > div {
     display: table-cell;
     vertical-align: top;
     border-top: 1px solid #ddd;
     padding: 8px;
   }
   div.table .file-row:nth-child(odd) {
     background: #f9f9f9;
   }



   /* The total progress gets shown by event listeners */
   #total-progress {
     opacity: 0;
     transition: opacity 0.3s linear;
   }

   /* Hide the progress bar when finished */
   #previews .file-row.dz-success .progress {
     opacity: 0;
     transition: opacity 0.3s linear;
   }

   /* Hide the delete button initially */
   #previews .file-row .delete {
     display: none;
   }

   /* Hide the start and cancel buttons and show the delete button */

   #previews .file-row.dz-success .start,
   #previews .file-row.dz-success .cancel {
     display: none;
   }
   #previews .file-row.dz-success .delete {
     display: block;
   }

</style>
@stop
@section('content')
<section class="content-header">
  <h1>Photo</h1>
</section>
<section class="content">

	<div class="box">
		<div class="container-fluid">
      <div class="tourcode" style="margin-bottom:10px;">
        <p><b>Course</b></p>
        {!!Form::select('tour_code',['' => 'Select Course'] + $list_tour,'',['class'=>'form-control', "id" => "tour_code"  ])!!}
      </div>
      <div class="album" style="margin-bottom:10px;">
        <p><b>Album</b></p>
        <div class="load-album">
          <select name="album_id" id="album_id" class="form-control">
            <option value="">Chọn Album</option>
          </select>
        </div>

      </div>

      <div id="actions" class="row">

        <div class="col-lg-7">
          <!-- The fileinput-button span is used to style the file input field as button -->
          <span class="btn btn-success fileinput-button dz-clickable">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files (1200x630)...</span>
          </span>
          <button type="submit" class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Start upload</span>
          </button>
          <button type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel upload</span>
          </button>
        </div>


      </div>
      <!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
      <div class="table table-striped" class="files" id="previews">

        <div id="template" class="file-row">
          <!-- This is used as the file preview template -->
          <div>
              <span class="preview">
                <img data-dz-thumbnail />
                <div class="title form-group" style="margin-top:10px"></div>
                <div class="order form-group" style="margin-top:10px"></div>
                <div class="description form-group"></div>
              </span>
          </div>
          <div>
              <p class="name" data-dz-name></p>
              <strong class="error text-danger" data-dz-errormessage></strong>
          </div>
          <div>
              <p class="size" data-dz-size></p>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
              </div>
          </div>
          <div>
            <button data-dz-remove class="btn btn-warning cancel">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel</span>
            </button>
            <button data-dz-remove class="btn btn-danger delete">
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete</span>
            </button>
          </div>
        </div>

      </div>

		</div>
	</div>
</section>
@stop

@section('script')
  <link rel="stylesheet" href="<?php echo asset('public/assets/backend/js/dropzoner/dropzone.min.css'); ?>">
  <script src="<?php echo asset('public/assets/backend/js/dropzoner/dropzone.min.js'); ?>"></script>

  <script>
    $(document).ready(function(){
      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

      // DROPZONE
      var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "{!!route('admin.photo.postUpload')!!}", // Set the url
        maxFilesize: 30,
        uploadMultiple: false,
        autoProcessQueue: false,
        acceptedFiles: 'image/*',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        headers: {
            'X-CSRFToken': $('meta[name="csrf-token"]').attr('content')
        },
        dictFileTooBig: 'Image is bigger than 8MB',
        // autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        init:function(){
          var myDropzone = this;

          myDropzone.on("addedfile",function(file){
            var uni_field_id = new Date().getTime();
            var title = file.title == undefined ? "" : file.title;
            var description = file.description == undefined ? "" : file.description;
            var order = file.order == undefined ? "" : file.order;
            file._title = Dropzone.createElement('<input type="text" value="'+title+'" id="'+uni_field_id+'" name="title" placeholder="Title..." class="form-control" />');
            // file._order = Dropzone.createElement('<input type="text" value="'+order+'" id="'+uni_field_id+'" name="order" placeholder="Order..." class="form-control" />');
             file.previewElement.querySelector('.title').appendChild(file._title);
            //  file.previewElement.querySelector('.order').appendChild(file._order);
          });

          myDropzone.on("sending",function(file, xhr, formData){
              title = file.previewElement.querySelector("input[name='title'");
            //   order = file.previewElement.querySelector("input[name='order'");
            //   description = file.previewElement.querySelector("textarea[name='description'");
              formData.append("text_title",$(title).val());
            //   formData.append("text_order",$(order).val());
              formData.append("album_id",$('select[name="album_id"]').val());
              document.querySelector(".start").setAttribute("disabled", "disabled");
          });

          document.querySelector('.start').addEventListener("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();
          });

          myDropzone.on("queuecomplete", function(progress) {
            document.querySelector(".progress").style.opacity = "0";
          });

        },

        success: function(file,response) {
            // file.serverId = response.code;
            console.log(response.filename);
            window.location = "{!!route('admin.photo.index')!!}";
        },
        error: function(file, response) {
            console.log(response);
        },
        sending:function(file, shr, formData){
          formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        }
      });

      document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
      };

        // SELECT ALBUM
        $('select[name="album_id"]').prop('disabled', true);
        $('select#tour_code').change(function(){
          const  tour_id =  $(this).val();
          $.ajax({
            url : '{!!route("admin.photo.ajaxAlbum")!!}',
            type: "GET",
            data: {id: tour_id, _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(data){
              console.log(data);
              $('.load-album').empty();
              $('.load-album').append(data.msg);
            },
          })
        })

    })
  </script>
@stop
