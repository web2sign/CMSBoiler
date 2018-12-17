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
    ])->meta()->saveMany([
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



    Page::create([
      'status' => true,
      'post_type' => 'page',
      'slug' => 'page-1',
      'title'  => 'Parent Page 1',
      'description' => 'Description Page 1',
      'keywords' => 'Keywords Page 1',
      'content' => 'Page Content 1',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

    Page::create([
      'slug' => 'page-2',
      'post_type' => 'page',
      'title'  => 'Parent Page 2',
      'description' => 'Description Page 2',
      'keywords' => 'Keywords Page 2',
      'content' => 'Page Content 2',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

    Page::create([
      'parent_id' => 1,
      'slug' => 'page-3',
      'post_type' => 'page',
      'title'  => 'Parent Page 3',
      'description' => 'Description Page 3',
      'keywords' => 'Keywords Page 3',
      'content' => 'Page Content 3',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

    Page::create([
      'parent_id' => 2,
      'slug' => 'page-4',
      'post_type' => 'page',
      'title'  => 'Parent Page 4',
      'description' => 'Description Page 4',
      'keywords' => 'Keywords Page 4',
      'content' => 'Page Content 4',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

    Page::create([
      'parent_id' => 1,
      'slug' => 'page-5',
      'post_type' => 'page',
      'title'  => 'Parent Page 5',
      'description' => 'Description Page 5',
      'keywords' => 'Keywords Page 5',
      'content' => 'Page Content 5',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

    Page::create([
      'parent_id' => 2,
      'slug' => 'page-6',
      'post_type' => 'page',
      'title'  => 'Parent Page 6',
      'description' => 'Description Page 6',
      'keywords' => 'Keywords Page 6',
      'content' => 'Page Content 6',
    ])->meta()->saveMany([
      new Pagemeta(['metakey' => 'keywords','metavalue' => '']),
      new Pagemeta(['metakey' => 'description','metavalue' => '']),
      new Pagemeta(['metakey' => 'featured_image','metavalue' => ''])
    ]);

  }
}
