import AppForm from '../app-components/Form/AppForm';

Vue.component('gym-location-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});