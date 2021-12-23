import AppForm from '../app-components/Form/AppForm';

Vue.component('gym-staff-form', {
    mixins: [AppForm],
    props: [
        'gymStaffTypes',
        'gymLocations'
    ],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                phone:  '' ,
                clubready_owner_id:  '' ,
                event_uuid:  '' ,
                gym_staff_type: '',
                gym_location: '',
            }
        }
    }

});
