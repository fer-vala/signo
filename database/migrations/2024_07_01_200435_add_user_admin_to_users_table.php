<?php

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Migrations\Migration;
use ILC\AdminUsuarios\Models\ILCUser as BaseUser;

return new class extends Migration
{
    /**
     * List of applications to add.
     */
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete'
    ];

    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        $user = BaseUser::create([
            'nombre' => 'Amilgar Manuel',
            'email' => 'amilgar83@gmail.com',
            'password' => Hash::make('develop'),
            'primer_apellido' => 'Cortes',
            'segundo_apellido' => 'Soberanes',
            'curp' => 'COSA830411HVZRBM05'
        ]);

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $role = Role::create(['name' => 'Administrador']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }

    public function down(): void
    {
        //here you can revert above created roles or permissions but you must ensure no user is still using any of them
    }
};
