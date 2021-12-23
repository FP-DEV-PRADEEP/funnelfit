@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.gym-staff.actions.edit', ['name' => $gymStaff->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <gym-staff-form
                :action="'{{ $gymStaff->resource_url }}'"
                :gym-staff-types="{{$gymStaffTypes->toJson()}}"
                :gym-locations="{{$gymLocations->toJson()}}"
                :data="{{ $gymStaff->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.gym-staff.actions.edit', ['name' => $gymStaff->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.gym-staff.components.form-elements')
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </gym-staff-form>

        </div>

</div>

@endsection
