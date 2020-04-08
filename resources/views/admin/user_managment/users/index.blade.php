@extends('admin.layouts.admin_layout')

@section('content')

    <div class="container">
        <a href="{{route('admin.user_managment.user.create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus-square-o"></i> Create User
        </a>

        <table class="table table-striped" id="datatable">
            <thead>
            <th>User Name <i class="fa fa-sort-alpha-desc"></i></th>
            <th>Email <i class="fa fa-sort-alpha-desc"></i></th>
            <th>Roles <i class="fa fa-sort-alpha-desc"></i></th>
            <th class="text-right">Actions</th>
            <tr>
                <td>
                    <input type="text" class="form-control filter-input" data-column="0">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="1">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="2">
                </td>
            </tr>
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


{{--don't know yet how to make it work, but i believe i will--}}



{{--@section('page-js-script')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}
{{--            var table = $('#datatable').DataTable({--}}
{{--                'processing' : true,--}}
{{--                'serverSide' : true,--}}
{{--                'ajax' : "{{route('admin.index')}}",--}}
{{--                'columns' : [--}}
{{--                    {'data' : 'name'},--}}
{{--                    {'data' : 'email'},--}}
{{--                    {'data' : 'role'}--}}
{{--                ],--}}
{{--            });--}}

{{--            $('.filter-input').keyup(function () {--}}
{{--                table.column($(this).data('column')).search($(this).val()).draw();--}}
{{--            });--}}

{{--            $('.filter-select').change(function () {--}}
{{--                table.column($(this).data('column')).search($(this).val()).draw();--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}

