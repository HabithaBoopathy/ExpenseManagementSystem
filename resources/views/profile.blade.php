@extends('layouts.app')

@section('content')
<style>
    .sidebar-expanded {
        min-height: 100vh;
    }
</style>

<div class="container-fluid bg-light min-vh-100 px-0">
    <div class="row g-0">
        <!-- Toggle Button (Mobile) -->
        <div class="d-md-none bg-primary text-white p-2">
            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                ☰ Menu
            </button>
        </div>

        <!-- Sidebar (Offcanvas for Mobile, Static for Desktop) -->
        <div class="col-md-3 col-lg-2 text-white sidebar-expanded d-none d-md-block p-4" style="background-color: #2e2e2e;">
        <h5 class="fw-bold mb-4">📊 Dashboard</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white {{ request()->routeIs('expenses.index') ? 'fw-bold' : '' }}" href="{{ route('expenses.index') }}">
                        <i class="bi bi-house-door me-2"></i> View Expenses
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white {{ request()->routeIs('expenses.create') ? 'fw-bold' : '' }}" href="{{ route('expenses.create') }}">
                        <i class="bi bi-plus-circle me-2"></i> Add Expense
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white {{ request()->routeIs('reports.monthly') ? 'fw-bold' : '' }}" href="{{ route('reports.monthly') }}">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Report
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white {{ request()->routeIs('budget.create') ? 'fw-bold' : '' }}" href="{{ route('budget.create') }}">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i> Monthly Budget
                    </a>
                </li>
            </ul>
        </div>

        <!-- Offcanvas Sidebar for Mobile -->
        <div class="offcanvas offcanvas-start bg-primary text-white" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="mobileSidebarLabel">Dashboard Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('expenses.index') }}">
                            <i class="bi bi-house-door me-2"></i> View Expenses
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('expenses.create') }}">
                            <i class="bi bi-plus-circle me-2"></i> Add Expense
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('reports.monthly') }}">
                            <i class="bi bi-file-earmark-bar-graph me-2"></i> Generate Report
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="bg-custom-lightgrey p-4 rounded shadow-sm">
                <h2 class="mb-3">👋 Welcome, {{ Auth::user()->name }}</h2>
                <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p class="text-muted">You are successfully logged in and ready to manage your expenses.</p>
            </div>
        </div>
    </div>
</div>
@endsection
