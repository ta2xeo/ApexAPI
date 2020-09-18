'use strict'

let app = new Vue ({
  el :'#topWrapper',
  data:{
    userName: 'pygmalion8787',
    platform: 'origin',
  },
  methods:{
    onclick: function(){
      let LaravelData = null;

      axios.get('/profile',{
        params: {
          name: this.userName,
          platform: this.platform,
        }
      })
          .then(function(res){
            console.log(res);
          })
          .catch(function(res){
            console.log(res);
            console.log('error!');
          })
    }
  }
})