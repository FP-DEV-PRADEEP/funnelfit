<style scoped>
    .vue-daterange-picker {
        width: 100%;
    }
</style>
<template>
    <date-range-picker
        ref="picker"
        v-model="dateRange"
        :autoApply="true"
        @update="rangeSelected"
    >
        <template v-slot:input="picker" style="min-width: 350px;">
            {{ picker.startDate | date }} - {{ picker.endDate | date }}
        </template>
    </date-range-picker>
</template>

<script>
import DateRangePicker from 'vue2-daterange-picker'
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
const dayjs = require('dayjs')
import { connectRange } from 'instantsearch.js/es/connectors';
import { createWidgetMixin } from 'vue-instantsearch';

export default {
    components: {
        DateRangePicker,
    },
    mixins: [
        createWidgetMixin({ connector: connectRange }),
    ],
    data() {
        return {
            dateRange: {
                startDate: undefined,
                endDate: undefined,
            }
        }
    },
    props: {
        attribute: {
            type: String,
            required: true,
        },
        min: {
            type: Number,
            required: false,
            default: 0,
        },
        max: {
            type: Number,
            required: false,
            default: dayjs().add(200, 'year').unix(),
        },
        precision: {
            type: Number,
            required: false,
            default: 0,
        },
    },
    computed: {
        widgetParams() {
            return {
                attribute: this.attribute,
                min: this.min,
                max: this.max,
                precision: this.precision,
            };
        },
    },
    filters: {
        date(value) {
            return value ? dayjs(value).format('MM/DD/YYYY') : 'Select Date'
        }
    },
    methods: {
        rangeSelected() {
            let startValue = dayjs(this.dateRange.startDate).unix()
            let endValue = dayjs(this.dateRange.endDate).unix()

            this.state.refine([
                Number.isFinite(startValue) ? startValue : undefined,
                Number.isFinite(endValue) ? endValue : undefined,
            ]);
        }
    }
}
</script>
