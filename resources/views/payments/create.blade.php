@extends('layouts.app')

@section('title', 'Process Payment - Harbour')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Process Payment</h2>
        
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Summary</h3>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Room Type</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ ucwords(str_replace('_', ' ', $booking->room->room_type)) }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Total Amount</dt>
                    <dd class="mt-1 text-sm text-gray-900">${{ number_format($booking->total_price, 2) }}</dd>
                </div>
            </dl>
        </div>

        <form action="{{ route('payments.store', $booking) }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="payment_method" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Cash">Cash</option>
                </select>
                @error('payment_method')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                Process Payment
            </button>
        </form>
    </div>
</div>
@endsection 