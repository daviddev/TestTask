/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import RegisterComponent from './components/RegisterComponent.vue';
import GameComponent from './components/GameComponent.vue';

app.component('register', RegisterComponent);
app.component('game', GameComponent);

import moment from 'moment';

app.config.globalProperties.$filters = {
    dateFormat(value) {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY hh:mm')
        }
    }
}

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
