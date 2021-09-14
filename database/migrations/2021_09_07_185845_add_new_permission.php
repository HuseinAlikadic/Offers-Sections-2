<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AddNewPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         DB::table('permissions')->insert(['name' => 'add offer', 'guard_name' =>'web']);
         DB::table('permissions')->insert(['name' => 'edit offer', 'guard_name' =>'web']);
         DB::table('permissions')->insert(['name' => 'delete offer', 'guard_name' =>'web']);
         DB::table('permissions')->insert(['name' => 'add section', 'guard_name' =>'web']);
         DB::table('permissions')->insert(['name' => 'edit section', 'guard_name' =>'web']);
         DB::table('permissions')->insert(['name' => 'delete section', 'guard_name' =>'web']);

        DB::table('roles')->insert(['name' => 'admin', 'guard_name' =>'web']);
        $role = Role::where('name','admin')->first();
    
        $role->givePermissionTo(Permission::all());
        
        $role = DB::table('roles')->insert(['name' => 'user', 'guard_name' =>'web']);

        DB::table('roles')->insert(['name' => 'finance', 'guard_name' =>'web']);
        $role = Role::where('name','finance')->first();
        $role->givePermissionTo(['edit offer','edit section' ]);

        DB::table('roles')->insert(['name' => 'manager', 'guard_name' =>'web']);
        $role = Role::where('name','manager')->first();
        $role->givePermissionTo(['delete offer','delete section' ]);

        $user=User::find(4);
        $user->assignRole('admin');

        $user=User::find(5);
        $user->assignRole('finance');

        $user=User::find(6);
        $user->givePermissionTo('add offer');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}