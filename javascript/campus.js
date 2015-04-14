require(['core/first'], function() {
    require(['theme_campus/bootstrap', 'theme_campus/anti_gravity', 'theme_campus/custom', 'core/log'], function(bootstrap, ag, c, log) {
        log.debug('Campus JavaScript initialised');
    });
});
