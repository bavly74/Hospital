<tr>
    <td>{{ $group->id}}</td>
    <td>{{ $group->name }}</td>
    <td>{{ number_format($group->Total_with_tax, 2) }}</td>
    <td>{{ $group->notes }}</td>
    <td>
        <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $group->id }})"><i class="fa fa-trash"></i></button>
    </td>
</tr>
