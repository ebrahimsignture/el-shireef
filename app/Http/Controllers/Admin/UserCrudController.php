<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('User', 'Users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addClause('where', 'role', '!=', 'super_admin');

        $this->crud->addColumn([
            'name' => 'row_number',
            'type' => 'row_number',
            'label' => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        $this->crud->addColumns([
            [
                'name' => 'name', // The db column name
                'label' => 'Name', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'Email Address', // Table column heading
                'type' => 'email',
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading
            ],

            [
                'name' => 'created_at', // The db column name
                'label' => 'Join Date', // Table column heading
                'type' => 'date',
                // 'format' => 'l j F Y', // use something else than the base.default_date_format config value
            ],

        ]);
        CRUD::column('role');
        CRUD::column('status');



        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }





    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumns([
            [
                'name' => 'name', // The db column name
                'label' => 'Name', // Table column heading
            ],

            [
                'name' => 'email', // The db column name
                'label' => 'Email', // Table column heading
                'type' => 'email', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading
            ],

            [
                'name' => 'role',
                'label' => 'Role',
            ],

            [
                'name' => 'status',
                'label' => 'Status',
            ],
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }


    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserCreateRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'User Name ..',
                ],
            ],
            [   // Email
                'name' => 'email',
                'label' => 'Email Address',
                'type' => 'email',
                'attributes' => [
                    'placeholder' => 'User Email ..',
                ],
            ],
            [   // Password
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'attributes' => [
                    'prefix' => 'if you dont want to edit password just leave it empty (only in edit case) '
                ],
            ],
            [   // Number
                'name' => 'phone',
                'label' => 'Number',
                'type' => 'number',

                // optionals
                // 'attributes' => ["step" => "any"], // allow decimals
                // 'prefix'     => "$",
                // 'suffix'     => ".00",
            ],
            [   // Browse
                'name'  => 'image',
                'label' => 'Image',
                'type'  => 'browse'
            ],
            [   // select_from_array
                'name'        => 'role',
                'label'       => "Role",
                'type'        => 'select_from_array',
                'options'     => ['admin' => 'admin', 'user' => 'user'],
                'allows_null' => false,
                'default'     => 'user',
                // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
            ],
            [   // Enum Status
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum'
            ],

        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        {
            CRUD::setValidation(UserUpdateRequest::class);
            $this->crud->addFields([
                [   // Text Title
                    'name' => 'name',
                    'label' => "Name",
                    'type' => 'text',
                    'attributes' => [
                        'placeholder' => 'User Name ..',
                    ],
                ],
                [   // Email
                    'name' => 'email',
                    'label' => 'Email Address',
                    'type' => 'email',
                    'attributes' => [
                        'placeholder' => 'User Email ..',
                    ],
                ],
                [   // Number
                    'name' => 'phone',
                    'label' => 'Number',
                    'type' => 'number',

                    // optionals
                    // 'attributes' => ["step" => "any"], // allow decimals
                    'prefix'     => "+20",
                    // 'suffix'     => ".00",
                ],
                [   // Browse
                    'name'  => 'image',
                    'label' => 'Image',
                    'type'  => 'browse'
                ],
                [   // select_from_array
                    'name'        => 'role',
                    'label'       => "Role",
                    'type'        => 'select_from_array',
                    'options'     => ['admin' => 'admin', 'user' => 'user'],
                    'allows_null' => false,
                    'default'     => 'user',
                    // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
                ],
                [   // Enum Status
                    'name' => 'status',
                    'label' => 'Status',
                    'type' => 'enum'
                ],
            ]);
        }    }
}
