import './bootstrap';

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import TomSelect from "tom-select";
import 'tom-select/dist/css/tom-select.bootstrap5.css'

console.log('hello');

if(document.querySelector('select[multiple]') !== null) {
    new TomSelect('select[multiple]', { plugins: { remove_button: { title: 'Supprimer' }}});
}
