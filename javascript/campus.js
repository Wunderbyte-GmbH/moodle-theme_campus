require(['core/first'], function() {
    require(['theme_boost/loader', 'theme_campus/anti_gravity', 'theme_campus/custom', 'core/log'], function(boostloader, ag, c, log) {
        log.debug('Campus JavaScript initialised');
    });
});
