@extends('admin.layouts.admin_layout')

@section('content')

    <div class="container">
        <form class="form-horizontal" action="{{route('admin.user_managment.user.update', $user)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('admin.user_managment.partials.form')

        </form>
    </div>
@endsection
