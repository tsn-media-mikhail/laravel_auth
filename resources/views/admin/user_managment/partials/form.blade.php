@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<label>Name</label>
<input type="text" class="form-control" name="name" value="@if(old('name')){{old('name')}}@else{{($user && $user->name) ? $user->name : ""}}@endif" required>

<label>Email</label>
<input type="text" class="form-control" name="email" value="@if(old('email')){{old('email')}}@else{{($user && $user->email) ? $user->email : ""}}@endif" required>

@if(!$user || $user->id != Auth::user()->id)
    <label>Role</label>
    <select class="form-control" name="role">
        @foreach($roles as $role)
            <option @if($user->roles()->where(['name' =>  $role->name])->exists()){{'selected'}}@endif value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
    </select>
@endif

<label>Password</label>
<input type="password" class="form-control" name="password" >

<label>Password Confirmation</label>
<input type="password" class="form-control" name="password_confirmation" >

<input class="btn btn-primary" type="submit" value="Save">
