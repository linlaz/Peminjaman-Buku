<x-app-layout titles="Manage book">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/dashboard/book/update" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="form-control" name="id_book" value="{{ $detail->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name Book</label>
            <input type="text" class="form-control" name="name_book" value="{{ $detail->name }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Published Book</label>
            <input type="date" class="form-control" name="published_book" value="{{ $detail->published_at }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Desc Book</label>
            <div class="mb-3">
                <input id="desc_book" type="hidden" name="desc_book" value="{{ $detail->desc_book }}">
                <trix-editor input="desc_book" placeholder="Lintang penulis buku bergenre filsafat">
                </trix-editor>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Publisher</label>
            <select class="form-select" aria-label="Default select example" name="publisher_book">
                @foreach ($publisher as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $detail->publisher->id) selected="selected" @endif>
                        {{ $item->name_publisher }}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">author</label>
            <select class="form-select" aria-label="Default select example" name="author_book">
                @foreach ($author as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $detail->author->id) selected="selected" @endif>
                        {{ $item->name_author }}</option>
                @endforeach

            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Category Book</label>
            <select class="form-select" aria-label="Default select example" name="category_book">
                @foreach ($category as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $detail->category->id) selected="selected" @endif>
                        {{ $item->name_category }}</option>
                @endforeach

            </select>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Upload Thumbnail</label>
            <input type="file" class="form-control" name="thumbnail_book" id="inputGroupFile01">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Type Book</label>
            <select class="form-select" aria-label="Default select example" name="type_book">
                <option value="soft">soft</option>
                <option value="hard">hard</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-app-layout>
