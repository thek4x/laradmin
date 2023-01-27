<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class permseed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        
        $formtables = config('form_tables.tables_form');
//        $formtables = ['tables_form'=>[]];
        foreach ($formtables as $prefix=>$table) {
            $modules = ['list', 'create', 'edit', 'delete'];
            foreach ($modules as $subperm) {
                $full_perm = $prefix . '.' . $subperm;
                Permission::create(['name' => $full_perm, 'guard_name' => 'admin', 'group_name' => $prefix]);
            }
        }
        

      
    }

}
