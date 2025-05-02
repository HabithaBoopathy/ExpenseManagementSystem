@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Set Monthly Budget</h2>
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>
</div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('budget.store') }}">
        @csrf

        <div class="form-group">
            <label for="month">Month</label>
            <select name="month" id="month" class="form-control" required>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ date('Y') }}" required>
        </div>

        <div class="form-group">
            <label for="budgetamount">Budget Amount</label>
            <input type="number" name="budgetamount" id="budgetamount" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Budget</button>
    </form>

    {{-- Budget History --}}
    <hr>
    <h3 class="mt-4">Your Saved Budgets</h3>

    @if($budgets->isEmpty())
        <p>No budgets found.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($budgets as $budget)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($budget->date)->format('F') }}</td>
                        <td>{{ \Carbon\Carbon::parse($budget->date)->format('Y') }}</td>
                        <td>${{ number_format($budget->budgetamount, 2) }}</td>
                        <td>
                            <a href="{{ route('budget.edit', $budget->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('budget.destroy', $budget->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this budget?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection