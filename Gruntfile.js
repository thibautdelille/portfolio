module.exports = function(grunt) {

  grunt.initConfig({
    // load our main definition package
    pkg: grunt.file.readJSON('package.json'),


    /*
    * url: https://github.com/ai/autoprefixer
    * description: Autoprefixer uses the data on current browser popularity and properties support to apply prefixes for you:
      a { transition: transform 1s }
      become
      a {
        -webkit-transition: -webkit-transform 1s;
        transition: -ms-transform 1s;
        transition: transform 1s
      }
    */
    autoprefixer: {
      build: {
        options: {
          browsers: ['last 2 versions', '> 1%']
        },
        files: [
          {
            cwd: 'html/wp-content/themes/thibautdelille/assets/css/',
            src : ['*.sass.css'],
            dest: 'html/wp-content/themes/thibautdelille/assets/css/',
            ext : '.autoprefixed.css',
            expand : true
          }
        ]
      }
    },


    /*
    * url: https://github.com/gruntjs/grunt-contrib-cssmin
    * description: minify the css
    */

    cssmin: {
      minify: {
        expand: true,
        cwd: 'html/wp-content/themes/thibautdelille/assets/css/',
        src: ['*.css', '!*.min.css'],
        dest: 'html/wp-content/themes/thibautdelille/assets/css/',
        ext: '.min.css'
      }
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-concat
    * description: concat all js plugin into one js file and concat the css prefixed with the icon and font css
    */
    concat: {
      options: {
        separator: ';',
        stripBanners: true,
        banner: '/*!\n<%= pkg.name %>\nv<%= pkg.version %>\n<%= grunt.template.today("mm-dd-yyyy") %>\nMade at <%= pkg.author.name %> - <%= pkg.author.url %>\n*/'
      },
      js: {
        src: ['html/wp-content/themes/thibautdelille/assets/vendors/modernizr/modernizr-2.6.2.min.js', 'html/wp-content/themes/thibautdelille/assets/js/globals.js', 'html/wp-content/themes/thibautdelille/assets/js/thibautdelille-*.js'],
        dest: 'html/wp-content/themes/thibautdelille/assets/js/thibautdelille.js'
      },
      css: {
        src: ['html/wp-content/themes/thibautdelille/assets/vendors/icomoon/style.css', 'html/wp-content/themes/thibautdelille/assets/css/style.autoprefixed.css'],
        dest: 'html/wp-content/themes/thibautdelille/assets/css/style.css'
      }
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-copy
    * description: copy icon, js and vendors into the documentation
    */
    copy: {
      // Copy all ./assets/ folder to Jekyll folder
      icomoon: {
        files: [
          { expand: true, cwd: 'html/wp-content/themes/thibautdelille/assets/vendors/icomoon/fonts', src: ['./**/*.*'], dest: 'html/wp-content/themes/thibautdelille/assets/css/fonts' }
        ]
      }
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-uglify
    * description: Minify files with UglifyJS.
    */
    uglify: {
      options: {
        report: true
      },
      js: {
        files: {
          'html/wp-content/themes/thibautdelille/assets/js/thibautdelille.min.js': ['html/wp-content/themes/thibautdelille/assets/js/thibautdelille.js']
        }
      }
    },

    /*
    * https://github.com/gruntjs/grunt-contrib-sass
    * description: compile sass to css
    */
    sass: {
      build: {
        files : [
          {
            src : ['*.scss', '!_*.scss'],
            cwd : 'html/wp-content/themes/thibautdelille/assets/scss',
            dest : 'html/wp-content/themes/thibautdelille/assets/css/',
            ext : '.sass.css',
            expand : true
          }
        ],
        options : {
          style : 'expanded'
        }
      }
    },
    /*
    * url: https://github.com/gruntjs/grunt-contrib-watch
    * description: Run predefined tasks whenever watched file patterns are added, changed or deleted.
    */
    watch: {
      scss: {
        files: ['html/wp-content/themes/thibautdelille/assets/scss/**/*.scss'],
        tasks: ['scss']
      },
      js: {
        files: ['html/wp-content/themes/thibautdelille/assets/js/thibautdelille-*.js'],
        tasks: ['js']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          'html/wp-content/themes/thibautdelille/*.php',
          'html/wp-content/themes/thibautdelille/*.html',
          'html/wp-content/themes/thibautdelille/assets/css/{,*/}*.css',
          'html/wp-content/themes/thibautdelille/assets/js/thibautdelille.js'
        ]
      }
    }
  });

  // CSS
  grunt.registerTask('scss', ['sass', 'autoprefixer', 'concat:css', 'cssmin']);

  grunt.registerTask('js', ['concat:js', 'uglify:js']);

  grunt.registerTask('dev', ['watch']);

  grunt.registerTask('default', ['scss', 'js', 'copy']);

  grunt.loadNpmTasks('grunt-sass');

  grunt.loadNpmTasks('grunt-autoprefixer');

  require('matchdep').filterDev('grunt-contrib*').forEach(grunt.loadNpmTasks);
};