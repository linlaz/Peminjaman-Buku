<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <table class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Title Book</th>
                <th>Date Published</th>
                <th>Description</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($allbook as $item)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->published_at }}</td>
                    <td>{!! Str::limit(html_entity_decode(strip_tags($item->desc_book)), 20) !!}</td>
                    <td>{{ $item->category->name_category }}</td>
                    <td>
                        <a href="/dashboard/book/{{ Crypt::encrypt($item->id) }}/edit" class="btn btn-primary"><i
                                class="ri-edit-line"></i></a>
                        <a href="/detail/{{ Crypt::encrypt($item->id) }}" type="button" wire:click="show('{{ Crypt::encrypt($item->id) }} }}')"
                            class="btn btn-secondary"><i class="ri-eye-line"></i></a>
                        <button type="button"
                            onclick="confirm('Are you sure you want to delete this Author ? delete category same you delete book in auhtor this') || event.stopImmediatePropagation()"
                            wire:click="destroy('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-success"><i
                                class="ri-delete-bin-7-line"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $allbook->links() }}
</div>
