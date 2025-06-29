@extends('admin.layout')

@section('title', 'Customers Management')
<style>
    .table-container {
        width: 100%;
        min-height: 80vh;
        background-color: #DAB08A;
        color: black;
    }

    thead {
        background-color: #FEB87A;
    }

    th, td {
        padding: 1rem 1.25rem;
        word-wrap: break-word;
        max-width: 200px;
        color: #2B1500;
    }

    tbody td {
        background-color: #FAE3C2;
    }

    tbody tr:nth-child(even) td {
        background-color: #F7D7AE;
    }

    .btn-primary {
        background-color: #F59E0B;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #B45309;
        transform: translateY(-1px);
    }

    .btn-edit,
    .btn-delete,
    .btn-view {
        width: 100px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 2%;
        padding: 0 12px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        border-radius: 6px;
        color: white;
        background-color: #F59E0B;

        i {
            padding-right: 2%;
        }
    }

    .btn-edit:hover,
    .btn-delete:hover,
    .btn-view:hover, {
        background-color: #B45309;
    }

    .no-products {
        color: #4B5563;
    }

    .scrollable-table-wrapper {
        overflow-x: auto;
        overflow-y: auto;
        max-height: 80vh;
    }

    .scrollable-table-wrapper::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-track {
        background: #FAE3C2;
        border-radius: 6px;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-thumb {
        background-color: #F59E0B;
        border-radius: 6px;
        border: 2px solid #FAE3C2;
    }

    .scrollable-table-wrapper::-webkit-scrollbar-thumb:hover {
        background-color: #B45309;
    }

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .alert-success {
        background-color: #D1FAE5;
        color: #065F46;
        border: 1px solid #A7F3D0;
    }

    .alert-error {
        background-color: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .btn-container {
        display: flex;
        flex-direction: column;
    }
</style>

@section('content')
<div class="table-container rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">CUSTOMERS</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-orange-100 rounded-lg scrollable-table-wrapper">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">User ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Username</th>
                    <th class="px-6 py-3 text-left font-semibold">Email</th>
                    <th class="px-6 py-3 text-left font-semibold">Phone No.</th>
                    <th class="px-6 py-3 text-left font-semibold">Gender</th>
                    <th class="px-6 py-3 text-left font-semibold">Date of Birth</th>
                    <th class="px-6 py-3 text-left font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $customer->id }}</td>
                    <td class="px-6 py-4">{{ $customer->name }}</td>
                    <td class="px-6 py-4">{{ $customer->username ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->phonenumber ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ ucfirst($customer->gender ?? 'N/A') }}</td>
                    <td class="px-6 py-4">{{ $customer->dob ? date('M d, Y', strtotime($customer->dob)) : 'N/A' }}</td>
                    <td class="px-6 py-4 space-x-1 btn-container">
                        <a href="{{ route('admin.customers.show', $customer->id) }}" 
                           class="btn-edit btn-view">
                            <i class="fas fa-eye"></i> View
                        </a>
                        
                        <a href="{{ route('admin.customers.edit', $customer->id) }}" 
                           class="btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <button onclick="openDeleteConfirm({{ $customer->id }}, '{{ $customer->name }}')" class="btn-delete" title="Delete Customer">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2"></i>
                        <p>No customers found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md">
        <div class="flex items-center gap-3 mb-4">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl"></i>
            <h2 class="text-xl font-bold text-gray-800">Confirm Deletion</h2>
        </div>
        <p class="text-gray-700 mb-6">Are you sure you want to permanently delete customer <span id="deleteCustomerName" class="font-semibold"></span>? This action cannot be undone.</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-4">
                <button type="button" onclick="closeDeleteConfirm()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-4 py-2 rounded-lg">Cancel</button>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteConfirm(id, name) {
    document.getElementById('deleteCustomerName').innerText = name;
    document.getElementById('deleteForm').action = `/admin/customers/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteConfirm() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

@if(session('success'))
<div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="success-alert">
    <div class="flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
</div>
<script>
    setTimeout(() => document.getElementById('success-alert').style.display = 'none', 3000);
</script>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" id="error-alert">
    <div class="flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
</div>
<script>
    setTimeout(() => document.getElementById('error-alert').style.display = 'none', 3000);
</script>
@endif
@endsection