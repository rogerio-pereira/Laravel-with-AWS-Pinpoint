<layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Templates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="bg-white shadow-sm sm:rounded-lg w-full shadow">
                <div class='p-6'>
                    <div class='flex'>
                        {{-- Name --}}
                        <div class="w-1/2 col-span-full mb-6">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" wire:model="name" id="name" autocomplete="name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Template Name">
                                </div>
                            </div>
                            @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>

                        {{-- Subject --}}
                        <div class="w-1/2 mb-6">
                            <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Subject</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" wire:model="subject" id="subject" autocomplete="subject" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Subject">
                                </div>
                            </div>
                            @error('subject') <small class="text-red-500">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    {{-- HTML --}}
                    <div class="col-span-full mb-6">
                        <label for="html" class="block text-sm font-medium leading-6 text-gray-900">Html Content</label>
                        <div class="mt-2">
                            <textarea id="html" wire:model="html" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('html') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>

                    {{-- Text --}}
                    <div class="col-span-full mb-6">
                        <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Text Content</label>
                        <div class="mt-2">
                            <textarea id="text" wire:model="text" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        @error('text') <small class="text-red-500">{{ $message }}</small> @enderror
                    </div>

                    <div class="mt-6 mb-6 flex items-center justify-end">
                        <button wire:click='save' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                    </div>

                    @if (session('status'))
                        <div class="{{ session('status') == 'success' ? 'bg-green-300 text-green-800' : 'bg-red-300 text-red-800'}} p-4 rounded">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<layout>
