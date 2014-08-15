/*!
 * Bootstrap's Gruntfile
 * http://getbootstrap.com
 * Copyright 2013-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

module.exports = function (grunt) {
  'use strict';

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  RegExp.quote = function (string) {
    return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&');
  };

  var fs = require('fs');
  var path = require('path');
  var npmShrinkwrap = require('npm-shrinkwrap');
  var generateGlyphiconsData = require('./grunt/bs-glyphicons-data-generator.js');
  var BsLessdocParser = require('./grunt/bs-lessdoc-parser.js');
  var generateRawFiles = require('./grunt/bs-raw-files-generator.js');

  // Project configuration.
  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
   
    // Task configuration.
    clean: {
      dist: ['css']
    },
    
    less: {
        compileCss: {
            options: {
              strictMath: true,
              sourceMap: true,
              outputSourceFiles: true,
              sourceMapURL: 'css/style.css.map',
              sourceMapFilename: 'css/style.css.map'
            },
            
            files: {
              'css/style.css': 'less/all.less'
            }
        }
    },
    
    cssmin: {
        options: {
            compatibility: 'ie8',
            noAdvanced: true
        },
        core: {
            files: {
              'css/style.min.css': 'css/style.css' 
            }
        }
    },

    concat: {
        options: {
          stripBanners: true
        },
      
        regiominoJS: {
            src: [
                'js/bootstrap/transition.js',
                'js/bootstrap/alert.js',
                'js/bootstrap/button.js',
              //  'js/bootstrap/carousel.js',
                'js/bootstrap/collapse.js',
                'js/bootstrap/dropdown.js',
                'js/bootstrap/modal.js',
                'js/bootstrap/tooltip.js',
                'js/bootstrap/popover.js',
              //  'js/bootstrap/scrollspy.js',
                'js/bootstrap/tab.js',
               // 'js/bootstrap/affix.js',
                
                'js/custom/jquery.jCounter-0.1.2.js',
                'js/custom/main.js'
            ],
            dest: 'js/regiomino.js'
        }
    },

    uglify: {
      options: {
        preserveComments: 'some'
      },
      js: {
        src: '<%= concat.regiominoJS.dest %>',
        dest: 'js/regiomino.min.js'
      }
    },

   

    autoprefixer: {
        options: {
            browsers: [
                'Android 2.3',
                'Android >= 4',
                'Chrome >= 20',
                'Firefox >= 24', // Firefox 24 is the latest ESR
                'Explorer >= 8',
                'iOS >= 6',
                'Opera >= 12',
                'Safari >= 6'
            ]
        },
        
        core: {
            options: {
                map: true
            },
            src: 'css/style.css'
        }
    },

    copy: {
        fonts: {
            expand: true,
            src: 'fonts/*',
            dest: 'dist/'
        }
    },

    watch: {
        less: {
            files: 'less/**/*.less',
            tasks: ['less', 'cssmin']
        },
        
        js: {
            files: ['js/bootstrap/*.js', 'js/custom/*.js'],
            tasks : ['concat','uglify']
        }
    },

    exec: {
        npmUpdate: {
            command: 'npm update'
        } 
    }
  });


  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
  
/******************************/
// Tasks
/******************************/

  // JS distribution task.
  grunt.registerTask('dist-js', ['uglify']);

  // CSS distribution task.
  
  grunt.registerTask('dist-css', ['less-compile', 'autoprefixer', 'cssmin']);
 
  // Full distribution task.
  grunt.registerTask('dist', ['clean', 'dist-css', 'copy:fonts', 'dist-js', 'dist-docs']);

  // Default task.
  grunt.registerTask('default', ['test', 'dist', 'build-glyphicons-data', 'build-customizer']);

  // Version numbering task.
  // grunt change-version-number --oldver=A.B.C --newver=X.Y.Z
  // This can be overzealous, so its changes should always be manually reviewed!
  grunt.registerTask('change-version-number', 'sed');

  grunt.registerTask('build-glyphicons-data', function () { generateGlyphiconsData.call(this, grunt); });

 

  // Task for updating the cached npm packages used by the Travis build (which are controlled by test-infra/npm-shrinkwrap.json).
  // This task should be run and the updated file should be committed whenever Bootstrap's dependencies change.
  grunt.registerTask('update-shrinkwrap', ['exec:npmUpdate', '_update-shrinkwrap']);
  grunt.registerTask('_update-shrinkwrap', function () {
    var done = this.async();
    npmShrinkwrap({ dev: true, dirname: __dirname }, function (err) {
      if (err) {
        grunt.fail.warn(err)
      }
      var dest = 'test-infra/npm-shrinkwrap.json';
      fs.renameSync('npm-shrinkwrap.json', dest);
      grunt.log.writeln('File ' + dest.cyan + ' updated.');
      done();
    });
  });
};
