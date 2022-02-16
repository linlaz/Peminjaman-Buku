<div>
    {{-- In work, do what you enjoy. --}}
    <button type="button" wire:click="create" class="btn btn-secondary">Create New Publisher</button>
    @if ($form != null)
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name publisher</label>
            <input type="text" class="form-control" name="name_publisher" @if ($form == 'show') disabled @endif
                wire:model="name_publisher">
            @error('name_publisher')
                <div class="alert alert-danger my-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Address publisher</label>
            <input type="text" class="form-control" name="address_publisher" @if ($form == 'show') disabled @endif
                wire:model="address_publisher">
            @error('address_publisher')
                <div class="alert alert-danger my-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Desc publisher</label>
            <div>
                <div class="mb-3" wire:model.debounce.350ms="desc_address" wire:ignore>
                    <input id="desc_address" type="hidden" name="desc_address" value="{{ $desc_address }}">
                    <trix-editor input="desc_address" placeholder="Lintang penulis buku bergenre filsafat">
                    </trix-editor>
                </div>
                @error('desc_address')
                    <div class="alert alert-danger my-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        @if ($form != 'show')
            <button type="button" wire:click="{{ $form }}" class="btn btn-primary">{{ $form }}</button>
        @endif
        <button type="button" wire:click="cancel" class="btn btn-danger">Cancel</button>
    @endif

    <table id="example" class="table table-striped table-responsive" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allpublisher as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name_publisher }}</td>
                    <td>{!! Str::limit(strip_tags($item->address_publisher), 50) !!} </td>
                    <td>{!! Str::limit(strip_tags($item->desc_address), 50) !!}</td>
                    <td>
                        <button wire:click="edit('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-primary"><i
                                class="ri-edit-line"></i></button>
                        <button type="button" wire:click="show('{{ Crypt::encrypt($item->id) }} }}')"
                            class="btn btn-secondary"><i class="ri-eye-line"></i></button>
                        <button type="button"
                            onclick="confirm('Are you sure you want to delete this publisher ? delete category same you delete book in auhtor this') || event.stopImmediatePropagation()"
                            wire:click="destroy('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-success"><i
                                class="ri-delete-bin-7-line"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $allpublisher->links() }}
</div>
