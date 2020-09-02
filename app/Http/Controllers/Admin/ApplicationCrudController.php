<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ApplicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ApplicationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\ReviseOperation\ReviseOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Application::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/application');
        CRUD::setEntityNameStrings('application', 'applications');
        // CRUD::enableExportButtons();


    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
         CRUD::addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Applicant Name']);
         CRUD::addColumn(['name' => 'personal_id', 'type' => 'text', 'label' => 'ID']);
         CRUD::addColumn(['name' => 'status', 'type' => 'text']);
         CRUD::addColumn([
           'label'     => 'State', // Table column heading
           'type'      => 'relationship',
           'name'      => 'state', // the column that contains the ID of that connected entity;
           // 'entity'    => 'state', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           // 'model'     => "App\Models\State", // foreign key model
         ]);

         CRUD::addColumn([
           'label'     => 'Applicant Group', // Table column heading
           'type'      => 'relationship',
           'name'      => 'appgroup', // the column that contains the ID of that connected entity;
           // 'entity'    => 'state', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           // 'model'     => "App\Models\State", // foreign key model
         ]);


    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ApplicationRequest::class);

        // CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */

         CRUD::addField(['name' => 'name', 'type' => 'text']);
         CRUD::addField(['name' => 'personal_id', 'type' => 'text', 'label' => 'NRIC / Company Registration No']);
         CRUD::addField([  // Select2
             'label'     => "State",
             'type'      => 'select2',
             'name'      => 'state_id', // the db column for the foreign key
             'entity'    => 'state', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             // optional
             // 'model'     => "App\Models\State", // foreign key model
             // 'default'   => 1, // set the default value of the select2
             // 'options'   => (function ($query) {
             //      return $query->orderBy('name', 'ASC')->where('depth', 1)->get();
             //  }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
          ],
         );

         CRUD::addField([
             'label'     => "Applicant Group",
             'type'      => 'select2',
             'name'      => 'applicant_group_id',
             'entity'    => 'appgroup',
             'attribute' => 'name',
          ],
         );

         CRUD::addField([  // Select2
             'label'     => "Owner Username (registered email for login)",
             'type'      => 'select2',
             'name'      => 'user_id', // the db column for the foreign key
             'entity'    => 'user', // the method that defines the relationship in your Model
             'attribute' => 'email', // foreign key attribute that is shown to user

             // optional
             // 'model'     => "App\Models\State", // foreign key model
             // 'default'   => 1, // set the default value of the select2
             'options'   => (function ($query) {
                  return $query->orderBy('email', 'ASC')->get();
              }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
          ],
         );

         CRUD::addField([   // Hidden
            'name'  => 'user_id',
            'type'  => 'hidden',
            'value' => backpack_user()->id,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
