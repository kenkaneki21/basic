@extends('admin.admin_master')

@section('admin')

<div class="row">
	<div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Edit Slider</h2>
			</div>
			<div class="card-body">
				<form action="{{ url('update/slider/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
					@csrf 
					<div class="form-group">
						<label for="exampleFormControlInput1">Edit Slider Title</label>
						<input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="Enter Slider Title" value="{{ $sliders->title }}">
						 
					</div>
					
					
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Slider Description</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" >{{ $sliders->description }}</textarea>
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Slider Image</label>
						<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image" value="{{ $sliders->image }}">
						 @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
					</div>
					<input type="hidden" name="old_image" value="{{ $sliders->image }}">
					<div class="form-group">
						<img src="{{ asset($sliders->image) }}" alt="" style="height: 200px; width: 330px;">
					</div>
					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Update</button>
						 
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection