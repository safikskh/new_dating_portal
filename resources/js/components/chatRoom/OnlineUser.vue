<template>
  <div class="col-lg-3">
    <div class="online-box-area height-100" :class="authuser.chatSidebarColor">
      <div class="header-area">
        <h3>
          Online
          <small class="badge badge-pill badge-success">{{onlineusers.length}}</small>
        </h3>
      </div>
      <div class="online-box-area-pro">
        <div class="single-online-area" v-for="item in onlineusers">
          <a target="_blank" :href="profileLink(item.userObj.id)" :title="item.userObj.userName">
            <div class="online-box-content">
              <div class="img-area chat-room-online-users">
                <b-img
                  :src="getPicture(item.userObj.profilePicture)"
                  height="60px"
                  width="60px"
                  rounded="circle"
                  alt="img"
                  class="m-0"
                />
              </div>
              <div class="online-box-text">
                <p :class="item.userObj.portalInfo.userNameColor" v-b-tooltip.hover="tooltipText(item.userObj)">{{item.userObj.portalInfo.userName}}</p>
                <span>{{getAge(item.userObj.portalInfo.dob)}} years</span>
              </div>
            </div>
          </a>
          &nbsp;
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["onlineusers","authuser"],
  methods: {
    className(sex){
      if(sex == 'mand'){
        return 'user-male';
      }else if(sex == 'kvinde'){
        return 'user-female';
      }else{
        return 'user-par';
      }
    },
    tooltipText(user) {
      return this.stringCheck(user.portalInfo.userName)
      +'\n'+ this.getAge(user.portalInfo.dob)
      +' år - '+ this.stringCheck(user.portalInfo.regionName)
      +'\n Postnummer: '+ this.stringCheck(user.portalInfo.zipCode)
      +'\n Søger: '+ this.strReplace(JSON.parse(user.portalInfo.searching))
      +'\n Højde: '+ this.stringCheck(user.portalInfo.height) 
      +'\n Vægt: '+ this.stringCheck(user.portalInfo.weight) 
      +'\n Børn: '+ this.stringCheck(user.portalInfo.children)
      +'\n Matchord: '+  this.strReplace(JSON.parse(user.portalInfo.matchWords));
    },
    strReplace(str){
      if(str){
     return str.join(", ");
    }
    },
    matchWords(data){
      if(data != null){
        if(typeof data === 'object' ){
          return Object.values(data)
        }else{
          return data;
        }
      }else{
        return '';
      }
    },
    stringCheck(data){
      if(data != null){
        return data;
      }else{
        return '';
      }
    },
    getAge(dateString) {
      if(dateString){
      var today = new Date();
      var birthDate = new Date(dateString);
      var age = today.getFullYear() - birthDate.getFullYear();
      var m = today.getMonth() - birthDate.getMonth();
      if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
      }
      return age;
    }
    },
    getPicture(path) {
      return "../"+path;
    },
    profileLink(id) {
      return "../profile?user_id=" + id;
    }
  }

};
</script>
<style>
.widt {
  max-width: 70%;
}
</style>

