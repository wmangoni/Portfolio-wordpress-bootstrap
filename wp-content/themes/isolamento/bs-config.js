
/*
 |--------------------------------------------------------------------------
 | Browser-sync config file
 |--------------------------------------------------------------------------
 |
 | For up-to-date information about the options:
 |   http://www.browsersync.io/docs/options/
 |
 | There are more options than you see here, these are just the ones that are
 | set internally. See the website for more info.
 |
 |
 */
module.exports = {
    "files": [
        '*.php',
        'assets/stylesheets/styles.css',
        'assets/images/**',
        'assets/javascript/**',
        'inc/**'
    ],
    "server": false,
    "proxy": "localhost/vtex",
    "port": 3000,
    "ghostMode": {
        "clicks": true,
        "scroll": true,
        "forms": {
            "submit": true,
            "inputs": true,
            "toggles": true
        }
    },
    "open": true,
    "xip": false,
    "reloadOnRestart": true,
    "notify": true,
    "scrollProportionally": true,
    "scrollThrottle": 0,
    "reloadDelay": 0,
    "injectChanges": true,
    "minify": true,
    "codeSync": true,
    "timestamps": true
};