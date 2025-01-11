@extends('layouts.dashboard')

@section('title', 'المدربين المحذوفين')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">المدربين المحذوفين</h1>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>اسم المدرب</th>
                            <th>التخصص</th>
                            <th>الخبرة (سنوات)</th>
                            <th>التقييم</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletedTrainers as $trainer)
                            <tr>
                                <td>{{ $trainer->user->name }}</td>
                                <td>{{ $trainer->specialization }}</td>
                                <td>{{ $trainer->experience_years }}</td>
                                <td>{{ $trainer->rating_avg }}</td>
                                <td>
                                    <span class="badge {{ $trainer->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $trainer->status }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Restore button -->
                                    <form action="{{ route('admin.trainer.restore', $trainer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="استرجاع">
                                            <i class="bi bi-arrow-counterclockwise"></i> استرجاع
                                        </button>
                                    </form>

                                    <!-- Force delete button -->
                                    <form action="{{ route('admin.trainer.force-delete', $trainer->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف نهائي"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا المدرب بشكل نهائي؟')">
                                            <i class="bi bi-trash"></i> حذف نهائي
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
