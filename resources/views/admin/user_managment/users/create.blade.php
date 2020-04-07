@extends('admin.layouts.admin_layout')

@section('content')

    <div class="container">
        <form class="form-horizontal" action="{{route('admin.user_managment.user.store')}}" method="post">
        {{ csrf_field() }}

        @include('admin.user_managment.partials.form')

        </form>
    </div>
@endsection
