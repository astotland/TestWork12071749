<template>
  <div class="list">
    <b-card :title="food.name"  v-for="food in food_list" :key="food.id">


      <b-button @click="editfood(food.id)" variant="success">Редактировать</b-button>
      <b-button @click="deletefood(food.id)" variant="danger">Удалить</b-button>
    </b-card>  
   <router-link to="/food/create">Добавить</router-link> 
  </div>
</template>

<script>
// @ is an alias to /src
import { BCard, BButton  } from 'bootstrap-vue'

export default {
  name: 'List',
  data: () => ({
    food_list: []
  }),
  components: {
    'b-card': BCard,
    'b-button': BButton
  },
  methods: {
    fetchData(){      
      this.axios.get(`${window.api}/food`, {}).then((res) => {
        this.food_list = res.data;
      });
    },
    deletefood(id){
      this.axios.delete(`${window.api}/food/${id}`, {}).then(() => {
        this.fetchData();
      })
    },
    editfood(id){
      this.$router.push(`/food/${id}`);
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