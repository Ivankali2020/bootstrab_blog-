window._ = require('lodash');
import Swal from 'sweetalert2/dist/sweetalert2.js'
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
    // window.Swal = require('sweetalert2');
    window.Swal = Swal;
    window.bootstrap = require('bootstrap5/dist/js/bootstrap.bundle.min');
} catch (e) {}
