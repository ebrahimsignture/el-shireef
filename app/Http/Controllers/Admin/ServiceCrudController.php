<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Service::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/service');
        CRUD::setEntityNameStrings('Service', 'Services');
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
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
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
                'name' => 'is_featured', // The db column name
                'label' => 'Featured', // Table column heading
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
                'name' => 'title', // The db column name
                'label' => 'Title', // Table column heading
            ],

            [
                'name' => 'slug', // The db column name
                'label' => 'Slug', // Table column heading
            ],
//            [
//                'name' => 'description', // The db column name
//                'label' => 'Description', // Table column heading
//                'type' => 'arranged_description'
//            ],
            [
                'name' => 'short_des', // The db column name
                'label' => 'Short Description', // Table column heading
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
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
                'name' => 'is_featured',
                'label' => 'Featured',
                'type' => 'enum',
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ServiceRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Type Title ..',
                ],
            ],


//            [   // Textarea Description
//                'name' => 'description',
//                'label' => 'Description',
//                'type' => 'summernote',
//                'attributes' => [
//                    'placeholder' => 'Write Description Here ... ',
//                ],
//                'options' => [
//                    'toolbar' => [
//                        ['insert', ['picture', 'link', 'video', 'table', 'hr']],
//                        ['Font Style', ['fontname', 'fontsize','fontsizeunit',  'forecolor', 'backcolor', 'bold', 'italic', 'underline','strikethrough','superscript','subscript','clear',]],
//                        ['Paragraph style', ['style','ol','ul','paragraph','height']],
//                        ['Misc', ['fullscreen','codeview','undo','redo','help']]
//                    ]
//                ],
//            ],
            [   // Textarea Short Description
                'name' => 'short_des',
                'label' => 'Short Description',
                'type' => 'textarea',
                'attributes' => [
                    'placeholder' => 'Write Short Description Here ... ',
                ],
            ],
            [  // Select Category
                'label' => "Category",
                'type' => 'select',
                'name' => 'servicecategory_id', // the db column for the foreign key
                'entity' => 'category', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'attributes' => [
                    'id' => 'servicecategory_id'
                ],
                // optional
                'model' => "App\Models\Servicecategory",
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
                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
            [   // Upload Image
                'name' => 'image',
                'label' => 'Image',
                'type' => 'browse',
            ],

            [   // Enum Status
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum'
            ],
            [   // Enum Status
                'name' => 'is_featured',
                'label' => 'Featured',
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
