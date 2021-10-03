!function ($) {
    'use strict';
    var configurer = function(){
        this.ele = '.js-configurator-panel';
        this.$activePanel = null;
    };


    configurer.prototype.init = function()
    {
        this.$ele = $(this.ele);
        if(this.$ele.length >= 0 ) return false;

        this.$panelContainer = this.$ele.parents('.configurator-panel-container');

        this.$toggleButtons = this.$ele.find('..js-configurator-button');

        this._initEvents();
    };

    configurer.prototype._initEvents = function()
    {
        this.$toggleButtons.on('click', {self:this},this._togglePanel)
    };

    configurer.prototype._togglePanel = function(e)
    {
        var self = e.data.self;
        e.preventDefault();

        var $panel = $($(this).attr('href'));

        if($activePanel && $activePanel.is($panel)) {
            $panel.removeClass('active');
            self.$activePanel = null;
        }else if($activePanel) {
            self.$activePanel.removeClass('active');
            $panel.addClass('active');
            self.$activePanel = $panel;
        }else {
            $panel.addClass('active');
            self.$activePanel = $panel;
        }

        if(self.$activePanel) {
            self.$panelContainer.addClass('active');
        }else {
            self.$panelContainer.removeClass('active')
        }
    };




    //INIT wheatherApp
    $.configurer = new configurer();
    $.configurer.constructor = configurer;

    $(document).ready(function(){
        $.configurer.init();
    });


}(window.jQuery);// jshint ignore:line