<template>
  <div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg static-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img class="logo" src="img/logo.png" alt="logo">
        </a>
        <div class="nav-mensuss" id="navbarResponsive">
          <form class="form-inline">
            <input type="text" class="form-control mr-sm-2" placeholder="Email">
            <input
              type="password"
              class="form-control mr-sm-2"
              autocomplete="new-password"
              placeholder="Password"
            >
            <button type="submit" class="btn login-btn" @click="ajaxLogin()">Log In</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <div class="intro-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <form class="dating-selection">
              <label>Jeg søger en</label>
              <select class="wSelect" v-model="selectedSeeking">
                <option v-for="iAmSeeking in iAmSeekingAll">{{iAmSeeking}}</option>
              </select>
              <button v-if="selectedSeeking !== null" class="reg-btn" @click="callSignupPage()">
                <a>Opret Profil</a>
                <!-- Opret Profil -->
                <!-- <router-link to="/signup/'{selectedSeeking}'">Opret Profil</router-link> -->
              </button>
              <button v-if="selectedSeeking === null" class="reg-btn" disabled>Opret Profil
                <!-- Opret Profil -->
                <!-- <router-link to="/signup/'{selectedSeeking}'">Opret Profil</router-link> -->
              </button>
            </form>
          </div>
        </div>
      </div>
      <!-- /.container -->
    </div>
    <!-- /.intro-header -->
    <section id="video-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="video-title">Dating portalen video</h1>
            <div id="player-overlay">
              <video
                controls
                poster="https://ak7.picdn.net/shutterstock/videos/25099157/thumb/4.jpg"
              >
                <source
                  src="https://ak7.picdn.net/shutterstock/videos/25099157/preview/stock-footage-romantic-couple-in-paris-eiffel-tower-embrace-kissing-honeymoon-enjoying-european-summer-holiday.webm"
                  type="video/webm"
                >
                <source src="http://techslides.com/demos/sample-videos/small.ogv" type="video/ogg">
                <source
                  src="https://ak7.picdn.net/shutterstock/videos/25099157/preview/stock-footage-romantic-couple-in-paris-eiffel-tower-embrace-kissing-honeymoon-enjoying-european-summer-holiday.mp4"
                  type="video/mp4"
                >
                <source src="http://techslides.com/demos/sample-videos/small.3gp" type="video/3gp">
              </video>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.container -->
    <section id="disclaimer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
          </div>
          <div class="col-md-6">
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
            <h5 class="disclaimer-title">What is Lorem Ipsum?</h5>
            <p
              class="disclaimer-para"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->
    <footer class="page-footer font-small">
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2018 All Rights Reserved</div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      iAmSeekingAll: null,
      selectedSeeking: null
    };
  },
  mounted() {
    this.iAmSeekingA();
    // console.log(this.selectedSeeking);
  },
  methods: {
    callSignupPage() {
      let dateType = this.selectedSeeking;
      this.$router.push(`/signup/${dateType}`);
      console.log(this.selectedSeeking);
    },
    iAmSeekingA() {
      axios.get("/api/signup").then(res => {
        this.iAmSeekingAll = res.data.iAmSeekingA;
        // console.log(res.data.iAmSeekingA);
        console.log(this.iAmSeekingAll);
      });
    },
    ajaxLogin() {
      let email = "rakib@test.com";
      let pass = "123456";
      axios
        .post("/login", {
          email: email,
          password: pass
        })
        .then(
          function(res) {
            this.getCrsfToken(); //refresh crsf token
            console.log(res);
          }.bind(this)
        );
    },
    getCrsfToken() {
      axios.get("/getToken").then(function(res) {
        // Refresh crsf token from session after login
        window.axios.defaults.headers.common["X-CSRF-TOKEN"] = res.data;
      });
    }
  }
};
</script>

<style scoped>
</style>