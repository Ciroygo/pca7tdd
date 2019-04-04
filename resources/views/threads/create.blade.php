@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" rows="5" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-primary" type="submit">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection