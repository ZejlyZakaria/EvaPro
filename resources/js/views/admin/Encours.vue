<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Calcul de l'encours</h4>
            <div
                class="d-sm-flex justify-content-between align-items-start"
                style="margin-bottom: 2ch"
            >
                <div>
                    <select
                        class="combo"
                        id="selectedMonth"
                        v-model="selectedMonth"
                        @change="getBillings()"
                    >
                        <option
                            v-for="month in months"
                            :key="month.abbreviation"
                            :value="month.abbreviation"
                            :data-meta="month.abbreviation"
                            :class="'custom-option'"
                        >
                            {{ month.name }}
                        </option>
                    </select>
                    <select
                        id="yearsInput"
                        class="combo"
                        @change="getBillings()"
                    >
                    </select>
                </div>
                <div class="col-sm-3">
                    <input
                        type="text"
                        class="form-control"
                        v-model="searchQuery"
                        placeholder="Rechercher..."
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Réf #</th>
                                    <th>Projet</th>
                                    <th>Client</th>
                                    <th>Fournisseur</th>
                                    <th>Total des encaissements</th>
                                    <th>Total des décaissements</th>
                                    <th>Solde Balance</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="billing in tempBillings">
                                    <tr
                                        :id="'trow' + billing.id"
                                        v-bind:data-target="
                                            '#billing' + billing.id
                                        "
                                        v-bind:aria-controls="
                                            'billing' + billing.id
                                        "
                                        class="trBgHover collapsed"
                                        @click="
                                            getAllData(
                                                billing.id,
                                                billing.id_project,
                                                billing.provider_id
                                            )
                                        "
                                        style="cursor: pointer; font-weight: 600 "
                                    >
                                        <td>{{ billing.id }}</td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="
                                                    showProjectModal(
                                                        billing.id_project
                                                    )
                                                "
                                            >
                                                {{ billing.name }}
                                            </a>
                                        </td>
                                        <td>{{ billing.client }}</td>
                                        <td>
                                            <a
                                                href="#"
                                                @click="
                                                    showProviderModal(
                                                        billing.provider_id
                                                    )
                                                "
                                            >
                                                {{ billing.full_name }}
                                            </a>
                                        </td>
                                        <td
                                            class="bg-warning"
                                            style="font-weight: 600; text-align: center; font-size: 1rem;"
                                        >
                                            {{
                                                billing.all_total_paid_per_client +
                                                    " €"
                                            }}
                                        </td>
                                        <td
                                            class="bg-warning"
                                            style="font-weight: 600; text-align: center; font-size: 1rem; border-left: 2px solid #fff  "
                                        >
                                            {{ billing.all_total_paid + " €" }}
                                        </td>
                                        <td
                                            class="bg-primary"
                                            style="font-weight: 600; color: #fff; text-align: center; font-size: 1rem; border-left: 2px solid #fff "
                                        >
                                            {{
                                                billing.all_total_paid_per_client -
                                                    billing.all_total_paid -
                                                    billing.total_commissions +
                                                    " €"
                                            }}
                                        </td>

                                        <td style="text-align: center">
                                            <i
                                                :id="'arrow' + billing.id"
                                                class="fas fa-arrow-down"
                                                style="color:  #5671e2"
                                            ></i>
                                        </td>
                                    </tr>
                                    <tr style="font-weight: 500">
                                        <td
                                            colspan="10"
                                            v-bind:id="'billing' + billing.id"
                                            class="collapse "
                                            data-parent="#accordion"
                                        >
                                            <div
                                                class="row m-1"
                                                style="background-color: #fff"
                                            >
                                                <div
                                                    class="table-responsive mb-3"
                                                >
                                                    <table
                                                        class="table table-striped"
                                                    >
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    Montant
                                                                    Total
                                                                    Facturé
                                                                </th>
                                                                <th>
                                                                    Montant
                                                                    Total
                                                                    Encaissé
                                                                </th>
                                                                <th>
                                                                    Restant dû
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td
                                                                    style="font-weight: 700; font-size: 1.1rem"
                                                                >
                                                                    {{
                                                                        billing.all_total_bill +
                                                                            " €"
                                                                    }}
                                                                </td>
                                                                <td
                                                                    style="font-weight: 700; font-size: 1.1rem; border-left: 4px solid #fff"
                                                                >
                                                                    {{
                                                                        billing.all_total_paid_per_client +
                                                                            " €"
                                                                    }}
                                                                </td>
                                                                <td
                                                                    class="bg-danger"
                                                                    style="font-weight: 700; color: #fff; font-size: 1.1rem; border-left: 4px solid #fff"
                                                                >
                                                                    {{
                                                                        billing.all_total_bill -
                                                                            billing.all_total_paid_per_client +
                                                                            " €"
                                                                    }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Provider Profil -->
        <div
            class="modal fade"
            id="providerModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="providerModalTitle">
                            Provider details
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
                    <div class="modal-body">
                        <div
                            class="align-items-center text-center"
                            id="partLeft"
                        >
                            <img
                                :src="
                                    'assets/images/' +
                                        providerModalSelected.image
                                "
                                alt="provider"
                                class="rounded-circle"
                                width="150"
                                id="providerModalImg"
                            />
                            <div class="mt-3">
                                <h4>{{ providerModalSelected.full_name }}</h4>
                                <p class="text-secondary mb-1">
                                    {{ providerModalSelected.type }}
                                </p>
                            </div>
                            <div class="card-body text-left">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">First name</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.first_name }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Last name</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.last_name }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.email }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.phone }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Type</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.type }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Provider Profil -->

        <!-- Project Details -->
        <div
            class="modal fade"
            id="projectModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="projectModalTitle">
                            Project details
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
                    <div class="modal-body">
                        <div class="card-body text-left">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Project name</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ projectModalSelected.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Client</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ projectModalSelected.client }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Start date</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ projectModalSelected.start_date }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">End date</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ projectModalSelected.end_date }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Outstanding</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ projectModalSelected.outstanding }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Project Details -->

        <div id="cover-spin"></div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.fillInputsYear();
        this.getBillings();
    },
    data() {
        return {
            selectedMonth: "",
            selectedYear: "",
            months: [
                {
                    abbreviation: "01",
                    name: "Janvier"
                },
                {
                    abbreviation: "02",
                    name: "Février"
                },
                {
                    abbreviation: "03",
                    name: "Mars"
                },
                {
                    abbreviation: "04",
                    name: "Avril"
                },
                {
                    abbreviation: "05",
                    name: "Mai"
                },
                {
                    abbreviation: "06",
                    name: "Juin"
                },
                {
                    abbreviation: "07",
                    name: "Juillet"
                },
                {
                    abbreviation: "08",
                    name: "Août"
                },
                {
                    abbreviation: "09",
                    name: "Septembre"
                },
                {
                    abbreviation: "10",
                    name: "Octobre"
                },
                {
                    abbreviation: "11",
                    name: "Novembre"
                },
                {
                    abbreviation: "12",
                    name: "Décembre"
                }
            ],
            searchQuery: "",
            billings: {},
            selectedBilling: {},
            providerModalSelected: {},
            tempBillings: {},
            newAmountClient: {
                value: ""
            },
            projectModalSelected: {},
            selectedCommissionRate: "",
            selectedCommissionValue: "",
            selectedPayment: {},
            selectedTransfers: {},
            selectedToModifyTransfer: {},
            newCommission: {
                commission: "",
                commissionType: "rate"
            },
            newTransfer: {
                name: "",
                value: "",
                month: "January",
                year: "2021"
            },
            modifyTransfer: {
                name: "",
                value: "",
                month: "January",
                year: "2021"
            },
            check: false,
            event: {
                id: "",
                date: "",
                title: "",
                id_project: "",
                provider_id: "",
                nbrOfDays: 0
            },
            list: {
                id: "",
                class: "",
                hasDiv: false,
                idDiv: "",
                classDiv: "",
                contentDiv: "",
                events: []
            },
            dates: [],
            listes: [],
            isLoading: false
        };
    },
    methods: {
        getBillings() {
            var m = "";
            var y = $("#yearsInput option:selected").text();

            let h = this.selectedMonth;
            this.months.forEach(element => {
                if (element.abbreviation == h) {
                    m = element.name;
                }
            });
            let url = "api/getBillingsWhere/" + y + "/" + m;
            axios.post(url).then(response => {
                this.billings = response.data.data.reverse();
                this.tempBillings = this.billings;
            });
        },
        fillInputsYear() {
            var nowY = new Date().getFullYear(),
                options = "";

            for (var Y = nowY; Y >= 2000; Y--) {
                options +=
                    "<option style='font-size: 0.9rem; font-weight: 600'>" +
                    Y +
                    "</option>";
            }
            $("#yearsInput").append(options);
            var m = new Date().getMonth();
            m += 1;
            if (m < 10) m = "0" + m;
            this.selectedMonth = m;
        },
        getProvider(elem) {
            axios.post("api/getProvider/" + elem).then(response => {
                this.provider = response.data.data;
            });
        },
        getProject(elem) {
            axios.post("api/getProject/" + elem).then(response => {
                this.project = response.data.data;
            });
        },
        getCommission(elem) {
            axios.post("api/getCommission/" + elem).then(response => {
                this.commission = response.data.data;
            });
        },
        modifyAmountClient() {
            this.isLoading = true;
            let url = "api/updateClientAmount/" + this.selectedBilling.id;
            axios.post(url, this.newAmountClient).then(response => {
                this.getBillings();
                this.reloadData();
                this.isLoading = false;
                this.hideModal("modifyClientModal");
            });
        },
        getAllData(elem1, elem2, elem3) {
            this.selectedExpenses = {};
            this.selectedTransfers = {};
            if (this.check != true) {
                if ($("#trow" + elem1).hasClass("collapsed")) {
                    this.closeAlltr();

                    $("#cover-spin").show(0);
                    $("#billing" + elem1).addClass("acc show");
                    $("#trow" + elem1).attr("aria-expanded", "true");
                    $("#trow" + elem1).removeClass("collapsed");
                    $("#trow" + elem1).css("background-color", "#ececec");
                    $("#arrow" + elem1).removeClass("fa-arrow-down");
                    $("#arrow" + elem1).addClass("fa-arrow-up");

                    axios.post("api/getBilling/" + elem1).then(response => {
                        this.selectedBilling = response.data.data;
                    });
                    axios.post("api/getProject/" + elem2).then(response => {
                        this.selectedProject = response.data.data;
                    });
                    axios.post("api/getProvider/" + elem3).then(response => {
                        this.selectedProvider = response.data.data;
                    });
                    axios
                        .post("api/getCommissionsByProject/" + elem2)
                        .then(response => {
                            this.selectedCommissions = response.data.data;
                        });
                    axios
                        .post("api/getCommissionRate/" + elem2)
                        .then(response => {
                            this.selectedCommissionRate = response.data.data;
                        });
                    axios
                        .post("api/getCommissionValue/" + elem2)
                        .then(response => {
                            this.selectedCommissionValue = response.data.data;
                        });
                    axios.post("api/getPayment/" + elem1).then(response => {
                        this.selectedPayment = response.data.data;
                    });
                    axios
                        .post("api/getExpenses/" + elem3 + "/" + elem2)
                        .then(response => {
                            this.selectedExpenses = response.data.data;
                            $("#cover-spin").hide(0);
                        });
                } else {
                    $("#billing" + elem1).removeClass("acc show");
                    $("#trow" + elem1).attr("aria-expanded", "false");
                    $("#trow" + elem1).addClass("collapsed");
                    $("#trow" + elem1).css("background-color", "#fff");
                    $("#arrow" + elem1).removeClass("fa-arrow-up");
                    $("#arrow" + elem1).addClass("fa-arrow-down");
                }
            }
            this.check = false;
        },
        closeAlltr() {
            $('[id^="billing"]').removeClass("acc show");
            $('[id^="trow"]').attr("aria-expanded", "false");
            $('[id^="trow"]').addClass("collapsed");
            $('[id^="trow"]').css("background-color", "#fff");
            $('[id^="arrow"]').removeClass("fa-arrow-up");
            $('[id^="arrow"]').addClass("fa-arrow-down");
        },
        getTransfers() {
            $("#cover-spin").show(0);
            axios
                .post("api/getTransfers/" + this.selectedPayment.id)
                .then(response => {
                    this.selectedTransfers = response.data.data;
                    $("#cover-spin").hide(0);
                });
            var nowY = new Date().getFullYear(),
                options = "";

            for (var Y = nowY; Y >= 2000; Y--) {
                options += "<option>" + Y + "</option>";
            }
            this.fillInputsYear();
            $("#yearsInput").append(options);
            $("#yearsInputModify").append(options);
        },
        getExpense() {},
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
        showFile(elem, elem2, elem3) {
            this.currentExpense = elem2;
            $("#iframeFile").attr("src", "assets/files/" + elem3 + "/" + elem);
            $("#showFileModal").modal("toggle");
        },
        acceptOrRefuseExpense(elem1, elem2, elem3) {
            if ($("#statusExpense" + elem1).text() != "accepted") {
                if (elem2 == true) {
                    $("#cover-spin").show(0);
                    var url =
                        "api/acceptOrRefuseExpense/" +
                        elem1 +
                        "/accepted/" +
                        elem3;
                    axios.post(url).then(response => {
                        $("#statusExpense" + elem1).html("accepted");
                        $("#statusExpense" + elem1).removeClass(
                            "badge-warning"
                        );
                        $("#statusExpense" + elem1).removeClass("badge-danger");
                        $("#statusExpense" + elem1).addClass(" badge-success");
                    });
                }
            }
            if ($("#statusExpense" + elem1).text() != "refused") {
                if (elem2 == false) {
                    $("#cover-spin").show(0);
                    var url =
                        "api/acceptOrRefuseExpense/" +
                        elem1 +
                        "/refused/" +
                        elem3;
                    axios.post(url).then(response => {
                        $("#statusExpense" + elem1).html("refused");
                        $("#statusExpense" + elem1).removeClass(
                            "badge-warning"
                        );
                        $("#statusExpense" + elem1).removeClass(
                            "badge-success"
                        );
                        $("#statusExpense" + elem1).addClass("badge-danger");
                    });
                }
            }
            this.reloadData();
        },
        showProviderModal(elem) {
            this.check = true;
            axios.post("api/getProvider/" + elem).then(response => {
                this.providerModalSelected = response.data.data;
            });
            $("#providerModal").modal("toggle");
        },
        showProjectModal(elem2) {
            this.check = true;
            axios.post("api/getProject/" + elem2).then(response => {
                this.projectModalSelected = response.data.data;
            });
            $("#projectModal").modal("toggle");
        },
        addCommission() {
            this.isLoading = true;
            axios
                .post(
                    "api/addCommission/" + this.selectedProject.id,
                    this.newCommission
                )
                .then(response => {
                    this.selectedCommissions = response.data.data;
                });
            axios
                .post("api/getCommissionRate/" + this.selectedProject.id)
                .then(response => {
                    this.selectedCommissionRate = response.data.data;
                });
            axios
                .post("api/getCommissionValue/" + this.selectedProject.id)
                .then(response => {
                    this.selectedCommissionValue = response.data.data;
                    this.isLoading = false;
                    $("#addCommissionModal").modal("toggle");
                    $("#cover-spin").show(0);
                    this.reloadData();
                });
        },
        addTransfer() {
            axios
                .post(
                    "api/addTransfer/" + this.selectedPayment.id,
                    this.newTransfer
                )
                .then(response => {
                    if (response.data.status == "success") {
                        $("#cover-spin").show(0);
                        this.selectedTransfers = response.data.data;
                        this.newTransfer.value = "";
                        this.newTransfer.month = "January";
                        this.newTransfer.year = "2021";
                        this.reloadData();
                    } else if (response.data.status == "error") {
                        this.errorsAddTransfer = response.data.errors;
                    }
                });
        },
        reloadData() {
            axios
                .post("api/getBilling/" + this.selectedBilling.id)
                .then(response => {
                    this.selectedBilling = response.data.data;
                });
            axios
                .post("api/getProject/" + this.selectedProject.id)
                .then(response => {
                    this.selectedProject = response.data.data;
                });
            axios
                .post("api/getPayment/" + this.selectedPayment.id)
                .then(response => {
                    this.selectedPayment = response.data.data;
                });
            axios
                .post(
                    "api/getExpenses/" +
                        this.selectedProvider.id +
                        "/" +
                        this.selectedProject.id
                )
                .then(response => {
                    this.selectedExpenses = response.data.data;
                    this.getBillings();
                    $("#cover-spin").hide(0);
                });
        },
        removeTransfer(elem) {
            axios.post("api/removeTransfer/" + elem).then(response => {
                $("#cover-spin").show(0);
                this.selectedTransfers = response.data.data;
                this.reloadData();
            });
        },
        updateTransfer() {
            axios
                .post(
                    "api/updateTransfer/" +
                        this.selectedToModifyTransfer.id +
                        "/" +
                        this.selectedPayment.id,
                    this.modifyTransfer
                )
                .then(response => {
                    if (response.data.status == "success") {
                        $("#cover-spin").show(0);
                        this.selectedTransfers = response.data.data;
                        this.modifyTransfer.value = "";
                        this.modifyTransfer.month = "January";
                        this.modifyTransfer.year = "2021";
                        $("#modifyTransferModal").modal("toggle");
                        this.reloadData();
                    } else if (response.data.status == "error") {
                        this.errorsModifyTransfer = response.data.errors;
                    }
                });
        },
        showModifyTransfer(elem) {
            this.selectedToModifyTransfer = elem;
        },
        deleteCommission(elem) {
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
                        axios
                            .post("api/deleteCommission/" + elem)
                            .then(response => {
                                axios
                                    .post(
                                        "api/getCommissionsByProject/" +
                                            this.selectedProject.id
                                    )
                                    .then(response => {
                                        $("#cover-spin").show(0);
                                        this.selectedCommissions =
                                            response.data.data;
                                    });
                                axios
                                    .post(
                                        "api/getCommissionRate/" +
                                            this.selectedProject.id
                                    )
                                    .then(response => {
                                        this.selectedCommissionRate =
                                            response.data.data;
                                    });
                                axios
                                    .post(
                                        "api/getCommissionValue/" +
                                            this.selectedProject.id
                                    )
                                    .then(response => {
                                        this.selectedCommissionValue =
                                            response.data.data;
                                    });
                                this.reloadData();
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
                "Commission per percent";
            this.newCommission.commissionType = "rate";
        },
        changePlaceholder2() {
            document.getElementById("commissionInput").placeholder =
                "Commission per value";
            this.newCommission.commissionType = "value";
        },
        searchPaid() {
            $("input:radio[name=inlineRadioOptionsUnpaid][value=unpaid]").prop(
                "checked",
                false
            );
            $(
                "input:radio[name=inlineRadioOptionsNotCompleted][value=notcompleted]"
            ).prop("checked", false);

            if (!$("#inlineRadioPaid").is(":checked")) {
                $("input:radio[name=inlineRadioOptionsPaid][value=paid]").prop(
                    "checked",
                    true
                );
                axios.post("api/getBillingsByStatus/paid").then(response => {
                    this.tempBillings = response.data.data;
                });
            } else {
                $("input:radio[name=inlineRadioOptionsPaid][value=paid]").prop(
                    "checked",
                    false
                );
                if ($("#inlineRadioHigher").is(":checked")) {
                    this.sortByHigher;
                } else if ($("#inlineRadioLower").is(":checked")) {
                    this.sortByLower;
                } else {
                    axios.post("api/getBillings").then(response => {
                        this.tempBillings = response.data.data;
                    });
                }
            }
        },
        searchUnpaid() {
            $("input:radio[name=inlineRadioOptionsPaid][value=paid]").prop(
                "checked",
                false
            );
            $(
                "input:radio[name=inlineRadioOptionsNotCompleted][value=notcompleted]"
            ).prop("checked", false);
            if (!$("#inlineRadioUnpaid").is(":checked")) {
                $(
                    "input:radio[name=inlineRadioOptionsUnpaid][value=unpaid]"
                ).prop("checked", true);
                axios.post("api/getBillingsByStatus/unpaid").then(response => {
                    this.tempBillings = response.data.data;
                });
            } else {
                $(
                    "input:radio[name=inlineRadioOptionsUnpaid][value=unpaid]"
                ).prop("checked", false);
                if ($("#inlineRadioHigher").is(":checked")) {
                    this.sortByHigher;
                } else if ($("#inlineRadioLower").is(":checked")) {
                    this.sortByLower;
                } else {
                    axios.post("api/getBillings").then(response => {
                        this.tempBillings = response.data.data;
                    });
                }
            }
        },
        searchNotCompleted() {
            $("input:radio[name=inlineRadioOptionsPaid][value=paid]").prop(
                "checked",
                false
            );
            $("input:radio[name=inlineRadioOptionsUnpaid][value=unpaid]").prop(
                "checked",
                false
            );

            if (!$("#inlineRadioNotCompleted").is(":checked")) {
                $(
                    "input:radio[name=inlineRadioOptionsNotCompleted][value=notcompleted]"
                ).prop("checked", true);
                axios
                    .post("api/getBillingsByStatus/not completed")
                    .then(response => {
                        this.tempBillings = response.data.data;
                    });
            } else {
                $(
                    "input:radio[name=inlineRadioOptionsNotCompleted][value=notcompleted]"
                ).prop("checked", false);
                if ($("#inlineRadioHigher").is(":checked")) {
                    this.sortByHigher;
                } else if ($("#inlineRadioLower").is(":checked")) {
                    this.sortByLower;
                } else {
                    axios.post("api/getBillings").then(response => {
                        this.tempBillings = response.data.data;
                    });
                }
            }
        },
        sortByHigher() {
            axios.get("api/getBillingsOrderBy").then(response => {
                this.tempBillings = response.data.data.reverse();
            });
        },
        sortByLower() {
            axios.get("api/getBillingsOrderBy").then(response => {
                this.tempBillings = response.data.data;
            });
        },
        toggleDetails() {
            $("#balanceDetails").toggle();
            if ($("#arrowBalance").hasClass("fa-chevron-down")) {
                $("#arrowBalance").removeClass("fa-chevron-down");
                $("#arrowBalance").addClass("fa-chevron-up");
            } else {
                $("#arrowBalance").removeClass("fa-chevron-up");
                $("#arrowBalance").addClass("fa-chevron-down");
            }
        },
        requestModification(content) {
            $("#newAmountValue").val(content);
            $("#modifyClientModal").modal("show");
        },
        hideModal(elem) {
            $("#" + elem).modal("hide");
        },
        showModal(elem) {
            $("#" + elem).modal("show");
        }
    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length >= 0) {
                var billings = this.billings;
                this.tempBillings = billings.filter(item => {
                    return (
                        item.name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.full_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.client
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1
                    );
                });
            }
        }
    }
};
</script>

