<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="col-md-8">
                        <div class="card-header">{{ __('Lista de archivos') }}</div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre del archivo</th>
                                <th scope="col">Ruta</th>
                                <th scope="col">Ver</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                            <tr>
                                <th scope="row">{{ $file->id }}</th>
                                <td>{{ $file->name }}</td>
                                <td>{{ public_path() }}s</td>
                                <td>
                                    {{-- <a href="storage/app/public/{{ Auth::id() }}/{{ $file->name }}" class="btn btn-sm btn-outline-secondary">Ver</a> --}}
                                    {{-- <a href="{{ route('user.files.ver',$file->name) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Ver</a> --}}
                                    <a href="{{ route('user.files.show',$file->code_name) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Ver</a>
                                </td>
                                <td>
                                    <form action="{{ route('user.files.destroy',$file->code_name) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>