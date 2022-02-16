<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card container p-3" style="margin-top:100px;">
        <div class="row">
            <div class="col">
                <img src="{{ asset($detail->thumbnail) }}" class="img-thumbnail" alt="{{ $detail->name }}">
            </div>
            <div class="col">
                <p class="h1">{{ $detail->name }}</p>
                <figcaption class="figure-caption"><a href="">{{ $detail->author->name_author }}</a>
                    {{ $detail->published_at }} By {{ $detail->publisher->name_publisher }}</figcaption>
                <div>
                    {!! $detail->desc_book !!}
                </div>
                <div class="date row p-2">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label"> Start
                            date</label>
                        <input type="date" class="form-control" wire:model="start_date">
                        @error('start_date')
                            <div class="alert alert-warning" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-label">end
                            date</label>
                        <input type="date" class="form-control" wire:model="end_date">
                        @error('end_date')
                            <div class="alert alert-warning" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="pick">
                    <button type="button" wire:click="borrow('{{ Crypt::encrypt($detail->id) }}')"
                        class="btn btn-outline-secondary">Save</button>
                </div>
            </div>

        </div>
        <hr>
        <div class="author">
            <p class="h3">
                Tentang Author
            </p>
            <div>
                {!! $detail->author->desc_author !!}
            </div>
            <div class="h5">
                {{ $detail->author->address_author }}
            </div>
        </div>
        <hr>
        <div class="publisher">
            <p class="h3">
                Tentang Publisher
            </p>
            <div>
                {!! $detail->publisher->desc_address !!}
            </div>
            <div class="h5">
                {{ $detail->author->address_publisher }}
            </div>
        </div>
    </div>


    @push('modals')
        <script>
            window.addEventListener('success', event => {
                alert('action borrow is : ' + event.detail.newName);
            })
        </script>
    @endpush
</div>
