@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
          <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>
</div>
        <div class="col-md-9 col-lg-10 ps-md-4 pt-3">
            <h2 class="mb-3">My Expenses</h2>
           

            <!-- Filter Form -->
            <form method="GET" action="{{ route('expenses.index') }}" class="row g-3 mb-4">
                <div class="col-md-2">
                    <label class="form-label">From</label>
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">To</label>
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
    <label class="form-label">Min Amount</label>
    <div class="input-group">
        <span class="input-group-text">₹</span> <!-- Indian Rupee Symbol -->
        <input type="number" step="0.01" name="min_amount" class="form-control" value="{{ request('min_amount') }}">
    </div>
</div>
<div class="col-md-2">
    <label class="form-label">Max Amount</label>
    <div class="input-group">
        <span class="input-group-text">₹</span> <!-- Indian Rupee Symbol -->
        <input type="number" step="0.01" name="max_amount" class="form-control" value="{{ request('max_amount') }}">
    </div>
</div>

                
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                
                
            </form>

            <!-- Expense Table -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->category->name }}</td>
                                <td>₹{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->description ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this expense?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No expenses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ✅ SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ SweetAlert2 Toast Messages -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@endsection
