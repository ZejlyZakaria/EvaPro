<template>
    <div class="col-lg-12 grid-margin stretch-card" style="font-weight: 500">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-sm-flex justify-content-between align-items-start"
                >
                    <div>
                        <h4 class="card-title">Tableau Des Commissions</h4>
                    </div>
                    <div style="margin-bottom:10px">
                        <button
                            class="btn btn-primary btn-md text-white mb-0 me-0"
                            style="line-height:0.3"
                            @click="addModal"
                        >
                            <i class="fas fa-user-plus fa-fw "></i>
                            &nbsp;&nbsp;&nbsp;<b>Ajouter une nouvelle</b>
                        </button>
                    </div>
                </div>
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
                                <th>Taux de commission</th>
                                <th>Valeur de commission</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Nom du projet</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="commission in temp.data"
                                :key="commission.id"
                            >
                                <td>{{ commission.id }}</td>
                                <td>{{ commission.commission_rate }}</td>
                                <td>{{ commission.commission_value }}</td>
                                <td>{{ commission.start_date | myDate }}</td>
                                <td>{{ commission.end_date | myDate }}</td>
                                <td>{{ commission.project_name }}</td>
                                <td>
                                    <a href="#">
                                        <i
                                            class="far fa-edit"
                                            style="color: #1F3BB3; font-size:16px;margin-right:10px"
                                            @click="editModal(commission)"
                                        ></i>
                                    </a>

                                    <a
                                        href="#"
                                        @click="deleteUser(commission.id)"
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

        <!-- modify Modal -->
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" style="margin-top:20px">
                <div class="modal-content container-fluid">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            Modifier La Commission
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

                    <!-- modal body -->
                    <div class="modal-body">
                        <!-- commissions -->
                        <div class="form-group">
                            <div class="col-md-3 mb-3">
                                <label>Commission :</label>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div
                                    class="form-check"
                                    @click="changePlaceholder1"
                                >
                                    <input
                                        class="form-check-input"
                                        style="margin-left:0px"
                                        type="radio"
                                        id="flexRadioDefault1"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="flexRadioDefault1"
                                    >
                                        Par pourcentage (%)
                                    </label>
                                </div>
                                <div
                                    class="form-check"
                                    @click="changePlaceholder2"
                                >
                                    <input
                                        class="form-check-input"
                                        style="margin-left:0px"
                                        type="radio"
                                        id="flexRadioDefault2"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="flexRadioDefault2"
                                    >
                                        Par valeur (€)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="commissionInput"
                                    v-model="newCommission.commission_value"
                                    placeholder="Commission per rate"
                                />
                            </div>
                        </div>

                        <!-- start_date -->
                        <div class="form-group">
                            <label>Date de début :</label>
                            <input
                                id="start_date"
                                v-model="newCommission.start_date"
                                placeholder="Start date"
                                type="date"
                                name="start_date"
                                class="form-control"
                            />
                        </div>

                        <!-- end date -->
                        <div class="form-group">
                            <label>Date de fin :</label>
                            <input
                                id="end_date"
                                v-model="newCommission.end_date"
                                placeholder="End date"
                                type="date"
                                name="end_date"
                                class="form-control"
                            />
                        </div>
                        <div class="form-group" id="combobox">
                            <label class="mb-2">Projet :</label>
                            <select class="form-control" id="selectProject">
                                <option
                                    v-for="project in projects"
                                    :key="project.id"
                                    :value="project.id"
                                    :data-meta="project.id"
                                >
                                    {{ project.name }}
                                </option>
                            </select>
                            <!-- <span v-if="errors.pro" class="text-danger">{{
                                errors.pro[0]
                            }}</span> -->
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
                        <button
                            class="btn btn-primary"
                            @click="updateCommission()"
                        >
                            Modifier
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add modal -->
        <div
            class="modal fade"
            id="addNew1"
            tabindex="-1"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" style="margin-top:20px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            Ajouter Une Nouvelle Commission
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="closeModal1"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- commissions -->
                        <div class="form-group">
                            <div class="col-md-3 mb-3">
                                <label>Commission :</label>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        style="margin-left:0px"
                                        type="radio"
                                        id="flexRadioDefault11"
                                        @click="placeholder1"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="flexRadioDefault11"
                                    >
                                        Per rate (%)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        style="margin-left:0px"
                                        type="radio"
                                        id="flexRadioDefault22"
                                        @click="placeholder2"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="flexRadioDefault22"
                                    >
                                        Per value (€)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="commissionInput2"
                                    placeholder="Commission per rate"
                                    v-model="addCommission.commission_value"
                                />
                            </div>
                        </div>

                        <div class="form-group" id="combobox">
                            <label class="mb-2">Choose Project :</label>
                            <select
                                class="form-control"
                                id="selectProject"
                                v-model="selectedProject"
                            >
                                <option
                                    v-for="project in projects"
                                    :key="project.id"
                                    :value="project.id"
                                    :data-meta="project.id"
                                >
                                    {{ project.name }}
                                </option>
                            </select>
                            <!-- <span v-if="errors.pro" class="text-danger">{{
                                errors.pro[0]
                            }}</span> -->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                            @click="closeModal1"
                        >
                            Fermer
                        </button>
                        <button
                            class="btn btn-primary"
                            @click="createCommission()"
                        >
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import axios from "axios";

