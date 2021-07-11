<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Prospects</div>
                <div class="card-body">
                  <div class="row mb-4">
                    <div class="col-sm-3">
                      <input type="text" v-model="form.search" class="form-control" placeholder="Search firstname, lastname, email, phone">
                    </div>
                    <div class="col-sm-3">
                      <Datepicker v-model="form.date" input-class="form-control" placeholder="Select date"></Datepicker>
                    </div>
                    <div class="col-sm-3">
                      <select name="gym" id="filter-gym" class="form-control" v-model="form.gym">
                        <option value="">Select Gym</option>
                        <option :value="gym" v-for="gym in gyms">{{ gym }}</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <button class="btn btn-link" type="button" @click="resetFilter">Reset</button>
                    </div>
                  </div>
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Source</th>
                        <th scope="col">Gym Location</th>
                      </tr>
                    </thead>
                    <tbody v-if="data.data.length > 0">
                      <tr v-for="item in data.data" :key="item.id">
                        <td>{{ item.date }}</td>
                        <td>{{ item.prospect_first_name }}</td>
                        <td>{{ item.prospect_last_name }}</td>
                        <td>{{ item.prospect_email }}</td>
                        <td>{{ item.prospect_phone }}</td>
                        <td>{{ item.prospect_city }}</td>
                        <td>{{ item.prospect_state }}</td>
                        <td>{{ item.prospect_source }}</td>
                        <td>{{ item.prospect_gym }}</td>
                      </tr>
                    </tbody>
                    <tbody v-if="data.data.length <= 0">
                      <tr>
                        <td colspan="6" align="center">No items found.</td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :data="data" @pagination-change-page="getProspects"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'

export default {
    name: 'ProspectsIndex',
    components: {
      Datepicker
    },
    data() {
      return {
        data: {
          data: []
        },
        gyms: [],
        form: {
          search: '',
          date: '',
          gym: '',
        }
      }
    },
    methods: {
      getProspects(page = 1) {
        axios.get(`prospects/get-data?page=${page}`, {params: pickBy(this.form)})
          .then(response => {
            console.log(response)
            this.data = response.data
          })
      },
      getGyms() {
        axios.get(`prospects/get-gyms`)
          .then(response => {
            console.log(response)
            this.gyms = response.data
          })
      },
      resetFilter() {
        this.form = mapValues(this.form, () => '')
      }
    },
    watch: {
      form: {
        deep: true,
        handler: throttle(function() {
          this.getProspects()
        }, 700),
      },
    },
    mounted() {
      this.getProspects();
      this.getGyms();
    }
}
</script>
