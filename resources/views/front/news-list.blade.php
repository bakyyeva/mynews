
@extends('layouts.front')

@section('title')
    My News List
@endsection

@section('css')
@endsection

@section('content')
<x-bootstrap.card>
    <x-slot:header>
        <div class="d-flex justify-content-between align-items-center mt-5">
            <div>My News List</div>
            <div class="d-flex">
                @can('new_add')
                    <a href="{{ route('front.new-create') }}"
                        class="btn btn-success btn-sm ms-2">
                        Add
                    </a>
                @endcan
            </div>
        </div>
    </x-slot:header>
    <x-slot:body>
        <x-bootstrap.table
            :class="'mb-0 table-striped'"
        >
            <x-slot:columns>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </x-slot:columns>

            <x-slot:rows>
                @foreach($news as $new)
                    <tr id="row-{{ $new->id }}">
                        <td>{{ $new->id }}</td>
                        <td>{{ $new->name }}</td>
                        <td> {{ substr($new->description, 0, 50) }} </td>
                        <td>
                            <div class="d-flex">
                                @can('new_edit')
                                    <a href="{{ route('front.news-edit', ['id' => $new->id]) }}"
                                        class="ms-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                    </a>
                                @endcan
                                    <a href="{{ route('news.detail', ['id' => $new->id]) }}"
                                        class="ms-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                          </svg>
                                    </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-slot:rows>
        </x-bootstrap.table>
    </x-slot:body>
</x-bootstrap.card>
@endsection

@section('js')
@endsection
