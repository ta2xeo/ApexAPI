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

      axios.get('/profile',{
        params: {
          name: this.userName,
          platform: this.platform,
        }
      })
      .then(res=>{
            console.log(res.data);
            
            this.killCount = res["data"]["data"]["segments"][0]["stats"]["kills"]["value"];
            this.rank = res["data"]["data"]["segments"][0]["stats"]["rankScore"]["metadata"]["rankName"]+"の"+res["data"]["data"]["segments"][0]["stats"]["rankScore"]["value"];

      })
      .catch(res=>{
            console.log(res);
            console.log('error!');
      })
      //todo axiosリクエストもっとうまいことまとめたい。promisオブジェクト作って引数にaxiosインスタンスぶち込めばいいっぽい

      axios.get('/sessions',{
        params: {
          name: this.userName,
          platform: this.platform,
        }
      })
        .then(res=>{
        //時間表記規格ISO8601→UTC→JST
        let GMT = res['data']['data']['items'][0]['metadata']['endDate']['value'];
        let UTC = Date.parse(GMT);
        let JST = new Date(UTC).toLocaleString('ja-JP', {era:'long'});
        console.log(JST);

        this.recentPlay = JST;
      })
        .catch(res=>{
        console.log(res);
        console.log('error!');
      })
    }
  }
})
