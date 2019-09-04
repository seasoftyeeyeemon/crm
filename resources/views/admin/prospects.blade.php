@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-3">
        <!-- <button type="button" id="add-new-prospect-btn" class="btn-primary">Add Prospect</button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
                Launch demo modal
            </button>
        </div>
    </div>

    <div class="row">
    @foreach ($prospects as $prospect)
        <div class="col-md-3 offset-2">
            <div class="card mt-3">
                    <div class="card-header">{{$prospect->name}}</div>
                    <div class="card-body">
                        <h6>Phone: {{$prospect->phone1}}/{{$prospect->phone2}} </h6>
                        <h6>Email: {{$prospect->email}}</h6>
                    </div>
            </div>
       </div>
        @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
            <div class="text-center">
                {{$prospects->links()}}
            </div>
        </div>
    </div>
    <!-- <div class="modal-dialog modal-dialog-scrollable margin-top">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
            <div class="card">
                <div class="card-header">Add New Prospect</div>
                <div class="card-body">
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="name">Prospect Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone 1</label>
                            <input type="phone1" name="phone1" id="phone1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone 2</label>
                            <input type="phone2" name="phone2" id="phone2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Address</label>
                            <input type="address" name="address" id="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">City</label>
                            <input type="city" name="city" id="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Note</label>
                            <textarea name="note" id="note" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Prospect Message</label>
                            <textarea name="prospect_message" id="prospect_message" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="assigned">Assigned</label>
                            <select name="assigned" id="assigned" class="form-control">
                                <option value="0" default>Unassigned</option>
                                @foreach( $users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn-primary btn-block" value="Create Prospect">
                        </div>
                    </form>
                </div>
        </div>
    </div> -->
    
    <!-- Modal scrollable -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.prospects.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Prospect Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone 1</label>
                            <input type="phone1" name="phone1" id="phone1" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone 2</label>
                            <input type="phone2" name="phone2" id="phone2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Address</label>
                            <input type="address" name="address" id="address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">City</label>
                            <input type="city" name="city" id="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Note</label>
                            <textarea name="note" id="note" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Prospect Message</label>
                            <textarea name="prospect_message" id="prospect_message" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="assigned">Assigned</label>
                            <select name="assigned" id="assigned" class="form-control">
                                <option value="0" default>Unassigned</option>
                                @foreach( $users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
      </div>
     
    </div>
  </div>
</div>
    
</div>
@endsection

@push('admin.layouts.scripts.scripts')
    <script src="{{ asset('js/admin/prospects.js') }}"></script>
@endpush