<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'sections',
           'employers',
           'general_setting',
           'addition_and_discount',
           'attendance',
           'salary_report',
           'archeve',
           'roles',
           'official_holidays',
           'Dashboard',
           'users'
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}