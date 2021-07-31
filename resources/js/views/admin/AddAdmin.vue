<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Add an admin</h5>
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
                        v-model="admin.first_name"
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
                        v-model="admin.last_name"
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
                        :class="[
                            'form-control',
                            errors.full_name ? 'is-invalid' : ''
                        ]"
                        placeholder="Full name"
                        v-model="admin.full_name"
                        readonly="readonly"
                    />
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationDefault09">Email</label>
                    <input
                        type="email"
                        :class="[
                            'form-control',
                            errors.email ? 'is-invalid' : ''
                        ]"
                        placeholder="Email address"
                        v-model="admin.email"
                    />
                    <span v-if="errors.email" class="text-danger">{{
                        errors.email[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Phone</label>
                    <input
                        type="tel"
                        class="form-control"
                        placeholder="Phone number"
                        v-model="admin.phone"
                    />
                </div>
                <div class="col-md-4 mb-3">
                    <label>Job title</label>
                    <select
                        :class="[
                            'form-control',
                            errors.job_title ? 'is-invalid' : ''
                        ]"
                        v-model="admin.job_title"
                    >
                        <option value="Developper">Developper</option>
                        <option value="Manager">Manager</option>
                        <option value="CEO">CEO</option>
                    </select>
                    <span v-if="errors.job_title" class="text-danger">{{
                        errors.job_title[0]
                    }}</span>
                </div>
                <!-- <label>Image</label>
                <div class="custom-file m-20">
                    <input
                        type="file"
                        class="custom-file-input"
                        accept=".jpg,.gif,.png"
                        id="selectFile"
                        @change="onFileChange"
                    />
                    <label class="custom-file-label" for="customFile"
                        >Choose image</label
                    >
                </div> -->
            </div>
            <button class="btn btn-primary" @click="addAdmin">
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
            admin: {
                first_name: "",
                last_name: "",
                full_name: "",
                email: "",
                phone: "",
                job_title: "Developper",
                image: ""
            },
            errors: []
        };
    },
    methods: {
        addAdmin() {
            // var filename = $("#selectFile")
            //     .val()
            //     .replace(/C:\\fakepath\\/i, "");
            // alert(filename + "");
            axios.post("api/addAdmin", this.admin).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Created successfully"
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
            this.admin.first_name = this.admin.last_name = this.admin.full_name = this.admin.email = this.admin.phone = this.admin.image =
                "";
        },
        fillFullName() {
            this.admin.first_name = this.admin.first_name.toUpperCase();
            this.admin.last_name = this.admin.last_name.toUpperCase();
            this.admin.full_name =
                this.admin.first_name + " " + this.admin.last_name;
        }
    }
};
</script>
