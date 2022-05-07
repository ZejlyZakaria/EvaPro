<template>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nouveau fournisseur</h4>
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
                                        v-model="provider.first_name"
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
                                            errors.last_name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="DOE"
                                        v-model="provider.last_name"
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
                                    <select class="form-control" v-model="provider.gender">
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
                                        class="form-control"
                                        placeholder="1970/12/01"
                                        v-model="provider.dateOfBirth"
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
                                        v-model="provider.email"
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
                                        class="form-control"
                                        placeholder="0710203040"
                                        v-model="provider.phone"
                                    />
                                    <span v-if="errors.phone" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.phone[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Adresse
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Adresse 1</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="59 rue Marguerite" v-model="provider.address" />
                                    <span v-if="errors.address" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.address[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Région</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Île-de-France" v-model="provider.state"/>
                                    <span v-if="errors.state" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.state[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Adresse 2</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" v-model="provider.address2" />
                                    <span v-if="errors.address2" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.address2[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Code postale</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="95400" v-model="provider.postcode"/>
                                    <span v-if="errors.postcode" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.postcode[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Ville</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="VILLIERS-LE-BEL" v-model="provider.city" />
                                    <span v-if="errors.city" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.city[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Pays</label
                                >
                                <div class="col-sm-9">
                                    <select class="form-control" v-model="provider.country">
                                        <option v-for="p in pays" :value="p" :key="p">{{ p }}</option>
                                    </select>
                                    <span v-if="errors.country" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.country[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Information professionnelle
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Numéro de SS</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="1 85 08 75 123 456 12"
                                        v-model="provider.ssn"
                                    />
                                    <span v-if="errors.ssn" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.ssn[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Type</label
                                >
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="radio"
                                                name="membershipRadios"
                                                id="salaryRadio"
                                                value=""
                                                checked
                                            />
                                            Salarié
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="radio"
                                                name="membershipRadios"
                                                id="freelancerRadio"
                                                value="option2"
                                            />
                                            Freelance
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button @click="addUser" class="btn btn-primary me-2">
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
    mounted() {
        vm.$forceUpdate();
    },
    data() {
        return {
            provider: {
                first_name: "",
                last_name: "",
                full_name: "",
                gender: "Masculin",
                dateOfBirth: "",
                email: "",
                phone: "",
                address: "",
                address2: "",
                state: "",
                postcode: "",
                city: "",
                country: "France",
                type: "Salary",
                ssn: ""
            },
            errors: [],
            isLoading: false,
            pays: [
                "Afghanistan",
                "Afrique du Sud",
                "Albanie",
                "Algérie",
                "Allemagne",
                "Andorre",
                "Angola",
                "Anguilla",
                "Antarctique",
                "Antigua-et-Barbuda",
                "Antilles néerlandaises",
                "Arabie saoudite",
                "Argentine",
                "Arménie",
                "Aruba",
                "Australie",
                "Autriche",
                "Azerbaïdjan",
                "Bahamas",
                "Bahreïn",
                "Bangladesh",
                "Barbade",
                "Bélarus",
                "Belgique",
                "Belize",
                "Bénin",
                "Bermudes",
                "Bhoutan",
                "Bolivie",
                "Bosnie-Herzégovine",
                "Botswana",
                "Brésil",
                "Brunéi Darussalam",
                "Bulgarie",
                "Burkina Faso",
                "Burundi",
                "Cambodge",
                "Cameroun",
                "Canada",
                "Cap-Vert",
                "Ceuta et Melilla",
                "Chili",
                "Chine",
                "Chypre",
                "Colombie",
                "Comores",
                "Congo-Brazzaville",
                "Corée du Nord",
                "Corée du Sud",
                "Costa Rica",
                "Côte d’Ivoire",
                "Croatie",
                "Cuba",
                "Danemark",
                "Diego Garcia",
                "Djibouti",
                "Dominique",
                "Égypte",
                "El Salvador",
                "Émirats arabes unis",
                "Équateur",
                "Érythrée",
                "Espagne",
                "Estonie",
                "État de la Cité du Vatican",
                "États fédérés de Micronésie",
                "États-Unis",
                "Éthiopie",
                "Fidji",
                "Finlande",
                "France",
                "Gabon",
                "Gambie",
                "Géorgie",
                "Géorgie du Sud et les îles Sandwich du Sud",
                "Ghana",
                "Gibraltar",
                "Grèce",
                "Grenade",
                "Groenland",
                "Guadeloupe",
                "Guam",
                "Guatemala",
                "Guernesey",
                "Guinée",
                "Guinée équatoriale",
                "Guinée-Bissau",
                "Guyana",
                "Guyane française",
                "Haïti",
                "Honduras",
                "Hongrie",
                "Île Bouvet",
                "Île Christmas",
                "Île Clipperton",
                "Île de l'Ascension",
                "Île de Man",
                "Île Norfolk",
                "Îles Åland",
                "Îles Caïmans",
                "Îles Canaries",
                "Îles Cocos - Keeling",
                "Îles Cook",
                "Îles Féroé",
                "Îles Heard et MacDonald",
                "Îles Malouines",
                "Îles Mariannes du Nord",
                "Îles Marshall",
                "Îles Mineures Éloignées des États-Unis",
                "Îles Salomon",
                "Îles Turks et Caïques",
                "Îles Vierges britanniques",
                "Îles Vierges des États-Unis",
                "Inde",
                "Indonésie",
                "Irak",
                "Iran",
                "Irlande",
                "Islande",
                "Italie",
                "Jamaïque",
                "Japon",
                "Jersey",
                "Jordanie",
                "Kazakhstan",
                "Kenya",
                "Kirghizistan",
                "Kiribati",
                "Koweït",
                "Laos",
                "Lesotho",
                "Lettonie",
                "Liban",
                "Libéria",
                "Libye",
                "Liechtenstein",
                "Lituanie",
                "Luxembourg",
                "Macédoine",
                "Madagascar",
                "Malaisie",
                "Malawi",
                "Maldives",
                "Mali",
                "Malte",
                "Maroc",
                "Martinique",
                "Maurice",
                "Mauritanie",
                "Mayotte",
                "Mexique",
                "Moldavie",
                "Monaco",
                "Mongolie",
                "Monténégro",
                "Montserrat",
                "Mozambique",
                "Myanmar",
                "Namibie",
                "Nauru",
                "Népal",
                "Nicaragua",
                "Niger",
                "Nigéria",
                "Niue",
                "Norvège",
                "Nouvelle-Calédonie",
                "Nouvelle-Zélande",
                "Oman",
                "Ouganda",
                "Ouzbékistan",
                "Pakistan",
                "Palaos",
                "Panama",
                "Papouasie-Nouvelle-Guinée",
                "Paraguay",
                "Pays-Bas",
                "Pérou",
                "Philippines",
                "Pitcairn",
                "Pologne",
                "Polynésie française",
                "Porto Rico",
                "Portugal",
                "Qatar",
                "R.A.S. chinoise de Hong Kong",
                "R.A.S. chinoise de Macao",
                "Régions éloignées de l’Océanie",
                "République centrafricaine",
                "République démocratique du Congo",
                "République dominicaine",
                "République tchèque",
                "Réunion",
                "Roumanie",
                "Royaume-Uni",
                "Russie",
                "Rwanda",
                "Sahara occidental",
                "Saint-Barthélémy",
                "Saint-Kitts-et-Nevis",
                "Saint-Marin",
                "Saint-Martin",
                "Saint-Pierre-et-Miquelon",
                "Saint-Vincent-et-les Grenadines",
                "Sainte-Hélène",
                "Sainte-Lucie",
                "Samoa",
                "Samoa américaines",
                "Sao Tomé-et-Principe",
                "Sénégal",
                "Serbie",
                "Serbie-et-Monténégro",
                "Seychelles",
                "Sierra Leone",
                "Singapour",
                "Slovaquie",
                "Slovénie",
                "Somalie",
                "Soudan",
                "Sri Lanka",
                "Suède",
                "Suisse",
                "Suriname",
                "Svalbard et Île Jan Mayen",
                "Swaziland",
                "Syrie",
                "Tadjikistan",
                "Taïwan",
                "Tanzanie",
                "Tchad",
                "Terres australes françaises",
                "Territoire britannique de l'océan Indien",
                "Territoire palestinien",
                "Thaïlande",
                "Timor oriental",
                "Togo",
                "Tokelau",
                "Tonga",
                "Trinité-et-Tobago",
                "Tristan da Cunha",
                "Tunisie",
                "Turkménistan",
                "Turquie",
                "Tuvalu",
                "Ukraine",
                "Union européenne",
                "Uruguay",
                "Vanuatu",
                "Venezuela",
                "Viêt Nam",
                "Wallis-et-Futuna",
                "Yémen",
                "Zambie",
                "Zimbabwe"
            ]
        };
    },
    methods: {
        addUser() {
            // var date = new Date(this.provider.dateOfBirth);

            // let newDate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
            // alert(newDate)
            if ($("#salaryRadio").prop("checked")) {
                this.provider.type = "Salarié";
            }
            else if ($("#freelancerRadio").prop("checked")) {
                this.provider.type = "Freelance";
            }
            this.provider.full_name = this.provider.first_name + ' ' + this.provider.last_name;
            this.isLoading = true;
            axios.post("api/addUser", this.provider).then(response => {
                this.isLoading = false;
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        title: "Created successfully",
                        position: "bottom-end"
                    });
                    this.reset();
                    this.errors = [];
                }
            });
        },
        reset() {
            this.provider.first_name = this.provider.last_name = this.provider.full_name = this.provider.email = this.provider.phone = this.provider.ssn =
            this.provider.address = this.provider.address2 = this.provider.state = this.provider.city =
            this.provider.ssn = this.provider.dateOfBirth = "";
        },
        fillFullName() {
            const str = this.provider.first_name;
            const str2 = str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            this.provider.first_name = str2;
            this.provider.last_name = this.provider.last_name.toUpperCase();
        },
        toLower() {
            this.provider.email = this.provider.email.toLowerCase();
        },
    }
};
</script>

<style scoped>
.form-check .form-check-input {
  float: left;
  margin-left: -1.5em;
}

.form-check-input {
  width: 1em;
  height: 1em;
  margin-top: 0.25em;
  vertical-align: top;
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  border: 1px solid rgba(0, 0, 0, 0.25);
  /* appearance: none; */
  color-adjust: exact;
}

.form-check-input[type="checkbox"] {
  border-radius: 0.25em;
}

.form-check-input[type="radio"] {
  border-radius: 50%;
}

.form-check-input:active {
  filter: brightness(90%);
}

.form-check-input:focus {
  border-color: #86b7fe;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-check-input:checked {
  background-color: #0d6efd;
  border-color: #0d6efd;
}

.form-check-input:checked[type="checkbox"] {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
}

.form-check-input:checked[type="radio"] {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-input[type="checkbox"]:indeterminate {
  background-color: #0d6efd;
  border-color: #0d6efd;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
}

.form-check-input:disabled {
  pointer-events: none;
  filter: none;
  opacity: 0.5;
}

.form-check-input[disabled] ~ .form-check-label, .form-check-input:disabled ~ .form-check-label {
  opacity: 0.5;
}

.form-switch {
  padding-left: 2.5em;
}

.form-switch .form-check-input {
  width: 2em;
  margin-left: -2.5em;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
  background-position: left center;
  border-radius: 2em;
  transition: background-position 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
  .form-switch .form-check-input {
    transition: none;
  }
}

.form-switch .form-check-input:focus {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%2386b7fe'/%3e%3c/svg%3e");
}

.form-switch .form-check-input:checked {
  background-position: right center;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
}




</style>
