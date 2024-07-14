import './bootstrap';
import $ from 'jquery';
import handleAjaxForm from './ajaxForms';

window.$ = window.jQuery = $;

handleAjaxForm('#loginForm');
handleAjaxForm('#registerForm');