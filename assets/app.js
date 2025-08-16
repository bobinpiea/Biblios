import './bootstrap.js';

// CSS : Bootstrap d’abord, puis tes CSS
import './vendor/bootstrap/dist/css/bootstrap.min.css';
import './styles/styles.css';
import './styles/app.css';

// JS : importer Bootstrap avant ton script perso
import 'bootstrap';
import './js/scripts.js';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');