<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Complaint Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Complaint ID:') }} {{ $complaint->id }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ __('Complaint Type:') }}</p>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $complaint->complaintType->type }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ __('Submission Date:') }}</p>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $complaint->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ __('Current Status:') }}</p>
                            <span class="mt-1 px-2 inline-flex text-lg leading-5 font-semibold rounded-full
                                @if ($complaint->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif ($complaint->status == 'in_progress') bg-blue-100 text-blue-800
                                @elseif ($complaint->status == 'resolved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-700">{{ __('Complaint Description:') }}</p>
                        <p class="mt-1 p-4 bg-gray-50 rounded-md text-gray-800 leading-relaxed">
                            {{ $complaint->details }}
                        </p>
                    </div>

                    <div class="mt-6 text-right">
                        <a href="{{ route('user.complaints.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Back to My Complaints') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>