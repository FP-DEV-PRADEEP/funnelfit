import AppForm from '../app-components/Form/AppForm';

Vue.component('gym-staff-type-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});