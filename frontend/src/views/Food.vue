<template>
<div>
    <b-form @submit="onSubmit" v-if="show">
        <b-form-group
            id="input-group-1"
            label="Название блюда"
            label-for="input-1"
        >
            <b-form-input
            id="input-1"
            v-model="food.name"
            type="text"
            placeholder="Название"
            required
            ></b-form-input>

        </b-form-group>


        <b-button type="submit" variant="primary">Сохранить</b-button>
    </b-form>
      
</div>
    

</template>

<script>
import { BForm, BFormInput, BFormGroup, BButton  } from 'bootstrap-vue'


export default {
    components: {
         'b-form': BForm,
         'b-form-input': BFormInput,
         'b-form-group': BFormGroup,
         'b-button': BButton,
    },
    data: () => ({
        food: [],
        show: true,
        action: false
    }),
    methods: {
        onSubmit(event) {
            event.preventDefault();

            if(this.action === 'update'){
                this.axios.put(`${window.api}/food/${this.$route.params.id}`, 
                    {
                        name: this.food.name,
                        age: this.food.age
                    }
                ).then(() => {
                    this.$router.push('/food/');
                });
            }

            if(this.action === 'create'){
                this.axios.post(`${window.api}/food`, 
                    {
                        name: this.food.name,
                        age: this.food.age
                    }
                ).then(() => {
                    this.$router.push('/food/');
                });
                 
            }
        },
        fetchData() {
            if(this.$route.fullPath == '/food/create'){
                this.guset = {
                    name: '',
                    age: ''
                };
                this.action = "create";
                return;
            }

            this.axios.get(`${window.api}/food/${this.$route.params.id}/edit`, {}).then( res => {
                this.food = res.data || false;
                this.action = "update";
            });
        }
    },
    watch: {
        $route(){
            this.fetchData();
        }
    },
    created(){
       this.fetchData();
    }
}
</script>