<template>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nouveau projet</h4>
                    <p class="card-description">
                        Information du projet
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Nom</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errors.name
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="Réalisation d'une application mobile"
                                        v-model="project.name"
                                    />
                                    <span v-if="errors.name" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.name[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Client</label
                                >
                                <div class="col-sm-9">
                                    <input type="text" :class="[
                                            'form-control',
                                            errors.client
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="Amazon"
                                        v-model="project.client"
                                        list="clientsList"
                                    />
                                    <span v-if="errors.client" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.client[0]
                                    }}</span>
                                    <datalist id="clientsList">

                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Fournisseur</label
                                >
                                <div class="col-sm-9">
                                    <select
                                        :class="[
                                            'form-control',
                                            errors.provider ? 'is-invalid' : ''
                                        ]"
                                        id="selectProvider"
                                    >
                                        <option
                                            v-for="provider in providers"
                                            :key="provider.id"
                                            :value="provider.id" :data-meta="provider.id"
                                        >
                                            {{provider.full_name }}
                                        </option>
                                    </select>
                                    <span v-if="errors.provider" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.provider[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Tarif journalier moyen</label
                                >
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <input type="number" :class="[
                                            'form-control',
                                            errors.average_daily_rate
                                                ? 'is-invalid'
                                                : ''
                                        ]" v-model="project.average_daily_rate" placeholder="35" aria-label="Amount (to the nearest dollar)">

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-primary text-white">€</span>
                                        </div>
                                        </div>
                                        <span v-if="errors.average_daily_rate" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.average_daily_rate[0]
                                    }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Date de début</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="date"
                                        :class="[
                                            'form-control',
                                            errors.start_date
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        v-model="project.start_date"
                                    />
                                    <span v-if="errors.start_date" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.start_date[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Date de fin</label
                                >
                                <div class="col-sm-9">
                                     <input
                                        type="date"
                                        :class="[
                                            'form-control',
                                            errors.end_date
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        v-model="project.end_date"
                                    />
                                    <span v-if="errors.end_date" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.end_date[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                >Exceptionnelle</label
                                >
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        :class="[
                                            'form-control',
                                            errors.outstanding
                                                ? 'is-invalid'
                                                : ''
                                        ]"
                                        placeholder="Lorem ipsum dolor sit amet."
                                        v-model="project.outstanding"
                                    />
                                    <span v-if="errors.outstanding" class="text-danger" style="font-size: 0.8rem">{{
                                        errors.outstanding[0]
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="card-description">
                        Commissions
                    </p>
                    <div class="row">

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
                                                class="form-check-input"
                                                name="membershipRadios"
                                                id="salaryRadio"
                                                value=""
                                                checked
                                                @click="changePlaceholder1"
                                            />
                                            Par pourcentage
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
                                                @click="changePlaceholder2"
                                            />
                                            Par valeur
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                    >Valeur</label
                                >
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <input type="number" class="form-control"
                                            placeholder="Commission par pourcentage"
                                            v-model="project.commission"
                                            id="commissionInput"
                                        >
                                        <div class="input-group-append">
                                            <span id="tagCommission" class="input-group-text bg-primary text-white">%</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button @click="addCommission" class="btn btn-primary me-2" style="line-height: 0.2; font-size: 1.4rem; font-weight:600">
                                        +
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row" v-if="project.commissions.length > 0" style="margin-top: 0; margin-bottom: 2ch">
                        <div class="table-wrap">
                            <table class="table table-responsive-xl">
                                <thead>
                                    <tr>
                                        <th>Type de commission</th>
                                        <th>Valeur de commission</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="alert"
                                        role="alert"
                                         v-for="com in project.commissions"
                                         :key="com.commissionType"
                                    >
                                        <td>
                                            {{ com.commissionType }}
                                        </td>
                                        <td>
                                            {{ com.commissionValue }}
                                        </td>
                                        <td>
                                            <a
                                                style="cursor: pointer"
                                                class="close"
                                                @click="deleteCom(com.commissionType, com.commissionValue)"
                                            >
                                                <span
                                                    ><i class="fa fa-close text-danger"></i
                                                ></span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button @click="addProject" class="btn btn-primary me-2">
                        <span v-show="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Créer
                    </button>
                    <button class="btn btn-light" @click="reset">Réinitialiser</button>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import { en, fr } from "vuejs-datepicker/dist/locale";
import $ from "jquery";
import NotificationsBar from "./NotificationsBar.vue";

export default {
    mounted() {
        this.getProviders();
        this.fillClients();
    },
    data() {
        return {
            project: {
                name: "",
                client: "",
                provider: "",
                average_daily_rate: "",
                start_date: "",
                end_date: "",
                commissions: [],
                commission: "",
                outstanding: "",
                commissionType: "rate"
            },
            com: {
                commissionType: '',
                commissionValue: ''
            },
            providers: {},
            errors: [],
            isLoading: false,
            en: en,
            fr: fr,
            odel: {
                date: ""
            },
            disabledDates: {
                to: new Date(Date.now() - 8640000)
            },
            disabledDates2: {
                to: new Date(Date.now() - 8640000)
            },
            societes: [
                "PSA AUTOMOBILES SA",
 "ELECTRICITE DE FRANCE",
 "AIRBUS",
 "RENAULT SAS",
 "TOTALENERGIES MARKETING FRANCE",
 "ORANGE",
 "CSF",
 "ENGIE",
 "CMA CGM",
 "LA FRANCAISE DES JEUX",
 "SNCF MOBILITES",
 "ITM ALIMENTAIRE INTERNATIONAL",
 "AUTOMOBILES PEUGEOT",
 "ENEDIS",
 "CARREFOUR HYPERMARCHES",
 "SNCF VOYAGEURS",
 "SYSTEME U CENTRALE NATIONALE",
 "AUCHAN HYPERMARCHE",
 "SANOFI WINTHROP INDUSTRIE",
 "LA POSTE",
 "TOTAL RAFFINAGE FRANCE",
 "SOCIETE DIMPORTATION LECLERC",
 "ESSO SOCIETE ANONYME FRANCAISE",
 "CONGOLAISE TRANSPORT MARITIME-SOCOTRAM",
 "HP FRANCE SAS",
 "SOCIETE FRANCAISE DU RADIOTELEPHONE - SFR",
 "AIRBUS OPERATIONS",
 "SINERGY",
 "AUTOMOBILES CITROEN",
 "DISTRIBUTION CASINO FRANCE",
 "SCA PETROLE ET DERIVES",
 "SAFRAN AIRCRAFT ENGINES",
 "BOUYGUES TELECOM",
 "LEROY MERLIN FRANCE",
 "SNCF RESEAU",
 "VOLKSWAGEN GROUP FRANCE",
 "LOUIS VUITTON MALLETIER",
 "SOCIETE AIR FRANCE",
 "OCP REPARTITION",
 "RENAULT RETAIL GROUP",
 "CONTANGO TRADING SA",
 "CARFUEL",
 "ARCELORMITTAL ATLANTIQUE ET LORRAINE",
 "LOREAL",
 "DASSAULT AVIATION",
 "GLOBAL LNG",
 "TOTALENERGIES ELECTRICITE ET GAZ FRANCE",
 "RTE RESEAU DE TRANSPORT D ELECTRICITE",
 "PEUGEOT CITROEN SOCHAUX SNC",
 "MANUF FRANC PNEUMATIQ MICHELIN",
 "METRO FRANCE",
 "ARCELORMITTAL FRANCE",
 "MONOPRIX EXPLOIT PAR ABREVIATION MPX",
 "SCAMARK",
 "FNAC DARTY PARTICIPATIONS ET SERVICES",
 "TOTAL SE",
 "COMPAGNIE DEXPLOITATION ET DE REPARTITION PHARMACEUTIQUES DE RO",
 "MANPOWER FRANCE",
 "ADECCO FRANCE",
 "CORA",
 "CFM INTERNATIONAL",
 "RENAULT TRUCKS",
 "SONY EUROPE B.V.",
 "ALLIANCE HEALTHCARE REPARTITION",
 "MERCEDES-BENZ FRANCE",
 "ALSTOM TRANSPORT SA",
 "SCHNEIDER ELECTRIC INDUSTRIES SAS",
 "PSA RETAIL FRANCE SAS",
 "GRDF",
 "NAVAL GROUP",
 "AUTOROUTES DU SUD DE LA FRANCE",
 "HERMES SELLIER",
 "SUCRES ET DENREES",
 "DECATHLON FRANCE",
 "CHANEL",
 "AUCHAN SUPERMARCHE",
 "SANOFI-AVENTIS GROUPE",
 "FREE",
 "FRANCE TELEVISIONS",
 "SOCIETE MECANIQUE AUTOMOBILE DE LEST",
 "MONDELEZ FRANCE SAS",
 "GROUPE LACTALIS",
 "AIRBUS HELICOPTERS",
 "TOTAL PETROCHEMICALS FRANCE",
 "MEUBLES IKEA FRANCE",
 "ITM ALIMENTAIRE CENTRE EST",
 "AS 24",
 "SCHNEIDER ELECTRIC FRANCE",
 "RANDSTAD",
 "SODIAAL UNION",
 "SAMSUNG ELECTRONICS FRANCE",
 "BMW FRANCE",
 "SHV GAS SUPPLY & RISK MANAGEMENT",
 "BOULANGER",
 "CAPGEMINI TECHNOLOGY SERVICES",
 "THEVENIN DUCROT DISTRIBUTION",
 "ITM ALIMENTAIRE SUD EST",
 "CASTORAMA FRANCE",
 "TOYOTA MOTOR MANUFACTURING FRANCE",
 "REXEL FRANCE",
 "TECH DATA FRANCE",
 "APERAM STAINLESS EUROPE",
 "ARKEMA FRANCE",
 "SANOFI PASTEUR",
 "LOGISTA FRANCE",
 "STELIA AEROSPACE",
 "TOYOTA FRANCE",
 "ALCATEL-LUCENT INTERNATIONAL",
 "BRICO DEPOT",
 "SAIPOL",
 "CARREFOUR STATIONS SERVICE",
 "CDISCOUNT",
 "LES LABORATOIRES SERVIER",
 "ITM ALIMENTAIRE SUD OUEST",
 "COCA-COLA EUROPEAN PARTNERS FRANCE",
 "MBDA FRANCE",
 "ENGIE ENERGIE SERVICES",
 "ROBERT BOSCH (FRANCE) SAS",
 "NOVARTIS PHARMA SAS",
 "ITM ALIMENTAIRE REGION PARISIENNE",
 "DALKIA",
 "POMONA",
 "LYONNAISE DES EAUX FRANCE",
 "RHODIA OPERATIONS",
 "AUCHAN ENERGIES",
 "SOCIETE COOPERATIVE AGRICOLE ET AGRO-ALIMENTAIRE AGRIAL",
 "UBISOFT ENTERTAINMENT",
 "CONFRAT EXPLOIT ET REPART PHARMACEUTIQUE",
 "MICROSOFT FRANCE",
 "VEOLIA EAU - COMPAGNIE GENERALE DES EAUX",
 "FMC AUTOMOBILES",
 "THALES LAS FRANCE SAS",
 "THALES SIX GTS FRANCE SAS",
 "CIE IBM FRANCE",
 "FRAMATOME",
 "DECATHLON",
 "DISTRIDYN",
 "CERTAS ENERGY FRANCE",
 "ROQUETTE FRERES",
 "TOTALENERGIES EP ANGOLA",
 "ACTION FRANCE",
 "NESTLE FRANCE",
 "UNILEVER FRANCE",
 "ITM ALIMENTAIRE OUEST",
 "THALES DMS FRANCE SAS",
 "BRIQUETERIE LAMOUR",
 "AIRBUS DEFENCE AND SPACE SAS",
 "ARIANEGROUP SAS",
 "FEDEX EXPRESS FR",
 "DYNEFF S.A.S.",
 "DISTRIBUTION LEADER PRICE SNC",
 "SOUFFLET NEGOCE",
 "SOCIETE VEHICULES AUTOMOBILES BATILLY",
 "GRTGAZ",
 "CHRISTIAN DIOR COUTURE",
 "STEDIS",
 "UNION INVIVO",
 "SOCOPA VIANDES",
 "VENTE PRIVEE.COM",
 "SOCIETE DES PETROLES SHELL",
 "TERRENA",
 "DELL",
 "SANOFI-AVENTIS FRANCE",
 "THALES AVS FRANCE SAS",
 "DASSAULT SYSTEMES",
 "SEPHORA",
 "CARGILL FRANCE",
 "BUT INTERNATIONAL",
 "SOCIETE EUROPEENNE DE VEHICULES LEGERS DU NORD - SEVEL NORD",
 "MONDELEZ FRANCE SAS",
 "PEUGEOT CITROEN MULHOUSE SNC",
 "CHANTIERS DE LATLANTIQUE",
 "JPMORGAN ASSET MANAGEMENT (EUROPE) SARL",
 "GROUPE CANAL+ SA",
 "CARREFOUR SUPPLY CHAIN",
 "IVECO FRANCE",
 "M H C S",
 "PEUGEOT CITROEN RENNES SNC",
 "CHANEL COORDINATION",
 "APRR",
 "BOLLORE LOGISTICS",
 "SOCIETE COOPERATIVE DAPPROVISIONNEMENT DE LOUEST",
 "ADEO SERVICES",
 "PHOENIX PHARMA",
 "DISTRIBUTION SANITAIRE CHAUFFAGE",
 "CONFORAMA FRANCE",
 "BOUYGUES IMMOBILIER",
 "ITM ALIMENTAIRE CENTRE OUEST",
 "MSD FRANCE",
 "GE MEDICAL SYSTEMS",
 "IPSEN PHARMA",
 "SANOFI-AVENTIS RECHERCHE ET DEVELOPPEMENT",
 "ITM ALIMENTAIRE NORD",
 "SOCIETE DEDITION DE CANAL PLUS",
 "FCA FRANCE",
 "BOUYGUES BATIMENT ILE DE FRANCE",
 "SOC DES ATELIERS LOUIS VUITTON",
 "INGRAM MICRO",
 "NEXANS FRANCE",
 "ENI GAS & POWER FRANCE",
 "SOPRA STERIA GROUP",
 "SAFRAN LANDING SYSTEMS",
 "GEFCO FRANCE",
 "GROUPE BIGARD",
 "PARFUMS CHRISTIAN DIOR",
 "PROCTER & GAMBLE FRANCE",
 "PICARD SURGELES",
 "SAGEMCOM BROADBAND SAS",
 "AUCHAN CARBURANT",
 "SCC SA",
 "AEROPORTS DE PARIS",
 "NHINDUSTRIES",
 "ETABLISSEMENTS DARTY ET FILS",
 "TF1 PUBLICITE",
 "TRANSITYRE FRANCE SA",
 "SOCIETE JAS HENNESSY & Co",
 "SAUR",
 "SOCIETE COOPERATIVE DAPPROVISIONNEMENT PARIS-EST",
 "LECLERC APPROVIONNEMENT SUD",
 "ACCENTURE",
 "SA EAUX MINERALES EVIAN",
 "ARCELORMITTAL MEDITERRANEE",
 "TEMSYS",
 "EURIAL LAIT",
 "EIFFAGE TP",
 "TOTALENERGIES LUBRIFIANTS",
 "SANOFI CHIMIE",
 "JOHN DEERE SAS",
 "SCHENKER FRANCE",
 "EXXONMOBIL CHEMICAL FRANCE",
 "TECHNIP FRANCE",
 "JACOBS DOUWE EGBERTS FR SAS",
 "CNH INDUSTRIAL FRANCE",
 "TOTAL OUTRE-MER",
 "MAGASINS GALERIES LAFAYETTE",
 "EG RETAIL (FRANCE) SAS",
 "MILLIPORE",
 "EURO-INFORMATION EUROPEENNE DE TRAITEMENT DE LINFORMATION",
 "URBAINE DES PETROLES",
 "GALERIES LAFAYETTE HAUSSMANN - GL HAUSSMANN",
 "TEREOS FRANCE",
 "PEUGEOT CITROEN PIECES DE RECHANGE",
 "BP FRANCE",
 "CRIT",
 "SOUFFLET AGRICULTURE",
 "SOCAMAINE",
 "BEL",
 "BOLLORE ENERGY",
 "NISSAN WEST EUROPE",
 "LEGRAND SNC",
 "SOCIETE COOPERATIVE DAPPROVISIONNEMENT RHONE ALPES",
 "SANEF",
 "SCAPALSACE",
 "BAYER SAS",
 "PFIZER",
 "DANONE PRODUITS FRAIS FRANCE",
 "SICA SAS AXEREAL",
 "BIOMERIEUX SA",
 "PRINTEMPS",
 "NESTLE WATERS MARKETING & DISTRIBUTION",
 "INTERSPORT FRANCE",
 "ALPIQ ENERGIE FRANCE SAS",
 "SAFRAN HELICOPTER ENGINES",
 "SONAPRO",
 "HUAWEI TECHNOLOGIES FRANCE",
 "GAS NATURAL EUROPE",
 "SAFRAN ELECTRONICS & DEFENSE",
 "COOPERATIVE DAPPROVISIONNEMENT NORMANDE",
 "ITM LOGISTIQUE ALIMENTAIRE INTERNATIONAL",
 "FERRERO FRANCE COMMERCIALE",
 "PEPSICO FRANCE",
 "ORANO CHIMIE-ENRICHISSEMENT",
 "BOUYGUES TRAVAUX PUBLICS",
 "SOC COOPERATIVE SOCAMIL",
 "HEINEKEN ENTREPRISE",
 "TRANSGOURMET OPERATIONS",
 "ANTARGAZ",
 "H&M HENNES & MAURITZ",
 "CDC HABITAT SOCIAL SOCIETE ANONYME DHABITATIONS A LOYER MODERE",
 "COFIROUTE",
 "GRENKE LOCATION",
 "BRISTOL MYERS SQUIBB",
 "SAFRAN NACELLES",
 "YVES SAINT LAURENT",
 "NESTLE PURINA PETCARE FRANCE",
 "BASELL POLYOLEFINES FRANCE",
 "ARVAL SERVICE LEASE",
 "SOCIETE COOPERATIVE DAPPROVISIONNEMENT DE LA REGION DE LARTOIS",
 "JANSSEN CILAG",
 "CANDIA",
 "COMPAGNIE NATIONALE DU RHONE",
 "BRAKE FRANCE SERVICE",
 "ITM ALIMENTAIRE EST",
 "HACHETTE LIVRE",
 "BAYER HEALTHCARE SAS",
 "CRISTALCO",
 "TOUTON SA",
 "BECTON DICKINSON FRANCE",
 "GE ENERGY PRODUCTS FRANCE SNC",
 "ADISSEO FRANCE S.A.S.",
 "KIABI EUROPE",
 "CGI FRANCE",
 "SFR FIBRE SAS",
 "WOREX SNC",
 "JTEKT EUROPE",
 "VINCI CONSTRUCTION GRANDS PROJETS",
 "MARTIN-BROWER FRANCE SAS",
 "MANITOU BF",
 "GROUPE MOBALI-BANDA",
 "AMUNDI ASSET MANAGEMENT",
 "ALTRAN TECHNOLOGIES",
 "ENTREMONT ALLIANCE",
 "SOCIETE COOPERATIVE DAPPROVISIONNEMENT DE LILE DE FRANCE",
 "GAZELENERGIE SOLUTIONS",
 "VIVESCIA",
 "AXIMA CONCEPT",
 "SUPERMARCHES MATCH",
 "SAP FRANCE",
 "PICOTY",
 "ESSITY FRANCE",
 "ROCHE",
 "MCDONALDS FRANCE",
 "TELEVISION FRANCAISE 1",
 "DIAC LOCATION",
 "APERAM STAINLESS FRANCE",
 "BNP PARIBAS ASSET MANAGEMENT FRANCE",
 "LUBRIZOL FRANCE",
 "ZARA FRANCE",
 "KUWAIT PETROLEUM AVIATION FRANCE SAS",
 "CREDIT AGRICOLE-GROUP INFRASTRUCTURE PLATFORM",
 "LAGARDERE TRAVEL RETAIL FRANCE",
 "BOUYGUES ENERGIES & SERVICES",
 "CRISTAL UNION",
 "LACTALIS FROMAGES",
 "MAN TRUCK & BUS FRANCE",
 "ARIANESPACE",
 "AREVA MINES",
 "SYNGENTA FRANCE SAS",
 "AMADEUS",
 "EURO DISNEY ASSOCIES SAS",
 "SOCIETE DES MAGASINS LOUIS VUITTON - FRANCE",
 "MAISON JOHANES BOUBEE",
 "EUTELSAT S.A.",
 "BUNGE FRANCE",
 "ESSILOR INTERNATIONAL",
 "ELECTRO DEPOT FRANCE",
 "AIR LIQUIDE FRANCE INDUSTRIE",
 "SCA FRUITS LEGUMES FLEURS",
 "AUCHAN RETAIL AGRO",
 "KPMG",
 "ROYAL CANIN SAS",
 "KERMENE",
 "FNAC DIRECT",
 "GIFI MAG",
 "ORPEA",
 "DAHER AEROSPACE",
 "KRONENBOURG",
 "BEAUTE PRESTIGE INTERNATIONAL",
 "AGCO DISTRIBUTION S.A.S.",
 "LECUREUR SA",
 "CLUB MED",
 "MAISONS DU MONDE FRANCE",
 "SIEMENS S.A.S",
 "ALTICE FRANCE",
 "PARIS HABITAT-OPH",
 "BIOCOOP",
 "KEM ONE",
 "SYNERGIE",
 "LYONDELL CHIMIE FRANCE",
 "COMPAGNIE PETROLIERE DE LOUEST",
 "MYLAN",
 "TUI FRANCE",
 "TOTAL ENERGIE GAZ",
 "ORACLE FRANCE",
 "IMMOBILIERE 3F",
 "PIERRE FABRE MEDICAMENT",
 "CONTINENTAL FRANCE",
 "SNETOR CHIMIE",
 "SOC CENTRALE APPROVISIONNEMENT ARMORIQUE",
 "GUY DAUPHIN ENVIRONNEMENT",
 "CHRONOPOST",
 "CREDIT AGRICOLE TECHNOLOGIES ET SERVICES",
 "BULL SAS",
 "ELIVIA",
 "CHAUSSON MATERIAUX",
 "CIRCET",
 "SA DE LA RAFFINERIE DES ANTILLES",
 "PROSOL",
 "FRANCAISE DE MECANIQUE",
 "BIOGARAN",
 "LACTALIS INGREDIENTS",
 "VOLVO CAR FRANCE",
 "OPEL FRANCE",
 "SOCIETE COOPERATIVE AGRICOLE AXEREAL",
 "SPIE INDUSTRIE & TERTIAIRE",
 "RIVA ACIER",
 "IDEMIA FRANCE",
 "VARO ENERGY FRANCE SAS",
 "LENOVO FRANCE SAS",
 "CHARAL",
 "LEGRAND FRANCE",
 "LA HALLE",
 "LES GRANDS CHAIS DE FRANCE",
 "SOCIETE DE DISTRIBUTION AEROPORTUAIRE",
 "SAIPEM SA",
 "KIA FRANCE",
 "ORGANISATION INTRA-GROUPE DES ACHATS",
 "COMPASS GROUP FRANCE",
 "VALEO EQUIPEMENTS ELECTRIQUES MOTEUR",
 "GROUPE SEB FRANCE",
 "CARREFOUR IMPORT",
 "ARROW ECS",
 "SOC CENTRALE APPROVISION SUD OUEST",
 "SIDEL BLOWING & SERVICES",
 "ERAMET",
 "ENI FRANCE SARL",
 "EDF PRODUCTION ELECTRIQUE INSULAIRE SAS",
 "ORANGINA SCHWEPPES FRANCE",
 "AUTODISTRIBUTION",
 "PIERRE FABRE DERMO-COSMETIQUE",
 "COOP ATLANTIQUE",
 "BALENCIAGA S A",
 "UNITED PARCEL SERVICE FRANCE SAS",
 "CENTRALE DAPPROVISIONNEMENT DES LANDES",
 "NETWORK RELATED SERVICES",
 "STMICROELECTRONICS SA",
 "ALSTOM CRESPIN SAS",
 "SMURFIT KAPPA FRANCE",
 "SPBI",
 "NORAUTO FRANCE",
 "EVOBUS FRANCE SASU",
 "ES ENERGIES STRASBOURG",
 "AGCO S.A.S.",
 "JAGUAR LAND ROVER FRANCE",
 "SOC COOP APPROVISIONNEMENT PARIS NORD",
 "NTN-SNR ROULEMENTS",
 "MSD VACCINS",
 "FLOREAL",
 "BASF FRANCE SAS",
 "BOUYGUES BATIMENT INTERNATIONAL",
 "RELAIS FNAC",
 "SAS EQUIPEMENT DE LA MAISON",
 "COMPAGNIE GENERALE DES ETABLISSEMENTS MICHELIN",
 "T D F",
 "HENKEL FRANCE",
 "HYUNDAI MOTOR FRANCE",
 "SNEF",
 "AXA INVESTMENT MANAGERS PARIS",
 "SNF SAS",
 "UBISOFT EMEA",
 "SOCIETE VALMY DEFENSE 17 - SDV 17",
 "TRANSAVIA FRANCE",
 "PERNOD RICARD FRANCE",
 "FAURECIA SIEGES DAUTOMOBILE",
 "SEDIFRAIS",
 "CHARVET LA MURE BIANCO",
 "AUTOROUTE ESTEREL COTE AZUR PROVENCE ALP",
 "KUBOTA EUROPE",
 "PLANET PAYMENT FRANCE SAS",
 "MARS PF FRANCE",
 "LILLY FRANCE",
 "MITSUBISHI TURBOCHARGER AND ENGINE EUROPE B.V.",
 "COOP AGRICOL VENDEE APPROV VENTE CEREALE",
 "BUTAGAZ",
 "DISTRIBUTION FRANPRIX",
 "CITEO",
 "CLINEA",
 "SCANIA FRANCE",
 "AMAZON FRANCE LOGISTIQUE SAS",
 "ADIDAS FRANCE",
 "COLAS ILE DE FRANCE NORMANDIE",
 "YAMGAZ",
 "COLAS NORD-EST",
 "SPIE CITYNETWORKS",
 "NEXTER SYSTEMS",
 "KUEHNE+NAGEL",
 "GROUPE SEB EXPORT",
 "CLAAS TRACTOR SAS",
 "SOCIETE VALMY DEFENSE 38 EN ABREGE SVD 38",
 "STMICROELECTRONICS ROUSSET SAS",
 "ALSO FRANCE",
 "SOCIETE VITREENNE DABATTAGE",
 "THALES DIS FRANCE SA",
 "AXXES",
 "MEDTRONIC FRANCE",
 "ATOS INTEGRATION",
 "KUEHNE NAGEL ROAD",
 "INVIVO TRADING",
 "MARS WRIGLEY CONFECTIONERY FRANCE",
 "GFI INFORMATIQUE",
 "TOLL COLLECT GMBH",
 "LABORATOIRE GLAXOSMITHKLINE",
 "INFINEUM FRANCE",
 "MERCEDES-BENZ TRUCKS FRANCE S.A.S.U",
 "BONDUELLE EUROPE LONG LIFE",
 "NOCIBE FRANCE DISTRIBUTION",
 "BERGERAT MONNOYEUR",
 "ESSO RAFFINAGE",
 "LOXAM",

            ]
        };
    },
    methods: {
        addProject() {
            if (this.project.start_date > this.project.end_date) {
                this.errors = {
                    start_date : ["La date de début doit être avant la date de fin"],
                    end_date : ["La date de fin doit être après la date de début"],
                }
            }
            else {
                this.isLoading = true;
                this.project.provider = $('#selectProvider').val();
                axios.post("api/createProject", this.project).then(response => {
                    this.isLoading = false;
                    if (response.data.status == "error") {
                        this.errors = response.data.errors;
                    } else if (response.data.status == "success") {
                        this.project.commissions.forEach(element => {
                            axios.post("api/addingCom/" + response.data.data.id, element).then(response => {
                            });
                        });
                        Toast.fire({
                            icon: "success",
                            position: "bottom-end",
                            title: "Created successfully"
                        });
                        this.errors = [];
                        this.reset();
                    }
                });
            }

        },

        getProviders() {
            axios.get("api/getProviders").then(response => {
                this.providers = response.data.data;
            });
        },
        deleteCom(elem1, elem2) {
            for (let index = 0; index < this.project.commissions.length; index++) {
                if (this.project.commissions[index].commissionType == elem1 && this.project.commissions[index].commissionValue == elem2) {
                    this.project.commissions.splice(index, 1);
                }

            }
        },
        reset() {
            this.project.name = this.project.client = this.project.provider = this.project.average_daily_rate = this.project.start_date = this.project.end_date = this.project.commission = this.project.outstanding =
                "";
                this.project.commissions = [];
        },
        changePlaceholder1() {
            document.getElementById("commissionInput").placeholder =
                "Commission par pourcentage";
            $('#tagCommission').text('%');
            this.project.commissionType = "rate";
        },
        changePlaceholder2() {
            document.getElementById("commissionInput").placeholder =
                "Commission par valeur";
            $('#tagCommission').text('€');

            this.project.commissionType = "value";
        },
        addCommission() {
            let value = this.project.commission;
            let type = this.project.commissionType;
            this.project.commissions.push({
                commissionValue: value,
                commissionType: type
            });
            console.log(this.project.commissions)
            $('#commissionInput').val('');
        },
        fillClients() {
            var options = "";
            this.societes.forEach(element => {
                options += "<option>" + element + "</option>";
            });
            document.getElementById("clientsList").innerHTML = options;
        }
    },
    created() {
        this.getProviders();
    },
    components: {
        "date-picker": Datepicker,
        "notifications-bar": NotificationsBar
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
