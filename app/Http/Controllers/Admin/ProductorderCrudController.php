<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\ProductorderRequest;
use App\Models\Productorder;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductorderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductorderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Productorder::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/productorder');
        CRUD::setEntityNameStrings('productorder', 'productorders');
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
                'name' => 'order_number', // The db column name
                'label' => 'Order Number', // Table column heading
                'type' => 'text',

            ],

            [
                'name' => 'status', // The db column name
                'label' => 'Status', // Table column heading
                'type' => 'text',
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
                'name' => 'payment_status', // The db column name
                'label' => 'Payment', // Table column heading
                'type' => 'text',
            ],
            [
                'name' => 'shipping.place', // The db column name
                'label' => 'Shipping', // Table column heading
                'type' => 'text',

            ],

            [
                'name' => 'total_amount', // The db column name
                'label' => 'Total Amount', // Table column heading
                'type' => 'number',
                // 'prefix'        => '$',
                'suffix' => ' EGP',
//                 'decimals'      => 1,
                // 'dec_point'     => ',',
                // 'thousands_sep' => '.',
                // decimals, dec_point and thousands_sep are used to format the number;
                // for details on how they work check out PHP's number_format() method, they're passed directly to it;
                // https://www.php.net/manual/en/function.number-format.php
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading
                'type' => 'phone',
                // 'limit' => 10, // if you want to truncate the phone number to a different number of characters
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
                'name' => 'order_number', // The db column name
                'label' => 'Order Number', // Table column heading
                'type' => 'text',

            ],

            [
                'name' => 'quantity', // The db column name
                'label' => 'Quantity', // Table column heading
            ],
            [
                'name' => 'status', // The db column name
                'label' => 'Status', // Table column heading
                'type' => 'text',
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
                'name' => 'payment_status', // The db column name
                'label' => 'Payment', // Table column heading
                'type' => 'text',
            ],
            [
                'name' => 'shipping.place', // The db column name
                'label' => 'Shipping', // Table column heading
                'type' => 'text',

            ],

            [
                'name' => 'sub_total', // The db column name
                'label' => 'Sub Amount', // Table column heading
                'type' => 'number',
                // 'prefix'        => '$',
                'suffix' => ' EGP',
//                 'decimals'      => 1,
                // 'dec_point'     => ',',
                // 'thousands_sep' => '.',
                // decimals, dec_point and thousands_sep are used to format the number;
                // for details on how they work check out PHP's number_format() method, they're passed directly to it;
                // https://www.php.net/manual/en/function.number-format.php
            ],
            [
                'name' => 'total_amount', // The db column name
                'label' => 'Total Amount', // Table column heading
                'type' => 'number',
                // 'prefix'        => '$',
                'suffix' => ' EGP',
//                 'decimals'      => 1,
                // 'dec_point'     => ',',
                // 'thousands_sep' => '.',
                // decimals, dec_point and thousands_sep are used to format the number;
                // for details on how they work check out PHP's number_format() method, they're passed directly to it;
                // https://www.php.net/manual/en/function.number-format.php
            ],
            [
                'name' => 'full_name', // The db column name
                'label' => 'Full Name', // Table column heading
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'Email', // Table column heading
            ],
            [
                'name' => 'state', // The db column name
                'label' => 'State', // Table column heading
            ],
            [
                'name' => 'address1', // The db column name
                'label' => 'Address1', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading
                'type' => 'phone',
                // 'limit' => 10, // if you want to truncate the phone number to a different number of characters
            ],
            [
                'name' => 'notes', // The db column name
                'label' => 'Notes', // Table column heading
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
        CRUD::setValidation(ProductorderRequest::class);

        $this->crud->addFields([
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum',
            ],
//            [
//                'name' => 'payment_method',
//                'label' => 'Payment Method',
//                'type' => 'enum',
//                'hint' => '"cod" stands for "Cash on Delivery"',
//            ],
            [
                'name' => 'payment_status',
                'label' => 'Payment Status',
                'type' => 'enum',
            ],
        ]);
        CRUD::field('shipping_id');
    }
}
