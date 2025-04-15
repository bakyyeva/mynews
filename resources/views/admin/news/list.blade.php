@extends('layouts.admin')

@section('title')
    News List
@endsection

@section('css')
@endsection

@section('content')
<x-bootstrap.card>
    <x-slot:header>
        <div class="d-flex justify-content-between align-items-center">
            <div>New List</div>
            <div class="d-flex">
                @can('new_add')
                    <a href="{{ route('new.create') }}"
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
                                    <a href="{{ route('new.edit', ['id' => $new->id]) }}"
                                        class="ms-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                          </svg>
                                    </a>
                                @endcan
                                @can('new_remove')
                                    <a href="javascript:void(0)"
                                        class="ms-2 btnDelete"
                                        data-id="{{ $new->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                          </svg>
                                    </a>
                                @endcan
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
