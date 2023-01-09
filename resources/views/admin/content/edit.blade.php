@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('style')
    <style>
        #value {
            display: none;
        }

    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @include('include.message')
            <form action="{{ route('updateContent') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{ $model->key }}
                                <i class="fa fa-info-circle info"
                                    title="{{ __('Use the given HTML formatter only. Directly used HTML will be saved as plain text') }}"></i>
                            </label>
                            <input type="hidden" name="id" value="{{ $model->id }}">
                            <textarea id="value" rows="6" name="value"
                                class="form-control {{ $errors->has('value') ? ' is-invalid' : '' }}">{{ old($model->value) ?? $model->value }}</textarea>
                            @if ($errors->has('value'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                <a href="{{ route('content') }}"><button type="button"
                        class="btn btn-default">{{ __('Back') }}</button></a>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function() {
            CKEDITOR.replace('value', {
                toolbarGroups: [{
                        "name": "basicstyles",
                        "groups": ["basicstyles", "links"]
                    },
                    {
                        "name": 'paragraph',
                        "groups": ['list']
                    },
                    {
                        "name": "styles",
                        "groups": ["styles"]
                    },
                ],
                removeButtons: 'Styles,Font,FontSize,Superscript,Subscript,Strike,Anchor',
                language: '{{ getSelectedLanguage()->name }}'
            });
        });
    </script>
@endsection
