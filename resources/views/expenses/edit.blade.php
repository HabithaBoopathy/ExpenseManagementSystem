@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Optional Sidebar Space -->
        <div class="col-md-3 col-lg-2"></div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-8 bg-white shadow-sm rounded-4 p-4">
            <h2 class="mb-4">Edit Expense</h2>

            <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input 
                        type="number" 
                        name="amount" 
                        id="amount" 
                        class="form-control @error('amount') is-invalid @enderror" 
                        value="{{ old('amount', $expense->amount) }}" 
                        step="0.01" 
                        required
                    >
                    @error('amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                
                <div class="form-group">
    <label for="date">Date</label>
    @php
        use Carbon\Carbon;
    @endphp

    <!-- Date Input with properly formatted value -->
    <input type="date" name="date" id="date" class="form-control"
           value="{{ Carbon::parse($expense->date)->format('Y-m-d') }}" required>
</div>

<script>
    // Allowed months in "YYYY-MM" format, passed from the controller
    const allowedMonths = @json($allowedMonths);

    // Listen for any changes in the date input
    document.getElementById('date').addEventListener('change', function () {
        const selectedDate = new Date(this.value);
        const selectedMonth = selectedDate.toISOString().slice(0, 7); // "YYYY-MM" format

        // Check if the selected month is in the list of allowed months
        if (!allowedMonths.includes(selectedMonth)) {
            alert('You can only select a date in a month where a budget is set.');
            this.value = ''; // Clear invalid value
        }
    });
</script>



                <div class="mb-3">
                    <label for="description" class="form-label">Description (optional)</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control" 
                        rows="3"
                        placeholder="Add a note or detail (optional)"
                    >{{ old('description', $expense->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Expense</button>
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
