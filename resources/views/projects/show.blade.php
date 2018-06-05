@extends('common.template')

@section('heading')
    Project: {{ $project->name }}
@endsection

@section('content')
    <p>{{ $project->description }}</p>

    {!! Form::open(['route' => ['uploads.store'], 'files' => true]) !!}

    {!! Form::hidden('project_id', $project->id) !!}

    @include('projects.partials.upload')

    <div class="box box-primary">
        <div class="box-body no-padding">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file }}</td>
                        <td>
                            {!! Form::open(array('route' => ['uploads.download'])) !!}
                            {!! Form::hidden('file', $file) !!}
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