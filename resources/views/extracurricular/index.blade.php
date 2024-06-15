@extends('layouts.main')
@section('container')
    {{-- @if (session()->has('successMessage'))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if (session()->has('errorMessage'))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif --}}

    <a href="{{ URL::to('extracurricular/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus" aria-hidden="true"></i> Add</a>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th width="5%">No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extracurriculars as $index => $extracurricular)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $extracurricular->name }}</td>
                        <td class="align-middle">{{ $extracurricular->description }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a title="Lihat" href="{{ URL::to('extracurricular/' . $extracurricular->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ URL::to('extracurricular/' . $extracurricular->id . '/edit') }}"
                                    class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                <form action="{{ URL::to('extracurricular/' . $extracurricular->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                        onclick="return confirm('Anda yakin mau menghapus data ini {{ $extracurricular->name }} ?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
