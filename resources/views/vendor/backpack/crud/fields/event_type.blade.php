<!-- field_type_name -->
@include('crud::fields.inc.wrapper_start')



{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- no styles -->
    @endpush

    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script>
            $(window).ready(function () {
                $('#service_id').parent().css('display','none');
                $('#product_id').parent().css('display','none');
                $('#project_id').parent().css('display','none');
                $('#post_id').parent().css('display','none');
                $('#url').parent().css('display','none');
                let type = $('#event_type').val();
                if(type === 'service') {
                    $('#service_id').parent().css('display','block');
                } else if (type === 'project') {
                    $('#project_id').parent().css('display','block');
                } else if (type === 'post') {
                    $('#post_id').parent().css('display','block');
                }else if (type === 'external') {
                    $('#url').parent().css('display','block');
                }else if (type === 'product') {
                    $('#product_id').parent().css('display','block');
                }
                $('#event_type').change(function () {
                    let type = $(this).val();
                    if (type != null && type === 'service') {
                        $('#service_id').parent().css('display','block');
                        $('#project_id').val('');
                        $('#project_id').parent().css('display','none');
                        $('#product_id').val('');
                        $('#product_id').parent().css('display','none');
                        $('#post_id').val('');
                        $('#post_id').parent().css('display','none');
                        $('#url').val('');
                        $('#url').parent().css('display','none');

                    } else if (type != null && type === 'project') {
                        $('#project_id').parent().css('display','block');

                        $('#service_id').val('');
                        $('#service_id').parent().css('display','none');
                        $('#product_id').val('');
                        $('#product_id').parent().css('display','none');
                        $('#post_id').val('');
                        $('#post_id').parent().css('display','none');
                        $('#url').val('');
                        $('#url').parent().css('display','none');

                    } else if (type != null && type === 'post') {
                        $('#post_id').parent().css('display','block');

                        $('#product_id').val('');
                        $('#product_id').parent().css('display','none');
                        $('#project_id').val('');
                        $('#project_id').parent().css('display','none');
                        $('#service_id').val('');
                        $('#service_id').parent().css('display','none');
                        $('#url').val('');
                        $('#url').parent().css('display','none');

                    } else if (type != null && type === 'external') {
                        $('#url').parent().css('display','block');

                        $('#product_id').val('');
                        $('#product_id').parent().css('display','none');
                        $('#project_id').val('');
                        $('#project_id').parent().css('display','none');
                        $('#service_id').val('');
                        $('#service_id').parent().css('display','none');
                        $('#post_id').val('');
                        $('#post_id').parent().css('display','none');

                    } else if (type != null && type === 'product') {
                        $('#product_id').parent().css('display','block');

                        $('#url').val('');
                        $('#url').parent().css('display','none');
                        $('#project_id').val('');
                        $('#project_id').parent().css('display','none');
                        $('#service_id').val('');
                        $('#service_id').parent().css('display','none');
                        $('#post_id').val('');
                        $('#post_id').parent().css('display','none');

                    } else if (type != null && type === 'none') {
                        $('#product_id').val('');
                        $('#product_id').parent().css('display','none');
                        $('#url').val('');
                        $('#url').parent().css('display','none');
                        $('#project_id').val('');
                        $('#project_id').parent().css('display','none');
                        $('#service_id').val('');
                        $('#service_id').parent().css('display','none');
                        $('#post_id').val('');
                        $('#post_id').parent().css('display','none');
                    }
                })

            });

        </script>
    @endpush
@endif
