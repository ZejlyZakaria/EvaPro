<template>
    <div>
        <div class="col-12 grid-margin stretch-card" v-if="provider.projectsCount == 0">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Compte rendu d'activité</h4>
                <div v-if="provider.projectsCount == 0" class="alert alert-secondary" style="color: #000; background-color: #e6e6e6" role="alert">
                    Vous n'avez pas encore de projet!
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card" v-if="provider.projectsCount != 0">
            <div class="card card-rounded" style="background: transparent">
                <div
                    class="card-body"
                    style="margin-bottom: 0; padding-bottom: 0"
                >
                    <div class="row">
                        <div class="col-md-2">
                            <div>
                                <h4 class="card-title card-title-dash">
                                    Compte rendu d'activité
                                </h4>
                            </div>
                            <div class="mt-4">
                                <p>Clés</p>
                                <div class="form-check form-check-primary" style="display: flex; font-weight: 500; font-size: 0.8rem">
                                    <div class="bg-ferie" style="width: 19px; border: 2px solid #aaaaaa; height: 19px; border-radius: 2px"></div>
                                    &nbsp;&nbsp;&nbsp;Jours fériés
                                </div>
                                <div class="form-check form-check-primary" style="display: flex; font-weight: 500; font-size: 0.8rem">
                                    <div class="bg-secondary" style="width: 19px; border: 2px solid #aaaaaa; height: 19px; border-radius: 2px"></div>
                                    &nbsp;&nbsp;&nbsp;Weekend
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10" id="step1">
                            <div
                                class="d-sm-flex justify-content-between align-items-start"
                                style="margin-bottom: 2ch"
                            >
                                <div></div>
                                <div>
                                    <button
                                        class="btn btn-primary"
                                        @click="
                                            initCalendar();
                                            nextStep('step1', 'step2', '30%');
                                            nextStepP(
                                                'step1P',
                                                'step2P',
                                                'next'
                                            );
                                        "
                                    >
                                        Suivant
                                    </button>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-body">
                                    <h4 class="card-title">Sélectionnez le mois et l'année</h4>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1"
                                            >Mois</label
                                        >
                                        <select
                                            class="form-control"
                                            v-model="selectedMonth"
                                            id="selectedMonth"
                                        >
                                            <option
                                                v-for="month in months"
                                                :key="month.abbreviation"
                                                :value="month.abbreviation"
                                                :data-meta="month.abbreviation"
                                            >
                                                {{ month.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Année</label
                                        >
                                        <select
                                            id="yearsInput"
                                            class="form-control"
                                            v-model="selectedYear"
                                        >
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10" id="step2" style="display: none">
                            <div
                                class="d-sm-flex justify-content-between align-items-start"
                                style="margin-bottom: 2ch"
                            >
                                <div></div>
                                <div>
                                    <button
                                        class="btn btn-light"
                                        @click="
                                            nextStep('step1', 'step2', '0%');
                                            nextStepP(
                                                'step1P',
                                                'step2P',
                                                'back'
                                            );
                                        "
                                    >
                                        Précédent
                                    </button>
                                    &nbsp;
                                    <button
                                        class="btn btn-primary"
                                        @click="
                                            countNbrOfDays();
                                            nextStep('step2', 'step3', '60%');
                                            nextStepP(
                                                'step2P',
                                                'step3P',
                                                'next'
                                            );
                                        "
                                    >
                                        Suivant
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Calendrie</h4>
                                    <div class="calendar bg-white">
                                        <div
                                            class="d-sm-flex justify-content-between align-items-start"
                                            style="margin-bottom: 2ch"
                                        >
                                            <div>
                                                <select
                                                    class="combo"
                                                    v-model="selectedMonth"
                                                    id="selectedMonth2"
                                                    @change="initCalendar"
                                                >
                                                    <option
                                                        v-for="month in months"
                                                        :key="
                                                            month.abbreviation
                                                        "
                                                        :value="
                                                            month.abbreviation
                                                        "
                                                        :data-meta="
                                                            month.abbreviation
                                                        "
                                                :class="'custom-option'"

                                                    >
                                                        {{ month.name }}
                                                    </option>
                                                </select>
                                                <select
                                                    id="yearsInput2"
                                                    class="combo"
                                                    v-model="selectedYear"
                                                    @change="initCalendar"
                                                >
                                                </select>
                                            </div>
                                            <select
                                                class="combo2"
                                                id="selectProject"
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
                                        </div>
                                        <!-- <p class="font-italic text-muted mb-5">
                                            No events for this day.
                                        </p> -->
                                        <ol
                                            class="day-names list-unstyled"
                                            style="font-weight: 500;"
                                        >
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Lun
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Mar
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Mer
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Jeu
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Ven
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Sam
                                            </li>
                                            <li
                                                class="font-weight-bold text-uppercase"
                                            >
                                                Dim
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
                                                @click="
                                                    addToCalendar(
                                                        list.id,
                                                        list.events[
                                                            Object.keys(
                                                                list.events
                                                            )[0]
                                                        ],
                                                        list.events[
                                                            Object.keys(
                                                                list.events
                                                            )[1]
                                                        ]
                                                    )
                                                "
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
                                                    @click="
                                                        deleteEvent(event.id)
                                                    "
                                                >
                                                    {{ event.title }}
                                                </div>
                                            </li>
                                            <!-- <li id="li-1">
                                                <div class="date" id="day1">1</div>
                                                <div class="event bg-success">
                                                    Event with Long Name
                                                </div>
                                            </li>
                                            <li id="li-2" @click="addEvent('#li-2', '02')">
                                                <div class="date" id="day2">2</div>
                                            </li>
                                            <li id="li-3" @click="addEvent('#li-3', '03')">
                                                <div class="date" id="day3">3</div>
                                            </li> -->
                                            <!-- <li>
                                                <div class="date" id="day4">4</div>
                                            </li>
                                            <li id="li-5" @click="addEvent('#li-5', '05')">
                                                <div class="date" id="day5">5</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day6">6</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day7">7</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day8">8</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day9">9</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day10">10</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day11">11</div>
                                            </li>
                                            <li>
                                                <div class="date" id="day12">12</div>
                                            </li>
                                            <li>
                                                <div class="date">13</div>
                                                <div
                                                    class="event all-day begin span-2 bg-warning"
                                                >
                                                    Event Name
                                                </div>
                                            </li>
                                            <li>
                                                <div class="date">14</div>
                                            </li>
                                            <li>
                                                <div class="date">15</div>
                                                <div class="event all-day end bg-success">
                                                    Event Name
                                                </div>
                                            </li>
                                            <li>
                                                <div class="date">16</div>
                                            </li>
                                            <li>
                                                <div class="date">17</div>
                                            </li>
                                            <li>
                                                <div class="date">18</div>
                                            </li>
                                            <li>
                                                <div class="date">19</div>
                                            </li>
                                            <li>
                                                <div class="date">20</div>
                                            </li>
                                            <li>
                                                <div class="date">21</div>
                                                <div class="event bg-primary">
                                                    Event Name
                                                </div>
                                                <div class="event bg-success">
                                                    Event Name
                                                </div>
                                            </li>
                                            <li>
                                                <div class="date">22</div>
                                                <div class="event bg-info">
                                                    Event with Longer Name
                                                </div>
                                            </li>
                                            <li>
                                                <div class="date">23</div>
                                            </li>
                                            <li>
                                                <div class="date">24</div>
                                            </li>
                                            <li>
                                                <div class="date">25</div>
                                            </li>
                                            <li>
                                                <div class="date">26</div>
                                            </li>
                                            <li>
                                                <div class="date">27</div>
                                            </li>
                                            <li>
                                                <div class="date">28</div>
                                            </li>
                                            <li>
                                                <div class="date">29</div>
                                            </li>
                                            <li>
                                                <div class="date">30</div>
                                            </li>
                                            <li>
                                                <div class="date">31</div>
                                            </li>
                                            <li class="outside">
                                                <div class="date">1</div>
                                            </li>
                                            <li class="outside">
                                                <div class="date">2</div>
                                            </li>
                                            <li class="outside">
                                                <div class="date">3</div>
                                            </li>
                                            <li class="outside">
                                                <div class="date">4</div>
                                            </li> -->
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10" id="step3" style="display: none">
                            <div
                                class="d-sm-flex justify-content-between align-items-start"
                                style="margin-bottom: 2ch"
                            >
                                <div></div>
                                <div>
                                    <button
                                        class="btn btn-light"
                                        @click="
                                            nextStep('step2', 'step3', '30%');
                                            nextStepP(
                                                'step2P',
                                                'step3P',
                                                'back'
                                            );
                                        "
                                    >
                                        Précédent
                                    </button>
                                    &nbsp;
                                    <button
                                        class="btn btn-primary"
                                        @click="getExpenses();
                                            nextStep('step3', 'step4');
                                            nextStepP(
                                                'step3P',
                                                'step4P',
                                                'next'
                                            );
                                        "
                                    >
                                        Suivant
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Calcul du montant</h4>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <i><h6>Projet sélectionné</h6></i>
                                        <h6
                                            id="nameSelectedProject"
                                            style="font-weight: 600"
                                        ></h6>
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <i><h6>Nombre de jours travaillés</h6></i>
                                        <span
                                            class="badge badge-danger text-white"
                                            style="background-color: #F95F53; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{ nbrOfDays + " jours" }}</span
                                        >
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                    >
                                        <i><h6>Tarif journalier moyen</h6></i>
                                        <span
                                            class="badge badge-success text-white"
                                            style="background-color: #34B1AA; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{ averageDailyRate + "€" }}</span
                                        >
                                    </div>
                                    <hr />
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <h6 style="font-weight: 700">
                                            Montant total
                                        </h6>
                                        <span
                                            class="badge badge-primary text-white"
                                            style="background-color: #1F3BB3; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{
                                                billing.bill_amount + "€"
                                            }}</span
                                        >
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                    >
                                        <h6 style="font-weight: 700">
                                            Net après commission
                                        </h6>
                                        <span
                                            class="badge badge-info text-white"
                                            style="background-color: #52CDFF; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{
                                                billing.net_bill_after_comiss + "€"
                                            }}</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10" id="step4" style="display: none">
                            <div
                                class="d-sm-flex justify-content-between align-items-start"
                                style="margin-bottom: 2ch"
                            >
                                <div></div>
                                <div>
                                    <button
                                        class="btn btn-light"
                                        @click="
                                            nextStep('step3', 'step4', '30%');
                                nextStepP('step3P', 'step4P', 'back');
                                        "
                                    >
                                        Précédent
                                    </button>
                                    &nbsp;
                                    <button
                                        class="btn btn-primary"
                                        @click="
                                            showBilling();
                                            nextStep('step4', 'step5');
                                nextStepP('step4P', 'step5P', 'next');
                                        "
                                    >
                                        Suivant
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Les dépenses
                                    </h4>
                                    <br />
                                    <div class="row justify-content-left">
                                        <div class="col-3">
                                            <label
                                                class="sr-only"
                                                for="inlineFormInput"
                                                >Sujet</label
                                            >
                                            <input
                                                type="text"
                                                :class="[
                                                    'form-control mb-2',
                                                    errors.subject
                                                        ? 'is-invalid'
                                                        : ''
                                                ]"
                                                id="subjectId"
                                                placeholder="Sujet"
                                                v-model="expense.subject"
                                            />
                                        </div>
                                        <div class="col-2">
                                            <label
                                                class="sr-only"
                                                for="inlineFormInputGroup"
                                                >Montant</label
                                            >
                                            <div class="input-group mb-2">
                                                <input
                                                    type="text"
                                                    :class="[
                                                        'form-control',
                                                        errors.amount
                                                            ? 'is-invalid'
                                                            : ''
                                                    ]"
                                                    id="amountId"
                                                    placeholder="Montant"
                                                    v-model="expense.amount"
                                                />
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <div
                                                        class="input-group-text"
                                                    >
                                                        <strong>€</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label
                                                class="sr-only"
                                                for="inlineFormInput"
                                                >Client</label
                                            >
                                            <select
                                                class="form-control"
                                                v-model="expense.toPayBy"
                                            >
                                                <option value="Client"
                                                    >Client</option
                                                >
                                                <option value="Newteam"
                                                    >Newteam</option
                                                >
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <input
                                                    type="file"
                                                    name="img[]"
                                                    class="file-upload-default"
                                                    id="customFile"
                                                    @change="onChange"
                                                />
                                                <div
                                                    class="input-group col-xs-12"
                                                >
                                                    <input
                                                        type="text"
                                                        class="form-control file-upload-info"
                                                        disabled
                                                        placeholder="Upload Verification"
                                                    />
                                                    <span
                                                        class="input-group-append"
                                                    >
                                                        <button
                                                            class="file-upload-browse btn btn-secondary"
                                                            type="button"
                                                            style="line-height: 0.3"
                                                        >
                                                            Importer
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button
                                                class="btn btn-primary mb-2"
                                                @click="addExpense"
                                                style="line-height: 0.3"
                                            >
                                                Ajouter
                                            </button>
                                        </div>
                                    </div>
                                    <div class="table-wrap">
                                        <table
                                            class="table table-responsive-xl"
                                        >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sujet</th>
                                                    <th>Montant</th>
                                                    <th>Payable par</th>
                                                    <th>Vérification</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    class="alert"
                                                    role="alert"
                                                    v-for="exp in expenses"
                                                    :key="exp.id"
                                                    style="margin-bottom: 0"
                                                >
                                                    <td>
                                                        {{ exp.id }}
                                                    </td>
                                                    <td>
                                                        {{ exp.subject }}
                                                    </td>
                                                    <td>
                                                        {{ exp.amount + " €" }}
                                                    </td>
                                                    <td>
                                                        {{ exp.toPayBy }}
                                                    </td>
                                                    <td class="status">
                                                        <a
                                                            href="#"
                                                            class="badge badge-success"
                                                            @click="
                                                                showFile(
                                                                    exp.verification,
                                                                    exp.id
                                                                )
                                                            "
                                                            >Importée</a
                                                        >
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="#"
                                                            class="close"
                                                            data-dismiss="alert"
                                                            aria-label="Close"
                                                            @click="
                                                                deleteExpense(
                                                                    exp.id
                                                                )
                                                            "
                                                        >
                                                            <span
                                                                aria-hidden="true"
                                                                ><i
                                                                    class="fa fa-close text-danger"
                                                                ></i
                                                            ></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10" id="step5" style="display: none">
                            <div
                                class="d-sm-flex justify-content-between align-items-start"
                                style="margin-bottom: 2ch"
                            >
                                <div></div>
                                <div>
                                    <button
                                        class="btn btn-light"
                                        @click="
                                            nextStep('step4', 'step5', '30%');
                                nextStepP('step4P', 'step5P', 'back');
                                        "
                                    >
                                        Précédent
                                    </button>
                                    &nbsp;
                                    <button
                                        class="btn btn-primary"
                                        @click="createBilling()"
                                    >
                                        Envoyer
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Détails de la facturation</h4>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <i><h6>Mois et année</h6></i>
                                        <h6
                                            style="font-weight: 600"
                                        >{{ billing.billing_month + ' ' + billing.billing_year }}</h6>
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <i><h6>Nom du projet</h6></i>
                                        <h6
                                            id="nameSelectedProject2"
                                            style="font-weight: 600"
                                        ></h6>
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"

                                    >
                                        <i><h6>Montant de la facture</h6></i>
                                        <span
                                            class="badge badge-light text-black"
                                            style="background-color: #aab2bd; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{ this.billing.bill_amount + "€" }}</span
                                        >
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                    >
                                        <i><h6>Totale commissions</h6></i>
                                        <span
                                            class="badge badge-light text-black"
                                            style="background-color: #aab2bd; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{ this.billing.total_commissions + "€" }}</span
                                        >
                                    </div>
                                    <hr />
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"

                                    >
                                        <h6 style="font-weight: 700">
                                            Net après commissions
                                        </h6>
                                        <span
                                            class="badge badge-light text-black"
                                            style="background-color: #aab2bd; border-radius: 5px; font-size: 0.9rem; font-weight: 600"
                                            >{{
                                                billing.net_bill_after_comiss + "€"
                                            }}</span
                                        >
                                    </div>
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                    >
                                        <i><h6>Totale dépenses</h6></i>
                                        <span
                                            class="badge badge-light text-black"
                                            style="background-color: #aab2bd; border-radius: 5px; font-size: 0.9rem; font-weight: 500"
                                            >{{ totalExpenses + "€" }}</span
                                        >
                                    </div>
                                    <hr />
                                    <div
                                        class="d-sm-flex justify-content-between align-items-start"
                                        style="margin-bottom: 1ch"
                                    >
                                        <h6 style="font-weight: 700">
                                            Totale
                                        </h6>
                                        <span
                                            class="badge badge-primary text-white"
                                            style="background-color: #1F3BB3; border-radius: 5px; font-size: 0.9rem; font-weight: 600"
                                            >{{
                                                (billing.net_bill_after_comiss + totalExpenses ) + "€"
                                            }}</span
                                        >
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="showFileModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLongTitle"
            aria-hidden="true"
            v-if="provider.projectsCount != 0"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Votre vérification
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                            @click="hideModal('showFileModal')"
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
                        <label for="inputFile2" class="myLabel float-left"
                            ><input
                                type="file"
                                class="myInput"
                                name=""
                                id="inputFile2"
                                accept="image/*,.pdf,.word,.xls,.rtf"
                                @change="onChangeFile"
                            /><i class="fas fa-sync-alt"></i> Changer fichier</label
                        >

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="hideModal('showFileModal')"
                        >
                            Fermer
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-dimiss="modal"
                            @click="changeFile"
                        >
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="provider.projectsCount != 0" class="modal fade" id="ignismyModal" role="dialog" @click="checkModal()">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>

                    <div class="modal-body">

						<div class="thank-you-pop">
							<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
							<h1>Travail rapporté avec succès!</h1>
							<p>Vous pouvez voir les détails dans votre tableau de facturation</p>
							<h3 class="cupon-pop">Id facture: <span>{{ billingId.id }}</span></h3>

 						</div>

                    </div>

                </div>
            </div>
        </div>
        <div v-if="provider.projectsCount != 0" class="modal fade" id="ignismyModal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>

                    <div class="modal-body">

						<div class="thank-you-pop">
							<img src="https://weakwifisolutions.com/wp-content/uploads/2019/08/error-red-cross-1.png?ezimgfmt=ng%3Awebp%2Fngcb2%2Frs%3Adevice%2Frscb2-2" alt="">
							<h1>Projet déjà rapporté</h1>
							<p>Vous avez déjà rapporté ce projet le même mois et la même année</p>

 						</div>

                    </div>

                </div>
            </div>
        </div>
        <div id="cover-spin"></div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { en, fr } from "vuejs-datepicker/dist/locale";
