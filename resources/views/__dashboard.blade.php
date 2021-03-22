<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div> --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="col-md-8">
                        <div class="card-header">{{ __('Subir archivos') }}</div>
                    </div>
                    <form action="{{ route('user.files.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="files[]" multiple class="form-control" required>
                        <button type="submit" class="mt-4 btn btn-primary float-right">
                            Subir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
