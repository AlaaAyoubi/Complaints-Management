<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit a New Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.complaints.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="complaint_type_id" :value="__('Type of Complaint')" />
                            <select id="complaint_type_id" name="complaint_type_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">{{ __('Select a type') }}</option>
                                @foreach ($complaintTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('complaint_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->type }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('complaint_type_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="details" :value="__('Complaint Details')" />
                            <textarea id="details" name="details" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('details') }}</textarea>
                            <x-input-error :messages="$errors->get('details')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Submit Complaint') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>