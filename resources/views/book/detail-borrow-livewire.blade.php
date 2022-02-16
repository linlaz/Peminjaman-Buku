<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    @foreach ($list as $item)
            <div class="card border my-2 p-3">
                <div class="row">
                    <div class="col">
                        <img src="{{ $item->book->thumbnail }}" class="img-responsivethumbnail" alt="...">
                    </div>
                    <div class="col">
                        <div>
                            <p class="h1">{{ $item->book->name }}</p>
                            <figcaption class="figure-caption"><a href="">{{ $item->book->author->name_author }}</a>
                                {{ $item->book->published_at }} By {{ $item->book->publisher->name_publisher }}
                            </figcaption>
                            <div>
                                {!! Str::limit(html_entity_decode(strip_tags($item->book->desc_book)), 200) !!}
                            </div>
                        </div>
                        <div class="date">
                            <p class="fw-bold">start_date {{ $item->start_borrow }} until
                                {{ $item->finish_borrow }}</p>
                        </div>
                        <div class="delete">
                            <button type="button"
                                onclick="confirm('Are you sure you want to delete this borrow ? delete category same you delete book in auhtor this') || event.stopImmediatePropagation()"
                                wire:click="destroy('{{ Crypt::encrypt($item->id) }} }}')" class="btn btn-success"><i
                                    class="ri-delete-bin-7-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $list->links() }}
</div>
