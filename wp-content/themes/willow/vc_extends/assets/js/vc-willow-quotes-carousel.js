(function ($) {
    var Shortcodes = vc.shortcodes;

    window.WillowQuotesCarousel = vc.shortcode_view.extend({
        adding_new_tab:false,
        events:{
            'click .add_tab':'addTab',
            'click > .controls .column_delete':'deleteShortcode',
            'click > .controls .column_edit':'editElement',
            'click > .controls .column_clone':'clone'
        },
        render:function () {
            window.WillowQuotesCarousel.__super__.render.call(this);
            this.$content.sortable({
                axis:"y",
                // handle:"h3",
                stop:function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.prev().triggerHandler("focusout");
                    $(this).find('> .wpb_sortable').each(function () {
                        var shortcode = $(this).data('model');
                        shortcode.save({'order':$(this).index()}); // Optimize
                    });
                }
            });
            return this;
        },
        changeShortcodeParams:function (model) {
            window.WillowQuotesCarousel.__super__.changeShortcodeParams.call(this, model);
            var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            if (this.$content.hasClass('ui-accordion')) {
                this.$content.accordion("option", "collapsible", collapsible);
            }
        },
        changedContent:function (view) {
            // if (this.$content.hasClass('ui-accordion')) this.$content.accordion('destroy');
            // var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            // this.$content.accordion({
            //     header:"h3",
            //     navigation:false,
            //     autoHeight:true,
            //     heightStyle: "content",
            //     collapsible:collapsible,
            //     active:this.adding_new_tab === false && view.model.get('cloned') !== true ? 0 : view.$el.index()
            // });
            this.adding_new_tab = false;
        },
        addTab:function (e) {
            this.adding_new_tab = true;
            e.preventDefault();
            vc.shortcodes.create({shortcode:'vc_willow_quote', params:{title:window.i18nLocale.section}, parent_id:this.model.id});
        },
        _loadDefaults:function () {
            window.WillowQuotesCarousel.__super__._loadDefaults.call(this);
        }
    });
})(window.jQuery);