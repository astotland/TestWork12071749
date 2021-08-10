<template>
  <div class="list">
    <b-card :title="guest.name"  v-for="guest in guest_list" :key="guest.id">
      <b-card-text>
        возраст: {{ guest.age }}
      </b-card-text>
       <b-card-text v-if="guest.drinks.length">
        <div>предпочитаемые напитки:</div> 
        <span v-for="drink in guest.drinks" :key="drink.id">{{ drink.name }} </span>
  
      </b-card-text>

       <b-card-text v-if="guest.food.length">
        <div>предпочитаемые блюда:</div> 
        <span v-for="foo in guest.food" :key="foo.id">{{ foo.name }} </span>
  
      </b-card-text>
       

      <b-button @click="editGuest(guest.id)" variant="success">Редактировать</b-button>
      <b-button @click="deleteGuest(guest.id)" variant="danger">Удалить</b-button>
    </b-card>  
   <router-link to="/guests/create">Добавить</router-link> 
  </div>
</template>

<script>
// @ is an alias to /src
import { BCard, BCardText, BButton  } from 'bootstrap-vue'

export default {
  name: 'List',
  data: () => ({
    guest_list: []
  }),
  components: {
    'b-card': BCard,
    'b-card-text': BCardText,
    'b-button': BButton
  },
  methods: {
    fetchData(){      
      this.axios.get(`${window.api}/guests`, {}).then((res) => {
        this.guest_list = res.data;
      });
    },
    deleteGuest(id){
      this.axios.delete(`${window.api}/guests/${id}`, {}).then(() => {
        this.fetchData();
      })
    },
    editGuest(id){
      this.$router.push(`/guests/${id}`);
    }
  },
  watch: {
    '$route': 'fetchData'
  },
  created(){
    this.fetchData();
  }
}
</script>
