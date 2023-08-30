/**
 * Gruntfile for compiling theme_campus .less files.
 *
 * This file configures tasks to be run by Grunt
 * http://gruntjs.com/ for the current theme.
 *
 *
 * Requirements:
 * -------------
 * nodejs, npm, grunt-cli.
 *
 * Installation:
 * -------------
 * node and npm: instructions at http://nodejs.org/
 *
 * grunt-cli: `[sudo] npm install -g grunt-cli`
 *
 * node dependencies: run `npm install` in the root directory.
 *
 *
 * Usage:
 * ------
 * Call tasks from the theme root directory. Default behaviour
 * (calling only `grunt`) is to run the watch task detailed below.
 *
 *
 * Porcelain tasks:
 * ----------------
 * The nice user interface intended for everyday use. Provide a
 * high level of automation and convenience for specific use-cases.
 *
 * grunt watch   Watch the less directory (and all subdirectories)
 *               for changes to *.less files then on detection
 *               run 'grunt compile'
 *
 *               Options:
 *
 *               --dirroot=<path>  Optional. Explicitly define the
 *                                 path to your Moodle root directory
 *                                 when your theme is not in the
 *                                 standard location.
 *
 * grunt amd     Use core, e.g. grunt amd --root=theme/campus
 *               If on Windows, then set 'linebreak-style' to 'off' in root '.eslintrc'
 *               as Git will handle this for us.
 *
 * grunt svg                 Change the colour of the SVGs in pix_core by
 *                           text replacing #999999 with a new hex color.
 *                           Note this requires the SVGs to be #999999 to
 *                           start with or the replace will do nothing
 *                           so should usually be preceded by copying
 *                           a fresh set of the original SVGs.
 *
 *                           Options:
 *
 *                           --svgcolor=<hexcolor> Hex color to use for SVGs
 *
 * Plumbing tasks & targets:
 * -------------------------
 * Lower level tasks encapsulating a specific piece of functionality
 * but usually only useful when called in combination with another.
 *
 * grunt decache      Clears the Moodle theme cache.
 *
 *                    Options:
 *
 *                    --dirroot=<path>  Optional. Explicitly define
 *                                      the path to your Moodle root
 *                                      directory when your theme is
 *                                      not in the standard location.
 *
 * grunt replace             Run all text replace tasks.
 *
 *
 * @package theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author Based on code originally written by Joby Harding, Bas Brands, David Scotson and many other contributors. 
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

module.exports = function(grunt) {

    // Import modules.
    var path = require('path');

    // Theme Bootstrap constants.
    var LESSDIR         = 'less',
        MOODLEURLPREFIX = grunt.option('urlprefix') || '',
        THEMEDIR        = path.basename(path.resolve('.'));

    // Production / development.
    var build = grunt.option('build') || 'd'; // Development for 'watch' task.

    if ((build != 'p') && (build != 'd')) {
        build = 'p';
        console.log('-build switch only accepts \'p\' for production or \'d\' for development,');
        console.log('e.g. -build=p or -build=d.  Defaulting to development.');
    }

    // PHP strings for exec task.
    var moodleroot = path.dirname(path.dirname(__dirname)),
        configfile = '',
        decachephp = '',
        dirrootopt = grunt.option('dirroot') || process.env.MOODLE_DIR || '';

    // Allow user to explicitly define Moodle root dir.
    if ('' !== dirrootopt) {
        moodleroot = path.resolve(dirrootopt);
    }

    var PWD = process.cwd();
    configfile = path.join(moodleroot, 'config.php');

    decachephp += 'define(\'CLI_SCRIPT\', true);';
    decachephp += 'require(\'' + configfile  + '\');';
    decachephp += 'theme_reset_all_caches();';

    var svgcolor = grunt.option('svgcolor') || '#999999';

    grunt.initConfig({
        exec: {
            decache: {
                cmd: 'php -r "' + decachephp + '"',
                callback: function(error, stdout, stderror) {
                    // exec will output error messages
                    // just add one to confirm success.
                    if (!error) {
                        grunt.log.writeln("Moodle theme cache reset.");
                    }
                }
            }
        },
        copy: {
            svg_core: {
                 expand: true,
                 cwd:  'pix_core_originals/',
                 src:  '**',
                 dest: 'pix_core/',
            },
            svg_plugins: {
                 expand: true,
                 cwd:  'pix_plugins_originals/',
                 src:  '**',
                 dest: 'pix_plugins/',
            },
            svg_fp: {
                 expand: true,
                 cwd:  'pix_fp_originals/',
                 src:  '**',
                 dest: 'pix/fp/',
            }
        },
        replace: {
            svg_colours_core: {
                src: 'pix_core/**/*.svg',
                    overwrite: true,
                    replacements: [{
                        from: '#999',
                        to: svgcolor
                    }]
            },
            svg_colours_plugins: {
                src: 'pix_plugins/**/*.svg',
                    overwrite: true,
                    replacements: [{
                        from: '#999',
                        to: svgcolor
                    }]
            },
            svg_colours_fp: {
                src: 'pix/fp/**/*.svg',
                    overwrite: true,
                    replacements: [{
                        from: '#999',
                        to: svgcolor
                    }]
            }
        },
        svgmin: {                       // Task
            options: {                  // Configuration that will be passed directly to SVGO
                plugins: [{
                    removeViewBox: false
                }, {
                    removeUselessStrokeAndFill: false
                }, {
                    convertPathData: { 
                        straightCurves: false // advanced SVGO plugin option
                   }
                }]
            },
            dist: {                       // Target
                files: [{                 // Dictionary of files
                    expand: true,         // Enable dynamic expansion.
                    cwd: 'pix_core',      // Source matches are relative to this path.
                    src: ['**/*.svg'],    // Actual pattern(s) to match.
                    dest: 'pix_core/',    // Destination path prefix.
                    ext: '.svg'           // Destination file paths will have this extension.
                }, {                      // Dictionary of files
                    expand: true,         // Enable dynamic expansion.
                    cwd: 'pix_plugins',   // Source matches are relative to this path.
                    src: ['**/*.svg'],    // Actual pattern(s) to match.
                    dest: 'pix_plugins/', // Destination path prefix.
                    ext: '.svg'           // Destination file paths will have this extension.
                }, {                      // Dictionary of files
                    expand: true,         // Enable dynamic expansion.
                    cwd: 'pix/fp',        // Source matches are relative to this path.
                    src: ['**/*.svg'],    // Actual pattern(s) to match.
                    dest: 'pix/fp/',      // Destination path prefix.
                    ext: '.svg'           // Destination file paths will have this extension.
                }]
            }
        }
    });

    // Load contrib tasks.
    grunt.loadNpmTasks("grunt-exec");
    grunt.loadNpmTasks("grunt-text-replace");
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-svgmin');

    // Register tasks.
    grunt.registerTask("decache", ["exec:decache"]);

    grunt.registerTask("copy:svg", ["copy:svg_core", "copy:svg_plugins", "copy:svg_fp"]);
    grunt.registerTask("replace:svg_colours", ["replace:svg_colours_core", "replace:svg_colours_plugins", "replace:svg_colours_fp"]);
    grunt.registerTask("svg", ["copy:svg", "replace:svg_colours", "svgmin"]);
};
