module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        /*'gitcommit':{
			task: {
				options: {
			   		message: 'Testing'
			    },
			   	files: {
			       src: ['../OneSchool/*']
			    }
			}
        },*/
        
		'ftp-deploy': {
		  build: {
		    auth: {
		      host: 'ftp.cunxiao.org',
		      port: 21,
		      authKey: 'ftpkey'
		    },
		    src: '../OneSchool/src',
		    dest: '/',
		    //exclusions: ['path/to/source/folder/**/.DS_Store', 'path/to/source/folder/**/Thumbs.db', 'dist/tmp']
		  }
		}
	});
    grunt.loadNpmTasks('grunt-ftp-deploy');
    grunt.registerTask('deploy', ['ftp-deploy']);
};