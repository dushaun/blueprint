@extends('common.template')

@section('heading')
    Files
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Last Modified</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file['name'] }}</td>
                        <td>{{ $file['size'] }}</td>
                        <td>{{ $file['last_modified'] }}</td>
                        <td>
                            {!! Form::open(array('route' => ['uploads.download'])) !!}
                            {!! Form::hidden('file', $file['name']) !!}
                            {!! Form::submitButton('Download') !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection