@extends('layouts.dashboard')

@section('title', 'إدارة خطط الوجبات')

@push('styles')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        }

        body {
            background-color: #f4f7fa;
        }

        .stats-card {
            transition: all 0.4s ease;
            border-radius: 15px;
            overflow: hidden;
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0 50%; }
        }

        .stats-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
            transition: background-color 0.3s ease;
        }

        .action-buttons .btn {
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .action-buttons .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-box-seam me-2"></i> إدارة خطط الوجبات
            </h1>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.meal-plans.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> إضافة خطة جديدة
                </a>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card stats-card border-0 shadow-sm" style="background-image: var(--primary-gradient);">
                    <div class="card-body text-white">
                        <div class="d-flex align-items-center">
                            <div class="icon-box me-3">
                                <i class="bi bi-box-seam fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-subtitle mb-1 text-white-50">إجمالي الخطط</h6>
                                <h2 class="card-title mb-0">{{ $totalMealPlans }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.meal-plans.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="بحث باسم الخطة" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> بحث
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Main Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mealPlansTable" class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>اسم الخطة</th>
                                <th>السعرات اليومية</th>
                                <th>الوصف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mealPlans as $plan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->calories_per_day }}</td>
                                    <td>{{ Str::limit($plan->description, 50, '...') }}</td>
                                    <td>
                                        <div class="action-buttons d-flex gap-1">
                                            <a href="{{ route('admin.meal-plans.show', $plan->id) }}" class="btn btn-sm btn-info" title="عرض">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @can('manage-meal-plans')
                                            <a href="{{ route('admin.meal-plans.edit', $plan->id) }}" class="btn btn-sm btn-warning" title="تعديل">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.meal-plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $mealPlans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mealPlansTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json'
                },
                pageLength: 10,
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: [-1] }
                ]
            });
        });
    </script>
@endpush
