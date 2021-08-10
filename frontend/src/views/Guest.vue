<template>
<div>
    <b-form @submit="onSubmit" v-if="show">
        <b-form-group
            id="input-group-1"
            label="Имя гостя"
            label-for="input-1"
        >
            <b-form-input
            id="input-1"
            v-model="guest.name"
            type="text"
            placeholder="Имя"
            required
            ></b-form-input>

        </b-form-group>

        <b-form-group
            id="input-group-2"
            label="Возраст гостя"
            label-for="input-2"
        >
            <b-form-input
            id="input-2"
            v-model="guest.age"
            type="text"
            placeholder="Возраст"
            ></b-form-input>

        </b-form-group>

        <b-form-group label="Предпочитаемые напитки:" v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
                id="checkbox-group-2"
                v-model="selectedDrinks"
                :aria-describedby="ariaDescribedby"
                name="flavour-2"
            >
                <b-form-checkbox 
                    v-for="drink in drinks" 
                    :key="drink.id" 
                    :value="drink.id"
                >
                    {{ drink.name }}
                </b-form-checkbox>
                   
            </b-form-checkbox-group>
        </b-form-group>

        <b-form-group label="Предпочитаемые блюда:" v-slot="{ ariaDescribedby }">
            <b-form-checkbox-group
                id="checkbox-group-2"
                v-model="selectedFood"
                :aria-describedby="ariaDescribedby"
                name="flavour-2"
            >
                <b-form-checkbox 
                    v-for="foo in food" 
                    :key="foo.id" 
                    :value="foo.id"
                >
                    {{ foo.name }}
                </b-form-checkbox>
                   
            </b-form-checkbox-group>
        </b-form-group>

        <b-button type="submit" variant="primary">Сохранить</b-button>
    </b-form>

</div>
    

</template>

<script>
import { BForm, BFormInput, BFormGroup, BButton, BFormCheckboxGroup, BFormCheckbox  } from 'bootstrap-vue'


export default {
    components: {
         'b-form': BForm,
         'b-form-input': BFormInput,
         'b-form-group': BFormGroup,
         'b-button': BButton,
         'b-form-checkbox-group': BFormCheckboxGroup,
         "b-form-checkbox" : BFormCheckbox
    },
    data: () => ({
        guest: [],
        drinks: [],
        food: [],
        selectedFood: [],
        selectedDrinks: [],
        show: true,
        action: false,

    }),
    methods: {
        onSubmit(event) {
            event.preventDefault();

            if(this.action === 'update'){
                this.axios.put(`${window.api}/guests/${this.$route.params.id}`, 
                    {
                        name: this.guest.name,
                        age: this.guest.age,
                        drinks: this.selectedDrinks,
                        food: this.selectedFood
                    }
                ).then(() => {
                    this.$router.push('/guests/');
                });
            }

            if(this.action === 'create'){
                this.axios.post(`${window.api}/guests`, 
                    {
                        name: this.guest.name,
                        age: this.guest.age,
                        drinks: this.selectedDrinks,
                        food: this.selectedFood
                    }
                ).then(() => {
                    this.$router.push('/guests/');
                });
                 
            }
        },
        fetchData() {
            this.axios.get(`${window.api}/food`, {}).then((res) => {
                this.food = res.data;
            });

            this.axios.get(`${window.api}/drinks`, {}).then((res) => {
                this.drinks = res.data;
            });
            
            if(this.$route.fullPath == '/guests/create'){
                this.guset = {
                    name: '',
                    age: ''
                };
                this.action = "create";
                return;
            }

            this.axios.get(`${window.api}/guests/${this.$route.params.id}/edit`, {}).then( res => {
                this.guest = res.data|| false;
                this.selectedDrinks = this.guest.drinks.map(item => item.id);
                this.selectedFood = this.guest.food.map(item => item.id);
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