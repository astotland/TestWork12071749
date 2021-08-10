<template>
  <div id="app" class="container">
    <div class="row">
      <div class="col-2">
        <b-list-group>
          <b-list-group-item class="d-flex justify-content-between align-items-center">
            <router-link to="/guests">Список гостей</router-link> 

          </b-list-group-item>

          <b-list-group-item class="d-flex justify-content-between align-items-center">
        
            <router-link to="/drinks">Напитки</router-link> 

          </b-list-group-item>

          <b-list-group-item class="d-flex justify-content-between align-items-center">
           <router-link to="/food">Еда</router-link> 
          </b-list-group-item>
        </b-list-group>
      </div>
     
      <div class="col-6">
        <router-view/>
      </div>
    </div>
  </div>
</template>

<script>
import { BListGroup, BListGroupItem } from 'bootstrap-vue'

export default {
   components: {
     'b-list-group': BListGroup,
     'b-list-group-item': BListGroupItem,
     
   },
   data: () => ({

   }),
   created(){
      
   }
}
</script>

<style>
  #app{
    margin-top: 25px;
  }
</style>
