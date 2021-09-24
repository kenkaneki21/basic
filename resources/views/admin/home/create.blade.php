@extends('admin.admin_master')

@section('admin')

<div class="row">
	<div class="col-lg-12">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Create HomeAbout</h2>
			</div>
			<div class="card-body">
				<form action="{{ route('store.about') }}" method="POST" enctype="multipart/form-data">
					@csrf 
					<div class="form-group">
						<label for="exampleFormControlInput1">HomeAbout Title</label>
						<input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="Enter Title">
						 
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Short Description</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="short_description" rows="2" placeholder="Enter Long Description"></textarea>
						 
					</div>
					
					
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Slider Description</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="long_description" rows="3" placeholder="Enter Long Description"></textarea>
					</div>
					 
					<div class="form-footer pt-4 pt-5 mt-4 border-top">
						<button type="submit" class="btn btn-primary btn-default">Submit</button>
						 
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection