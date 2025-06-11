<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Complaint Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.complaint_types.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="type" :value="__('Complaint Type Name')" />
                            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus />
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Add Complaint Type') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>