export default {
    mounted() {
        this.getPro();
    },
    data() {
        return {
            selectedProject: {},
            projects: {},
            project: { id: "" },
            commissions: {},
            commission: {},
            searchQuery: "",
            temp: {},
            commissionType: "",
            form: new Form({
                id: "",
                commission_rate: "",
                commission_value: "",
                start_date: "",
                end_date: "",
                id_project: "",
                project_name: "",
                commissionType: ""
            }),
            newCommission: {
                id: "",
                commission_rate: null,
                commission_value: null,
                start_date: "",
                end_date: "",
                id_project: "",
                project_name: "",
                commissionType: ""
            },
            addCommission: {
                id: "",
                commission_value: null,
                start_date: "",
                end_date: "",
                id_project: "",
                project_name: "",
                commissionType: ""
            }
        };
    },
    methods: {
        reset() {
            this.addCommission.start_date = "";
            this.addCommission.end_date = "";
            this.addCommission.commission_value = "";
            this.addCommission.commission_rate = "";
            $("#flexRadioDefault22").attr("checked", false);
            $("#flexRadioDefault11").prop("checked", false);
        },
        createUser() {
            this.$Progress.start();
            this.form
                .post("api/commission")
                .then(() => {
                    // fire - updating the data after creating without refresh
                    Fire.$emit("AfterCreate");
                    // hide the modal after creating a new user
                    $("#addNew1").modal("hide");
                    // sweet alert after creating a new user
                    Toast.fire({
                        icon: "success",
                        title: "User Created Successfully"
                    });
                    this.$Progress.finish();
                })
                .catch(() => {});
        },
        createCommission() {
            let id_project = this.selectedProject;
            axios
                .post("api/createCommission/" + id_project, this.addCommission)
                .then(response => {
                    this.loadUsers();
                    $("#addNew1").modal("hide");
                });
            this.reset();
        },
        getPro() {
            axios.get("api/getPro").then(response => {
                this.projects = response.data.data;
            });
        },
        updateCommission() {
            this.newCommission.commission_value = $("#commissionInput").val();
            axios
                .post(
                    "api/updateCommission/" + this.newCommission.id,
                    this.newCommission
                )
                .then(response => {
                    $("#addNew").modal("hide");
                    this.loadUsers();
                });
        },
        getResults(page = 1) {
            axios.get("api/commission?page=" + page).then(response => {
                this.commissions = { ...this.commissions, ...response.data };
                this.temp = response.data;
            });
        },
        updateUser() {
            this.$Progress.start();
            this.form
                .put("api/commission/" + this.form.id)
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
        editModal(commission) {
            this.newCommission = commission;
            if (commission.commissionType != "rate") {
                this.changePlaceholder2();
            } else {
                this.newCommission.commission_value =
                    commission.commission_rate;
                this.changePlaceholder1();
            }
            $("#addNew").modal("show");
            $("#combobox").hide();
        },
        addModal(commission) {
            this.newCommission = commission;
            this.newCommission.commissionType = "";

            this.newCommission.commissionType = "";
            this.form.reset();
            $("#addNew1").modal("show");

            if (this.btntitle == "Create") {
                $("#combobox").show();
            }
        },
        loadUsers() {
            axios.get("api/showCommissions").then(response => {
                this.commissions = response.data;
                this.temp = response.data;
            });
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
                            .delete("api/commission/" + id)
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
        changePlaceholder1() {
            document.getElementById("commissionInput").placeholder =
                "Commission per rate";
            $("#commissionInput").val(this.newCommission.commission_rate);
            this.newCommission.commissionType = "rate";
            $("#flexRadioDefault1").attr("checked", "checked");
            $("#flexRadioDefault2").prop("checked", false);
        },
        changePlaceholder2() {
            document.getElementById("commissionInput").placeholder =
                "Commission per value";
            $("#commissionInput").val(this.newCommission.commission_value);

            this.newCommission.commissionType = "value";
            $("#flexRadioDefault2").attr("checked", "checked");
            $("#flexRadioDefault1").prop("checked", false);
        },
        placeholder1() {
            this.addCommission.commissionType = "rate";
            document.getElementById("commissionInput2").placeholder =
                "Commission per rate";

            $("#flexRadioDefault11").attr("checked", "checked");
            $("#flexRadioDefault22").prop("checked", false);
        },
        placeholder2() {
            this.addCommission.commissionType = "value";
            document.getElementById("commissionInput2").placeholder =
                "Commission per value";

            $("#flexRadioDefault22").attr("checked", "checked");
            $("#flexRadioDefault11").prop("checked", false);
        },
        closeModal() {
            $("#addNew").modal("hide");
        },
        closeModal1() {
            $("#addNew1").modal("hide");
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
                .get(`api/findCommission?q=${query}`) // send and http request to the server
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
                let com = this.commissions.data;
                this.temp.data = com.filter(item => {
                    return (
                        item.id
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1
                    );
                });
            }
        }
    }
};
</script>
