@foreach ($roles as $role)
    <tr>
        <td>{{ $role->name }}</td>
        <td>{{ $role->description }}</td>
        <td>
            <!-- Optional: Add "Assign Modules" button -->
            <a href="{{ route('role-modules.edit', $role->id) }}" class="text-blue-500 underline">
                Assign Modules
            </a>
        </td>
    </tr>
@endforeach
