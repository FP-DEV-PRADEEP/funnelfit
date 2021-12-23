import AppListing from '../app-components/Listing/AppListing';

Vue.component('gym-staff-listing', {
    mixins: [AppListing],
    data() {
        return {
            showGymStaffTypesFilter: false,
            showGymLocationsFilter: false,
            gymStaffTypesMultiselect: {},
            gymLocationsMultiselect: {},

            filters: {
                gymStaffTypes: [],
                gymLocations: [],
            },
        }
    },

    watch: {
        showGymLocationsFilter: function (newVal, oldVal) {
            this.gymLocationsMultiselect = [];
        },
        gymLocationsMultiselect: function(newVal, oldVal) {
            this.filters.gymLocations = newVal.map(function(object) { return object['key']; });
            this.filter('gymLocations', this.filters.gymLocations);
        },

        showGymStaffTypesFilter: function (newVal, oldVal) {
            this.gymStaffTypesMultiselect = [];
        },
        gymStaffTypesMultiselect: function(newVal, oldVal) {
            this.filters.gymStaffTypes = newVal.map(function(object) { return object['key']; });
            this.filter('gymStaffTypes', this.filters.gymStaffTypes);
        },
    }
});
