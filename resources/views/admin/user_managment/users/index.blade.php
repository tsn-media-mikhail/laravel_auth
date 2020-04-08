@extends('admin.layouts.admin_layout')

@section('content')
    <style>
        .active {
            display: inline-block !important;
        }
        .sorting i {
            display: none;
        }
    </style>
    <div class="container">
        <a href="{{route('admin.user_managment.user.create')}}" class="btn btn-primary pull-right">
            <i class="fa fa-plus-square-o"></i> Create User
        </a>

        <table class="table table-striped" id="datatable">
            <thead>
            <th class="sorting" data-sort_type="asc" data-column_name="id">
                User Id <i id="id_icon" class="fa fa-sort-alpha-asc active"></i>
            </th>
            <th class="sorting" data-sort_type="asc" data-column_name="name">
                User Name <i id="name_icon" class="fa fa-sort-alpha-asc"></i>
            </th>
            <th class="sorting" data-sort_type="asc" data-column_name="email">
                Email <i id="email_icon" class="fa fa-sort-alpha-asc"></i>
            </th>
            <th class="sorting" data-sort_type="asc" data-column_name="roles">
                Roles <i id="role_icon" class="fa fa-sort-alpha-asc"></i>
            </th>

            <th class="text-right">Actions</th>
            <tr>
                <td>
                    <input type="text" class="form-control filter-input" data-column="id">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="name">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="email">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" data-column="roles">
                </td>
            </tr>
            </thead>

            <tbody>
            @include('admin.user_managment.partials.user_table')
            </tbody>
        </table>

        <input type="hidden" name="sort_column_name" id="sort_column_name" value="id">
        <input type="hidden" name="sort_type" id="sort_type" value="asc">
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            function fetch_data(sort_type, sort_by) {

                var url = '/admin/user_managment/user?sort_by=' + sort_by + '&sort_type=' + sort_type;

                var filterParams = getFilterParams();

                if (Object.keys(filterParams).length > 0) {
                    for (key in filterParams) {
                        url += ('&s_' + key + '=' + encodeURI(filterParams[key]));
                    }
                }

                $.ajax({
                    url: url,
                    success:function (data) {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                });
            }

            function getFilterParams(){

                var filters = [];

                $('.filter-input').each(function() {
                    if ($(this).val() != ''){
                        filters[$(this).data('column')] = $(this).val();
                    }
                });

                return filters;
            }

            $(document).on('click', '.sorting', function () {
                var column_name = $(this).data('column_name');
                var order_type = $(this).data('sort_type');
                var reverse_order = '';

                $('.sorting i').removeClass('active');

                if (order_type == 'asc') {
                    $(this).data('sort_type', 'desc');
                    reverse_order = 'desc';
                    $('#' + column_name+'_icon').addClass('fa-sort-alpha-desc');
                    $('#' + column_name+'_icon').removeClass('fa-sort-alpha-asc');
                } else if (order_type == 'desc') {
                    $(this).data('sort_type', 'asc');
                    reverse_order = 'asc';
                    $('#' + column_name+'_icon').addClass('fa-sort-alpha-asc');
                    $('#' + column_name+'_icon').removeClass('fa-sort-alpha-desc');
                }

                $('#' + column_name+'_icon').addClass('active');

                $('#sort_column_name').val(column_name);
                $('#sort_type').val(reverse_order);

                fetch_data(reverse_order, column_name);
            });

            $(document).on('change submit',function () {
                var sort_column_name = $('#sort_column_name').val();
                var reverse_order =  $('#sort_type').val();

                fetch_data(reverse_order, sort_column_name);
            })
        });
    </script>
@endsection
