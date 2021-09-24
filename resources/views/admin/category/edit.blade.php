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
                            <div class="card-header">Update Category</div>
                            <div class="card-body">
                            <form class="row g-3" action="{{ url('category/update/'.$categories->id)}}" method="POST">
                            @csrf 
                            <div class="col-md-12">
                                <label for="inputZip" class="form-label">Update Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="inputZip" value="{{$categories->category_name}}">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Category</button>
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
