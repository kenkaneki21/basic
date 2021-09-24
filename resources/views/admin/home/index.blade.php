@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h4>Home Slider</h4>
                <a href="{{ route('add.about') }}"><button class="btn btn-info">Add About</button></a>
                <br><br>
                <div class="col-md-12">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card">
                        
                        <div class="card-header">All Slider</div>
                   
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL#</th>
                            <th scope="col">Home Title</th><th scope="col">Short Description</th>
                            <th scope="col">Long Description</th>
                            
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          <!--@php($i = 1) -->
                             @foreach($homeabouts as $homeabout)
                            <tr>
                            <th scope="row">  {{ $i++ }} </th>
                            <td>{{ $homeabout->title}} </td>
                            <td>{{ $homeabout->short_dis}} </td>
                             <td>{{ $homeabout->long_dis}} </td>
                             
                             
                            <td><a href="{{ url('edit/about/'.$homeabout->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('about/delete/'.$homeabout->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        
                            
                        </tbody>
                        </table>
                         
                        
                   </div>
                  
                </div>

                
          </div>
    </div>
         
        
 

    @endsection

