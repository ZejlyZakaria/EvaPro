<template>
    <div class="col-lg-12 grid-margin stretch-card" style="font-weight: 500">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tableau des projets</h4>
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
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Client</th>
                                <th>Tarif journalier moyen</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Exceptionnelle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="project in temp.data" :key="project.id">
                                <td>{{ project.id }}</td>
                                <td>{{ project.name | uptext }}</td>
                                <td>{{ project.client | uptext }}</td>
                                <td>{{ project.average_daily_rate }}</td>
                                <td>{{ project.start_date | myDate }}</td>
                                <td>{{ project.end_date | myDate }}</td>
                                <td>{{ project.outstanding | uptext }}</td>
                                <td>
                                    <a href="#">
                                        <i
                                            class="far fa-edit"
                                            style="color: #1F3BB3; font-size:16px;margin-right:10px"
                                            @click="editModal(project)"
                                        ></i>
                                    </a>

                                    <a
                                        href="#"
                                        @click="deleteProject(project.id)"
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
                    <form @submit.prevent="updateProject()">
                        <div class="modal-body">
                            <!-- name -->
                            <div class="form-group">
                                <label for="">Nom du projet :</label>
                                <input
                                    id="name"
                                    v-model="form.name"
                                    placeholder="Name"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>

                            <!-- Client -->
                            <div class="form-group">
                                <label for="">Nom du client :</label>
                                <input
                                    id="client"
                                    v-model="form.client"
                                    placeholder="Client"
                                    type="text"
                                    name="client"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('client')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="client"
                                ></has-error>
                            </div>

                            <!-- average_daily_rate -->
                            <div class="form-group">
                                <label for="">Tarif journalier moyen :</label>
                                <input
                                    id="average_daily_rate"
                                    v-model="form.average_daily_rate"
                                    placeholder="Average Daily Rate"
                                    type="number"
                                    name="average_daily_rate"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'average_daily_rate'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="average_daily_rate"
                                ></has-error>
                            </div>

                            <!-- start_date -->
                            <div class="form-group">
                                <label for="">Date de début :</label>
                                <input
                                    id="start_date"
                                    v-model="form.start_date"
                                    placeholder="Start date"
                                    type="date"
                                    name="start_date"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'start_date'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="start_date"
                                ></has-error>
                            </div>

                            <!-- end date -->
                            <div class="form-group">
                                <label for="">Date de fin :</label>
                                <input
                                    id="end_date"
                                    v-model="form.end_date"
                                    placeholder="End date"
                                    type="date"
                                    name="end_date"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'end_date'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="end_date"
                                ></has-error>
                            </div>

                            <!-- security number -->
                            <div class="form-group">
                                <label for="">Description du projet :</label>
                                <input
                                    id="outstanding"
                                    v-model="form.outstanding"
                                    placeholder="Outstanding"
                                    type="text"
                                    name="outstanding"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'outstanding'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="outstanding"
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
            editmode: false,
            title: "Modifier Le Projet",
            btntitle: "Create",
            projects: {},
            searchQuery: "",
            temp: {},
            form: new Form({
                id: "",
                name: "",
                client: "",
                start_date: "",
                average_daily_rate: "",
                end_date: "",
                outstanding: ""
            })
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("api/project?page=" + page).then(response => {
                this.projects = { ...this.projects, ...response.data };
                this.temp = response.data;
            });
        },
        updateProject() {
            this.$Progress.start();
            this.form
                .put("api/project/" + this.form.id)
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
        editModal(project) {
            this.form.reset();
            $("#addNew").modal("show");
            this.form.fill(project); //  fill the input by the info of the user selected
        },
        loadUsers() {
            axios
                .get("api/showProjects")
                .then(({ data }) => (this.projects = data));
            axios
                .get("api/showProjects")
                .then(({ data }) => (this.temp = data));
        },
        deleteProject(id) {
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
                            .delete("api/project/" + id)
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
                        item.name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.client
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.outstanding
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1
                    );
                });
            }
        }
    }
};
</script>
