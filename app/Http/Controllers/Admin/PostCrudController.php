<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('Post', 'Posts');
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
                'name'    => 'image',
                'label'   => 'Images',
                'type' => 'single_image_from_multi',
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

        CRUD::column('is_featured');


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
                'name' => 'summary', // The db column name
                'label' => 'Summary', // Table column heading
            ],
            [
                'name' => 'article', // The db column name
                'label' => 'Article', // Table column heading
                'type' => 'arranged_article'
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
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'multi_images_column',
            ],
            [
                'name' => 'video', // The db column name
                'label' => 'Video', // Table column heading
                'type' => 'arranged_video',
                'attributes' => [
                    'id' => 'post_videos'
                ]
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
        CRUD::setValidation(PostRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Type Title ..',
                ],
            ],
            [   // Description
                'name' => 'summary',
                'label' => 'Summary',
                'type' => 'textarea',
                // 'options' => [], // easily pass parameters to the summernote JS initialization
            ],
            [   // Description
                'name' => 'article',
                'label' => 'Article',
                'type' => 'summernote',
                // 'options' => [], // easily pass parameters to the summernote JS initialization
            ],
            [  // Select Category
                'label' => "Category",
                'type' => 'select',
                'name' => 'blogcategory_id', // the db column for the foreign key
                'entity' => 'category', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'attributes' => [
                    'id' => 'blogcategory_id'
                ],
                // optional
                'model' => "App\Models\Blogcategory",
                'options' => (function ($query) {
                    return $query->orderBy('title', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],



            [   // Browse multiple
                'name'          => 'image',
                'label'         => 'Image',
                'type'          => 'browse_multiple',
                // 'multiple'   => true, // enable/disable the multiple selection functionality
                // 'sortable'   => false, // enable/disable the reordering with drag&drop
                'mime_types' => ['image'], // visible mime prefixes; ex. ['image'] or ['application/pdf']
            ],

            [   // Browse multiple
                'name'          => 'video',
                'label'         => 'Video',
                'type'          => 'textarea',
                // 'multiple'   => true, // enable/disable the multiple selection functionality
                // 'sortable'   => false, // enable/disable the reordering with drag&drop
//                'mime_types' => ['video'], // visible mime prefixes; ex. ['image'] or ['application/pdf']
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
