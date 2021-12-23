<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.gym-staff.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.gym-staff.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone'), 'has-success': fields.phone && fields.phone.valid }">
    <label for="phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.phone') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.phone" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': fields.phone && fields.phone.valid}" id="phone" name="phone" placeholder="{{ trans('admin.gym-staff.columns.phone') }}">
        <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('clubready_owner_id'), 'has-success': fields.clubready_owner_id && fields.clubready_owner_id.valid }">
    <label for="clubready_owner_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.clubready_owner_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.clubready_owner_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('clubready_owner_id'), 'form-control-success': fields.clubready_owner_id && fields.clubready_owner_id.valid}" id="clubready_owner_id" name="clubready_owner_id" placeholder="{{ trans('admin.gym-staff.columns.clubready_owner_id') }}">
        <div v-if="errors.has('clubready_owner_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('clubready_owner_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('event_uuid'), 'has-success': fields.event_uuid && fields.event_uuid.valid }">
    <label for="event_uuid" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.event_uuid') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.event_uuid" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('event_uuid'), 'form-control-success': fields.event_uuid && fields.event_uuid.valid}" id="event_uuid" name="event_uuid" placeholder="{{ trans('admin.gym-staff.columns.event_uuid') }}">
        <div v-if="errors.has('event_uuid')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('event_uuid') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('gym_staff_type'), 'has-success': this.fields.gym_staff_type && this.fields.gym_staff_type.valid }">
    <label for="gym_staff_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.gym_staff_type_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                id="gym_staff_type"
                v-model="form.gym_staff_type"
                :options="gymStaffTypes"
                :multiple="false"
                track-by="id"
                label="name"
                tag-placeholder="{{ __('Select Gym Staff Type') }}"
                placeholder="{{ __('Gym Staff Type') }}">
            </multiselect>
            <div v-if="errors.has('gym_staff_type')" class="form-control-feedback form-text" v-cloak>@{{
                errors.first('gym_staff_type') }}
            </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('gym_location'), 'has-success': this.fields.gym_location && this.fields.gym_location.valid }">
    <label for="gym_location" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.gym-staff.columns.gym_location_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect
            id="gym_location"
            v-model="form.gym_location"
            :options="gymLocations"
            :multiple="false"
            track-by="id"
            label="name"
            tag-placeholder="{{ __('Select Gym Location') }}"
            placeholder="{{ __('Gym Location') }}"
        >
        </multiselect>
        <div v-if="errors.has('gym_location')" class="form-control-feedback form-text" v-cloak>@{{
            errors.first('gym_location') }}
        </div>
    </div>
</div>
