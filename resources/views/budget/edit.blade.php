
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Budget</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('budget.update', $budget->id) }}" method="POST">
        @csrf
        @method('PUT')

        @php
            // Extract year and month from the date
            $month = \Carbon\Carbon::parse($budget->date)->format('m');
            $year = \Carbon\Carbon::parse($budget->date)->format('Y');
        @endphp

        <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <select name="month" id="month" class="form-select" required>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ $year }}" required>
        </div>

        <div class="mb-3">
            <label for="budgetamount" class="form-label">Budget Amount</label>
            <input type="number" name="budgetamount" id="budgetamount" class="form-control" step="0.01" value="{{ $budget->budgetamount }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Budget</button>
        <a href="{{ route('budget.create') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
