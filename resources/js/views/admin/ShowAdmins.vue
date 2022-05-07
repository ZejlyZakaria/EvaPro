<template>
    <div class="col-lg-12 grid-margin stretch-card" style="font-weight: 500">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tableau Des Admins</h4>
                <div class="d-flex flex-row-reverse">
                    <div class="col-sm-3">
                        <input
                            type="text"
                            class="form-control"
                            v-model="searchQuery"
                            placeholder="Rechercher..."
                        />
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
                                <th>Téléphone</th>
                                <th>Sexe</th>
                                <th>Date de naissance</th>
                                <th>Enregistré à</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="admin in temp.data" :key="admin.id">
                               <td class="py-1">
                                    <img
                                        :src="'assets/images/' + admin.image"
                                        alt="image"
                                    />
                                </td>
                                <td>{{ admin.first_name | uptext }}</td>
                                <td>{{ admin.last_name | uptext }}</td>
                                <td>{{ admin.email }}</td>
                                <td>{{ admin.phone }}</td>
                                <td>{{ admin.gender | uptext }}</td>
                                <td>{{ admin.dateOfBirth }}</td>
                                <td>{{ admin.created_at |myDate }}</td>
                                <td>
                                    <a href="#">
                                        <i
                                            class="far fa-edit"
                                            style="color: #1F3BB3; font-size:16px;margin-right:10px"
                                            @click="editModal(admin)"
                                        ></i>
                                    </a>

                                    <a
                                        href="#"
                                        v-if="admin.id != currentAdmin"
                                        @click="deleteAdmin(admin.id)"
                                    >
                                        <i
                                            class="fas fa-trash-alt"
                                            style="color: red; font-size:16px"
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
            <div class="modal-dialog" style="margin-top:20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            {{ title }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="closeModal"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- start form -->
                    <form @submit.prevent="updateAdmin()">
                        <div class="modal-body">
                            <!-- last name -->
                            <div class="form-group">
                                <label for="">Prénom</label>
                                <input
                                    id="first_name"
                                    v-model="form.first_name"
                                    placeholder="Prénom"
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

                            <!-- last name -->
                            <div class="form-group">
                                <label for="">Nom</label>
                                <input
                                    id="last_name"
                                    v-model="form.last_name"
                                    placeholder="Nom"
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
                                <label for="">Email</label>
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
                                <label for="">Numéro du téléphone</label>
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    placeholder="Numéro du téléphone"
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

                            <!-- gender -->
                            <div class="form-group">
                                <label for="">Sexe</label>
                                <select
                                    id="gender"
                                    v-model="form.gender"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('gender')
                                    }"
                                >
                                    <option value="" disabled selected hidden
                                        >Choisir un sexe</option
                                    >
                                    <option>Masculin</option>
                                    <option>Féminin</option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="gender"
                                ></has-error>
                            </div>

                            <!-- naissance -->
                            <div class="form-group">
                                <label for="">Date de naissance</label>
                                <input
                                    id="dateOfBirth"
                                    v-model="form.dateOfBirth"
                                    placeholder="Date de naissnace"
                                    type="date"
                                    name="dateOfBirth"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'dateOfBirth'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="dateOfBirth"
                                ></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                                @click="closeModal"
                            >
                                Fermer
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Modifier
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
            currentAdmin: document
                    .querySelector("meta[name='user-id']")
                    .getAttribute("content"),
            title: "Modifier l'Admin",
            btntitle: "Create",
            admins: {},
            searchQuery: "",
            temp: {},
            form: new Form({
                id: "",
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                gender: "",
                dateOfBirth: "",
                created_at: "",
            })
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("api/admin?page=" + page).then(response => {
                this.admins = { ...this.admins, ...response.data };
                this.temp = response.data;
            });
        },
        updateAdmin() {
            this.$Progress.start();
            this.form
                .put("api/admin/" + this.form.id)
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
        editModal(admin) {
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(admin); //  fill the input by the info of the user selected
        },
        loadUsers() {
            axios
                .get("api/showAdmins")
                .then(({ data }) => (this.projects = data));
            axios
                .get("api/showAdmins")
                .then(({ data }) => (this.temp = data));
        },
        deleteAdmin(id) {
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
                            .delete("api/admin/" + id)
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
        },
        closeModal() {
            $("#addNew").modal("hide");
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
                .get(`api/findProject?q=${query}`) // send and http request to the server
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
                var project2 = this.projects.data;
                this.temp.data = project2.filter(item => {
                    return (
                        item.first_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.last_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.email
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1
                    );
                });
            }
        }
    }
};
</script>
