<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #fff; color: #4B0082;">
            <h5 class="m-0 font-weight-bold">Create a project</h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Project name</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.name ? 'is-invalid' : ''
                        ]"
                        placeholder="Name of project"
                        v-model="project.name"
                    />
                    <span v-if="errors.name" class="text-danger">{{
                        errors.name[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Client</label>
                    <input
                        id="clientInput"
                        type="text"
                        :class="[
                            'form-control',
                            errors.client ? 'is-invalid' : ''
                        ]"
                        placeholder="Client of project"
                        v-model="project.client"
                    />
                    <span v-if="errors.client" class="text-danger">{{
                        errors.client[0]
                    }}</span>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label>Provider</label>
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
                    <span v-if="errors.provider" class="text-danger">{{
                        errors.provider[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationDefault03">Average daily rate</label>
                    <input
                        type="text"
                        :class="[
                            'form-control',
                            errors.average_daily_rate ? 'is-invalid' : ''
                        ]"
                        placeholder="Average daily rate"
                        v-model="project.average_daily_rate"
                    />
                    <span v-if="errors.average_daily_rate" class="text-danger">{{
                        errors.average_daily_rate[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Start date</label>
                    <date-picker
                        id="startdatePicker"
                        v-model="project.start_date"
                        bootstrap-styling
                        :language="fr"
                        :disabledDates="disabledDates"
                        monday-first
                        calendar-button
                        placeholder="Start date of project"
                        calendar-button-icon="fa fa-calendar"
                        format="yyyy/MM/dd"
                        input-class="bg-white"
                    >
                    </date-picker>
                    <span v-if="errors.start_date" class="text-danger">{{
                        errors.start_date[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <label >End date</label>
                    <date-picker
                        v-model="project.end_date"
                        bootstrap-styling
                        :language="fr"
                        :disabledDates="disabledDates2"
                        monday-first
                        calendar-button
                        placeholder="End date of project"
                        calendar-button-icon="fa fa-calendar"
                        format="yyyy/MM/dd"
                        required
                        input-class="bg-white"
                    >
                    </date-picker>
                    <span v-if="errors.end_date" class="text-danger">{{
                        errors.end_date[0]
                    }}</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-8 mb-3">
                    <label>Outstanding</label>
                    <textarea
                        :class="[
                            'form-control',
                            errors.outstanding ? 'is-invalid' : ''
                        ]"
                        rows="3"
                        v-model="project.outstanding"
                    ></textarea>
                    <span v-if="errors.outstanding" class="text-danger">{{
                        errors.outstanding[0]
                    }}</span>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="d-flex justify-content-between">
                        <label >Commission</label>
                        <a href data-toggle="modal" data-target="#addCommissionModal"> Add commission</a>
                    </div>
                    <div class="d-flex" v-for="commission in this.project.commissions" :key="commission.type">
                        <i><p v-if="commission.commissionType == 'rate'">{{ 'Commission per rate ' + commission.commissionValue }}</p></i>
                        <i><p v-if="commission.commissionType == 'value'">{{ 'Commission per value ' + commission.commissionValue }}</p></i>
                    </div>

                    <div></div>
                </div>
            </div>
            <div class="form-row"></div>
            <button class="btn btn-primary" @click="addProject">
                <span v-show="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Create
            </button>
            <button class="btn btn-light" @click="reset">
                Reset
            </button>
        </div>


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
                                    class="form-control"
                                    id="commissionInput"
                                    placeholder="Commission per percent"
                                    calendar-button
                                    calendar-button-icon="fa fa-calendar"
                                    v-model="project.commission"
                                />
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
        this.autoComplete();
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
            this.isLoading = true;
            this.project.provider = $('#selectProvider').val();
            axios.post("api/createProject", this.project).then(response => {
                this.isLoading = false;
                if (response.data.status == "error") {
                    this.errors = response.data.errors;
                } else if (response.data.status == "success") {
                    Toast.fire({
                        icon: "success",
                        position: "bottom-end",
                        title: "Created successfully"
                    });
                    this.errors = [];
                    this.reset;
                }
            });
        },
        getProviders() {
            axios.get("api/getProviders").then(response => {
                this.providers = response.data.data;
            });
        },
        reset() {
            this.project.name = this.project.client = this.project.provider = this.project.average_daily_rate = this.project.start_date = this.project.end_date = this.project.commission = this.project.outstanding =
                "";
        },
        changePlaceholder1() {
            document.getElementById("commissionInput").placeholder =
                "Commission per percent";
            this.project.commissionType = "rate";
        },
        changePlaceholder2() {
            document.getElementById("commissionInput").placeholder =
                "Commission per value";
            this.project.commissionType = "value";
        },
        addCommission() {
            let value = this.project.commission;
            let type = this.project.commissionType;
            this.project.commissions.push({
                commissionValue: value,
                commissionType: type
            });
            $('#commissionInput').val('');
        },
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
