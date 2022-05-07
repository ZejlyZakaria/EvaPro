<template>
    <div class="card shadow mb-4 allBillingsClass">
        <div
            class="card-header py-3 text-white"
            style=" background-color: #BB5BFF;"
        >
            <h5 class="m-0 font-weight-bold">All billings</h5>
        </div>
        <div class="card-body">
            <nav class="navbar navbar-expand-lg navbar-light bg-light d-print ">
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Filter by
                            </a>
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
                                    <strong>Paid</strong>
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
                                    <strong>Unpaid</strong>
                                    </a
                                >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem"
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
                                    <strong>Not completed</strong>
                                    </a
                                >
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="font-size: 1rem" @click="getBillings"
                                    ><strong>All</strong></a
                                >
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Sort by
                            </a>
                            <div
                                class="dropdown-menu"
                                aria-labelledby="navbarDropdown"
                            >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem"
                                    @click="sortByHigher"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptionsHigher"
                                        id="inlineRadioHigher"
                                        value="higher"
                                    />
                                    <i class="fas fa-sort-numeric-up-alt"></i>
                                    Higher</a
                                >
                                <a
                                    class="dropdown-item"
                                    style="font-size: 0.9rem"
                                    @click="sortByLower"
                                >
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="inlineRadioOptionsLower"
                                        id="inlineRadioLower"
                                        value="lower"
                                    />
                                    <i class="fas fa-sort-numeric-down"></i>
                                    Lower</a
                                >
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" @click="getBillings"
                                    >All</a
                                >
                            </div>
                        </li> -->
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input
                            class="form-control mr-sm-2"
                            type="search"
                            v-model="searchQuery"
                            placeholder="Search"
                            aria-label="Search"
                        />
                        <button
                            class="btn btn-outline-primary my-2 my-sm-0"
                            type="submit"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-wrap">
                <table class="table myaccordion table-hover" id="accordion">
                    <thead style="background-color: #BB5BFF; color: white">
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Client</th>
                            <th>Provider</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>All total bill</th>
                            <th>All total paid</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="billing in tempBillings">
                            <tr
                                :id="'trow' + billing.id"
                                v-bind:data-target="'#billing' + billing.id"
                                v-bind:aria-controls="'billing' + billing.id"
                                class="trBgHover collapsed"
                                @click="
                                    getAllData(
                                        billing.id,
                                        billing.id_project,
                                        billing.provider_id
                                    )
                                "
                                style="cursor: pointer"
                            >
                                <td>{{ billing.id }}</td>
                                <td>
                                    <a
                                        href="#"
                                        @click="
                                            showProjectModal(billing.id_project)
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
                                <td>{{ billing.billing_mounth }}</td>
                                <td>{{ billing.billing_year }}</td>
                                <td>{{ billing.all_total_bill + " €" }}</td>
                                <td>{{ billing.all_total_paid + " €" }}</td>
                                <td>
                                    <span
                                        :class="[
                                            'badge',
                                            billing.status == 'paid'
                                                ? 'badge-success'
                                                : billing.status == 'unpaid'
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
                                        class="fas fa-arrow-down text-success"
                                    ></i>
                                </td>
                            </tr>
                            <tr>
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
                                                    All commissions
                                                    <a
                                                        style="cursor: pointer;"
                                                        class="text-primary withoutLine"
                                                        data-toggle="modal"
                                                        data-target="#addCommissionModal"
                                                        ><i
                                                            class="fas fa-plus text-primary"
                                                        ></i>
                                                        Add</a
                                                    >
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        class="d-flex justify-content-between commissionPara"
                                                        v-for="commission in selectedCommissions"
                                                        :key="commission.id"
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
                                                                >Commission per
                                                                rate</i
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
                                                                >Commission per
                                                                value</i
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
                                                        <p class="card-text">
                                                            All total commission
                                                            (per rate)
                                                        </p>
                                                        <p
                                                            class="card-text text-primary"
                                                            style="font-size: 1rem"
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
                                                        <p class="card-text">
                                                            All total commission
                                                            (per value)
                                                        </p>
                                                        <p
                                                            class="card-text text-primary"
                                                            style="font-size: 1rem"
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
                                                    Profit
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
                                                            Your part
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
                                                    style="font-size: 0.9rem"
                                                >
                                                    Balance
                                                    <a
                                                        style="cursor: pointer;"
                                                        :class="[
                                                            'text-primary withoutLine',
                                                            selectedBilling.balance <
                                                            0
                                                                ? 'text-danger'
                                                                : selectedBilling.balance ==
                                                                  0
                                                                ? 'text-primary'
                                                                : 'text-success'
                                                        ]"
                                                    >
                                                        {{
                                                            selectedBilling.balance +
                                                                " €"
                                                        }}
                                                    </a>
                                                </div>
                                                <div
                                                    class="card-header d-flex justify-content-between"
                                                    style="font-size: 1rem"
                                                >
                                                    Billing details
                                                    <a
                                                        style="cursor: pointer;"
                                                        class="text-primary text-primary withoutLine"
                                                        data-toggle="modal"
                                                        data-target="#addCommissionModal"
                                                    >
                                                        <i
                                                            class="far fa-file-alt text-primary"
                                                        ></i>
                                                        See billing</a
                                                    >
                                                </div>
                                                <div
                                                    class="card-body"
                                                    style="line-height: 6px"
                                                >
                                                    <div
                                                        class="d-flex justify-content-between"
                                                    >
                                                        <p class="card-text">
                                                            Amount
                                                        </p>
                                                        <p class="card-text">
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
                                                                expenses</i
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
                                                        <p class="card-text">
                                                            Amount with expenses
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
                                                        <p class="card-text">
                                                            Amount after
                                                            commission(s)
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
                                                        <p class="card-text">
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
                                    <div class="card " :id="'downCard' + billing.id">
                                        <div class="card-header" :id="'headerCrad' + billing.id">
                                            <ul
                                                class="nav nav-tabs card-header-tabs"
                                                :id="'myTab' + billing.id"
                                                role="tablist"
                                            >
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link active"
                                                        :id="'calendar-tab' + billing.id"
                                                        data-toggle="tab"
                                                        :href="'#calendar' + billing.id"
                                                        role="tab"
                                                        :data-target="'#calendar' + billing.id"
                                                        :aria-controls="'calendar' + billing.id"
                                                        aria-selected="true"
                                                        >Calendar</a
                                                    >
                                                </li>
                                                <li class="nav-item">
                                                    <a
                                                        class="nav-link"
                                                        :id="'expenses-tab' + billing.id"
                                                        data-toggle="tab"
                                                        :href="'#expenses' + billing.id"
                                                        role="tab"
                                                        :data-target="'#expenses' + billing.id"
                                                        :aria-controls="'expenses' + billing.id"
                                                        aria-selected="false"
                                                        >Expenses
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
                                                        :id="'transfers-tab' + billing.id"
                                                        data-toggle="tab"
                                                        :href="'#transfers' + billing.id"
                                                        role="tab"
                                                        :data-target="'#transfers' + billing.id"
                                                        :aria-controls="'transfers' + billing.id"
                                                        aria-selected="false"
                                                        >Payment</a
                                                    >
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="card-body text-center">
                                            <div
                                                class="tab-content"
                                                :id="'myTabContent' + billing.id"
                                            >
                                                <div
                                                    class="tab-pane fade show active"
                                                    :id="'calendar' + billing.id"
                                                    role="tabpanel"
                                                    :aria-labelledby="'calendar-tab' + billing.id"
                                                >
                                                    Tab1
                                                </div>
                                                <div
                                                    class="tab-pane fade"
                                                    :id="'expenses' + billing.id"
                                                    role="tabpanel"
                                                    :aria-labelledby="'expenses-tab' + billing.id"
                                                >
                                                    <div class="table-wrap">
                                                        <table
                                                            class="table table-responsive-xl"
                                                        >
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>
                                                                        Subject
                                                                    </th>
                                                                    <th>
                                                                        Amount
                                                                    </th>
                                                                    <th>
                                                                        To be paid by
                                                                    </th>
                                                                    <th>
                                                                        Verification
                                                                    </th>
                                                                    <th>
                                                                        Status
                                                                    </th>
                                                                    <th>
                                                                        &nbsp;
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
                                                                                class="fas fa-eye text-success"
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
                                                                        &nbsp;
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
                                                    :id="'transfers' + billing.id"
                                                    role="tabpanel"
                                                    :aria-labelledby="'transfers-tab' + billing.id"
                                                >
                                                    <div class="card-body">
                                                        <div
                                                            class="form-row justify-content-center"
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
                                                                    :id="'yearsInput' + billing.id"
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
                                                                    class="btn btn-success mb-2"
                                                                    @click="
                                                                        addTransfer
                                                                    "
                                                                >
                                                                    Add transfer
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
                                                                            Name
                                                                        </th>
                                                                        <th>
                                                                            Month
                                                                        </th>
                                                                        <th>
                                                                            Year
                                                                        </th>
                                                                        <th>
                                                                            Amount
                                                                        </th>
                                                                        <th>
                                                                            &nbsp;
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
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div
            class="modal fade"
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
                                <h6 class="d-flex align-items-center mb-3">
                                    <i class="material-icons text-info mr-2"
                                        >assignment</i
                                    >More information
                                </h6>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">First name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ providerModalSelected.first_name }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Last name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ providerModalSelected.last_name }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ providerModalSelected.email }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ providerModalSelected.phone }}
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Type</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
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
                                <div class="col-sm-9 text-secondary">
                                    {{ projectModalSelected.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Client</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ projectModalSelected.client }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Start date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ projectModalSelected.start_date }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">End date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ projectModalSelected.end_date }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Outstanding</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
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
                            <strong>Add commission</strong>
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
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Commission:</label>
                            </div>

                            <div class="col-md-4 mb-3">
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
                                        Per percent (%)
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
                                        Per value (€)
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
                            Close
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
                            Add
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
                            <strong>Modify transfer</strong>
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
                                    >Transfer name</label
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
                                    >Transfer amount</label
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
                                    >Month</label
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
                                    >Year</label
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
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="updateTransfer"
                        >
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODIFY TRANSFER -->

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
                $(
                    "input:radio[name=inlineRadioOptionsPaid][value=paid]"
                ).prop("checked", true);
                axios
                        .post("api/getBillingsByStatus/paid")
                        .then(response => {
                            this.tempBillings = response.data.data;
                        });
            } else {
                $(
                    "input:radio[name=inlineRadioOptionsPaid][value=paid]"
                ).prop("checked", false);
                if ($("#inlineRadioHigher").is(":checked")) {
                    this.sortByHigher;
                } else if ($("#inlineRadioLower").is(":checked")) {
                    this.sortByLower;
                } else {
                    axios
                        .post("api/getBillings")
                        .then(response => {
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
                axios
                        .post("api/getBillingsByStatus/unpaid")
                        .then(response => {
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
                    axios
                        .post("api/getBillings")
                        .then(response => {
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
                    axios
                        .post("api/getBillings")
                        .then(response => {
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
        }
    },
    watch: {
        searchQuery() {
            if (this.searchQuery.length >= 0) {
                this.closeAlltr();
                var billings = this.billings;
                this.tempBillings = billings.filter(item => {
                    return (
                        item.id.
                            toString()
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
                        item.billing_mounth
                            .toLowerCase()
                            .indexOf(this.searchQuery.toLowerCase()) > -1 ||
                        item.billing_year
                            .toString().toLowerCase()
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

.withoutLine:hover {
    text-decoration: none;
}

.trBgHover:hover {
    background-color: #ececec !important;
    background: #ececec !important;
}
</style>



<div
                                                                    class="input-group"
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
