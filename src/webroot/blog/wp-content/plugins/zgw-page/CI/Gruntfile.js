module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            css: {
                src: [
                	'../css/bootstrap.min.css',
                    '../css/plugin.css',
                ],
                dest: '../css/plugin.min.css'
            },
            js: {
                src: [
                    '../js/app/zgw-app.js',
                    '../js/app/zgw-backbone.js',
                    
                    '../js/app/model/option.js',
                    
                    '../js/app/view/editor.js',
                    
                    '../js/app/zgw-editor.js',
                    '../js/app/zgw-editor-image-link.js',
                    '../js/plugin.js'
                ],
                dest: '../js/plugin.min.js'
            }
        }
	});
	
	
    grunt.loadNpmTasks('grunt-contrib-concat');
    
    grunt.registerTask('build', ['concat:css','concat:js']);
};