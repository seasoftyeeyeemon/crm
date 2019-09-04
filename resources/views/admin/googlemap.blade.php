@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">
            @component('admin.layouts.menus.sidebar')

            @endcomponent
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                    <button class="btn-block btn-primary form-control" id="show-new-user-form">Add New User</button>
                    @component('admin.layouts.components.forms.add_user')
                   
                    @endcomponent
                </div>
            </div>
           
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <h3>Current Users</h3>
                    @if($users)
                    <ul class="list-group list-group-flush">
                        @foreach($users as $user)
                           <li class="list-group-item"> <a href="user/{{$user->id}}">{{$user->name}}</a> </li>
                        @endforeach
                    </ul>
                    @endif
                   
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Modal start -->
  


@endsection

@push('admin.layouts.scripts.scripts')
    <script src="{{ asset('js/admin/map.js') }}"></script>
@endpush