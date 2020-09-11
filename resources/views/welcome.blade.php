@extends('layout/app')
@section('title', 'Home page')

@section('content')
    <div class="container">
        <form action="{{route('getUrl')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="url">URL to product or category</label>
                <input type="text" id="url" name="url"
                       class="form-control form-control-lg {{($errors->has('url')) ? 'is-invalid' : ''}}">
                @if ($errors->has('url'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('url') }}</strong>
                  </span>
                @endif
            </div>

            <button class="btn btn-primary" type="submit">Get products</button>
        </form>
    </div>
@endsection
