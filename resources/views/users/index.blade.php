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
    <div class="alert alert-success">
      <p>{{ $message }}</p>
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
