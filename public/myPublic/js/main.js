'use strict'

let app = new Vue ({
  el :'#topWrapper',
  data:{
    userName: 'unkochan893',
    platform: 'origin',
    killCount: 0,
    rank:'',
    recentPlay:'',
  },
  methods:{
    onclick: function(){
      let LaravelData = null;
      //todo 非同期処理でデータをうけとり画面に出力を表示させる
      axios.get('/profile',{
        params: {
          name: this.userName,
          platform: this.platform,
        }
      })
          .then((res)=>{
            console.log(res.data);
            
            this.killCount = res["data"]["data"]["segments"][0]["stats"]["kills"]["value"];
            this.rank = res["data"]["data"]["segments"][0]["stats"]["rankScore"]["metadata"]["rankName"]+"の"+res["data"]["data"]["segments"][0]["stats"]["rankScore"]["value"];

          })
          .catch(function(res){
            console.log(res);
            console.log('error!');
          })
    }
  }
})
