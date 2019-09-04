@extends('admin.layouts.app')

@section('content')
<div class="row">
        <div class="col-md-2">
            @component('admin.layouts.menus.sidebar')

            @endcomponent
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">User Details <span><button type="button" class="btn btn-primary float-right" id="edit-detail-modal-btn">Edit</button></span></div>
                <div class="card-body">
                   <h5>Name::{{$user->name}}</h5>
                   <h5>Email::{{$user->email}}</h5>
                   <h5>Role::{{$user->user_role}}</h5>
                   <h5>Active::{{$user->isActive ==1 ? 'Yes' : 'No'}}</h5>
                  
                </div>
            </div>
           
        </div>
        <div class="col-sm-5">
            <div class="card">
                
            </div>
        </div>
    </div>

    <!-- Modal Satrt -->
    <div class="modal margin-top" id="exampleModal">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card">
                    <div class="card-header">
                        Edit the detail For:{{$user->name}}
                        <span class="float-right color-red cursor-pointer" id="close-user-model-btn"><b>x</b></span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update',$user->id)}}" method="post">
                            @method('PUT')

                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}">
                            </div>
                            <div class="form-group">
                                <label for="email">User Email</label>
                                <input type="email" name="email"  class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" autocomplete="new-email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="role">User Role</label>
                                <select name="role"  class="form-control">
                                <option value="{{$user->user_role}}">{{$user->user_role}}</option>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="isActive">User is Active:</label>
                                <select name="isActive"  class="form-control">
                                    <option value="1" {{$user->isActive==1 ? 'default': ''}}>Yes</option>
                                    <option value="0" {{$user->isActive==0 ? 'default' : ''}}>No</option>
                                </select>
                            </div>
                            <div class="form-group my-4">
                                <input type="submit" value="Update User Value" class="form-control btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('admin.layouts.scripts.scripts')
    <script src="{{ asset('js/admin/user.js') }}"></script>
@endpush