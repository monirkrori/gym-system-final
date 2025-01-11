@extends('layouts.dashboard')

@section('content')
    <h1>خطط العضوية المحذوفة</h1>
    <table class="table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deletedMembershipPlans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->status }}</td>
                    <td>
                        <!-- Restore button -->
                        <form action="{{ route('admin.membership-plan.restore', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">استرجاع</button>
                        </form>

                        <!-- Force delete button -->
                        <form action="{{ route('admin.membership-plan.force-delete', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من أنك تريد حذف خطة العضوية هذه بشكل نهائي؟')">حذف نهائي</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
