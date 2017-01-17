@extends('layouts.manageLayout', ['active' => 'hot'])
@section('content')
    <h2>热门列表</h2>
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
        @foreach($hot_data as $each)
            <tr id="{{ $each->id }}">
                <td>{{ $each->id }}</td>
                <td><a href="{{ url('show', $each->id) }}">{{ $each->name }}</a></td>
                <td>{{ $each->create_time }}</td>
                <td>
                    <button class="btn btn-success" onclick="hot('0', '{{ $each->id }}');">
                        取消热门
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">{!! $hot_data->render() !!}</div>

    <hr>

    <h2>添加热门</h2>
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
                    <button class="btn btn-success" onclick="hot('1', '{{ $each->id }}');">
                        添加热门
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pull-right">{!! $data->render() !!}</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="hotModal">
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
        function hot(type, mid) {
            $.post("{{ url('hot') }}", {"type": type, "mid": mid}, function () {
                $('#' + mid).remove();
                $('#hotModal').modal();
            })
        }
    </script>
@endsection