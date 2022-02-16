<?php

namespace App\Http\Livewire\users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexUser extends Component
{
    //edit
    public $idedit, $getusername = '', $getroleuseredit, $permission, $userpermission;
    //endedit
    public $form, $anyrole = [];
    public $deleteId = '';

    protected $listeners = [
        'success' => '$refresh'
    ];

    public function render()
    {
        return view('dashboard.user.index-user', [
            'user' => User::with('roles')->get()
        ]);
    }

    public function edit($id)
    {
        $finded = User::where('id', $id)->first();
        $this->form = 'edituser';
        $this->idedit = $finded->id;
        $this->getusername = $finded;
        $this->getroleuseredit = $finded->getRoleNames();
        $this->anyrole = Role::all();
        $this->permission = Permission::all();
        $this->userpermission = $finded->getAllPermissions()->pluck('name');
    }
    public function update(User $id)
    {
        $id->syncRoles($this->getroleuseredit);
        $id->syncPermissions($this->userpermission);
        $this->resetAll();
        $this->emit('success');
    }

    public function resetAll()
    {
        $this->anyrole = '';
        $this->form = '';
        $this->idedit = '';
        $this->getusername = '';
        $this->getroleuseredit = '';
        $this->permission = '';
        $this->userpermission = '';
    }

    public function delete(User $id)
    {
        $id->delete();
        $this->emit('success');
    }
    public function blok(User $id, $active)
    {
        $id->update([
            'active' => $active
        ]);
        $this->emit('success');
    }
}
