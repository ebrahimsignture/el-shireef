<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmployeeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmployeeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmployeeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/employee');
        CRUD::setEntityNameStrings('Employee', 'Employees');
        $this->crud->orderBy('lft', 'ASC');

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
                'name' => 'job_title', // The db column name
                'label' => 'Job Title', // Table column heading
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
                'name' => 'name', // The db column name
                'label' => 'Name', // Table column heading
            ],

            [
                'name' => 'job_title', // The db column name
                'label' => 'Job Title', // Table column heading
            ],

            [
                'name' => 'fb_url', // The db column name
                'label' => 'Facebook', // Table column heading
            ],
            [
                'name' => 'twitter_url', // The db column name
                'label' => 'Twitter', // Table column heading
            ],
            [
                'name' => 'youtube_url', // The db column name
                'label' => 'Youtube', // Table column heading
            ],
            [
                'name' => 'instagram_url', // The db column name
                'label' => 'Instagram', // Table column heading
            ],
            [
                'name' => 'behance_url', // The db column name
                'label' => 'Behance', // Table column heading
            ],
            [
                'name' => 'whatsapp_url', // The db column name
                'label' => 'Whatsapp', // Table column heading
            ],
            [
                'name' => 'linked_url', // The db column name
                'label' => 'Linked in', // Table column heading
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


    public function setupReorderOperation() {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'title');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 100);
    }



    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmployeeRequest::class);

        $this->crud->addFields([
            [   // Text Title
                'name' => 'name',
                'label' => "Name",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Type Name ..',
                ],
            ],
            [   // Text Title
                'name' => 'job_title',
                'label' => "Job Title",
                'type' => 'text',
                'attributes' => [
                    'placeholder' => 'Type Job Title ..',
                ],
            ],




            [   // Textarea Description
                'name' => 'youtube_url',
                'label' => 'Youtube',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://youtube.com/example ',
                ],
            ],
            [   // Textarea Description
                'name' => 'fb_url',
                'label' => 'Facebook',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://facebook.com/example ',
                ],
            ],
            [   // Textarea Description
                'name' => 'twitter_url',
                'label' => 'Twitter',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://twitter.com/example ',
                ],
            ],
            [   // Textarea Description
                'name' => 'instagram_url',
                'label' => 'Instagram',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://instagram.com/example ',
                ],
            ],
            [   // Textarea Description
                'name' => 'behance_url',
                'label' => 'Behance',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://behance.com/example ',
                ],
            ],
            [   // Textarea Description
                'name' => 'whatsapp_url',
                'label' => 'Whatsapp',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://whatsapp.com/example ',
                ],
            ],

            [   // Textarea Description
                'name' => 'linked_url',
                'label' => 'Linked In',
                'type' => 'url',
                'attributes' => [
                    'placeholder' => 'http://linkedin.com/example ',
                ],
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
