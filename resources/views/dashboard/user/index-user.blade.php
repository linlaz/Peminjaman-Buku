<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        @can('edit-user')
                            @if ($form == 'edituser')
                                <form method="POST" wire:submit.prevent="update('{{ $idedit }}')">
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $getusername->name }}" disabled>
                                        </div>
                                    </div>
                                    @can('giverole-user')
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                                            <div class="col-sm-10">
                                                @foreach ($anyrole as $item)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                            value="{{ $item->name }}" wire:model="getroleuseredit">
                                                        <label class="form-check-label" for="gridCheck1">
                                                            {{ $item->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                        </fieldset>
                                    @endcan
                                    @can('givepermission-user')
                                        <fieldset class="row mb-3">
                                            <legend class="col-form-label col-sm-2 pt-0">permission</legend>
                                            <div class="col-sm-10">
                                                @foreach ($permission as $item)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                            value="{{ $item->name }}" wire:model="userpermission">
                                                        <label class="form-check-label" for="gridCheck1">
                                                            {{ $item->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    @endcan


                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Submit Button</label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Submit Form</button>
                                            <button type="button" class="btn btn-danger" wire:click="resetAll()">Cancel
                                                Form</button>
                                        </div>
                                    </div>

                                </form><!-- End General Form Elements -->
                            @endif
                        @endcan


                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">role</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td><a href="user/detailuser/{{ $item->name }}">{{ $item->name }}</a></td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @foreach ($item->getRoleNames() as $v)
                                                {{ $v }}
                                            @endforeach
                                        </td>

                                        <td>
                                            @can('edit-user')
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="edit('{{ $item->id }}')">Edit</button>
                                            @endcan
                                            @can('blok-user')
                                                @if ($item->active != '1')
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="confirm('Are you sure you want to blok the user ?') || event.stopImmediatePropagation()"
                                                        wire:click="blok('{{ $item->id }}','1')">unblokir</button>
                                                @else
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="confirm('Are you sure you want to blok the user ?') || event.stopImmediatePropagation()"
                                                        wire:click="blok('{{ $item->id }}','0')">blokir</button>
                                                @endif
                                            @endcan
                                            @can('delete-user')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirm('Are you sure you want to remove the user ?') || event.stopImmediatePropagation()"
                                                    wire:click="delete('{{ $item->id }}')">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
