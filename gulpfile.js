var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	var bootstrapPath = 'node_modules/bootstrap-sass/assets';

    mix.sass('app.scss')
    	.copy('node_modules/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.css', 'public/css')
    	.copy('node_modules/bootstrap-tokenfield/dist/css/tokenfield-typeahead.min.css', 'public/css')
    	.copy('node_modules/bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js', 'public/js')
    	.copy('node_modules/typeahead.js/dist/typeahead.bundle.min.js', 'public/js')
    	.copy('node_modules/dropzone/dist/dropzone.js', 'public/js')
    	.copy('node_modules/dropzone/dist/dropzone.css', 'public/css')
    	.copy('node_modules/nanobar/nanobar.min.js', 'public/js')
    	.copy('node_modules/underscore/underscore-min.js', 'public/js')
    	.copy('node_modules/bootstrap-markdown-editor/dist/js/bootstrap-markdown-editor.js', 'public/js')
    	.copy('node_modules/bootstrap-markdown-editor/dist/css/bootstrap-markdown-editor.css', 'public/css')
    	.copy('node_modules/ace-builds/src-min', 'public/js/ace')
    	.copy('node_modules/X-editable/dist/bootstrap3-editable/css', 'public/css/bootstrap3-editable/css')
    	.copy('node_modules/X-editable/dist/bootstrap3-editable/img', 'public/css/bootstrap3-editable/img')
    	.copy('node_modules/X-editable/dist/bootstrap3-editable/js', 'public/js/bootstrap3-editable')
    	.copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js');
});
