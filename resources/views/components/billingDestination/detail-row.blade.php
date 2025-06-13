<tr>
    <td class="px-6 py-4">
        <x-form.input name="properties[{{$index}}][name]" type="text" placeholder="物件名" :value="old('properties.'.$index.'.name', $property['name']??'')" />
        @error("properties.$index.name")
            <x-form.error>{{ $message }}</x-form.error>
        @enderror
    </td>
    <td class="px-6 py-4">
        <x-form.input name="properties[{{$index}}][address]" type="text" placeholder="住所" :value="old('properties.'.$index.'.address', $property['address']??'')" />
        @error("properties.$index.address")
            <x-form.error>{{ $message }}</x-form.error>
        @enderror
    </td>
    <td class="px-6 py-4">
        <x-button type="button" scheme="scraft" onClick="removePropertyRow(this)">削除</x-button>
    </td>
</tr>
