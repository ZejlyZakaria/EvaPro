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
                                        errors.first_name ? 'is-invalid' : ''
                                    ]"
                                    placeholder="John"
                                    v-model="provider.first_name"
                                    @keydown="fillFullName"
                                    @change="fillFullName"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    :class="[
                                        'form-control',
                                        errors.first_name ? 'is-invalid' : ''
                                    ]"
                                    placeholder="DOE"
                                    v-model="provider.last_name"
                                    @keydown="fillFullName"
                                    @change="fillFullName"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sexe</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control"
                                    v-model="provider.gender"
                                >
                                    <option>Masculin</option>
                                    <option>Féminin</option>
                                </select>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input
                                    type="email"
                                    :class="[
                                        'form-control',
                                        errors.email ? 'is-invalid' : ''
                                    ]"
                                    placeholder="John.doe@gmail.com"
                                    v-model="provider.email"
                                    @key="toLower"
                                />
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
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="59 rue Marguerite"
                                    v-model="provider.address"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"
                                >Région</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Île-de-France"
                                    v-model="provider.state"
                                />
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
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="provider.address2"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"
                                >Code postale</label
                            >
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="95400"
                                    v-model="provider.postcode"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ville</label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="VILLIERS-LE-BEL"
                                    v-model="provider.city"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pays</label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control"
                                    v-model="provider.country"
                                >
                                    <option
                                        v-for="p in pays"
                                        :value="p"
                                        :key="p"
                                        >{{ p }}</option
                                    >
                                </select>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input
                                            type="radio"
                                            class="form-check-input"
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
                                            class="form-check-input"
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
                    <span
                        v-show="isLoading"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    Ajouter
                </button>
                <button class="btn btn-light" @click="reset">
                    Réinitialiser
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
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
            } else if ($("#freelancerRadio").prop("checked")) {
                this.provider.type = "Freelance";
            }
            this.provider.full_name =
                this.provider.first_name + " " + this.provider.last_name;
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
                    this.errors = [];
                    this.reset;
                }
            });
        },
        reset() {
            this.provider.first_name = this.provider.last_name = this.provider.full_name = this.provider.email = this.provider.phone = this.provider.ssn = this.provider.address = this.provider.address2 = this.provider.state = this.provider.country = this.provider.city = this.provider.ssn = this.provider.dateOfBirth =
                "";
        },
        fillFullName() {
            const str = this.provider.first_name;
            const str2 =
                str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            this.provider.first_name = str2;
            this.provider.last_name = this.provider.last_name.toUpperCase();
        },
        toLower() {
            this.provider.email = this.provider.email.toLowerCase();
        }
    }
};
</script>
