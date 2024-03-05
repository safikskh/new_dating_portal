<template>
  <div class="container">
    <span class="logo-button logo-position">
      <a href="/">
        <img src="img/logo.png" class="logo">
      </a>
    </span>
    <button @click="testCall()">TestCall</button>
    <form id="regForm" action="#">
      <div class="tab">
        <h2 class="title-of-page" style="text-align:center;">Opret din profil</h2>
        <div class="center">
          <a class="butfacebook" href="#">Opret med facebook</a>
          <p class="btn-sub-title">Vi deler ikke noget på vegne af dig.</p>
          <div class="divder"></div>
          <p class="f1p">Eller du kan indtaste din e-mail nedenfor</p>
        </div>

        <!-- One "tab" for each step in the form: -->
        <p class="mailss" style="text-align:center;">
          <b-form-input
            :state="emailField"
            type="email"
            v-model="signupUser.email"
            placeholder="mail@mailesen.mail"
            name="email"
          ></b-form-input>
        </p>
        <div class="butn" style>
          <div style="margin-top:5px; margin-right: 17%; text-align: right;text-shadow: #000">
            <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Forrige</button> -->
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Næste</button>
          </div>
        </div>
      </div>
      <div class="tab">
        <h2 style="text-align:center;">Fortæl os lidt om dig selv</h2>
        <div class="secondf">
          <p class="pms">for-og efternavn (vi deler ikke dette med andre brugere)</p>
          <p>
            <b-form-input
              :state="firstNameField"
              v-model="signupUser.firstName"
              placeholder="Fornavn"
              name="Fornavn"
            ></b-form-input>
          </p>

          <p>
            <b-form-input
              :state="lastNameField"
              v-model="signupUser.lastName"
              placeholder="Efternavn"
              name="Efternavn"
            ></b-form-input>
          </p>

          <div class="fsc">
            <p class="pms">Fødselsdag</p>
            <p>
              <!-- <input placeholder="dd/mm/yyyy" type="date" oninput="this.className = ''" name="year"> -->
              <datepicker
                required
                :language="da"
                bootstrap-styling
                v-model="signupUser.dob"
                placeholder="dd/mm/yyyy"
                name="Fødselsdag"
              ></datepicker>
            </p>
          </div>
          <div class="fsc">
            <p class="pms">Seksuel orientering</p>
            <p>
              <b-form-select
                :state="sexualOrientationField"
                :value-field="''"
                :text-field="''"
                v-model="signupUser.sexualOrientation"
                :options="signupData.sexualOrientation"
                class="mb-3"
              ></b-form-select>
            </p>
            <div class="butn" style>
              <div style="margin-top:12px;  text-align: right">
                <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Forrige</button> -->
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Næste</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab">
        <h2 style="text-align:center;">Fortael os lidt mere</h2>
        <div class="mainthird">
          <div class="colum">
            <p>
              <label>Postnummer</label>
              <b-form-input
                :state="zipCodeField"
                v-model="signupUser.zipCode"
                placeholder="Postnummer"
                name="Postnummer"
                class="input-height"
              ></b-form-input>
            </p>
            <p>
              <label>Køn</label>

              <b-form-select
                :value-field="''"
                v-model="signupUser.sex"
                :options="signupData.sex"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Civilstatus</label>

              <b-form-select
                :value-field="''"
                v-model="signupUser.civilStatus"
                :options="signupData.civilStatus"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Brugernavn</label>
              <b-form-input
                :state="usernameField"
                v-model="signupUser.username"
                placeholder="Brugernavn"
                name="Brugernavn"
                class="input-height"
              ></b-form-input>
            </p>
            <p>
              <label>Højde</label>
              <!-- <select name="Hojde" id="Hojde" class="select-second optioncolor" required>
                <option value>Vælg</option>
              </select>-->
              <b-form-select
                :value-field="''"
                v-model="signupUser.height"
                :options="signupData.height"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Vaegt</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.weight"
                :options="signupData.weight"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Hårfarve</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.hairColor"
                :options="signupData.hairColor"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Øjenfarve</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.eyeColor"
                :options="signupData.eyeColor"
                class="mb-3"
              ></b-form-select>
            </p>
          </div>
          <div class="colum">
            <p>
              <label>Adgangskode</label>
              <b-form-input
                :state="passwordField"
                type="password"
                placeholder="adgangskode"
                name="Adgangskode"
                v-model="signupUser.password"
              ></b-form-input>
            </p>
            <p>
              <label>Søger</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.searching"
                :options="signupData.searching"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Kropsbygning</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.bodyType"
                :options="signupData.bodyType"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Tatoveringer</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.tattoos"
                :options="signupData.tattoos"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Piercing</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.piercing"
                :options="signupData.piercing"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Børn</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.children"
                :options="signupData.children"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Ryger</label>
              <b-form-select
                :value-field="''"
                v-model="signupUser.smoking"
                :options="signupData.smoking"
                class="mb-3"
              ></b-form-select>
            </p>
            <p>
              <label>Matchord</label>
              <b-form-input
                :state="matchWordsField"
                placeholder="Matchord"
                name="Machord"
                class="input-height"
                v-model="signupUser.matchWords"
              ></b-form-input>
            </p>
            <div class="butn" style>
              <div style="margin-top:12px;  text-align: right">
                <!-- <button type="button" id="prevBtn" onclick="nextPrev(-1)">Forrige</button> -->
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Næste</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab">
        <h2 style="text-align:center;">Medlemskab</h2>
        <p
          style="text-align:center;"
        >Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          <br>Lorem Ipsum has been the industry's standard dummy text ever
          <br>
          <br>of type and scrambled it to make a type specimen book. It has
          <br>since the 1500s, when an unknown printer took
        </p>
        <div class="mainbox">
          <div class="collum">
            <h4 style="text-align:center;">Medlemskab</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>
            <a v-if="!signupUser.membership_id" @click="toggleFreeMembership()">Jeg kigger lige</a>
            <a v-if="signupUser.membership_id" @click="toggleFreeMembership()">
              <i class="fas fa-check"></i> Jeg kigger lige
            </a>
          </div>
          <div class="collum">
            <h4 style="text-align:center;">Medlemskab</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>
            <a class="col-3" href="#">OpretMigSomMedlem</a>
          </div>
          <a
            style="text-align:center;"
            class="underline-txt"
            href="#"
          >Tryk her for at se handelsbetingelser</a>
        </div>
      </div>
      <!-- Circles which indicates the steps of the form: -->
      <div style="text-align:center;margin-top:40px;">
        <span class="step">1</span>
        <span class="step">2</span>
        <span class="step">3</span>
        <span class="step">4</span>
        <span class="step">5</span>
      </div>
    </form>
  </div>
