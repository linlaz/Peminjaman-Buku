<div>
    {{-- Stop trying to control. --}}
    <table class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name Book</th>
                <th>Date start</th>
                <th>Date end</th>
                <th>returned</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrow as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->borrow->book->name }}</td>
                    <td>{{ $item->borrow->start_borrow }}</td>
                    <td>{{ $item->borrow->finish_borrow }}</td>
                    <td>
                        @if (date('Y-m-d') < $item->borrow->start_borrow)
                            <span class="badge bg-primary">Belum waktunya</span>
                        @else
                            @if ($item->borrow->back != '1')
                                <span class="badge bg-danger">Belum Dikembalikan</span>
                            @else
                                <span class="badge bg-success">Sudah Dikembalikan</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        <button type="button" wire:click="acc('{{ Crypt::encrypt($item->borrow->id) }} }}')"
                            class="btn btn-secondary">returned</button>
                        <button type="button"
                            onclick="confirm('Are you sure you want to delete this Author ? delete category same you delete book in auhtor this') || event.stopImmediatePropagation()"
                            wire:click="destroy('{{ Crypt::encrypt($item->borrow->id) }} }}')"
                            class="btn btn-success"><i class="ri-delete-bin-7-line"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $borrow->links() }}
</div>
