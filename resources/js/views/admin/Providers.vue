<template>
    <div class="col-lg-12 grid-margin stretch-card" style="font-weight: 500">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tableau des fournisseurs</h4>
                <div class="d-flex flex-row-reverse">
                    <div class="col-sm-3">
                <input type="text" class="form-control" v-model="searchQuery" placeholder="Rechercher...">

                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Tél</th>
                                <th>Type</th>
                                <th>Enregistré à</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in temp.data" :key="user.id">
                                <td class="py-1">
                                    <img :src="'assets/images/' + user.image" alt='image'/>
                                </td>
                                <td>{{ user.first_name | uptext }}</td>
                                <td>{{ user.last_name | uptext }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.phone }}</td>
                                <td>{{ user.type | uptext }}</td>
                                <td>{{ user.created_at | myDate }}</td>
                                <td>
                                    <a href="#">
                                        <i
                                            class="fa fa-edit blue mr-4"
                                            @click="editModal(user)"
                                        ></i>
                                    </a>

                                    <a
                                        href="#"
                                        v-show="user.project_count == 0"
                                        @click="deleteUser(user.id)"
                                    >
                                        <i
                                            class="fa fa-trash "
                                            style="color: red"
                                        ></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            Modifier ce fournisseur
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- start form -->
                    <form
                        @submit.prevent="editmode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <!-- last name -->
                            <div class="form-group">
                                <input
                                    id="first_name"
                                    v-model="form.first_name"
                                    placeholder="First Name"
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'first_name'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="first_name"
                                ></has-error>
                            </div>

                            <!-- first name -->
                            <div class="form-group">
                                <input
                                    id="last_name"
                                    v-model="form.last_name"
                                    placeholder="Last Name"
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'last_name'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="last_name"
                                ></has-error>
                            </div>

                            <!-- email -->
                            <div class="form-group">
                                <input
                                    id="email"
                                    v-model="form.email"
                                    placeholder="Email"
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    placeholder="Phone"
                                    type="number"
                                    name="phone"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('phone')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="phone"
                                ></has-error>
                            </div>

                            <!-- type -->
                            <div class="form-group">
                                <select
                                    id="type"
                                    v-model="form.type"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                                >
                                    <option value="" disabled selected hidden
                                        >Choisir un type</option
                                    >
                                    <option>Salarié</option>
                                    <option>Freelance</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="type"
                                ></has-error>
                            </div>

                            <!-- security number -->
                            <div class="form-group">
                                <input
                                    id="social_security_number"
                                    v-model="form.social_security_number"
                                    placeholder="Social Security Number"
                                    type="text"
                                    name="social_security_number"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'social_security_number'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="social_security_number"
                                ></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Fermer
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Form from "vform";
import axios from "axios";
export default {
    data() {
        return {
            editmode: false,
            title: "Add New Collaborator",
            btntitle: "Create",
            users: {},
            searchQuery: "",
            temp: {},
            form: new Form({
                id: "",
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                type: "",
                social_security_number: "",
                created_at: "",
                project_count: ""
            })
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("api/user?page=" + page).then(response => {
                this.users = { ...this.users, ...response.data };
                this.temp = response.data;
            });
        },
        updateUser() {
            this.$Progress.start();
            this.form
                .put("api/user/" + this.form.id)
                .then(() => {
                    $("#addNew").modal("hide");
                    swalWithBootstrapButtons.fire(
                        "Updated!",
                        "Informations has been Updated.",
                        "success"
                    );
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                    Fire.$emit("AfterCreate"); // modify without refresh
                });
        },
        editModal(user) {
            this.btntitle = "Update";
            this.title = "Update The Collaborator";
            this.editmode = true;

            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(user); //  fill the input by the info of the user selected
        },
        newModal() {
            this.btntitle = "Create";
            this.editmode = false;
            this.title = "Add New Collaboratorr";

            this.form.reset();
            $("#addNew").modal("show");
        },
        createUser() {
            this.$Progress.start();
            this.form
                .post("api/user")
                .then(() => {
                    // fire - updating the data after creating without refresh
                    Fire.$emit("AfterCreate");
                    // hide the modal after creating a new user
                    $("#addNew").modal("hide");
                    // sweet alert after creating a new user
                    Toast.fire({
                        icon: "success",
                        title: "User Created Successfully"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {});
        },
        loadUsers() {
            axios.get("api/showUsers").then(({ data }) => (this.users = data));
            axios.get("api/showUsers").then(({ data }) => (this.temp = data));
        },
        deleteUser(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success m-3 ",
                    cancelButton: "btn btn-danger m-3"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                })
                .then(result => {
                    // send the request
                    if (result.value) {
                        this.form
                            .delete("api/user/" + id)
                            .then(() => {
                                swalWithBootstrapButtons.fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                );
                                Fire.$emit("AfterCreate");
                            })
                            .catch(() => {
                                if (
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                        "Cancelled",
                                        "Your imaginary file is safe :)",
                                        "error"
                                    );
                                }
                            });
                    }
                });
        }
    },
    created() {
        this.loadUsers();
        // setInterval(() => this.loadUsers(), 1500);
        //method 2
        Fire.$on("AfterCreate", () => {
            this.loadUsers();
        });

        Fire.$on("searching", () => {
            let query = this.$parent.search; // for taking the informations from the parent app.js
            axios
                .get(`api/findUser?q=${query}`) // send and http request to the server
                .then(data => {
                    // this.users = data.data; // data is the info caming from the srever
                    this.temp = data.data; // data is the info caming from the srever
                })
                .catch(() => {});
        });
    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length >= 0) {
                var users2 = this.users.data;
                this.temp.data = users2.filter(item => {
                    return (
                        item.last_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.first_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.email
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.type
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1
                    );
                });
            }
        }
    }
};
</script>

