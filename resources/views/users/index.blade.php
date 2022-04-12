<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>
 <x-slot name="slot">

    <div class="flex items-end justify-end mb-3">
            <a class="btn btn-neutral" href="{{ route('users.create') }}"> Create New User</a>
    </div>
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
   <th>Username</th>
   <th>Staff ID</th>
   <th>Roles</th>
 </tr>
 </thead>
 <tbody>
 @foreach ($data as $key => $user)

  <tr class="hover hover:cursor-pointer" onclick="location.href='{{ route('users.edit',$user->id) }}';">
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->staff_id }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
  </tr>
 @endforeach
 </tbody>
</table>


{!! $data->render() !!}
 </x-slot>
</x-app-layout>
