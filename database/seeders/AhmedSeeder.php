<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Hash;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AhmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'mohamed admin',
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('01230123'),
            'roles_name'=> ['admin'],
            'status'=>'active', 
   
           ]);


           $role = Role::create(['name' => 'admin']);
   
           $permissions = Permission::pluck('id','id')->all();
     
           $role->syncPermissions($permissions);
      
           $user->assignRole([$role->id]);
   
    }
}
