<template>
        <div class="container-fluid">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="d-flex flex-column align-items-center text-center"
                                id="partLeft"
                            >
                                <img
                                    :src="provider.image"
                                    alt="provider"
                                    class="rounded-circle"
                                    width="150"
                                />
                                <div class="mt-3">
                                    <h4>{{ provider.full_name }}</h4>
                                    <p class="text-muted font-size-sm">
                                        {{ provider.email }}
                                    </p>
                                    <div class="file btn btn-lg btn-primary">
                                        Changer la photo
                                        <input
                                            type="file"
                                            name="file"
                                            id="fileInput"
                                            class="profile-edit-btn"
                                            @change="onChange"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title"> Mot de passe</h5>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mot de passe actuel</label>
                                    <input type="password"
                                    :class="['form-control', errorsPass.currentPass ? 'is-invalid' : '']"
                                    id="exampleInputPassword1"
                                    v-model="password.currentPass"
                                    placeholder="Saisissez votre mot de passe acteul">
                                    <span
                                        v-if="errorsPass.currentPass"
                                        class="text-danger" style="font-size: 0.8rem"
                                        >{{ errorsPass.currentPass[0] }}
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nouveau mot de passe</label>
                                    <input type="password"
                                    :class="['form-control', errorsPass.newPass ? 'is-invalid' : '']"
                                    id="exampleInputPassword1"
                                    v-model="password.newPass"
                                    placeholder="Saisissez votre nouveau mot de passe">
                                    <span
                                        v-if="errorsPass.newPass"
                                        class="text-danger" style="font-size: 0.8rem"
                                        >{{ errorsPass.newPass[0] }}
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Confirmez le mot de passe</label>
                                    <input type="password"
                                    :class="['form-control', errorsPass.newPassC ? 'is-invalid' : '']"
                                    id="exampleInputConfirmPassword1"
                                    v-model="password.newPassC"
                                    placeholder="Ressaisissez votre nouveau mot de passe">
                                    <span
                                        v-if="errorsPass.newPassC"
                                        class="text-danger" style="font-size: 0.8rem"
                                        >{{ errorsPass.newPassC[0] }}
                                    </span>
                                </div>
                                <button type="button" class="btn btn-primary me-2" @click="changePassword">Modifier</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3 p-2" id="formChange1">
                        <div class="card-body">
                            <h5 class="card-title">Informations</h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ provider.first_name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ provider.last_name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse e-mail</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ provider.email }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tél</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ provider.phone }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Sexe</h6>
                                </div>
                                <div class="col-sm-9">
                                    {{ provider.gender }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date de naissance</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.dateOfBirth }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.address }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Région</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.state }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ville</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.city }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Code postale</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.postcode }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Pays</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.country }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Type</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.type }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Numéro de sécurité social</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    {{ provider.social_security_number }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12">
                                    <a
                                        class="btn btn-primary px-4"
                                        href="#"
                                        @click="edit"
                                    >
                                        Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Changes -->
                    <div class="card mb-3" id="formChange2">
                        <div class="card-body">
                            <h5 class="card-title">Modifier les informations</h5>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        name="first_name"
                                        :class="[
                                            'form-control',
                                            errors.first_name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        v-model="provider.first_name"
                                        @change="fillFullName"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.first_name"
                                            class="text-danger"
                                            >{{ errors.first_name[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        name="last_name"
                                        :class="[
                                            'form-control',
                                            errors.last_name ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.last_name"
                                        @change="fillFullName"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.last_name"
                                            class="text-danger"
                                            >{{ errors.last_name[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse e-mail</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="email"
                                        name="email"
                                        :class="[
                                            'form-control',
                                            errors.email ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.email"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.email"
                                            class="text-danger"
                                            >{{ errors.email[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tél</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="tel"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.phone ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.phone"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.phone"
                                            class="text-danger"
                                            >{{ errors.phone[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Sexe</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <select
                                        :class="[
                                            'form-control',
                                            errors.gender ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.gender"
                                    >
                                        <option :value="provider.gender">{{
                                            provider.gender
                                        }}</option>
                                        <option
                                            v-if="provider.gender == 'Masculin'"
                                            >Féminin</option
                                        >
                                        <option
                                            v-if="provider.gender == 'Féminin'"
                                            >Masculin</option
                                        >
                                    </select>
                                </div>
                            </div>

                             <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date de naissance</h6>
                                </div>
                                <div class="col-sm-9">
                                    <input
                                        type="date"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.dateOfBirth ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.dateOfBirth"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.dateOfBirth"
                                            class="text-danger"
                                            >{{ errors.dateOfBirth[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="tel"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.address ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.address"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.address"
                                            class="text-danger"
                                            >{{ errors.address[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ville</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="tel"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.city ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.city"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.city"
                                            class="text-danger"
                                            >{{ errors.city[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Région</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="tel"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.state ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.state"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.state"
                                            class="text-danger"
                                            >{{ errors.state[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Code postale</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="tel"
                                        name="phone"
                                        :class="[
                                            'form-control',
                                            errors.postcode ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.postcode"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.postcode"
                                            class="text-danger"
                                            >{{ errors.postcode[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Pays</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <select class="form-control" v-model="provider.country">
                                        <option v-for="p in pays" :value="p" :key="p">{{ p }}</option>
                                    </select>
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.country"
                                            class="text-danger"
                                            >{{ errors.country[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Type</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <select
                                        :class="[
                                            'form-control',
                                            errors.type ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.type"
                                    >
                                        <option :value="provider.type">{{
                                            provider.type
                                        }}</option>
                                        <option
                                            v-if="provider.type == 'Salarié'"
                                            >Freelance</option
                                        >
                                        <option
                                            v-if="provider.type == 'Freelance'"
                                            >Salarié</option
                                        >
                                    </select>
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.type"
                                            class="text-danger"
                                            >{{ errors.type[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Numéro de sécurité social</h6>
                                </div>
                                <div class="col-sm-9 ">
                                    <input
                                        type="number"
                                        name="email"
                                        :class="[
                                            'form-control',
                                            errors.social_security_number ? 'is-invalid' : ''
                                        ]"
                                        v-model="provider.social_security_number"
                                    />
                                    <div class="col-sm">
                                        <span
                                            v-if="errors.social_security_number"
                                            class="text-danger"
                                            >{{ errors.social_security_number[0] }}</span
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <a
                                        class="btn btn-primary px-4"
                                        href="#"
                                        @click="updateProvider"
                                    >
                                        Sauvegarder
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import $ from "jquery";

export default {
    mounted() {
        this.getProvider();
    },
    data() {
        return {
            provider: {
                id: document
                    .querySelector("meta[name='provider-id']")
                    .getAttribute("content"),
                first_name: "",
                last_name: "",
                full_name: "",
                email: "",
                phone: "",
                dateOfBirth: "",
                gender: "",
                city: "",
                country: "",
                address: "",
                state: "",
                state: "",
                postcode: "",
                type: "",
                social_security_number: "",
                image: "assets/images/" + document
                    .querySelector("meta[name='provider-image']")
                    .getAttribute("content"),
            },
            file: "",
            errors: [],
            errorsPass: [],
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
            ],
            password: {
                currentPass: '',
                newPass: '',
                newPassC: ''
            },
        };
    },
    methods: {
        updateProvider() {
            var formData = new FormData();
            formData.append('file', this.file);
            Object.entries(this.provider).forEach(([key, value]) => {
                formData.append(key, value);
            });
            var url = "api/updateProvider/" + this.provider.id;
            axios.post(url, formData).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Vos changements ont été enregistrés",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.errors = [];
                    this.edit();
                    if (this.file != '') {
                        this.provider.image = "assets/images/" + this.provider.image;
                    }

                }
            });
        },
        getProvider() {
            var url = "api/getProvider/" + this.provider.id;
            axios.post(url).then(response => {
                this.provider = response.data.data;
                this.provider.image = "assets/images/" + this.provider.image;
            });
        },
        updateImage() {
            var formData = new FormData();
            formData.append('file', this.file);
            var url = "api/updateImage/" + this.provider.id;
            axios.post(url, formData).then(response => {
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Votre image a été enregistrée",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.getProvider();
                }
            });
        },
        changePassword() {
            if (this.password.newPass != this.password.newPassC) {
                this.errorsPass = {
                    newPassC : ["Le mot de passe de confirmation n'est pas le même."],
                }
            }
            else {
                this.errorsPass = [];
                var url = "api/changePasswordConfirmation/" + this.provider.id;
            axios.post(url, this.password).then(response => {
                if (response.data.status == "error") {
                    this.errorsPass = {
                        currentPass : ["Le mot de passe actuel est incorrect."],
                    }
                }
                else if(response.data.status == "success") {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Votre mot de passe a été modifié",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.errorsPass = [];
                        this.password.currentPass = '';
                        this.password.newPass = '';
                        this.password.newPassC = '';
                    }
                });
            }

        },
        edit() {
            $("#formChange1").toggle();
            $("#formChange2").toggle();
        },
        onChange(e) {
            this.fileValidation(e);
        },
        fillFullName() {
            this.provider.first_name = this.provider.first_name.toUpperCase();
            this.provider.last_name = this.provider.last_name.toUpperCase();
            this.provider.full_name =
                this.provider.first_name + " " + this.provider.last_name;
        },
        fileValidation(e) {
            const fi = document.getElementById('fileInput');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file > 2048) {
                        alert(
                        "Fichier trop gros, veuillez sélectionner un fichier de moins de 2 Mo");
                    } else {
                        this.file = e.target.files[0];
                        this.updateImage();
                    }
                }
            }
        }
    }
};
</script>

<style scoped>

#formChange2 {
    display: none;
}
#partLeft .file {
    position: relative;
    overflow: hidden;
    width: 250px;
    border: none;
    font-size: 15px;
    margin-top: 5px;
    color: #495057;
    background-color: rgb(233, 233, 233);
}

#partLeft .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
}
</style>
