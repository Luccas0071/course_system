require('./bootstrap');

import { requestFetch } from './generic';
import { message } from './generic';

window.requestFetch = requestFetch;
window.message = message;