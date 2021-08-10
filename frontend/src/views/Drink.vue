<template>
<div>
    <b-form @submit="onSubmit" v-if="show">
        <b-form-group
            id="input-group-1"
            label="Название напитка"
            label-for="input-1"
        >
            <b-form-input
            id="input-1"
            v-model="drink.name"
            type="text"
            placeholder="Название напитка"
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
        drink: [],
        show: true,
        action: false
    }),
    methods: {
        onSubmit(event) {
            event.preventDefault();

            if(this.action === 'update'){
                this.axios.put(`${window.api}/drinks/${this.$route.params.id}`, 
                    {
                        name: this.drink.name,
                        age: this.drink.age
                    }
                ).then(() => {
                    this.$router.push('/drinks/');
                });
            }

            if(this.action === 'create'){
                this.axios.post(`${window.api}/drinks`, 
                    {
                        name: this.drink.name,
                        age: this.drink.age
                    }
                ).then(() => {
                    this.$router.push('/drinks/');
                });
                 
            }
        },
        fetchData() {
            if(this.$route.fullPath == '/drinks/create'){
                this.guset = {
                    name: '',
                    age: ''
                };
                this.action = "create";
                return;
            }

            this.axios.get(`${window.api}/drinks/${this.$route.params.id}/edit`, {}).then( res => {
                this.drink = res.data || false;
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