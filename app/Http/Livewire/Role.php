<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use Livewire\WithPagination;

class Role extends Component
{
    use WithPagination;
    //addrole
    public $name, $permissionselect = [];
    //editrole;
    public $getidrole, $getnamerole, $getpermissionrole;
    //addpermission // editpermission
    public $namepermission, $idpermission;
    public $form = '';

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function render()
    {

        $role = ModelsRole::all();
        $permission = Permission::all();
        return view('dashboard.role.role', [
            'role' => $role,
            'permissions' => $permission,
        ]);
    }
    public function addrole()
    {
        $this->form = 'addrole';
        $this->permission = Permission::all();
    }

    public function storerole()
    {
        $this->validate([
            'name' => 'required|unique:roles|alpha_dash',
        ]);
        $newrole = ModelsRole::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);
        $newrole->givePermissionTo($this->permissionselect);

        $this->resetall();
        $this->emit('success');
    }

    public function resetall()
    {
        $this->name = '';
        $this->permissionselect = '';
        $this->getidrole = '';
        $this->getnamerole = '';
        $this->getpermissionupdate = '';
        $this->namepermission = '';
        $this->idpermission = '';
        $this->form = '';
    }

    public function deleterole(ModelsRole $id)
    {
        $id->delete();
    }
    public function showedit(ModelsRole $id)
    {

        $this->form = 'editrole';
        $this->getidrole = $id->id;
        $this->getnamerole = $id->name;
        $this->getpermissionrole = $id->getAllPermissions()->pluck('name');
    }
    public function updaterole(ModelsRole $id)
    {

        $this->validate([
            'getnamerole' => 'required|alpha_dash|unique:roles,name,' . $id->id
        ]);
        $id->update([
            'name' =>  $this->getnamerole,
        ]);

        $id->syncPermissions($this->getpermissionrole);

        $this->resetall();
        $this->emit('success');
    }
    public function addpermission()
    {
        $this->form = 'addpermission';
    }
    public function storepermission()
    {
        $this->validate([
            'namepermission' => 'required|alpha_dash|unique:permissions,name'
        ]);
        Permission::create([
            'name' => $this->namepermission,
            'guard_name' => 'web'
        ]);

        $this->resetall();
        $this->emit('success');
    }
    public function deletepermission(Permission $id)
    {
        $id->delete();
        $this->resetall();
        $this->emit('success');
    }
    public function editpermission(Permission $id)
    {
        $this->form = 'editpermission';
        $this->idpermission = $id->id;
        $this->namepermission = $id->name;
    }
    public function updatepermission(Permission $id)
    {
        $this->validate([
            'namepermission' => 'required|alpha_dash|unique:permissions,name,' . $id->id
        ]);
        $id->update([
            'name' => $this->namepermission
        ]);
        $this->resetall();
        $this->emit('success');
    }
}
