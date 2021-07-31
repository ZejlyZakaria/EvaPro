<template>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Add a provider</h5>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault01">First name</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.first_name ? 'is-invalid' : ''
                        ]"
                        placeholder="First name"
                        v-model="fournisseur.first_name"
                        @change="fillFullName"
                    />
                    <span v-if="errors.first_name" class="text-danger">{{
                        errors.first_name[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault02">Last name</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.last_name ? 'is-invalid' : ''
                        ]"
                        placeholder="Last name"
                        v-model="fournisseur.last_name"
                        @change="fillFullName"
                    />
                    <span v-if="errors.last_name" class="text-danger">{{
                        errors.last_name[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Full name</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Full name"
                        v-model="fournisseur.full_name"
                        readonly="readonly"
                    />
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault09">Email</label>
                    <input
                        type="email"
                        :class="['form-control', errors.email ? 'is-invalid' : '']"
                        placeholder="Email address"
                        v-model="fournisseur.email"
                    />
                    <span v-if="errors.email" class="text-danger">{{
                        errors.email[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault55">Phone</label>
                    <input
                        type="email"
                        class="form-control"
                        placeholder="Phone number"
                        v-model="fournisseur.phone"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <label>Type</label>
                    <select
                        :class="['form-control', errors.type ? 'is-invalid' : '']"
                        v-model="fournisseur.type"
                    >
                        <option value="Salarié">Salarié</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                    <span v-if="errors.type" class="text-danger">{{
                        errors.type[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Social security number</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Numéro de sécurité sociale"
                        v-model="fournisseur.ssn"
                    />
                </div>
            </div>
            <button class="btn btn-primary" @click="addUser">
                Add
            </button>
            <button class="btn btn-light" @click="reset">
                Reset
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            fournisseur: {
                first_name: "",
                last_name: "",
                full_name: "",
                email: "",
                phone: "",
                type: "Salarié",
                ssn: ""
            },
            errors: []
        };
    },
    methods: {
        addUser() {
            axios.post("api/addUser", this.fournisseur).then(response => {
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
        reset() {
            this.fournisseur.first_name = this.fournisseur.last_name = this.fournisseur.full_name = this.fournisseur.email = this.fournisseur.phone = this.fournisseur.ssn = "";
        },
        fillFullName() {
            this.fournisseur.first_name = this.fournisseur.first_name.toUpperCase();
            this.fournisseur.last_name = this.fournisseur.last_name.toUpperCase();
            this.fournisseur.full_name = this.fournisseur.first_name + " " + this.fournisseur.last_name;
        }
    }
};
</script>