<style scoped>
.combo {
    background: transparent;
    color: #000;
    font-size: 1.1rem;
    border: none;
    font-weight: 500;
}

.combo2 {
    background-color: rgb(247, 247, 247);
    color: #000;
    font-size: 0.9rem;
    border-radius: 8px;
    padding: 1.5ch;
    border: none;
    font-weight: 500;
    max-width: 30%;
}

.custom-option {
    font-size: 0.8rem;
    font-weight: 600;
}

.table tbody th,
.table tbody td {
    border: none;
    font-size: 14px;
}
.table tbody td.acc {
    background: #f3f3f3;
    border: none;
}
.table tbody td .fa {
    font-size: 12px;
    color: #28a745;
}

[data-toggle="collapse"] .fa:before {
    content: "\f062";
    font-family: "FontAwesome";
    font-style: normal;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}
@media (prefers-reduced-motion: reduce) {
    [data-toggle="collapse"] .fa:before {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}

[data-toggle="collapse"].collapsed .fa:before {
    content: "\f063";
    font-family: "FontAwesome";
    font-style: normal;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
}
@media (prefers-reduced-motion: reduce) {
    [data-toggle="collapse"].collapsed .fa:before {
        -webkit-transition: none;
        -o-transition: none;
        transition: none;
    }
}

[data-toggle="collapse"] {
    background: #ececec !important;
}

[data-toggle="collapse"].collapsed {
    background: #fff !important;
}
[data-toggle="collapse"].collapsed:hover {
    background: #ececec !important;
    border-bottom: 2px solid #ececec;
}
.table-wrap {
    overflow: auto;
}

#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

#cover-spin::after {
    content: "";
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: #4b0082;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin 0.8s linear infinite;
    animation: spin 0.8s linear infinite;
}

