<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('event', 'events');
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
//            [
//                'name' => 'title', // The db column name
//                'label' => 'Title', // Table column heading
//            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],
//            [
//                'name' => 'type', // name of relationship method in the model
//                'label' => 'Type', // Table column heading
//            ],
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
//            [
//                'name' => 'title', // The db column name
//                'label' => 'Title', // Table column heading
//            ],
//            [
//                'name' => 'description', // The db column name
//                'label' => 'Description', // Table column heading
//            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                'height' => '50px',
                'width' => '50px',
            ],

//            [
//                'name' => 'type', // The db column name
//                'label' => 'Type', // Table column heading
//            ],
//            [
//                // any type of relationship
//                'name' => 'service', // name of relationship method in the model
//                'type' => 'relationship',
//                'label' => 'Service', // Table column heading
//                // OPTIONAL
//                // 'entity'    => 'tags', // the method that defines the relationship in your Model
//                // 'attribute' => 'name', // foreign key attribute that is shown to user
//                // 'model'     => App\Models\Category::class, // foreign key model
//            ],
//            [
//                // any type of relationship
//                'name' => 'post', // name of relationship method in the model
//                'type' => 'relationship',
//                'label' => 'Post', // Table column heading
//                // OPTIONAL
//                // 'entity'    => 'tags', // the method that defines the relationship in your Model
//                // 'attribute' => 'name', // foreign key attribute that is shown to user
//                // 'model'     => App\Models\Category::class, // foreign key model
//            ],
//            [
//                // any type of relationship
//                'name' => 'project', // name of relationship method in the model
//                'type' => 'relationship',
//                'label' => 'Project', // Table column heading
//                // OPTIONAL
//                // 'entity'    => 'tags', // the method that defines the relationship in your Model
//                // 'attribute' => 'name', // foreign key attribute that is shown to user
//                // 'model'     => App\Models\Category::class, // foreign key model
//            ],
//
//            [
//                // any type of relationship
//                'name' => 'product', // name of relationship method in the model
//                'type' => 'relationship',
//                'label' => 'Product', // Table column heading
//                // OPTIONAL
//                // 'entity'    => 'tags', // the method that defines the relationship in your Model
//                // 'attribute' => 'name', // foreign key attribute that is shown to user
//                // 'model'     => App\Models\Category::class, // foreign key model
//            ],
//            [
//                'name' => 'is_featured',
//                'label' => 'Featured',
//                'type' => 'enum',
//            ],

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
        CRUD::setValidation(EventRequest::class);

        $this->crud->addFields([
//            [   // Text Title
//                'name' => 'title',
//                'label' => "Title",
//                'type' => 'text',
//                'attributes' => [
//                    'placeholder' => 'Type Title ..',
//                ],
//            ],


//            [   // Textarea Description
//                'name' => 'description',
//                'label' => 'Description',
//                'type' => 'textarea',
//                'attributes' => [
//                    'placeholder' => 'Write Description Here ... ',
//                ],
//            ],
            [
                'name' => 'image',
                'label' => 'Image',
                'type' => 'browse',
            ],
//            [   // Upload Image
//                'name' => 'type',
//                'label' => 'Type',
//                'type' => 'enum',
//                'attributes' => [
//                    'id' => 'event_type',
//                ],
//            ],
//
//            [   // Upload Image
//                'name' => 'event_type',
//                'label' => 'Type',
//                'type' => 'event_type',
//                'attributes' => [
//                    'id' => 'event_type',
//                ],
//            ],
//
//            [   // Textarea Description
//                'name' => 'url',
//                'label' => 'External Url',
//                'type' => 'url',
//                'attributes' => [
//                    'placeholder' => 'http://external.com/example ',
//                    'id' => 'url'
//                ],
//            ],
//
//            [  // Select Category
//                'label' => "Products",
//                'type' => 'select',
//                'name' => 'product_id', // the db column for the foreign key
//                'entity' => 'product', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//                'attributes' => [
//                    'id' => 'product_id'
//                ],
//                // optional
//                'model' => "App\Models\Product",
//                'options' => (function ($query) {
//                    return $query->active()->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
//            [  // Select Category
//                'label' => "Services",
//                'type' => 'select',
//                'name' => 'service_id', // the db column for the foreign key
//                'entity' => 'service', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//                'attributes' => [
//                    'id' => 'service_id'
//                ],
//                // optional
//                'model' => "App\Models\Service",
//                'options' => (function ($query) {
//                    return $query->active()->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
//            [  // Select Category
//                'label' => "Projects",
//                'type' => 'select',
//                'name' => 'project_id', // the db column for the foreign key
//                'entity' => 'project', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//                'attributes' => [
//                    'id' => 'project_id'
//                ],
//                // optional
//                'model' => "App\Models\Project",
//                'options' => (function ($query) {
//                    return $query->active()->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
//            [  // Select Category
//                'label' => "Posts",
//                'type' => 'select',
//                'name' => 'post_id', // the db column for the foreign key
//                'entity' => 'post', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//                'attributes' => [
//                    'id' => 'post_id'
//                ],
//                // optional
//                'model' => "App\Models\Post",
//                'options' => (function ($query) {
//                    return $query->active()->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],


            [   // Enum Status
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum'
            ],
//            [   // Enum Status
//                'name' => 'is_featured',
//                'label' => 'Featured',
//                'type' => 'enum'
//            ],
        ]);


//        CRUD::field('service_id');
//        CRUD::field('post_id');
//        CRUD::field('project_id');


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
