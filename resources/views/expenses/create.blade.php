@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Expense</h1>

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('expense_category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" step="0.01" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->
        <div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" id="date" class="form-control" required>
</div>

<script>
    const allowedMonths = @json($allowedMonths);

    document.getElementById('date').addEventListener('change', function () {
        const selectedDate = new Date(this.value);
        const selectedMonth = selectedDate.toISOString().slice(0, 7); // "YYYY-MM"

        if (!allowedMonths.includes(selectedMonth)) {
            alert('You can only add expenses for months that have a budget set.');
            this.value = ''; // Clear the invalid input
        }
    });
</script>



        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Expense</button>
    </form>

    <a href="{{ route('profile') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
