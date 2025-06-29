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
    .btn-delete {
        width: 100px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 12px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        border-radius: 6px;
        color: white;
        background-color: #F59E0B;
    }

    .btn-edit:hover,
    .btn-delete:hover {
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
</style>
@section('content')
<div class="table-container rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">CUSTOMERS</h1>

    <div class="bg-orange-100 rounded-lg  scrollable-table-wrapper">
        <table class="w-full">
            <thead class="bg-[#FEB87A]">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">User ID</th>
                    <th class="px-6 py-3 text-left font-semibold">Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Email</th>
                    <th class="px-6 py-3 text-left font-semibold">Phone No.</th>
                    <th class="px-6 py-3 text-left font-semibold">Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                <tr class="border-b border-orange-200 hover:bg-orange-50 odd:bg-orange-100 even:bg-[#E8C7AA]">
                    <td class="px-6 py-4">{{ $customer->id }}</td>
                    <td class="px-6 py-4">{{ $customer->name }}</td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $customer->address ?? 'N/A' }}</td>
                </tr>
                <td class="px-6 py-4 space-x-2">
                    <form action="{{ route('admin.customers.delete', $customer->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>
                </td>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-2"></i>
                        <p>No customers found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection