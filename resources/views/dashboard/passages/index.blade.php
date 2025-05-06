@extends('dashboard.layouts.master')
@section('title', 'قائمة القطع التعليمية')
@section('css')
<style>
    :root {
        --primary-color: #6c5ce7;
        --secondary-color: #a29bfe;
        --accent-color: #fd79a8;
    }
    
    .compact-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .compact-table th {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        background-color: #f8f9fa;
    }
    
    .compact-table td {
        font-size: 0.82rem;
        padding: 0.5rem 0.75rem;
        vertical-align: middle;
    }
    
    .action-btn {
        width: 26px;
        height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        margin: 0 2px;
        font-size: 0.8rem;
    }
    
    .btn-view {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .btn-edit {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .btn-delete {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .badge-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .search-box {
        width: 160px;
        font-size: 0.8rem;
    }
    
    .empty-state {
        padding: 1.5rem;
    }
    
    .pagination-sm .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0 text-primary">
            <i class="fas fa-book-open me-1"></i>القطع التعليمية
        </h5>
        <a href="{{ route('passages.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>إضافة
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2 mb-3" role="alert">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="compact-card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table compact-table mb-0">
                    <thead>
                        <tr>
                            <th width="40">#</th>
                            <th>العنوان</th>
                            <th width="90">النوع</th>
                            <th width="120">المادة</th>
                            <th width="100">التاريخ</th>
                            <th width="80">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($passages as $passage)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="text-truncate d-flex align-items-center">
                                    {{-- <i class="fas fa-book text-primary me-2">  </i> --}}
                                    <span  style="max-width: 150px;">{{ $passage->title }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-sm rounded-pill {{ $passage->type === 'قراءة' ? 'bg-success' : 'bg-primary text-dark' }}">
                                    {{ $passage->type }}
                                </span>
                            </td>
                            <td class="text-truncate" style="max-width: 120px;">
                                {{ $passage->subject->name ?? 'غير محدد' }}
                            </td>
                            <td class="text-muted">
                                {{ $passage->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('passages.edit', $passage->id) }}" class="action-btn btn-edit" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('passages.destroy', $passage->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">
                                <div class="empty-state text-center">
                                    <i class="fas fa-book-open fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-2">لا توجد قطع تعليمية</p>
                                    <a href="{{ route('passages.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-1"></i> إضافة قطعة
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($passages->hasPages())
        <div class="card-footer py-2">
            <div class="d-flex justify-content-center">
                {{ $passages->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
</div>

@section('js')
<script>
    // Delete confirmation
    function confirmDelete(e) {
        if(!confirm('هل أنت متأكد من حذف هذه القطعة؟')) {
            e.preventDefault();
        }
    }
    
    // Add click event to all delete buttons
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', confirmDelete);
    });
</script>
@endsection