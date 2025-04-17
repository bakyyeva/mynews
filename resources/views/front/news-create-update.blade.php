@extends('layouts.front')

@section('title')
    News {{ isset($new) ? 'Update' : 'Add' }}
@endsection

@section('css')
@endsection

@section('content')
    <x-bootstrap.card>
        <x-slot:header>
            <div class="mt-5">
                News {{ isset($new) ? 'Update' : 'Add' }}
            </div>
        </x-slot:header>
        <x-slot:body>
            <x-errors.display-error />
            <form action="{{ isset($new) ? route('front.news-edit', ['id' => $new->id]) : route('front.new-create') }}"
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
                               required
                               value="{{ isset($new) ? $new->name : old('name') }}"
                        >
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="5" cols="60" required>{{ isset($new) ? $new->description : old('description') }}</textarea>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="image" class="form-label m-t-sm">Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                       @if(isset($new) && $new->image)
                            <img src="{{ asset($new->image) }}" class="img-fluid mt-3" style="max-height: 200px">
                       @endif
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