import $ from "jquery";
import NotificationsBar from "./NotificationsBar.vue";

export default {
    mounted() {
        this.getProjects();
        this.changeBG();
        this.fillInputsYear();
        this.firstCalendar();
    },
    data() {
        return {
            expense: {
                subject: "",
                amount: "",
                toPayBy: "Client"
            },
            provider: {
                id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content"),
                projectsCount: document
                    .querySelector("meta[name='provider-projectsCount']")
                    .getAttribute("content")
            },
            project: {
                id: ""
            },
            currentDate: {
                date: ""
            },
            selectedMonth: "",
            selectedYear: "2021",
            projects: {},
            expenses: {},
            billingId: {},
            totalExpenses: 0,
            errors: [],
            nbrOfDays: "",
            billing: {
                bill_amount: "",
                billing_month: "",
                billing_year: "",
                net_bill_after_comiss: "",
                total_commissions: "",
                nbrOfDays: ''
            },
            averageDailyRate: "",
            previously: 0,
            event: {
                id: "",
                date: "",
                title: "",
                id_project: "",
                provider_id: "",
                nbrOfDays: 0
            },
            oneTime: false,
            file: "",
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
            newFile: "",
            isDisponible: true,
            currentExpense: "",
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
            feries: [
                "2026-01-01",
                "2026-04-06",
                "2026-05-01",
                "2026-05-08",
                "2026-05-14",
                "2026-05-25",
                "2026-07-14",
                "2026-08-15",
                "2026-11-01",
                "2026-11-11",
                "2026-12-25",
                "2025-01-01",
                "2025-04-21",
                "2025-05-01",
                "2025-05-08",
                "2025-05-29",
                "2025-06-09",
                "2025-07-14",
                "2025-08-15",
                "2025-11-01",
                "2025-11-11",
                "2025-12-25",
                "2024-01-01",
                "2024-04-01",
                "2024-05-01",
                "2024-05-08",
                "2024-05-09",
                "2024-05-20",
                "2024-07-14",
                "2024-08-15",
                "2024-11-01",
                "2024-11-11",
                "2024-12-25",
                "2023-01-01",
                "2023-04-10",
                "2023-05-01",
                "2023-05-08",
                "2023-05-18",
                "2023-05-29",
                "2023-07-14",
                "2023-08-15",
                "2023-11-01",
                "2023-11-11",
                "2023-12-25",
                "2022-01-01",
                "2022-04-18",
                "2022-05-01",
                "2022-05-08",
                "2022-05-26",
                "2022-06-06",
                "2022-07-14",
                "2022-08-15",
                "2022-11-01",
                "2022-11-11",
                "2022-12-25",
                "2021-01-01",
                "2021-04-05",
                "2021-05-01",
                "2021-05-08",
                "2021-05-13",
                "2021-05-24",
                "2021-07-14",
                "2021-08-15",
                "2021-11-01",
                "2021-11-11",
                "2021-12-25",
                "2020-01-01",
                "2020-04-13",
                "2020-05-01",
                "2020-05-08",
                "2020-05-21",
                "2020-06-01",
                "2020-07-14",
                "2020-08-15",
                "2020-11-01",
                "2020-11-11",
                "2020-12-25"
            ]
        };
    },
    methods: {
        firstCalendar() {
            var date = new Date();
            var month = date.getMonth() + 1;
            if (month >= 1 && month <= 9) month = "0" + month;
            this.selectedMonth = month;
            this.selectedYear = date.getFullYear();
            this.initCalendar();
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
            let month = this.selectedMonth;
            let year = this.selectedYear;
            var mnth = $("selectedMonth").val();
            var nbrOfDays = new Date(
                parseInt(year),
                parseInt(month),
                0
            ).getDate();

            let newDate = year + "/" + month + "/01";
            let newDateStr = new Date(newDate) + "";
            let dateArray = newDateStr.split(" ");
            $("#calendar-title").text(
                $("#selectedMonth option:selected")
                    .text()
                    .toUpperCase() +
                    " " +
                    this.selectedYear
            );
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
                this.provider.id +
                "/" +
                this.selectedYear +
                "/" +
                this.selectedMonth;
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
                        // cal.append(li);
                    } else {
                        let li = "<li data-v-01138bdb></li>";
                        var obj = {
                            id: "",
                            class: "",
                            hasDiv: false,
                            idDiv: "",
                            contentDiv: "",
                            events: []
                        };
                        this.listes.push(obj);
                        // cal.append(li);
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
                            // let li = "<li data-v-01138bdb class='bg-light' id='li-" + ind + "' @click='addEvent(" + ind + ")' style='cursor: pointer'></li>";
                            // let div = "<div data-v-01138bdb class='date' id='day" + ind + "'>" + ind + "</div>";
                            // cal.append(li);
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
                            // $("#li-" + ind).append(div);
                        } else {
                            // let li = "<li data-v-01138bdb class='bg-light' id='li-" + index + "' @click='addEvent(" + index + ")' style='cursor: pointer'></li>";
                            // let div = "<div data-v-01138bdb class='date' id='day" + index + "'>" + index + "</div>";
                            // cal.append(li);
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
                            // $("#li-" + index).append(div);
                        }
                    } else {
                        if (index <= 9) {
                            let ind = "0" + index;
                            // let li = "<li data-v-01138bdb id='li-" + ind + "' @click='addEvent(" + ind + ")' style='cursor: pointer'></li>";
                            // let div = "<div data-v-01138bdb class='date' id='day" + ind + "'>" + ind + "</div>";
                            // cal.append(li);
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
                            // let li = "<li data-v-01138bdb id='li-" + index + "' @click='addEvent(" + index + ")' style='cursor: pointer'></li>";
                            // let div = "<div data-v-01138bdb class='date' id='day" + index + "'>" + index + "</div>";
                            // cal.append(li);
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
                            // $("#li-" + index).append(div);
                        }
                    }

                    forWeeks++;
                }
                this.listes.forEach(element => {
                    var temp = element.id.split('-');
                    var nDay = temp[1];
                    var cond = this.selectedYear + "-" + this.selectedMonth + '-' + nDay;
                    this.feries.forEach(element2 => {
                        if (cond == element2) {
                            element.class = 'bg-ferie';
                        }
                    });
                });
                $("#cover-spin").hide(0);
            });


        },
        showCalendar() {
            $("#yearandmonth").toggle();
            $("#calendarId").toggle();
        },
        deleteEvent(elem) {
            this.oneTime = true;
            axios.post("api/deleteCalendar/" + elem).then(response => {
                this.initCalendar();
                this.oneTime = false;
            });
        },
        fillInputsYear() {
            var nowY = new Date().getFullYear(),
                options = "";

            for (var Y = nowY; Y >= 2000; Y--) {
                options += "<option class='custom-option'>" + Y + "</option>";
            }
            $("#yearsInput").append(options);
            var nowY = new Date().getFullYear(),
                options = "";

            for (var Y = nowY; Y >= 2000; Y--) {
                options += "<option class='custom-option'>" + Y + "</option>";
            }
            $("#yearsInput2").append(options);
        },
        addEvent(id) {
            if (this.oneTime == false) {
                alert(id);
            }
        },
        // addEvent(title, day, id) {
        //     let event = "<div data-v-01138bdb id='" + id + "' class='event bg-primary'>" + title + "</div>";
        //     $("#li-" + day).append(event);
        // },
        handleSelect(date) {
            let newDate = "2019-12-" + date;
            let id_project = $("#selectProject").val();
            var url =
                "api/isAvailableCalendar/" +
                arg.startStr +
                "/" +
                arg.endStr +
                "/" +
                id_project;
            axios.post(url).then(response => {
                if (response.data.data == "true") {
                    this.event.start = arg.startStr;
                    this.event.end = arg.endStr;
                    let lastDay = this.event.end.slice(
                        this.event.end.length - 2
                    );
                    let firstDay = this.event.start.slice(
                        this.event.start.length - 2
                    );
                    let res = parseInt(lastDay) - parseInt(firstDay);
                    this.event.nbrOfDays = res;
                    this.addToCalendar();
                }
            });
        },
        addToCalendar(date, event, event2) {
            if (date != "") {
                let str = $("#selectProject option:selected").text();
                if (event == null && event2 == null) {
                    $("#cover-spin").show(0);
                    let d = date.split("-");
                    let day = d[1];
                    let project_id = $("#selectProject").val();
                    var url =
                        "api/addToCalendar/" +
                        project_id +
                        "/" +
                        this.selectedYear +
                        "/" +
                        this.selectedMonth +
                        "/" +
                        day;
                    axios.post(url, date).then(response => {
                        if (response.data.status == "success") {
                            this.initCalendar();
                        }
                    });
                } else if (event != null && event2 == null) {
                    if (!str.includes(event.title)) {
                        if (date != "" && this.oneTime == false) {
                            $("#cover-spin").show(0);
                            let d = date.split("-");
                            let day = d[1];
                            let project_id = $("#selectProject").val();
                            var url =
                                "api/addToCalendar/" +
                                project_id +
                                "/" +
                                this.selectedYear +
                                "/" +
                                this.selectedMonth +
                                "/" +
                                day;
                            axios.post(url, date).then(response => {
                                if (response.data.status == "success") {
                                    this.initCalendar();
                                }
                            });
                        }
                    }
                } else if (event != null && event2 != null) {
                }
            }
        },
        getCalendars() {
            var url =
                "api/getCalendars/" +
                this.provider.id +
                "/" +
                this.selectedYear +
                "/" +
                this.selectedMonth;
            axios.post(url).then(response => {
                let dates = response.data.data;
                dates.forEach(element => {
                    let str = element.date.split("-");
                    let day = str[2];
                    this.addEvent(element.title, day);
                });
            });
        },
        createBilling() {
            this.billing.nbrOfDays = this.nbrOfDays;
            let project_id = $("#selectProject").val();
            var url = "api/createBilling/" + project_id + '/' + this.provider.id;
            axios.post(url, this.billing).then(response => {
                if (response.data.status == 'success') {
                    this.billingId = response.data.data;
                    this.showModal('ignismyModal');
                }
                else if(response.data.status == 'error') {
                    this.showModal('ignismyModal2');
                }
            });
        },
        chechModal() {
            if (!$('#ignismyModal').hasClass('in')) {
                window.location.replace("/reportwork");
            }
        },
        getAverageDailyRate() {
            let project_id = $("#selectProject").val();
            var url = "api/getAverageDailyRate/" + project_id;
            axios.post(url).then(response => {
                this.averageDailyRate = response.data.data.average_daily_rate;
                this.billing.bill_amount = response.data.data.average_daily_rate * this.nbrOfDays;
                let comRate = 0;
                let comValue = 0;
                axios.post("api/getCommissionRate/" + project_id).then(response => {
                    comRate = response.data.data;
                });
                axios.post("api/getCommissionValue/" + project_id).then(response => {
                    comValue = response.data.data;
                    this.billing.total_commissions = comValue + ((comRate/100) * this.billing.bill_amount);
                    this.billing.net_bill_after_comiss = this.billing.bill_amount - this.billing.total_commissions;

                    $("#cover-spin").hide(0);

                });
            });
        },
        getCalendarsId() {
            $("#cover-spin").show(0);

            let project_id = $("#selectProject").val();
            var url = "api/getCalendarsId/" + project_id;
            axios.post(url).then(response => {
                var output = [];
                for (var i = 0; i < response.data.data.length; ++i)
                    output.push(response.data.data[i]["id"]);
                this.getNbrOfDays(output);
            });
        },
        changeBG() {
            const feries = [
                "2026-01-01",
                "2026-04-06",
                "2026-05-01",
                "2026-05-08",
                "2026-05-14",
                "2026-05-25",
                "2026-07-14",
                "2026-08-15",
                "2026-11-01",
                "2026-11-11",
                "2026-12-25",
                "2025-01-01",
                "2025-04-21",
                "2025-05-01",
                "2025-05-08",
                "2025-05-29",
                "2025-06-09",
                "2025-07-14",
                "2025-08-15",
                "2025-11-01",
                "2025-11-11",
                "2025-12-25",
                "2024-01-01",
                "2024-04-01",
                "2024-05-01",
                "2024-05-08",
                "2024-05-09",
                "2024-05-20",
                "2024-07-14",
                "2024-08-15",
                "2024-11-01",
                "2024-11-11",
                "2024-12-25",
                "2023-01-01",
                "2023-04-10",
                "2023-05-01",
                "2023-05-08",
                "2023-05-18",
                "2023-05-29",
                "2023-07-14",
                "2023-08-15",
                "2023-11-01",
                "2023-11-11",
                "2023-12-25",
                "2022-01-01",
                "2022-04-18",
                "2022-05-01",
                "2022-05-08",
                "2022-05-26",
                "2022-06-06",
                "2022-07-14",
                "2022-08-15",
                "2022-11-01",
                "2022-11-11",
                "2022-12-25",
                "2021-01-01",
                "2021-04-05",
                "2021-05-01",
                "2021-05-08",
                "2021-05-13",
                "2021-05-24",
                "2021-07-14",
                "2021-08-15",
                "2021-11-01",
                "2021-11-11",
                "2021-12-25",
                "2020-01-01",
                "2020-04-13",
                "2020-05-01",
                "2020-05-08",
                "2020-05-21",
                "2020-06-01",
                "2020-07-14",
                "2020-08-15",
                "2020-11-01",
                "2020-11-11",
                "2020-12-25"
            ];
            for (let index = 0; index < feries.length; index++) {
                var d = "td[data-date=" + "'" + feries[index] + "'" + "]";
                $(d).css("background-color", "#bfbfbf");
            }
            $(".fc-button").click(function() {
                for (let index = 0; index < feries.length; index++) {
                    var d = "td[data-date=" + "'" + feries[index] + "'" + "]";
                    $(d).css("background-color", "#bfbfbf");
                }
            });
        },
        nextStep(elem1, elem2, percent) {
            var elem1 = "#" + elem1;
            var elem2 = "#" + elem2;
            $(elem1).toggle();
            $(elem2).toggle();
            $(".progress-bar").animate({ width: percent }, 1200); // animate progress-bar
        },
        nextStepP(elem1, elem2, elem3) {
            var elem1 = "#" + elem1;
            var elem2 = "#" + elem2;

            if (elem3 == "back") {
                $(elem1).removeClass("done", 1200);
                $(elem2).removeClass("active", 1200);
                $(elem2).addClass("disable", 1200);
            } else {
                $(elem1).addClass("done", 1200);
                $(elem2).removeClass("disable", 1200);
                $(elem2).addClass("active", 1200);
            }
        },
        setProjectId() {
            this.project.id = $("#selectProject").val();
            this.getExpenses();
        },
        getProjects() {
            var url = "api/getProjects/" + this.provider.id;
            axios.post(url).then(response => {
                this.projects = response.data.data;
            });
        },
        countNbrOfDays() {
            $("#cover-spin").show(0);
            var count = 0;
            let str = $("#selectProject option:selected").text();
            let tab = this.listes;
            for (let i = 0; i < tab.length; i++) {
                if (tab[i].events.length > 0) {
                    let size = tab[i].events.length;
                    for (let index = 0; index < size; index++) {
                        if (str.includes(tab[i].events[index].title)) {
                            if (size == 2) {
                                count += 0.5;
                            } else if (size == 1) {
                                count++;
                            }
                        }
                    }
                }
            }
            this.nbrOfDays = count;
            $("#nameSelectedProject").text(
                $("#selectProject option:selected").text()
            );
            $("#nameSelectedProject2").text(
                $("#selectProject option:selected").text()
            );
            this.getAverageDailyRate();
        },
        addExpense() {
            if (this.file != "") {
                var formData = new FormData();
                formData.append("file", this.file);
                Object.entries(this.expense).forEach(([key, value]) => {
                    formData.append(key, value);
                });
                var url =
                    "api/addExpense/" +
                    this.provider.id +
                    "/" +
                    $("#selectProject").val();
                axios.post(url, formData).then(response => {
                    if (response.data.status == "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        this.errors = [];
                        this.reset();
                        this.getExpenses();
                    }
                });
            }
        },
        getExpenses() {
            $("#cover-spin").show(0);
            var url =
                "api/getExpenses/" +
                this.provider.id +
                "/" +
                $("#selectProject").val();
            axios.post(url).then(response => {
                this.expenses = response.data.data.reverse();
                $("#cover-spin").hide(0);

            });
        },
        showBilling() {
            this.billing.billing_month = $("#selectedMonth option:selected").text();
            this.billing.billing_year = this.selectedYear;
            var total = 0;
            this.expenses.forEach(element => {
                total += element.amount;
            });
            this.totalExpenses = total;
        },
        deleteExpense(elem) {
            var url = "api/deleteExpense/" + elem + "/" + this.provider.id;
            axios.post(url).then(response => {
                this.getExpenses();
            });
        },
        changeFile() {
            if (this.newFile != "") {
                var formData = new FormData();
                formData.append("file", this.newFile);
                var url =
                    "api/changeFile/" +
                    this.currentExpense +
                    "/" +
                    this.provider.id;
                axios.post(url, formData).then(response => {
                    if (response.data.status == "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        this.getExpenses();
                    }
                });
            }
            $("#showFileModal").modal("hide");
        },
        showFile(elem, elem2) {
            this.currentExpense = elem2;
            $("#iframeFile").attr(
                "src",
                "assets/files/" + this.provider.id + "/" + elem
            );
            $("#showFileModal").modal("toggle");
        },
        onChange(e) {
            if (e.target.files[0].size / 1024 / 1024 > 2) {
                $("#customFile").val("");
                Swal.fire("The file size is too big.");
            } else {
                this.file = e.target.files[0];
            }
        },
        onChangeFile(e) {
            if (e.target.files[0].size / 1024 / 1024 > 2) {
                $("#inputFile2").val("");
                Swal.fire("The file size is too big.");
            } else {
                this.newFile = e.target.files[0];
                let src = URL.createObjectURL(e.target.files[0]);
                $("#iframeFile").attr("src", src);
            }
        },
        hideModal(elem) {
            $("#" + elem).modal('hide');
        },
        showModal(elem) {
            $("#" + elem).modal('show');
        },
        reset() {
            $("#customFile").val("");
            this.expense.subject = this.expense.amount = "";

        },
        filevalidation() {
            const fi = document.getElementById("customFile");
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round(fsize / 1024);
                    // The size of the file.
                    if (file >= 1) {
                        alert(
                            "File too Big, please select a file less than 4mb"
                        );
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        },
        displayMessage(message) {
            toastr.success(message, "Event");
        }
    }
};
</script>

<style scoped>
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
