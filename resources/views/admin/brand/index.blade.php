@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="card">
                        @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        <div class="card-header">All Brand</div>
                   
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php($i = 1) 
                             @foreach($brands as $brand)
                            <tr>
                            <th scope="row"> {{ $brands->firstItem()+$loop->index }} </th>
                            <td>{{ $brand->brand_name}} </td>
                            <td> <img src="{{ asset($brand->brand_image )}}" style="height: 40px;width: 70px;"> </td>
                            <td>
                                @if($brand->created_at == NULL)
                                <span class="text-danger"> No Date Set</span>  
                                @else  
                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td><a href="{{ url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('brand/softdelete/'.$brand->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        
                            
                        </tbody>
                        </table>
                        {{ $brands->links() }}
                        
                   </div>
                  
                </div>

                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Add Brand Name</div>
                            <div class="card-body">
                            <form class="row g-3" action="{{ route('store.brand')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <label for="inputZip" class="form-label">Category Name</label>
                                <input type="text" name="brand_name" class="form-control" id="inputZip">
                                @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputZip" class="form-label">Image</label>
                                <input type="file" name="brand_image" class="form-control" id="inputZip">
                                @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                </div>
          </div>
    </div>
         
        
 

    @endsection

