@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('student/student-teacher-homeroom/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<form id="filterForm" method="GET" action="{{ route('student-teacher-homeroom.index') }}" class="mb-4">
    <div class="row mb-3">
        <div class="col-md-2">
            <label for="classroom" class="form-label">Classroom</label>
            <select name="classroom" id="classroom" class="form-select data-select-2" onchange="this.form.submit()">
                <option value="">Select Classroom</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ request('classroom') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Student</th>
                <th>Teacher Homeroom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentTeacherHomeroomRelationships as $index => $studentTeacherHomeroomRelationship)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $studentTeacherHomeroomRelationship->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }}</td>
                <td>{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->identity_number }} -{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <a title="Lihat" href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                            <a title="Edit" href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $studentTeacherHomeroomRelationship->student->name }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
