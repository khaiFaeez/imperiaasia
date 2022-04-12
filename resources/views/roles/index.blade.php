
<x-app-layout>
 <x-slot name="header">
        <h2 class="font-semibold text-xl  leading-tight">
            {{ __('Role Management') }}
        </h2>
    </x-slot>
    <x-slot name="slot">



@if ($message = Session::get('success'))

<div x-data="{show: true}" x-init="setTimeout(() => show = false, 1000)" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-show="show">
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
</div>
@endif


<table class="table table-bordered w-full">
<thead>
  <tr>
     <th>No</th>
     <th>Name</th>
  </tr>
  </thead>
  <tbody>
    @foreach ($roles as $key => $role)
    <tr class="hover hover:cursor-pointer" onclick="location.href='{{ route('roles.edit',$role->id) }}';">
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
    </tr>
    @endforeach
    </tbody>
</table>


{!! $roles->render() !!}
</x-slot>
</x-app-layout>
