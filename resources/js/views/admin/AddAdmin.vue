<template>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nouveau administrateur / nouvelle administratrice</h4>
                    <p class="card-description">
                        Information personnelle
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Prénom</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errors.first_name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="John"
                                        v-model="admin.first_name"
                                        @keydown="fillFullName"
                                        @change="fillFullName"
                                    />
                                    <span v-if="errors.first_name" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.first_name[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Nom</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" :class="[
                                            'form-control',
                                            errors.first_name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="DOE"
                                        v-model="admin.last_name"
                                        @keydown="fillFullName"
                                        @change="fillFullName"
                                    />
                                    <span v-if="errors.last_name" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.last_name[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Sexe</label
                                >
                                <div class="col-sm-9">
                                    <select class="form-control" v-model="admin.gender">
                                        <option>Masculin</option>
                                        <option>Féminin</option>
                                    </select>
                                    <span v-if="errors.gender" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.gender[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Date de naissance</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="date"
                                        :class="[
                                            'form-control',
                                            errors.dateOfBirth
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="1970/12/01"
                                        v-model="admin.dateOfBirth"
                                    />
                                    <span v-if="errors.dateOfBirth" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.dateOfBirth[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Email</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="email"
                                        :class="[
                                            'form-control',
                                            errors.email
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="John.doe@gmail.com"
                                        v-model="admin.email"
                                        @key="toLower"
                                    />
                                    <span v-if="errors.email" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.email[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Numéro de téléphone</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errors.phone
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="0710203040"
                                        v-model="admin.phone"
                                    />
                                    <span v-if="errors.phone" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.phone[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="addAdmin" class="btn btn-primary me-2">
                        <span v-show="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Ajouter
                    </button>
                    <button class="btn btn-light" @click="reset">Réinitialiser</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            admin: {
                first_name: "",
                last_name: "",
                full_name: "",
                email: "",
                phone: "",
                gender: "Masculin",
                dateOfBirth: "",
                image: ""
            },
            errors: [],
            isLoading: false,
        };
    },
    methods: {
        addAdmin() {
            this.admin.full_name = this.admin.first_name + ' ' + this.admin.last_name;
            this.isLoading = true;
            axios.post("api/addAdmin", this.admin).then(response => {
                this.isLoading = false;
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Created successfully",
                        position: "bottom-end"
                    });
                    this.errors = [];
                }
            });
        },
        // onFileChange(e) {
        //     console.log(e.target.files[0]);
        //     this.admin.image = e.target.files[0];
        // },
        reset() {
            this.admin.first_name = this.admin.last_name = this.admin.full_name = this.admin.email = this.admin.dateOfBirth = this.admin.phone = this.admin.image =
                "";
        },
        fillFullName() {
            const str = this.admin.first_name;
            const str2 = str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            this.admin.first_name = str2;
            this.admin.last_name = this.admin.last_name.toUpperCase();
        },
        toLower() {
            this.admin.email = this.admin.email.toLowerCase();
        },
    }
};
</script>
