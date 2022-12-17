<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SettingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SettingCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Setting::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/setting');
        CRUD::setEntityNameStrings('setting', 'settings');
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
                'label' => 'Meta - Title', // Table column heading
                'type' => 'text',
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'Meta - Type',
                'type' => 'text'
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'logo', // The db column name
                'label' => 'Logo', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],

            [
                'name' => 'email', // The db column name
                'label' => 'Email', // Table column heading
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


    protected function setupShowOperation()
    {

        $this->crud->addColumns([
            [
                'name' => 'title', // The db column name
                'label' => 'Title', // Table column heading
                'type' => 'text',
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'Type',
                'type' => 'text'
            ],
            [
                'name' => 'description',
                'label' => 'Long Des',
                'type' => 'arranged_description'
            ],

            [
                'name' => 'short_des',
                'label' => 'Short Des'
            ],
            [
                'name' => 'image', // The db column name
                'label' => 'Image', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'logo', // The db column name
                'label' => 'Logo', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
            ],
            [
                'name' => 'about_us_image', // The db column name
                'label' => 'About us Image', // Table column heading
                'type' => 'image',
                // optional width/height if 25px is not ok with you
                // 'height' => '30px',
                // 'width'  => '30px',
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
                'name' => 'address', // The db column name
                'label' => 'Address', // Table column heading
            ],
            [
                'name' => 'phone', // The db column name
                'label' => 'Phone', // Table column heading
                'type' => 'arranged_phones',
                // 'limit' => 10, // if you want to truncate the phone number to a different number of characters
            ],
            [
                'name' => 'email', // The db column name
                'label' => 'Email', // Table column heading
            ],
            [
                'name' => 'facebook', // The db column name
                'label' => 'Facebook', // Table column heading
            ],
            [
                'name' => 'twitter', // The db column name
                'label' => 'Twitter', // Table column heading
            ],
            [
                'name' => 'linkedin', // The db column name
                'label' => 'Linkedin', // Table column heading
            ],
            [
                'name' => 'behance', // The db column name
                'label' => 'Behance', // Table column heading
            ],
            [
                'name' => 'instagram', // The db column name
                'label' => 'Instagram', // Table column heading
            ],
            [
                'name' => 'whatsapp', // The db column name
                'label' => 'WhatsApp', // Table column heading
            ],
            [
                'name' => 'location',
                'label' => 'Google Map',
                'type' => 'arranged_map'
            ],
            [
                'name' => 'privacy',
                'label' => 'Privacy Policy',
                'type' => 'arranged_rights'
            ],

        ]);


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
//
//    protected function setupCreateOperation()
//    {
//        CRUD::setValidation(SettingRequest::class);
//
//        $this->crud->addFields([
//            [   // Summernote
//                'name' => 'title',
//                'label' => 'Title',
//                'type' => 'text'
//            ],
//            [   // Summernote
//                'name' => 'type',
//                'label' => 'Type',
//                'type' => 'text'
//            ],
//            [   // Summernote
//                'name' => 'short_des',
//                'label' => 'Short Description',
//                'type' => 'textarea'
//            ],
//            [   // Summernote
//                'name' => 'description',
//                'label' => 'Long Description',
//                'type' => 'summernote'
//            ],
//            [   // Upload Image
//                'name' => 'image',
//                'label' => 'Image',
//                'type' => 'browse',
//            ],
//            [   // Upload Image
//                'name' => 'logo',
//                'label' => 'Logo',
//                'type' => 'browse',
//            ],
//            [   // Upload Image
//                'name' => 'about_us_image',
//                'label' => 'About us Image',
//                'type' => 'browse',
//            ],
//
//            [    // Select2Multiple = n-n relationship (with pivot table)
//                'label' => "Tags",
//                'type' => 'select2_multiple',
//                'name' => 'tags', // the method that defines the relationship in your Model
//                'entity' => 'tags', // the method that defines the relationship in your Model
//                'attribute' => 'title', // foreign key attribute that is shown to user
//
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
//                // 'select_all' => true, // show Select All and Clear buttons?
//
//
//                // optional
//                'model' => "App\Models\Tag", // foreign key model
//                'options' => (function ($query) {
//                    return $query->where('status', 'active')->orderBy('title', 'ASC')->get();
//                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
//            ],
//            [
//                'name' => 'address',
//                'lable' => 'Address',
//                'type' => 'text'
//            ],
//            [
//                'name' => 'phone',
//                'lable' => 'Phone',
//                'type' => 'text'
//            ],
//
//            [
//                'name' => 'whatsapp',
//                'lable' => 'Whatsapp',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'email',
//                'lable' => 'Email',
//                'type' => 'email'
//            ],
//            [
//                'name' => 'facebook',
//                'lable' => 'Facebook',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'twitter',
//                'lable' => 'Twitter',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'linkedin',
//                'lable' => 'Linkedin',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'behance',
//                'lable' => 'Behance',
//                'type' => 'url'
//            ],
//            [
//                'name' => 'instagram',
//                'lable' => 'Instagram',
//                'type' => 'url'
//            ],
//
//
//            [   // Summernote
//                'name' => 'privacy',
//                'label' => 'Privacy Policy',
//                'type' => 'summernote'
//            ],
//
//        ]);
//    }


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(SettingRequest::class);

        $this->crud->addFields([
            [   // Summernote
                'name' => 'title',
                'label' => 'Title',
                'type' => 'text'
            ],
            [   // Summernote
                'name' => 'type',
                'label' => 'Type',
                'type' => 'text'
            ],
            [   // Summernote
                'name' => 'short_des',
                'label' => 'Short Description',
                'type' => 'textarea'
            ],
            [   // Summernote
                'name' => 'description',
                'label' => 'Long Description',
                'type' => 'summernote'
            ],
            [   // Upload Image
                'name' => 'image',
                'label' => 'Image',
                'type' => 'browse',
            ],
            [   // Upload Image
                'name' => 'logo',
                'label' => 'Logo',
                'type' => 'browse',
            ],
            [   // Upload Image
                'name' => 'about_us_image',
                'label' => 'About us Image',
                'type' => 'browse',
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
            [
                'name' => 'address',
                'lable' => 'Address',
                'type' => 'text'
            ],
            [
                'name' => 'location',
                'lable' => 'Google Map',
                'type' => 'textarea'
            ],
            [
                'name' => 'phone',
                'lable' => 'Phone',
                'type' => 'text'
            ],

            [
                'name' => 'whatsapp',
                'lable' => 'Whatsapp',
                'type' => 'url'
            ],
            [
                'name' => 'email',
                'lable' => 'Email',
                'type' => 'email'
            ],
            [
                'name' => 'facebook',
                'lable' => 'Facebook',
                'type' => 'url'
            ],
            [
                'name' => 'twitter',
                'lable' => 'Twitter',
                'type' => 'url'
            ],
            [
                'name' => 'linkedin',
                'lable' => 'Linkedin',
                'type' => 'url'
            ],
            [
                'name' => 'behance',
                'lable' => 'Behance',
                'type' => 'url'
            ],
            [
                'name' => 'instagram',
                'lable' => 'Instagram',
                'type' => 'url'
            ],


            [   // Summernote
                'name' => 'privacy',
                'label' => 'Privacy Policy',
                'type' => 'summernote'
            ],

        ]);
    }
}