/* Hide scrollbar for Chrome, Safari and Opera */
.table-wrap::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.table-wrap {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}

.deleteCommissionIcon {
    display: none;
}

.commissionPara {
    cursor: pointer;
    color: rgb(49, 49, 49);
}

.commissionPara:hover .deleteCommissionIcon {
    display: inline-block;
}

.withoutLine {
    text-decoration: none;
}
.withoutLine:hover {
    text-decoration: none;
}

.trBgHover:hover {
    background-color: #ececec !important;
    background: #ececec !important;
}
.progress-bar {
    background-color: #8b008b;
}
.bg-buttons {
    background-color: #6617cb;
    background-image: linear-gradient(315deg, #6617cb 0%, #cb218e 74%);
}

.progressbar {
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 100;
}
.progressbar li {
    list-style-type: none;
    width: 30%;
    float: left;
    font-size: 1rem;
    position: relative;
    text-align: center;
    color: #c87137;
}

.progressbar li:after {
    width: 100%;
    height: 4px;
    content: "";
    position: absolute;
    background-color: #c4c4c4;
    top: 25px;
    left: -50%;
    z-index: -1;
}
.progressbar li:first-child:after {
    content: none;
}

.progressbar li.active:before {
    border-color: #c4c4c4;
    animation: yourCustomAnimation 0.5s;
    animation-fill-mode: both;
}
.progressbar li.active + li:after {
    background-color: #c4c4c4;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

.progressbar li.done:before {
    border-color: #4b0082;
}
.progressbar li.done + li:after {
    background-color: #4b0082;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

.progressbar li:before {
    width: 50px;
    height: 50px;
    border: 5px solid #c87137;
    display: block;
    text-align: center;
    margin: auto;
    border-radius: 50%;
    background-color: #4b0082;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}
.progressbar li.disable:before {
    width: 50px;
    height: 50px;
    border: 5px solid #e4e4e4;
    display: block;
    text-align: center;
    margin: auto;
    border-radius: 50%;
    background-color: #e4e4e4;
    color: #4b0082;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: animation1 0.5s;
    animation-fill-mode: both;
}

li:before {
    content: "";
}

/* Step Count */
ul.rb-step {
    counter-reset: step;
}

ul.rb-step li:before {
    content: counter(step);
    counter-increment: step;
}

/* For Square */
ul.rb-square li::before {
    border-radius: 0;
}
/* For Rounded Square */
ul.rb-rounded-square li::before {
    border-radius: 20%;
}

/* For addition of Custom Icons */
li.mobile:before {
    font-family: FontAwesome;
    content: "\f274";
}
li.email:before {
    font-family: FontAwesome;
    content: "\f153";
}
li.user:before {
    font-family: FontAwesome;
    content: "\f073";
}
li.success:before {
    font-family: FontAwesome;
    content: "\f058";
}
@keyframes animation1 {
    from {
        transform: scale(0.7);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.myLabel {
    display: block;
    width: 20vw;
    max-width: 150px;
    margin-right: auto;
    background-color: rgb(231, 231, 231);
    color: #707070;
    border-radius: 2px;
    font-size: 1em;
    line-height: 2.5em;
    text-align: center;
}

.myLabel:hover {
    background-color: rgb(214, 214, 214);
}

.myLabel:active {
    background-color: mediumaquamarine;
}

.myInput {
    border: 0;
    clip: rect(1px, 1px, 1px, 1px);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

#cover-spin {
    position: fixed;
    width: 100%;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    display: none;
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

#cover-spin::after {
    content: "";
    display: block;
    position: absolute;
    left: 48%;
    top: 40%;
    width: 40px;
    height: 40px;
    border-style: solid;
    border-color: #1c3cb4;
    border-top-color: transparent;
    border-width: 4px;
    border-radius: 50%;
    -webkit-animation: spin 0.8s linear infinite;
    animation: spin 0.8s linear infinite;
}

.clearfix::after,
.calendar ol::after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}

/* ================
Calendar Styling */
.calendar {
    border-radius: 10px;
}

.month {
    font-size: 1rem;
}

@media (min-width: 992px) {
    .month {
        font-size: 2.5rem;
    }
}

.calendar ol li {
    float: left;
    width: 14.28571%;
}

.calendar .day-names {
    border-bottom: 1px solid #eee;
}

.calendar .day-names li {
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.calendar .days li {
    border: 1px solid #eee;
    min-height: 8rem;
}

.calendar .days li .date {
    margin: 0.5rem 0;
}

.calendar .days li .event {
    font-size: 0.75rem;
    padding: 0.4rem;
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-radius: 5px;
    margin-bottom: 1px;
}

.calendar .days li .event.span-2 {
    width: 200%;
}

.calendar .days li .event.begin {
    border-radius: 1rem 0 0 1rem;
}

.calendar .days li .event.end {
    border-radius: 0 1rem 1rem 0;
}

.calendar .days li .event.clear {
    background: none;
}

.calendar .days li:nth-child(n + 29) {
    border-bottom: none;
}

.calendar .days li.outside .date {
    color: #ddd;
}

.date {
    padding-left: 10px;
}

.project-bar {
    padding: 0;
    background-color: white;
    margin-bottom: 1ch;
    margin-left: 2ch;
}

.combo {
    background: transparent;
    color: #000;
    font-size: 1.7rem;
    border: none;
    font-weight: 500;
}

.combo2 {
    background-color: rgb(247, 247, 247);
    color: #000;
    font-size: 0.9rem;
    border-radius: 8px;
    padding: 1.5ch;
    border: none;
    font-weight: 500;
    max-width: 30%;
}

.custom-option {
    font-size: 1.2rem;
}

/*--thank you pop starts here--*/
.thank-you-pop {
    width: 100%;
    padding: 20px;
    text-align: center;
}
.thank-you-pop img {
    width: 76px;
    height: auto;
    margin: 0 auto;
    display: block;
    margin-bottom: 25px;
}

.thank-you-pop h1 {
    font-size: 42px;
    margin-bottom: 25px;
    color: #5c5c5c;
}
.thank-you-pop p {
    font-size: 20px;
    margin-bottom: 27px;
    color: #5c5c5c;
}
.thank-you-pop h3.cupon-pop {
    font-size: 25px;
    margin-bottom: 40px;
    color: #222;
    display: inline-block;
    text-align: center;
    padding: 10px 20px;
    border: 2px dashed #222;
    clear: both;
    font-weight: normal;
}
.thank-you-pop h3.cupon-pop span {
    color: #03a9f4;
}
.thank-you-pop a {
    display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8bc34a;
    border-radius: 17px;
}
.thank-you-pop a i {
    margin-right: 5px;
    color: #fff;
}
#ignismyModal .modal-header {
    border: 0px;
}
/*--thank you pop ends here--*/
</style>
