<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Create a project</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Project name</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.name ? 'is-invalid' : ''
                        ]"
                        placeholder="Name of project"
                        v-model="project.name"
                    />
                    <span v-if="errors.name" class="text-danger">{{
                        errors.name[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Client</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.client ? 'is-invalid' : ''
                        ]"
                        placeholder="Client of project"
                        v-model="project.client"
                    />
                    <span v-if="errors.client" class="text-danger">{{
                        errors.client[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Provider</label>
                    <select
                        :class="[
                            'form-control',
                            errors.provider ? 'is-invalid' : ''
                        ]"
                        id="selectProvider"
                    >
                        <option
                            v-for="provider in providers"
                            :key="provider.id"
                        >
                            {{ provider.id + ' | ' + provider.full_name }}
                        </option>
                    </select>
                    <span v-if="errors.provider" class="text-danger">{{
                        errors.provider[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Average daily rate</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.average_daily_rate ? 'is-invalid' : ''
                        ]"
                        placeholder="Average daily rate"
                        v-model="project.average_daily_rate"
                    />
                    <span v-if="errors.average_daily_rate" class="text-danger">{{
                        errors.average_daily_rate[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Start date</label>
                    <date-picker
                        id="startdatePicker"
                        v-model="project.start_date"
                        bootstrap-styling
                        :language="fr"
                        :disabledDates="disabledDates"
                        monday-first
                        calendar-button
                        placeholder="Start date of project"
                        calendar-button-icon="fa fa-calendar"
                        format="yyyy/MM/dd"
                        input-class="bg-white"
                    >
                    </date-picker>
                    <span v-if="errors.start_date" class="text-danger">{{
                        errors.start_date[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label >End date</label>
                    <date-picker
                        v-model="project.end_date"
                        bootstrap-styling
                        :language="fr"
                        :disabledDates="disabledDates2"
                        monday-first
                        calendar-button
                        placeholder="End date of project"
                        calendar-button-icon="fa fa-calendar"
                        format="yyyy/MM/dd"
                        required
                        input-class="bg-white"
                    >
                    </date-picker>
                    <span v-if="errors.end_date" class="text-danger">{{
                        errors.end_date[0]
                    }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8 mb-3">
                    <label>Outstanding</label>
                    <textarea
                        :class="[
                            'form-control',
                            errors.outstanding ? 'is-invalid' : ''
                        ]"
                        rows="3"
                        v-model="project.outstanding"
                    ></textarea>
                    <span v-if="errors.outstanding" class="text-danger">{{
                        errors.outstanding[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label >Commission</label>
                    <div class="form-check" @click="changePlaceholder1">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                            checked
                        />
                        <label class="form-check-label" for="flexRadioDefault1">
                            Per percent (%)
                        </label>
                    </div>
                    <div class="form-check" @click="changePlaceholder2">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                        />
                        <label class="form-check-label" for="flexRadioDefault2">
                            Per value (€)
                        </label>
                    </div>
                    <input
                        type="number"
                        :class="[
                            'form-control',
                            errors.commission ? 'is-invalid' : ''
                        ]"
                        id="commissionInput"
                        placeholder="Commission per percent"
                        v-model="project.commission"
                        calendar-button
                        calendar-button-icon="fa fa-calendar"
                    />
                    <span v-if="errors.commission" class="text-danger">{{
                        errors.commission[0]
                    }}</span>
                </div>
            </div>
            <div class="form-row"></div>
            <button class="btn btn-primary" @click="addProject">
                Create
            </button>
            <button class="btn btn-light" @click="reset">
                Reset
            </button>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { en, fr } from "vuejs-datepicker/dist/locale";
import $ from "jquery";
import NotificationsBar from "./NotificationsBar.vue";

export default {
    data() {
        return {
            project: {
                name: "",
                client: "",
                provider: "",
                average_daily_rate: "",
                start_date: "",
                end_date: "",
                commission: "",
                outstanding: "",
                commissionType: "rate"
            },
            providers: {},
            errors: [],
            en: en,
            fr: fr,
            odel: {
                date: ""
            },
            disabledDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledDates2: {
                to: new Date(Date.now() - 8640000)
            }
        };
    },
    methods: {
        addProject() {
            var p1 = document.getElementById('selectProvider');
            var p2 = p1.options[p1.selectedIndex].value;
            var elems = p2.split(" ");
            this.project.provider = elems[0];
            axios.post("api/createProject", this.project).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Created successfully"
                    });
                    this.errors = [];
                    this.reset;
                }
            });
        },
        getProviders() {
            axios.get("api/getProviders").then(response => {
                this.providers = response.data.data;
            });
        },
        reset() {
            this.project.name = this.project.client = this.project.provider = this.project.average_daily_rate = this.project.start_date = this.project.end_date = this.project.commission = this.project.outstanding =
                "";
        },
        changePlaceholder1() {
            document.getElementById("commissionInput").placeholder =
                "Commission per percent";
            this.project.commissionType = "rate";
        },
        changePlaceholder2() {
            document.getElementById("commissionInput").placeholder =
                "Commission per value";
            this.project.commissionType = "value";
        },
        // strr(str, val1, val2) {
        //     var newStr = "";
        //     for (let index = val1; index < str.length; index++) {
        //         if(index == val2) {
        //             newStr += str.charAt(index);
        //             return newStr;
        //         }
        //         newStr += str.charAt(index);
        //     }
        // }
    },
    created() {
        this.getProviders();
    },
    components: {
        "date-picker": Datepicker,
        "notifications-bar": NotificationsBar
    }
};
</script>
