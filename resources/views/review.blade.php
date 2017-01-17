@extends('layouts.manageLayout', ['active' => 'review'])
@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <td>编号</td>
            <td>名称</td>
            <td>时间</td>
            <td>操作</td>
        </tr>
        </thead>

        <tbody>
        @foreach($data as $each)
            <tr id="{{ $each->id }}">
                <td>{{ $each->id }}</td>
                <td><a href="{{ url('show', $each->id) }}">{{ $each->name }}</a></td>
                <td>{{ $each->create_time }}</td>
                <td>
                    <button class="btn btn-success" onclick="review(1, {{ $each->id }});">通过</button>
                    &nbsp;|&nbsp;
                    <button class="btn btn-danger" onclick="review(-1, {{ $each->id }});">不通过</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">{!! $data->render() !!}</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="reviewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">提示</h4>
                </div>
                <div class="modal-body">
                    操作成功
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function review(available, id) {
            $.post("{{ url('review') }}", {"available": available, "id": id}, function () {
                $('#' + id).remove();
                $('#reviewModal').modal();
            })
        }
    </script>
@endsection