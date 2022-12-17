<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
        $this->crud->orderBy('lft', 'ASC');

    }



    public function setupReorderOperation() {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'title');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 100);
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
                'name' => 'title', // The db column name
                'label' => 'Title', // Table column heading
            ],
            [
                'name' => 'cover', // The db column name
                'label' => 'Cover', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                // any type of relationship
                'name' => 'category', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'Category', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
            [
                'name' => 'price', // The db column name
                'label' => 'Price', // Table column heading
                'type' => 'number',
                'suffix' => ' EGP',
            ],
            [
                'name' => 'stock', // The db column name
                'label' => 'Quantity', // Table column heading
                'type' => 'number',
            ],
            [
                'name'  => 'discount', // The db column name
                'label' => 'Discount', // Table column heading
                'type'  => 'number',
                // 'prefix'        => '$',
                 'suffix'        => '%',
//                 'decimals'      => 2,
                // 'dec_point'     => ',',
                // 'thousands_sep' => '.',
                // decimals, dec_point and thousands_sep are used to format the number;
                // for details on how they work check out PHP's number_format() method, they're passed directly to it;
                // https://www.php.net/manual/en/function.number-format.php
            ],

            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'boolean',
                // optionally override the Yes/No texts
                'options' => [0 => 'Active', 1 => 'Inactive']
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
                'name' => 'title', // The db column name
                'label' => 'Title', // Table column heading
            ],

            [
                'name' => 'slug', // The db column name
                'label' => 'Slug', // Table column heading
            ],
            [
                'name' => 'sku', // The db column name
                'label' => 'SKU', // Table column heading
            ],
            [
                'name' => 'summary', // The db column name
                'label' => 'Summary', // Table column heading
            ],
            [
                'name' => 'description', // The db column name
                'label' => 'Description', // Table column heading
                'type' => 'arranged_description'
            ],
            [   // Stock
                'name' => 'color',
                'label' => 'Colors',
            ],
            [
                'name' => 'cover', // The db column name
                'label' => 'Cover', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'multi_images_column',
            ],
            [
                // any type of relationship
                'name' => 'category', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'Category', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
            [
                // any type of relationship
                'name' => 'tags', // name of relationship method in the model
                'type' => 'relationship',
                'label' => 'Tags', // Table column heading
                // OPTIONAL
                // 'entity'    => 'tags', // the method that defines the relationship in your Model
                // 'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model'     => App\Models\Category::class, // foreign key model
            ],
            [
                'name' => 'stock', // The db column name
                'label' => 'Quantity', // Table column heading
            ],
            [
                'name' => 'price', // The db column name
                'label' => 'Price', // Table column heading
                'type' => 'number',
                'suffix' => ' EGP',
            ],
            [
                'name' => 'discount', // The db column name
                'label' => 'Discount', // Table column heading
            ],
            [
                'name' => 'condition', // The db column name
                'label' => 'Condition', // Table column heading
            ],

            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'boolean',
                // optionally override the Yes/No texts
                'options' => [0 => 'Active', 1 => 'Inactive']
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
        CRUD::setValidation(ProductRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Type Title ..',
                ],
            ],
            [   // Summernote
                'name' => 'summary',
                'label' => 'Summary',
                'type' => 'text'
            ],
            [   // Description
                'name' => 'description',
                'label' => 'Description',
                'type' => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
                        ['Font Style', ['fontname', 'fontsize','fontsizeunit',  'forecolor', 'backcolor', 'bold', 'italic', 'underline','strikethrough','superscript','subscript','clear',]],
                        ['Paragraph style', ['style','ol','ul','paragraph','height']],
                        ['Misc', ['fullscreen','codeview','undo','redo','help']]
                    ]
                ],
            ],

//            [   // is_featured
//                'name' => 'is_featured',
//                'label' => 'Is Featured',
//                'type' => 'checkbox'
//            ],
            [  // Select Category
                'label' => "Category",
                'type' => 'select',
                'name' => 'cat_id', // the db column for the foreign key
                'entity' => 'category', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'attributes' => [
                    'id' => 'cat_id'
                ],
                // optional
                'model' => "App\Models\Productcategory",
                'options' => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],

            [    // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Tags",
                'type' => 'select2_multiple',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user

                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                // 'select_all' => true, // show Select All and Clear buttons?


                // optional
                'model' => "App\Models\Tag", // foreign key model
                'options' => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
            [   // Price
                'name' => 'price',
                'label' => 'Price',
                'type' => 'number',

                // optionals
                'attributes' => ["step" => "any", 'placeholder' => 'Type Price Here ...'], // allow decimals
                // 'prefix'     => "$",
                'suffix' => ".00",
            ],
            [   // Discount
                'name' => 'discount',
                'label' => 'Discount',
                'type' => 'number',
                // optionals
                'attributes' => ["step" => "any", 'min' => '0', 'max' => '100', 'placeholder' => 'Optional'], // allow decimals
                // 'prefix' => "$",
                'suffix' => "%",
            ],



            [   // Stock
                'name' => 'stock',
                'label' => 'Quantity',
                'type' => 'number',
            ],
            [   // Stock
                'name' => 'color',
                'label' => 'Colors',
                'type' => 'text',
            ],
            [   // Browse multiple
                'name'          => 'cover',
                'label'         => 'Cover',
                'type'          => 'browse',
                // 'multiple'   => true, // enable/disable the multiple selection functionality
                // 'sortable'   => false, // enable/disable the reordering with drag&drop
                'mime_types' => ['image'], // visible mime prefixes; ex. ['image'] or ['application/pdf']
            ],
            [   // Browse multiple
                'name'          => 'image',
                'label'         => 'Image',
                'type'          => 'browse_multiple',
                // 'multiple'   => true, // enable/disable the multiple selection functionality
                // 'sortable'   => false, // enable/disable the reordering with drag&drop
                'mime_types' => ['image'], // visible mime prefixes; ex. ['image'] or ['application/pdf']
            ],


            [   // select_from_array
                'name'        => 'condition',
                'label'       => "Condition",
                'type'        => 'select_from_array',
                'options'     => ['0' => 'Default', '1' => 'New', '2' => 'Hot'],
                'allows_null' => false,
                'default'     => '0',
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
        $this->setupCreateOperation();
    }
}
