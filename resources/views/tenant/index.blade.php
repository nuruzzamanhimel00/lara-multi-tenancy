<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <a href="{{route('tenants.create')}}" class="btn btn-primary">Create Tenant</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Domain</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($tenants as $tenant)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$tenant->name}}</td>
                                <td>{{$tenant->email}}</td>
                                <td>{{$tenant->domains->pluck('domain')->implode(', ')}}</td>
                                <td>
                                    <a href="{{route('tenants.edit', $tenant->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('tenants.destroy', $tenant->id)}}" class="btn btn-danger">Delete</a>
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
