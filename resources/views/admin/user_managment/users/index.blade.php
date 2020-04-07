@extends('admin.layouts.admin_layout')

@section('content')

    <div class="container">
        <a href="{{route('admin.user_managment.user.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Create User</a>

        <table class="table table-striped">
            <thead>
            <th>User Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th class="text-right">Actions</th>
            </thead>

            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{$role->name}}
                        @endforeach
                    </td>
                    <td class="text-right">
                        <form method="post" onsubmit="
                              if(confirm('Are you sure, you want to delete this user ?')){
                                    return true;
                              } else {
                                    return false;
                              }" action="{{route('admin.user_managment.user.destroy', $user)}}">
                            {{method_field('Delete')}}
                            {{csrf_field()}}

                            <a class="btn btn-default" href="{{route('admin.user_managment.user.edit', $user)}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>No users</p>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$users->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
