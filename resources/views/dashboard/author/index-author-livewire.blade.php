<div>
    {{-- In work, do what you enjoy. --}}
    <button type="button" wire:click="create" class="btn btn-secondary">Create New Author</button>
    @if ($form != null)
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name author</label>
            <input type="text" class="form-control" name="name_author" @if ($form == 'show') disabled @endif
                wire:model="name_author">
            @error('name_author')
                <div class="alert alert-danger my-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Address author</label>
            <input type="text" class="form-control" name="address_author" @if ($form == 'show') disabled @endif
                wire:model="address_author">
            @error('address_author')
                <div class="alert alert-danger my-3" role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Desc author</label>
            <div>
                <div class="mb-3" wire:model.debounce.350ms="desc_author" wire:ignore>
                    <input id="desc_author" type="hidden" name="desc_author" value="{{ $desc_author }}">
                    <trix-editor input="desc_author" placeholder="Lintang penulis buku bergenre filsafat">
                    </trix-editor>
                </div>
                @error('desc_author')
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

    <table class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name Author</th>
                <th>Address Author</th>
                <th>Desc Author</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allauthor as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{!! Str::limit(html_entity_decode(strip_tags($item->name_author)), 20) !!}</td>
                    <td>{!! Str::limit(html_entity_decode(strip_tags($item->address_author)), 50) !!}</td>
                    <td>{!! Str::limit(html_entity_decode(strip_tags($item->desc_author)), 50) !!}</td>
                    <td>
                        <div class="position-static">
                            <button wire:click="edit('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-primary"><i
                                    class="ri-edit-line"></i></button>
                            <button type="button" wire:click="show('{{ Crypt::encrypt($item->id) }} }}')"
                                class="btn btn-secondary"><i class="ri-eye-line"></i></button>
                            <button type="button"
                                onclick="confirm('Are you sure you want to delete this Author ? delete category same you delete book in auhtor this') || event.stopImmediatePropagation()"
                                wire:click="destroy('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-success"><i
                                    class="ri-delete-bin-7-line"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $allauthor->links() }}
</div>
