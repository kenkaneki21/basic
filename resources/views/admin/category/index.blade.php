<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Category
          <b style="float:right"> Total users
          <span class="badge badge-danger">   </span>
          </b>
        </h2>
    </x-slot>

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
                        <div class="card-header">All Category</div>
                   
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <!--@php($i = 1) -->
                             @foreach($categories as $category)
                            <tr>
                            <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                            <td>{{ $category->category_name}} </td>
                            <td> {{ $category->user->name }} </td>
                            <td>
                                @if($category->created_at == NULL)
                                <span class="text-danger"> No Date Set</span>  
                                @else  
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td><a href="{{ url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('category/softdelete/'.$category->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        
                            
                        </tbody>
                        </table>
                        {{ $categories->links() }}
                        
                   </div>
                   <div class="card">
                        
                        <div class="card-header">Trash List</div>
                   
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">User</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <!--@php($i = 1) -->
                             @foreach($trashCat as $category)
                            <tr>
                            <th scope="row"> {{ $categories->firstItem()+$loop->index }} </th>
                            <td>{{ $category->category_name}} </td>
                            <td> {{ $category->user->name }} </td>
                            <td>
                                @if($category->created_at == NULL)
                                <span class="text-danger"> No Date Set</span>  
                                @else  
                            {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                @endif
                            </td>
                            <td>
                            <a href="{{ url('category/restore/'.$category->id)}}" class="btn btn-info">Restore</a>
                            <a href="{{ url('category/pdelete/'.$category->id)}}" class="btn btn-danger">P Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        
                            
                        </tbody>
                        </table>
                        {{ $trashCat->links() }}
                        
                   </div>
                </div>

                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Add Category</div>
                            <div class="card-body">
                            <form class="row g-3" action="{{ route('store.category')}}" method="POST">
                            @csrf 
                            <div class="col-md-12">
                                <label for="inputZip" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="inputZip">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                </div>
          </div>
</div>
         
        
    </div>
</x-app-layout>
