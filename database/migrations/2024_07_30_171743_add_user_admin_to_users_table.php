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
        'visualizar-usuarios',
        'creacion-de-usuarios',
        'edicion-de-usuarios',
        'eliminacion-de-usuarios',
        'edicion-masiva-de-usuarios',
        'crear-usuarios-por-certificado',
        'crear-usuarios-por-xlsx'
    ];

    /**
     * Run the database seeds.
     */
    public function up(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'Administrador']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $user = BaseUser::create([
            'nombre' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => Hash::make('develop'),
            'curp' => 'XXXX830411HVZRBM05'
        ]);
        $user->assignRole([$role->id]);
        $user->givePermissionTo($permissions);

        $role = Role::create(['name' => 'Cliente']);
        $role->syncPermissions(['visualizar-usuarios']);

        $user = BaseUser::create([
            'nombre' => 'Usuario',
            'email' => 'user@email.com',
            'password' => Hash::make('develop'),
            'curp' => 'XXXX820604MOCXLN01'
        ]);
        $user->assignRole([$role->id]);
        $user->givePermissionTo(['visualizar-usuarios']);
    }

    public function down(): void
    {
        //here you can revert above created roles or permissions but you must ensure no user is still using any of them
    }
};
