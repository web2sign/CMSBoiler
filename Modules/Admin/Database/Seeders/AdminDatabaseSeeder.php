<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Admin\Entities\Group;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Usermeta;
use Modules\Admin\Entities\Ugroup;
use Modules\Admin\Entities\Upermit;
use Modules\Admin\Entities\Usession;
use Modules\Admin\Entities\Ucode;
use Modules\Admin\Entities\Page;
use Modules\Admin\Entities\Pagemeta;

class AdminDatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    echo 'insert group';
    Group::create([
        'name'              => 'Super Administrator',
        'description'       => 'Can access everything',
    ])->permits()->saveMany([
      new Upermit([
        'module'=>'*',
        'create'=>1,
        'read'=>1,
        'update'=>1,
        'delete'=>1
      ])
    ]);

    Group::create([
        'name'              => 'Administrator',
        'description'       => 'Can access everything.',
    ]);

    Group::create([
        'name'              => 'Inventory',
        'description'       => 'Can access inventory.',
    ]);

    Group::create([
        'name'              => 'Regular Member',
        'description'       => 'Can access website.',
    ]);

    $user = User::create([
        'username'      => 'admin',
        'email'         => 'admin@sportsace.com.au',
        'password'      => bcrypt('d4t4b0ss')
    ])->usermeta()->saveMany([
      new Usermeta([
        'metakey' => 'first_name',
        'metavalue' => 'Roy Vincent'
      ]),
      new Usermeta([
        'metakey' => 'middle_name',
        'metavalue' => 'Lisondra'
      ]),
      new Usermeta([
        'metakey' => 'last_name',
        'metavalue' => 'Niepes'
      ]),
      new Usermeta([
        'metakey' => 'address',
        'metavalue' => 'Pasig'
      ]),
    ]);
    User::find(1)->groups()->sync([1]);


  }
}
