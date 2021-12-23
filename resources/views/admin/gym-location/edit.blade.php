@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.gym-location.actions.edit', ['name' => $gymLocation->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <gym-location-form
                :action="'{{ $gymLocation->resource_url }}'"
                :data="{{ $gymLocation->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.gym-location.actions.edit', ['name' => $gymLocation->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.gym-location.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </gym-location-form>

        </div>
    
</div>

@endsection