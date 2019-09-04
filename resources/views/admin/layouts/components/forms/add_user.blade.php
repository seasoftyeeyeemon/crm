<form action="{{ route('admin.users.store')}}" method="POST" id="new-user-form">
 @csrf
  <div class="form-group">
    <label for="name">New User Name</label>
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" >
    @if($errors->has('name'))
        <div class="invalid-feedback">
            {{$errors->first('name')}}
        </div>
    @endif 
  </div>
  <div class="form-group">
    <label for="email">New User Email</label>
    <input type="email" name="email"  class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" autocomplete="new-email">
    @if($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email')}}
        </div>
    @endif
  </div>
  <div class="form-group">
    <label for="role">New User Role</label>
    <select name="role"  class="form-control">
        <option value="User" default>User</option>
        <option value="Admin">Admin</option>
    </select>
  </div>

  <div class="form-group">
    <label for="password">New User Password</label>
    <input type="password" name="password"  class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" autocomplete="new-password">
    @if($errors->has('password'))
        <div class="invalid-feedback">
            {{$errors->first('password')}}
        </div>
    @endif
  </div>

  <div class="from-group">
   <label for="confirm-password">New User temporary confirm password</label>
   <input type="password" name="confirm-password"  class="form-control {{ $errors->has('confirm-password') ? 'is-invalid' : ''}}" autocomplete="new-password">
   @if($errors->has('confirm-password'))
        <div class="invalid-feedback">
            {{$errors->first('confirm-password')}}
        </div>
    @endif
  </div>

  <div class="form-group my-4">
    <input type="submit" value="Create New User" class="form-control btn-primary">
  </div>

</form>