</template>

<script>
import { en, da } from "vuejs-datepicker/dist/locale";
import moment from "moment";
export default {
  computed: {
    emailField() {
      return this.signupUser.email.length > 7 ? true : false;
    },
    firstNameField() {
      return this.signupUser.firstName.length > 1 ? true : false;
    },
    lastNameField() {
      return this.signupUser.lastName.length > 1 ? true : false;
    },
    sexualOrientationField() {
      return this.signupUser.sexualOrientation;
    },
    usernameField() {
      return this.signupUser.username.length > 2 ? true : false;
    },
    zipCodeField() {
      return this.signupUser.zipCode.length > 2 ? true : false;
    },
    passwordField() {
      return this.signupUser.password.length > 2 ? true : false;
    },
    matchWordsField() {
      return this.signupUser.matchWords.length > 2 ? true : false;
    }
  },
  data() {
    return {
      da: da,
      paramName: this.$route.params.name,
      testObj: {
        username: "sabbirsr3",
        firstName: "Rakib",
        lastName: "Hasan",
        email: "rakib3@yahoo.com",
        password: "123456",
        dob: "10-10-1994",
        iAmSeekingA: "Date",
        sexualOrientation: "Heteroseksuel",
        sex: "mand",
        zipCode: "1229",
        civilStatus: "Single",
        height: "189 cm",
        weight: "249 kg",
        hairColor: "Brunt",
        eyeColor: "Brune",
        searching: "en parter",
        bodyType: "Gennemsnitlig",
        tattoos: "Ja",
        piercing: "Ja",
        children: "Ja",
        smoking: "Ja",
        matchWords: "rakib",
        membership_id: 1
      },
      signupUser: {
        username: "",
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        dob: "",
        iAmSeekingA: this.$route.params.name,
        sexualOrientation: "Vælg",
        sex: "",
        zipCode: "",
        civilStatus: "",
        height: "",
        weight: "",
        hairColor: "",
        eyeColor: "",
        searching: "",
        bodyType: "",
        tattoos: "",
        piercing: "",
        children: "",
        smoking: "",
        matchWords: "",
        membership_id: false
      },
      selected: null,
      signupData: {
        sexualOrientation: [],
        sex: [],
        civilStatus: [],
        height: [],
        hairColor: [],
        eyeColor: [],
        searching: [],
        bodyType: [],
        tattoos: [],
        piercing: [],
        children: [],
        smoking: []
      }
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.getSignupData();
  },
  methods: {
    testCall() {
      // this.signupUser.dob = this.customDateFormatter(this.signupUser.dob);
      fetch(`api/users`, {
        method: "POST",
        body: JSON.stringify(this.testObj),
        headers: { "content-type": "application/json" }
      })
        .then(res => {
          console.log(res);
        })
        .then(data => {
          console.log(data);
        })
        .catch(err => console.log(err));
    },
    toggleFreeMembership() {
      this.signupUser.membership_id = !this.signupUser.membership_id;
      this.signupUser.dob = this.customDateFormatter(this.signupUser.dob);

      fetch(`api/users`, {
        method: "post",
        body: JSON.stringify(this.signupUser),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(
          function(res) {
            this.getCrsfToken(); //refresh crsf token
            console.log(this.getCrsfToken());
          }.bind(this)
        )
        .then(data => {
          console.log(data);

          this.fetchTableInfo();
        })
        .catch(err => console.log(err));

      let user = this.signupUser;
      this.$router.push(`/profile/${user}`);
      console.log(this.signupUser);
    },
    getSignupData() {
      axios.get("/api/signup").then(res => {
        this.signupData = res.data;
      });
    },
    customDateFormatter(date) {
      return moment(date).format("YYYY-MM-DD");
    }
  }
};
</script>
