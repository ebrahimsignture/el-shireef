<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */

    protected function setupListOperation()
    {
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
                'label' => 'Email', // Table column heading

            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading

            ],
            [
                // any type of relationship
                'name' => 'user', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'User', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                // optionally override the Yes/No texts
            ],
        ]);


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
                // any type of relationship
                'name' => 'user', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'User', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
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
                'type' => 'phone', // Table column heading
            ],
            [
                'name' => 'whats_app', // The db column name
                'label' => 'Whats App', // Table column heading
                'type' => 'phone', // Table column heading
            ],
            [
                // any type of relationship
                'name' => 'services', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'Services in Order', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],

            [
                'name' => 'details',
                'label' => 'Details',
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum',
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


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(OrderRequest::class);
        $this->crud->addFields([
            [   // Text Title
                'name' => 'status',
                'label' => "Status",
                'type' => 'enum',
            ],
        ]);    }
}
