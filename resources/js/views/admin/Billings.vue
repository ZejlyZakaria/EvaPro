<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tableau de facturation</h4>
            <div class="d-flex justify-content-between">
                <div class="dropdown">
                    <button
                        class="btn btn-light btn-sm dropdown-toggle"
                        style="border-radius: 5px"
                        type="button"
                        id="dropdownMenuSizeButton2"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                    Filtrer par
                    </button>
                    <div
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdown"
                            >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem; cursor:pointer"
                                    @click="searchPaid"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptionsPaid"
                                        id="inlineRadioPaid"
                                        value="paid"
                                    />
                                    <i class="fas fa-circle text-success"></i>
                                    <strong>Payée</strong>
                                    </a
                                >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem; cursor:pointer"
                                    @click="searchUnpaid"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptionsUnpaid"
                                        id="inlineRadioUnpaid"
                                        value="unpaid"
                                    />
                                    <i class="fas fa-circle text-danger"></i>
                                    <strong>Impayée</strong>
                                    </a
                                >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem; cursor:pointer"
                                    @click="searchNotCompleted"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptionsNotCompleted"
                                        id="inlineRadioNotCompleted"
                                        value="notcompleted"
                                    />
                                    <i class="fas fa-circle text-warning"></i>
                                    <strong>Pas complétée</strong>
                                    </a
                                >
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="font-size: 1rem; cursor:pointer" @click="getBillings"
                                    ><strong>Annuler</strong></a
                                >
                            </div>
                </div>
                <div class="col-sm-3">
                    <input
                        type="text"
                        class="form-control"
                        v-model="searchQuery"
                        placeholder="Search"
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
                                    <th>Mois</th>
                                    <th>Année</th>
                                    <th>Total</th>
                                    <th>Totat payée</th>
                                    <th>Statut</th>
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
                                        <td>{{ billing.billing_month }}</td>
                                        <td>{{ billing.billing_year }}</td>
                                        <td>
                                            {{ billing.all_total_bill + " €" }}
                                        </td>
                                        <td>
                                            {{ billing.all_total_paid + " €" }}
                                        </td>
                                        <td>
                                            <span
                                                :class="[
                                                    'badge',
                                                    billing.status == 'paid'
                                                        ? 'badge-success'
                                                        : billing.status ==
                                                          'unpaid'
                                                        ? 'badge-danger'
                                                        : 'badge-warning'
                                                ]"
                                                style="font-size: 0.8rem"
                                                >{{ billing.status }}</span
                                            >
                                        </td>

                                        <td>
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
                                            <div class="row mb-1">
                                                <div class="col-sm-4">
                                                    <div class="card">
                                                        <div
                                                            class="card-header d-flex justify-content-between"
                                                        >
                                                            Les commissions
                                                            <a
                                                                style="cursor: pointer;"
                                                                class="text-primary withoutLine"
                                                                data-toggle="modal"
                                                                data-target="#addCommissionModal"
                                                                ><i
                                                                    class="fas fa-plus text-primary"
                                                                ></i>
                                                                Ajouter</a
                                                            >
                                                        </div>
                                                        <div class="card-body">
                                                            <div
                                                                class="d-flex justify-content-between commissionPara"
                                                                v-for="commission in selectedCommissions"
                                                                :key="
                                                                    commission.id
                                                                "
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        commission.commission_rate
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-trash-alt text-danger deleteCommissionIcon"
                                                                        @click="
                                                                            deleteCommission(
                                                                                commission.id
                                                                            )
                                                                        "
                                                                    ></i>
                                                                    <i
                                                                        >Commission
                                                                        par
                                                                        purcentage</i
                                                                    >
                                                                </p>
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        commission.commission_rate
                                                                    "
                                                                >
                                                                    {{
                                                                        commission.commission_rate +
                                                                            "%"
                                                                    }}
                                                                </p>
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        commission.commission_value
                                                                    "
                                                                >
                                                                    <i
                                                                        class="fas fa-trash-alt text-danger deleteCommissionIcon"
                                                                        @click="
                                                                            deleteCommission(
                                                                                commission.id
                                                                            )
                                                                        "
                                                                    ></i>
                                                                    <i
                                                                        >Commission
                                                                        par
                                                                        valeur</i
                                                                    >
                                                                </p>
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        commission.commission_value
                                                                    "
                                                                >
                                                                    {{
                                                                        commission.commission_value +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <hr />
                                                            <div
                                                                v-if="
                                                                    selectedCommissionRate !=
                                                                        null
                                                                "
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    Total
                                                                    commissions
                                                                    (par pourcentage)
                                                                </p>
                                                                <p
                                                                    class="card-text text-primary"
                                                                    style="font-size: 0.9rem"
                                                                >
                                                                    {{
                                                                        selectedCommissionRate +
                                                                            "%"
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                v-if="
                                                                    selectedCommissionValue !=
                                                                        null
                                                                "
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    Total
                                                                    commissions
                                                                    (par valeur)
                                                                </p>
                                                                <p
                                                                    class="card-text text-primary"
                                                                    style="font-size: 0.9rem"
                                                                >
                                                                    {{
                                                                        selectedCommissionValue +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="card-header d-flex justify-content-between"
                                                        >
                                                            Profite
                                                            <a
                                                                style="cursor: pointer;"
                                                                class="text-primary"
                                                                data-toggle="modal"
                                                                data-target="#addCommissionModal"
                                                            >
                                                                All</a
                                                            >
                                                        </div>
                                                        <div class="card-body">
                                                            <div
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        selectedBilling.total_commissions !=
                                                                            null
                                                                    "
                                                                >
                                                                    Votre part
                                                                </p>
                                                                <p
                                                                    class="card-text text-success"
                                                                    v-if="
                                                                        selectedBilling.total_commissions !=
                                                                            null
                                                                    "
                                                                >
                                                                    {{
                                                                        selectedBilling.total_commissions +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="card">
                                                        <div
                                                            class="card-header d-flex justify-content-between"
                                                            style="font-size: 0.9rem; cursor: pointer"
                                                            @click="
                                                                toggleDetails()
                                                            "
                                                        >
                                                            Balance
                                                            <a
                                                                style="font-weight: 600;"
                                                                class="text-primary withoutLine"
                                                            >
                                                                {{
                                                                    (selectedBilling.all_total_paid_per_client -
                                                                    selectedBilling.all_total_paid) +
                                                                        " €"
                                                                }}
                                                                &nbsp;
                                                                <i
                                                                    id="arrowBalance"
                                                                    class="fas fa-chevron-down fa-sm"
                                                                    style="color:  #5671e2"
                                                                ></i>
                                                            </a>
                                                        </div>
                                                        <div
                                                            id="balanceDetails"
                                                            class="card-body"
                                                            style="line-height: 6px; display: none"
                                                        >
                                                            <div
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    <i>
                                                                        Montant
                                                                        payé par
                                                                        le
                                                                        client
                                                                    </i>
                                                                </p>
                                                                <p
                                                                    class="card-text text-black"
                                                                    id="clientField"
                                                                >
                                                                    {{
                                                                        selectedBilling.all_total_paid_per_client +
                                                                            " €"
                                                                    }}
                                                                    &nbsp;
                                                                    <i
                                                                        class="fas fa-pen fa-sm"
                                                                        @click="
                                                                            requestModification(selectedBilling.all_total_paid_per_client)
                                                                        "
                                                                        style="color: #57c7d4; cursor: pointer"
                                                                    ></i>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="card-header d-flex justify-content-between"
                                                            style="font-size: 0.9rem"
                                                        >
                                                            Details de facture
                                                            <a
                                                                style="cursor: pointer;"
                                                                class="text-primary text-primary withoutLine"
                                                                data-toggle="modal"
                                                                data-target="#addCommissionModal"
                                                            >
                                                                <i
                                                                    class="far fa-file-alt text-primary"
                                                                ></i>
                                                                Facture</a
                                                            >
                                                        </div>
                                                        <div
                                                            class="card-body"
                                                            style="line-height: 6px"
                                                        >
                                                            <div
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    Montant
                                                                </p>
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    {{
                                                                        selectedBilling.bill_amount +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        selectedBilling.total_expenses !=
                                                                            null
                                                                    "
                                                                >
                                                                    <i
                                                                        >Total
                                                                        charges</i
                                                                    >
                                                                </p>
                                                                <p
                                                                    class="card-text text-success"
                                                                    v-if="
                                                                        selectedBilling.total_expenses !=
                                                                            null
                                                                    "
                                                                >
                                                                    {{
                                                                        "+" +
                                                                            selectedBilling.total_expenses +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <hr />
                                                            <div
                                                                v-if="
                                                                    selectedBilling.total_amount !=
                                                                        null
                                                                "
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    Montant avec
                                                                    les charges
                                                                </p>
                                                                <p
                                                                    class="card-text text-primary"
                                                                    style="font-size: 1rem"
                                                                >
                                                                    {{
                                                                        selectedBilling.total_amount +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                    v-if="
                                                                        selectedBilling.total_commissions !=
                                                                            null
                                                                    "
                                                                >
                                                                    <i
                                                                        >Total
                                                                        commissions</i
                                                                    >
                                                                </p>
                                                                <p
                                                                    class="card-text text-danger"
                                                                    v-if="
                                                                        selectedBilling.total_commissions !=
                                                                            null
                                                                    "
                                                                >
                                                                    {{
                                                                        "-" +
                                                                            selectedBilling.total_commissions +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <hr />
                                                            <div
                                                                v-if="
                                                                    selectedBilling.net_bill_after_comiss !=
                                                                        null
                                                                "
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    Montant avec
                                                                    commissions
                                                                </p>
                                                                <p
                                                                    class="card-text text-primary"
                                                                    style="font-size: 1rem; font-weight: 800"
                                                                >
                                                                    {{
                                                                        selectedBilling.net_bill_after_comiss +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <hr />
                                                            <div
                                                                v-if="
                                                                    selectedBilling.all_total_bill !=
                                                                        null
                                                                "
                                                                class="d-flex justify-content-between"
                                                            >
                                                                <p
                                                                    class="card-text"
                                                                >
                                                                    <strong
                                                                        >Total</strong
                                                                    >
                                                                </p>
                                                                <p
                                                                    class="card-text"
                                                                    style="font-size: 1.1rem; font-weight: 800"
                                                                >
                                                                    {{
                                                                        selectedBilling.all_total_bill +
                                                                            " €"
                                                                    }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul
                                                class="nav nav-tabs"
                                                :id="'myTab' + billing.id"
                                                role="tablist"
                                            >
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link active"
                                                        :id="
                                                            'calendar-tab' +
                                                                billing.id
                                                        "
                                                        data-toggle="tab"
                                                        :href="
                                                            '#calendar' +
                                                                billing.id
                                                        "
                                                        role="tab"
                                                        :data-target="
                                                            '#calendar' +
                                                                billing.id
                                                        "
                                                        :aria-controls="
                                                            'calendar' +
                                                                billing.id
                                                        "
                                                        aria-selected="true"
                                                        >Calendrier</a
                                                    >
                                                </li>
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link"
                                                        :id="
                                                            'expenses-tab' +
                                                                billing.id
                                                        "
                                                        data-toggle="tab"
                                                        :href="
                                                            '#expenses' +
                                                                billing.id
                                                        "
                                                        role="tab"
                                                        :data-target="
                                                            '#expenses' +
                                                                billing.id
                                                        "
                                                        :aria-controls="
                                                            'expenses' +
                                                                billing.id
                                                        "
                                                        aria-selected="false"
                                                        >Dépenses
                                                        <span
                                                            class="badge badge-danger badge-counter"
                                                            >{{
                                                                selectedExpenses.length
                                                            }}</span
                                                        >
                                                    </a>
                                                </li>
                                                <li
                                                    class="nav-item"
                                                    @click="getTransfers"
                                                >
                                                    <a
                                                        class="nav-link"
                                                        :id="
                                                            'transfers-tab' +
                                                                billing.id
                                                        "
                                                        data-toggle="tab"
                                                        :href="
                                                            '#transfers' +
                                                                billing.id
                                                        "
                                                        role="tab"
                                                        :data-target="
                                                            '#transfers' +
                                                                billing.id
                                                        "
                                                        :aria-controls="
                                                            'transfers' +
                                                                billing.id
                                                        "
                                                        aria-selected="false"
                                                        >Paiement</a
                                                    >
                                                </li>
                                            </ul>

                                            <div
                                                class="tab-content bg-white"
                                                :id="
                                                    'myTabContent' + billing.id
                                                "
                                            >
                                                <div
                                                    class="tab-pane fade show active"
                                                    :id="
                                                        'calendar' + billing.id
                                                    "
                                                    role="tabpanel"
                                                    :aria-labelledby="
                                                        'calendar-tab' +
                                                            billing.id
                                                    "
                                                >
                                                <div class="d-flex justify-content-between">
                                                    <div style="display: block">
                                                        <div style="display: flex; margin-bottom: 1ch">
                                                            <div style="font-weight: 500; font-size: 0.9rem">
                                                                <i>Nombre de jours travaillés:</i> &nbsp;
                                                            </div>
                                                            <div class="text-primary" style="font-weight: 700; font-size: 0.9rem">
                                                                {{selectedBilling.nbrOfDaysWorked + 'jours'}}
                                                            </div>
                                                        </div>
                                                        <div style="display: flex">
                                                            <div style="font-weight: 500; font-size: 0.9rem">
                                                                <i>Tarif journalier moyen:</i> &nbsp;
                                                            </div>
                                                            <div class="text-primary" style="font-weight: 700; font-size: 0.9rem">
                                                                {{selectedProject.average_daily_rate + '€'}}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#calendarModal" @click="initCalendar"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Voir calendrier</button>
                                                </div>

                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    :id="
                                                        'expenses' + billing.id
                                                    "
                                                    role="tabpanel"
                                                    :aria-labelledby="
                                                        'expenses-tab' +
                                                            billing.id
                                                    "
                                                >
                                                    <div class="table-wrap">
                                                        <table
                                                            class="table table-responsive-xl"
                                                        >
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>
                                                                        Object
                                                                    </th>
                                                                    <th>
                                                                        Montant
                                                                    </th>
                                                                    <th>
                                                                        Être payé par
                                                                    </th>
                                                                    <th>
                                                                        Vérification
                                                                    </th>
                                                                    <th>
                                                                        Staut
                                                                    </th>
                                                                    <th>
                                                                        Actions
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr
                                                                    class="alert"
                                                                    role="alert"
                                                                    v-for="exp in selectedExpenses"
                                                                    :key="
                                                                        exp.id
                                                                    "
                                                                >
                                                                    <td>
                                                                        {{
                                                                            exp.id
                                                                        }}
                                                                    </td>
                                                                    <td>
                                                                        {{
                                                                            exp.subject
                                                                        }}
                                                                    </td>
                                                                    <td>
                                                                        {{
                                                                            exp.amount +
                                                                                " €"
                                                                        }}
                                                                    </td>
                                                                    <td>
                                                                        {{
                                                                            exp.toPayBy
                                                                        }}
                                                                    </td>
                                                                    <td
                                                                        class="status"
                                                                    >
                                                                        <a
                                                                            href="#"
                                                                            @click="
                                                                                showFile(
                                                                                    exp.verification,
                                                                                    exp.id,
                                                                                    selectedProvider.id
                                                                                )
                                                                            "
                                                                        >
                                                                            <i
                                                                                class="fas fa-eye text-success fa-sm"
                                                                            ></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            :id="
                                                                                'statusExpense' +
                                                                                    exp.id
                                                                            "
                                                                            :class="[
                                                                                'badge',
                                                                                exp.status ==
                                                                                'accepted'
                                                                                    ? 'badge-success'
                                                                                    : exp.status ==
                                                                                      'refused'
                                                                                    ? 'badge-danger'
                                                                                    : 'badge-warning'
                                                                            ]"
                                                                            style="font-size: 0.8rem"
                                                                            >{{
                                                                                exp.status
                                                                            }}</span
                                                                        >
                                                                    </td>
                                                                    <td>
                                                                        <a
                                                                            href="#"
                                                                            @click="
                                                                                acceptOrRefuseExpense(
                                                                                    exp.id,
                                                                                    true,
                                                                                    billing.id_project,
                                                                                    exp.status
                                                                                )
                                                                            "
                                                                        >
                                                                            <i
                                                                                class="fas fa-check-square text-success fa-lg"
                                                                            ></i>
                                                                        </a>
                                                                        <a
                                                                            href="#"
                                                                            @click="
                                                                                acceptOrRefuseExpense(
                                                                                    exp.id,
                                                                                    false,
                                                                                    billing.id_project,
                                                                                    exp.status
                                                                                )
                                                                            "
                                                                        >
                                                                            <i
                                                                                class="fas fa-times text-danger fa-lg"
                                                                            ></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    :id="
                                                        'transfers' + billing.id
                                                    "
                                                    role="tabpanel"
                                                    :aria-labelledby="
                                                        'transfers-tab' +
                                                            billing.id
                                                    "
                                                >
                                                    <div class="card-body">
                                                        <div
                                                            class="row justify-content-center"
                                                        >
                                                            <div class="col-2">
                                                                <label
                                                                    class="sr-only"
                                                                    for="inlineFormInputGroup"
                                                                    >Transfer
                                                                    name</label
                                                                >
                                                                <div
                                                                    class="input-group mb-2"
                                                                >
                                                                    <input
                                                                        type="text"
                                                                        :class="[
                                                                            'form-control',
                                                                            errorsAddTransfer.name
                                                                                ? 'is-invalid'
                                                                                : ''
                                                                        ]"
                                                                        placeholder="Transfer name"
                                                                        v-model="
                                                                            newTransfer.name
                                                                        "
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <label
                                                                    class="sr-only"
                                                                    for="inlineFormInputGroup"
                                                                    >Transfer
                                                                    amount</label
                                                                >
                                                                <div
                                                                    class="input-group mb-2"
                                                                >
                                                                    <input
                                                                        type="text"
                                                                        :class="[
                                                                            'form-control',
                                                                            errorsAddTransfer.value
                                                                                ? 'is-invalid'
                                                                                : ''
                                                                        ]"
                                                                        placeholder="Transfer amount"
                                                                        v-model="
                                                                            newTransfer.value
                                                                        "
                                                                    />
                                                                    <div
                                                                        class="input-group-prepend"
                                                                    >
                                                                        <div
                                                                            class="input-group-text"
                                                                        >
                                                                            <strong
                                                                                >€</strong
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <label
                                                                    class="sr-only"
                                                                    for="inlineFormInput"
                                                                    >Month</label
                                                                >
                                                                <select
                                                                    class="form-control"
                                                                    v-model="
                                                                        newTransfer.month
                                                                    "
                                                                >
                                                                    <option
                                                                        v-for="month in months"
                                                                        :key="
                                                                            month.abbreviation
                                                                        "
                                                                        :value="
                                                                            month.name
                                                                        "
                                                                        :data-meta="
                                                                            month.name
                                                                        "
                                                                    >
                                                                        {{
                                                                            month.name
                                                                        }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-2">
                                                                <label
                                                                    class="sr-only"
                                                                    for="inlineFormInput2"
                                                                    >Year</label
                                                                >
                                                                <select
                                                                    :id="
                                                                        'yearsInput' +
                                                                            billing.id
                                                                    "
                                                                    class="form-control"
                                                                    v-model="
                                                                        newTransfer.year
                                                                    "
                                                                >
                                                                </select>
                                                            </div>
                                                            <div
                                                                class="col-auto"
                                                            >
                                                                <button
                                                                    class="btn btn-success"
                                                                    style="line-height: 0.3"
                                                                    @click="
                                                                        addTransfer
                                                                    "
                                                                >
                                                                    Ajouter transfere
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="table-wrap">
                                                            <table
                                                                class="table table-responsive-xl"
                                                            >
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            #
                                                                        </th>
                                                                        <th>
                                                                            Nom
                                                                        </th>
                                                                        <th>
                                                                            Mois
                                                                        </th>
                                                                        <th>
                                                                            Année
                                                                        </th>
                                                                        <th>
                                                                            Montant
                                                                        </th>
                                                                        <th>
                                                                            Actions
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr
                                                                        class="alert"
                                                                        role="alert"
                                                                        v-for="transfer in selectedTransfers"
                                                                        :key="
                                                                            transfer.id
                                                                        "
                                                                    >
                                                                        <td>
                                                                            {{
                                                                                transfer.id
                                                                            }}
                                                                        </td>
                                                                        <td>
                                                                            {{
                                                                                transfer.name
                                                                            }}
                                                                        </td>
                                                                        <td>
                                                                            {{
                                                                                transfer.month
                                                                            }}
                                                                        </td>
                                                                        <td>
                                                                            {{
                                                                                transfer.year
                                                                            }}
                                                                        </td>
                                                                        <td
                                                                            style="font-size: 1rem"
                                                                        >
                                                                            {{
                                                                                transfer.value +
                                                                                    " €"
                                                                            }}
                                                                        </td>
                                                                        <td>
                                                                            <a
                                                                                style="cursor: pointer;"
                                                                                data-toggle="modal"
                                                                                data-target="#modifyTransferModal"
                                                                                @click="
                                                                                    showModifyTransfer(
                                                                                        transfer
                                                                                    )
                                                                                "
                                                                            >
                                                                                <i
                                                                                    class="fas fa-edit text-primary fa-lg"
                                                                                ></i>
                                                                            </a>
                                                                            &nbsp;
                                                                            <a
                                                                                style="cursor: pointer;"
                                                                                @click="
                                                                                    removeTransfer(
                                                                                        transfer.id
                                                                                    )
                                                                                "
                                                                            >
                                                                                <i
                                                                                    class="fas fa-times text-danger fa-lg"
                                                                                ></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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
        <div
            class="modal fade text-center"
            id="showFileModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLongTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Provider's verification
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
                        <iframe
                            id="iframeFile"
                            src=""
                            width="100%"
                            height="500px"
                        >
                        </iframe>
                    </div>
                    <div class="modal-footer" id="modalFooter">
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
                            Informations du fournisseur
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
                                        <h6 class="mb-0">Prénom</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ providerModalSelected.first_name }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom</h6>
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
                            Fermer
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

        <!-- ADD COMMISSION -->
        <div
            class="modal fade"
            id="addCommissionModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <strong>Ajouter commission</strong>
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
                    <div class="modal-body ">
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Commission:</label>
                            </div>

                            <div class="col-md-4 mb-3 m-3">
                                <div
                                    class="form-check"
                                    @click="changePlaceholder1"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        checked
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
                                        type="radio"
                                        name="flexRadioDefault"
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
                            <div class="col-md-5 mb-3">
                                <input
                                    type="number"
                                    :class="[
                                        'form-control',
                                        errorsAddCommission.commission
                                            ? 'is-invalid'
                                            : ''
                                    ]"
                                    id="commissionInput"
                                    placeholder="Commission per percent"
                                    v-model="newCommission.commission"
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"
                                />
                                <span
                                    v-if="errorsAddCommission.commission"
                                    class="text-danger"
                                    >{{
                                        errorsAddCommission.commission[0]
                                    }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Fermer
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="addCommission"
                        >
                            <span
                                v-show="isLoading"
                                class="spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ADD COMMISSION -->

        <!-- MODIFY TRANSFER -->
        <div
            class="modal fade"
            id="modifyTransferModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <strong>Modifier transfere</strong>
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
                        <div class="form-row justify-content-center">
                            <div class="col-4">
                                <label
                                    class="sr-only"
                                    for="inlineFormInputGroup"
                                    >Nom de la transfere</label
                                >
                                <div class="input-group mb-2">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errorsModifyTransfer.name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="Transfer name"
                                        v-model="modifyTransfer.name"
                                    />
                                </div>
                            </div>
                            <div class="col-4">
                                <label
                                    class="sr-only"
                                    for="inlineFormInputGroup"
                                    >Montant de la transfere</label
                                >
                                <div class="input-group mb-2">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errorsModifyTransfer.value
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        id="amountId"
                                        placeholder="Transfer amount"
                                        v-model="modifyTransfer.value"
                                    />
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <strong>€</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="sr-only" for="inlineFormInput"
                                    >Mois</label
                                >
                                <select
                                    class="form-control"
                                    v-model="modifyTransfer.month"
                                >
                                    <option
                                        v-for="month in months"
                                        :key="month.abbreviation"
                                        :value="month.name"
                                        :data-meta="month.name"
                                    >
                                        {{ month.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="sr-only" for="inlineFormInput2"
                                    >Année</label
                                >
                                <select
                                    id="yearsInputModify"
                                    class="form-control"
                                    v-model="modifyTransfer.year"
                                >
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Fermer
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="updateTransfer"
                        >
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODIFY TRANSFER -->

        <!-- PAID PER CLIENT -->
        <div
            class="modal fade"
            id="modifyClientModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            <strong
                                >Modifier le montant payé par le client
                            </strong>
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="hideModal('modifyClientModal')"

                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Montant payé"
                                    id="newAmountValue"
                                    v-model="newAmountClient.value"
                                />
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <strong>€</strong>
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
                            @click="hideModal('modifyClientModal')"
                        >
                            Fermer
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="modifyAmountClient"
                        >
                            <span
                                v-show="isLoading"
                                class="spinner-border spinner-border-sm"
                                role="status"
                                aria-hidden="true"
                            ></span>
                            Modifier
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAID PER CLIENT -->

        <!-- Modal starts -->
        <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 60%; max-height: 100%">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2" style="font-weight: 600">{{ selectedBilling.billing_month + ' ' + selectedBilling.billing_year }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="hideModal('calendarModal')">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="calendar bg-white">
                        <ol
                            class="day-names list-unstyled"
                            style="font-weight: 500;"
                        >
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Mon
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Tue
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Wed
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Thu
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Fri
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Sat
                            </li>
                            <li
                                class="font-weight-bold text-uppercase"
                            >
                                Sun
                            </li>
                        </ol>

                        <ol
                            id="ol-calendar"
                            class="days list-unstyled"
                            style="font-weight: 400;"
                        >
                            <li
                                v-for="list in listes"
                                :key="list.id"
                                :id="list.id"
                                :class="list.class"
                                data-v-01138bdb
                                style="cursor: pointer"
                            >
                                <div
                                    data-v-01138bdb
                                    v-if="list.hasDiv"
                                    :id="list.idDiv"
                                    :class="list.classDiv"
                                >
                                    {{ list.contentDiv }}
                                </div>
                                <div
                                    v-for="event in list.events"
                                    :key="event.id"
                                    data-v-01138bdb
                                    :id="event.id"
                                    class="event bg-primary"
                                >
                                    {{ event.title }}
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal"  @click="hideModal('calendarModal')">Fermer</button>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Ends -->

        <div id="cover-spin"></div>
    </div>
</template>

<script>
import $ from "jquery";

export default {
    mounted() {
        this.getBillings();
        this.fillInputsYear();
    },
    data() {
        return {
            searchQuery: "",
            provider: {},
            project: {},
            commission: {},
            billings: {},
            selectedProvider: {},
            selectedProject: {},
            selectedExpenses: {},
            selectedCommissions: {},
            selectedBilling: {},
            providerModalSelected: {},
            tempBillings: {},
            newAmountClient: {
                value: ''
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
            errorsAddCommission: [],
            errorsAddTransfer: [],
            errorsModifyTransfer: [],
            isLoading: false,
            months: [
                {
                    abbreviation: "Jan",
                    name: "January"
                },
                {
                    abbreviation: "Feb",
                    name: "February"
                },
                {
                    abbreviation: "Mar",
                    name: "March"
                },
                {
                    abbreviation: "Apr",
                    name: "April"
                },
                {
                    abbreviation: "May",
                    name: "May"
                },
                {
                    abbreviation: "Jun",
                    name: "June"
                },
                {
                    abbreviation: "Jul",
                    name: "July"
                },
                {
                    abbreviation: "Aug",
                    name: "August"
                },
                {
                    abbreviation: "Sep",
                    name: "September"
                },
                {
                    abbreviation: "Oct",
                    name: "October"
                },
                {
                    abbreviation: "Nov",
                    name: "November"
                },
                {
                    abbreviation: "Dec",
                    name: "December"
                }
            ]
        };
    },
    methods: {
        getBillings() {
            axios.get("api/getBillings").then(response => {
                this.billings = response.data.data.reverse();
                this.tempBillings = this.billings;
            });
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
                this.hideModal('modifyClientModal')
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
        fillInputsYear() {
            var nowY = new Date().getFullYear(),
                options = "";

            for (var Y = nowY; Y >= 2000; Y--) {
                options += "<option>" + Y + "</option>";
            }
            $('[id^="yearsInput"]').append(options);
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
                        this.errorsAddTransfer = "";
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
            $("#modifyClientModal").modal('show');
        },
        hideModal(elem) {
            $("#" + elem).modal('hide');
        },
        showModal(elem) {
            $("#" + elem).modal('show');
        },
        initCalendar() {
            $("#cover-spin").show(0);
            this.listes = [];
            let cal = $("#ol-calendar");
            var options = {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric"
            };
            var month = '';
            let m = this.selectedBilling.billing_month;
            let year = this.selectedBilling.billing_year;
            if(m == 'Janvier') month = '01';
            if(m == 'Février') month = '02';
            if(m == 'Mars') month = '03';
            if(m == 'Avril') month = '04';
            if(m == 'Mai') month = '05';
            if(m == 'Juin') month = '06';
            if(m == 'Juillet') month = '07';
            if(m == 'Août') month = '08';
            if(m == 'Septembre') month = '09';
            if(m == 'Octobre') month = '10';
            if(m == 'Novembre') month = '11';
            if(m == 'Décembre') month = '12';
            var nbrOfDays = new Date(
                parseInt(year),
                parseInt(month),
                0
            ).getDate();

            let newDate = year + "/" + month + "/01";
            let newDateStr = new Date(newDate) + "";
            let dateArray = newDateStr.split(" ");
            let i = 0;
            if (dateArray[0] == "Mon") i = 1;
            if (dateArray[0] == "Tue") i = 2;
            if (dateArray[0] == "Wed") i = 3;
            if (dateArray[0] == "Thu") i = 4;
            if (dateArray[0] == "Fri") i = 5;
            if (dateArray[0] == "Sat") i = 6;
            if (dateArray[0] == "Sun") i = 7;
            let count = 1;
            cal.html("");
            var url =
                "api/getCalendars/" +
                this.selectedProvider.id +
                "/" +
                year +
                "/" +
                month;
            axios.post(url).then(response => {
                this.dates = response.data.data;
                let forWeeks = 1;
                for (count = 1; count < i; count++) {
                    if (forWeeks == 6) {
                        var obj = {
                            id: "",
                            class: "bg-light",
                            hasDiv: false,
                            idDiv: "",
                            contentDiv: "",
                            events: []
                        };
                        this.listes.push(obj);
                    } else {
                        var obj = {
                            id: "",
                            class: "",
                            hasDiv: false,
                            idDiv: "",
                            contentDiv: "",
                            events: []
                        };
                        this.listes.push(obj);
                    }
                    forWeeks++;
                }
                for (let index = 1; index <= nbrOfDays; index++) {
                    if (
                        forWeeks == 6 ||
                        forWeeks == 7 ||
                        forWeeks == 13 ||
                        forWeeks == 14 ||
                        forWeeks == 20 ||
                        forWeeks == 21 ||
                        forWeeks == 27 ||
                        forWeeks == 28 ||
                        forWeeks == 34 ||
                        forWeeks == 35
                    ) {
                        if (index <= 9) {
                            let ind = "0" + index;
                            var ev = [];
                            this.dates.forEach(event => {
                                let str = event.date.split("-");
                                let day = str[2];
                                if (day == ind) {
                                    ev.push(event);
                                }
                            });
                            var obj = {
                                id: "li-" + ind,
                                class: "bg-light",
                                hasDiv: true,
                                idDiv: "day" + ind,
                                classDiv: "date",
                                contentDiv: ind,
                                events: ev
                            };
                            this.listes.push(obj);
                        } else {
                            var ev = [];
                            this.dates.forEach(event => {
                                let str = event.date.split("-");
                                let day = str[2];
                                if (day == index) {
                                    ev.push(event);
                                }
                            });
                            var obj = {
                                id: "li-" + index,
                                class: "bg-light",
                                hasDiv: true,
                                idDiv: "day" + index,
                                classDiv: "date",
                                contentDiv: index,
                                events: ev
                            };
                            this.listes.push(obj);
                        }
                    } else {
                        if (index <= 9) {
                            let ind = "0" + index;
                            var ev = [];
                            this.dates.forEach(event => {
                                let str = event.date.split("-");
                                let day = str[2];
                                if (day == ind) {
                                    ev.push(event);
                                }
                            });
                            var obj = {
                                id: "li-" + ind,
                                class: "",
                                hasDiv: true,
                                idDiv: "day" + ind,
                                classDiv: "date",
                                contentDiv: ind,
                                events: ev
                            };
                            this.listes.push(obj);
                            // $("#li-" + ind).append(div);
                        } else {
                            var ev = [];
                            this.dates.forEach(event => {
                                let str = event.date.split("-");
                                let day = str[2];
                                if (day == index) {
                                    ev.push(event);
                                }
                            });
                            var obj = {
                                id: "li-" + index,
                                class: "",
                                hasDiv: true,
                                idDiv: "day" + index,
                                classDiv: "date",
                                contentDiv: index,
                                events: ev
                            };
                            this.listes.push(obj);
                        }
                    }

                    forWeeks++;
                }
                $("#cover-spin").hide(0);
            });


        },

    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length >= 0) {
                this.closeAlltr();
                var billings = this.billings;
                this.tempBillings = billings.filter(item => {
                    return (
                        item.id
                            .toString()
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.full_name
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.client
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.billing_month
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.billing_year
                            .toString()
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
.thank-you-pop{
	width:100%;
 	padding:20px;
	text-align:center;
}
.thank-you-pop img{
	width:76px;
	height:auto;
	margin:0 auto;
	display:block;
	margin-bottom:25px;
}

.thank-you-pop h1{
	font-size: 42px;
    margin-bottom: 25px;
	color:#5C5C5C;
}
.thank-you-pop p{
	font-size: 20px;
    margin-bottom: 27px;
 	color:#5C5C5C;
}
.thank-you-pop h3.cupon-pop{
	font-size: 25px;
    margin-bottom: 40px;
	color:#222;
	display:inline-block;
	text-align:center;
	padding:10px 20px;
	border:2px dashed #222;
	clear:both;
	font-weight:normal;
}
.thank-you-pop h3.cupon-pop span{
	color:#03A9F4;
}
.thank-you-pop a{
	display: inline-block;
    margin: 0 auto;
    padding: 9px 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #8BC34A;
    border-radius: 17px;
}
.thank-you-pop a i{
	margin-right:5px;
	color:#fff;
}
#ignismyModal .modal-header{
    border:0px;
}
/*--thank you pop ends here--*/

</style>
