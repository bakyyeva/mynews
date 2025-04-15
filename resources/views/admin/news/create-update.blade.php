@extends('layouts.admin')

@section('title')
    New {{ isset($new) ? 'Update' : 'Add' }}
@endsection

@section('css')
@endsection

@section('content')
    <x-bootstrap.card>
        <x-slot:header>
             New {{ isset($new) ? 'Update' : 'Add' }}
        </x-slot:header>
        <x-slot:body>
            <x-errors.display-error />
            <form action="{{ isset($new) ? route('new.edit', ['id' => $new->id]) : route('new.create') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="newForm">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-6 col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text"
                               class="form-control mb-3"
                               aria-label="default input example"
                               placeholder="Name"
                               name="name"
                               id="name"
                               value="{{ isset($new) ? $new->name : old('name') }}"
                        >
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="5" cols="60">{{ isset($new) ? $new->description : old('description') }}</textarea>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="image" class="form-label m-t-sm">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                       @if(isset($new) && $new->image)
                            <img src="{{ asset($new->image) }}" class="img-fluid mt-3" style="max-height: 200px">
                       @endif
                    </div>
                    <div class="col-md-6">
                        <label for="author_id" class="form-label">Authors</label>
                                <select
                                    class="form-select form-control form-control-solid-bordered m-b-sm"
                                    aria-label="Authors"
                                    name="author_id"
                                    id="author_id"
                                >
                                    <option value="{{ null }}">Choice Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ isset($new) && $new->author->id == $author->id ? 'selected' : ""}}>
                                            {{ $author->username }}
                                        </option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" class="mt-2 btn btn-success btn-rounded w-100" id="btnSave">
                            {{ isset($new) ? 'Update' : 'Add' }}
                        </button>
                    </div>
                </div>
            </form>
        </x-slot:body>
    </x-bootstrap.card>

@endsection

@section('js')
@endsection


