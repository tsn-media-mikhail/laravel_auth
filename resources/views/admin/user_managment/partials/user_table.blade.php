@forelse($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->roles}}
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

<tr>
    <td colspan="5">
        <ul class="pagination" style=" display: flex; justify-content: center;">
            {{$users->links()}}
        </ul>
    </td>
</tr>


