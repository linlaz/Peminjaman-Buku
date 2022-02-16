<div>
    {{-- In work, do what you enjoy. --}}
    <button type="button" wire:click="create" class="btn btn-secondary">Create New Category</button>
    @if ($form != null)
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name category</label>
            <input type="text" class="form-control" name="name_category" wire:model="name">
            @error('name')
                <div class="alert alert-danger my-2 alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
        </div>
        <button type="button" wire:click="store" class="btn btn-primary">Create</button>
        <button type="button" wire:click="cancel" class="btn btn-danger">Cancel</button>
    @endif
    {{ $form }}
    @if (session()->has('success'))
        <div class="alert alert-success my-2 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-striped table-hover my-2" style="width:100%">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name Category</th>
                <th>Slug Category</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allcategory as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{!! Str::limit(strip_tags($item->name_category), 50) !!}</td>
                    <td>{!! Str::limit(strip_tags($item->slug_category), 50) !!}</td>
                    <td>
                        <div class="position-static">
                            <button type="button"
                                onclick="confirm('Are you sure you want to delete this Category ? delete category same you delete book in Category this') || event.stopImmediatePropagation()"
                                wire:click="destroy('{{ Crypt::encrypt($item->id) }} }}')"
                                class="btn btn-secondary"><i class="ri-delete-bin-7-line"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $allcategory->links() }}
</div>
