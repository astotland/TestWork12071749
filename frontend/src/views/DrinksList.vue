<template>
  <div class="list">
    <b-card :title="drink.name"  v-for="drink in drink_list" :key="drink.id">


      <b-button @click="editdrink(drink.id)" variant="success">Редактировать</b-button>
      <b-button @click="deletedrink(drink.id)" variant="danger">Удалить</b-button>
    </b-card>  
   <router-link to="/drinks/create">Добавить</router-link> 
  </div>
</template>

<script>
// @ is an alias to /src
import { BCard, BButton  } from 'bootstrap-vue'

export default {
  name: 'List',
  data: () => ({
    drink_list: []
  }),
  components: {
    'b-card': BCard,
    'b-button': BButton
  },
  methods: {
    fetchData(){      
      this.axios.get(`${window.api}/drinks`, {}).then((res) => {
        this.drink_list = res.data;
      });
    },
    deletedrink(id){
      this.axios.delete(`${window.api}/drinks/${id}`, {}).then(() => {
        this.fetchData();
      })
    },
    editdrink(id){
      this.$router.push(`/drinks/${id}`);
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
s