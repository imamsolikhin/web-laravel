var showDialog = showDialog || (function ($) {
    'use strict';

	// Creating modal dialog's DOM
	var $dialog = $(
		'<div id="show-modal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
  		'<div class="modal-dialog modal-m">' +
        '<div class="modal-content">' +
          '<div class="modal-header bg-danger pt-3 pb-3">' +
              '<h5 class="modal-title text-white bold" id="modal">Show Dialog</h5>' +
              '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                  '<i aria-hidden="true" class="text-white bold ki ki-close"></i>' +
              '</button>' +
          '</div>' +
    			'<div class="modal-body">' +
    			   '<div id="content-dialog">' +
                '<h1>Loading Content....</h1>' +
              '</div>' +
      		'</div>' +
    		'</div>' +
      '</div>' +
    '</div>');

	return {
		/**
		 * Opens our dialog
		 * @param message Custom message
		 * @param options Custom options:
		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
		 */
		show: function (message, options) {
			// Assigning defaults
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			var settings = $.extend({
				dialogSize: 'm',
				progressType: '',
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			// Configuring dialog
			$dialog.find('#show-modal>.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('show-modal>.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('#show-modal>.progress-bar').addClass('progress-bar-' + settings.progressType);
			}
      $dialog.find('#content-dialog').html(message);
			// $dialog.find('h3').text(message);
			// Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			// Opening dialog
			$dialog.modal();
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			$dialog.modal('hide');
		}
	};

})(jQuery);


const Loading = function(element, options) {
  this.element = element;
  this.settings = $.extend({}, Loading.defaults, options);
  this.settings.fullPage = this.element.is("body");

  this.init();

  if (this.settings.start) {
    this.start();
  }
};

Loading.defaults = {
  /**
   * jQuery element to be used as overlay
   * If not defined, a default overlay will be created
   */
  overlay: undefined,

  /**
   * z-index to be used by the default overlay
   * If not defined, a z-index will be calculated based on the
   * target's z-index
   * Has no effect if a custom overlay is defined
   */
  zIndex: undefined,

  /**
   * Message to be rendered on the overlay content
   * Has no effect if a custom overlay is defined
   */
  message: "Loading...",

  /**
   * Theme to be applied on the loading element
   *
   * Some default themes are implemented on `jquery.loading.css`, but you can
   *  define your own. Just add a `.loading-theme-my_awesome_theme` selector
   *  somewhere with your custom styles and change this option
   *  to 'my_awesome_theme'. The class is applied to the parent overlay div
   *
   * Has no effect if a custom overlay is defined
   */
  theme: "light",

  /**
   * Class(es) to be applied to the overlay element when the loading state is started
   */
  shownClass: "loading-shown",

  /**
   * Class(es) to be applied to the overlay element when the loading state is stopped
   */
  hiddenClass: "loading-hidden",

  /**
   * Set to true to stop the loading state if the overlay is clicked
   * This options does NOT override the onClick event
   */
  stoppable: false,

  /**
   * Set to false to not start the loading state when initialized
   */
  start: true,

  /**
   * Function to be executed when the loading state is started
   * Receives the loading object as parameter
   *
   * The function is attached to the `loading.start` event
   */
  onStart: function(loading) {
    loading.overlay.fadeIn(150);
  },

  /**
   * Function to be executed when the loading state is stopped
   * Receives the loading object as parameter
   *
   * The function is attached to the `loading.stop` event
   */
  onStop: function(loading) {
    loading.overlay.fadeOut(150);
  },

  /**
   * Function to be executed when the overlay is clicked
   * Receives the loading object as parameter
   *
   * The function is attached to the `loading.click` event
   */
  onClick: function() {}
};

/**
 * Extend the Loading plugin default settings with the user options
 * Use it as `$.Loading.setDefaults({ ... })`
 *
 * @param {Object} options Custom options to override the plugin defaults
 */
Loading.setDefaults = function(options) {
  Loading.defaults = $.extend({}, Loading.defaults, options);
};

$.extend(Loading.prototype, {
  /**
   * Initializes the overlay and attach handlers to the appropriate events
   */
  init: function() {
    this.isActive = false;
    this.overlay = this.settings.overlay || this.createOverlay();
    this.resize();
    this.attachMethodsToExternalEvents();
    this.attachOptionsHandlers();
  },

  /**
   * Return a new default overlay
   *
   * @return {jQuery} A new overlay already appended to the page's body
   */
  createOverlay: function() {
    var overlay = $(
      '<div class="loading-overlay loading-theme-' +
        this.settings.theme +
        '"><div class="loading-overlay-content">' +
        this.settings.message +
        "</div></div>"
    )
      .addClass(this.settings.hiddenClass)
      .hide()
      .appendTo("body");

    var elementID = this.element.attr("id");
    if (elementID) {
      overlay.attr("id", elementID + "_loading-overlay");
    }

    return overlay;
  },

  /**
   * Attach some internal methods to external events
   * e.g. overlay click, window resize etc
   */
  attachMethodsToExternalEvents: function() {
    var self = this;

    // Add `shownClass` and remove `hiddenClass` from overlay when loading state
    // is activated
    self.element.on("loading.start", function() {
      self.overlay
        .removeClass(self.settings.hiddenClass)
        .addClass(self.settings.shownClass);
    });

    // Add `hiddenClass` and remove `shownClass` from overlay when loading state
    // is stopped
    self.element.on("loading.stop", function() {
      self.overlay
        .removeClass(self.settings.shownClass)
        .addClass(self.settings.hiddenClass);
    });

    // Attach the 'stop loading on click' behaviour if the `stoppable` option is set
    if (self.settings.stoppable) {
      self.overlay.on("click", function() {
        self.stop();
      });
    }

    // Trigger the `loading.click` event if the overlay is clicked
    self.overlay.on("click", function() {
      self.element.trigger("loading.click", self);
    });

    // Bind the `resize` method to `window.resize`
    $(window).on("resize", function() {
      self.resize();
    });

    // Bind the `resize` method to `document.ready` to guarantee right
    // positioning and dimensions after the page is loaded
    $(function() {
      self.resize();
    });
  },

  /**
   * Attach the handlers defined on `options` for the respective events
   */
  attachOptionsHandlers: function() {
    var self = this;

    self.element.on("loading.start", function(event, loading) {
      self.settings.onStart(loading);
    });

    self.element.on("loading.stop", function(event, loading) {
      self.settings.onStop(loading);
    });

    self.element.on("loading.click", function(event, loading) {
      self.settings.onClick(loading);
    });
  },

  /**
   * Calculate the z-index for the default overlay element
   * Return the z-index passed as setting to the plugin or calculate it
   * based on the target's z-index
   */
  calcZIndex: function() {
    if (this.settings.zIndex !== undefined) {
      return this.settings.zIndex;
    } else {
      return (
        (parseInt(this.element.css("z-index")) || 0) +
        1 +
        this.settings.fullPage
      );
    }
  },

  /**
   * Reposition the overlay on the top of the target element
   * This method needs to be called if the target element changes position
   *  or dimension
   */
  resize: function() {
    var self = this;

    var element = self.element,
      totalWidth = element.outerWidth(),
      totalHeight = element.outerHeight();

    if (this.settings.fullPage) {
      totalHeight = "100%";
      totalWidth = "100%";
    }

    this.overlay.css({
      position: self.settings.fullPage ? "fixed" : "absolute",
      zIndex: self.calcZIndex(),
      top: element.offset().top,
      left: element.offset().left,
      width: totalWidth,
      height: totalHeight
    });
  },

  /**
   * Trigger the `loading.start` event and turn on the loading state
   */
  start: function() {
    this.isActive = true;
    this.resize();
    this.element.trigger("loading.start", this);
  },

  /**
   * Trigger the `loading.stop` event and turn off the loading state
   */
  stop: function() {
    this.isActive = false;
    this.element.trigger("loading.stop", this);
  },

  /**
   * Check whether the loading state is active or not
   *
   * @return {Boolean}
   */
  active: function() {
    return this.isActive;
  },

  /**
   * Toggle the state of the loading overlay
   */
  toggle: function() {
    if (this.active()) {
      this.stop();
    } else {
      this.start();
    }
  },

  /**
   * Destroy plugin instance.
   */
  destroy: function() {
    this.overlay.remove();
  }
});

/**
 * Name of the data attribute where the plugin object will be stored
 */
var dataAttr = "jquery-loading";

/**
 * Initializes the plugin and return a chainable jQuery object
 *
 * @param {Object} [options] Initialization options. Extends `Loading.defaults`
 * @return {jQuery}
 */
$.fn.loading = function(options) {
  return this.each(function() {
    // (Try to) retrieve an existing plugin object associated with element
    var loading = $.data(this, dataAttr);

    if (!loading) {
      // First call. Initialize and save plugin object
      if (
        options === undefined ||
        typeof options === "object" ||
        options === "start" ||
        options === "toggle"
      ) {
        // Initialize it just if argument is undefined, a config object
        // or a direct call to 'start' or 'toggle' methods
        $.data(this, dataAttr, new Loading($(this), options));
      }
    } else {
      // Already initialized
      if (options === undefined) {
        // $(...).loading() call. Call the 'start' by default
        loading.start();
      } else if (typeof options === "string") {
        // $(...).loading('method') call. Execute 'method'
        loading[options].apply(loading);
      } else {
        // $(...).loading({...}) call. New configurations. Reinitialize
        // plugin object with new config options and start the plugin
        // Also, destroy the old overlay instance
        loading.destroy();
        $.data(this, dataAttr, new Loading($(this), options));
      }
    }
  });
};

/**
 * Return the loading object associated to the element or initialize it
 * This method is interesting if you need the plugin object to access the
 * internal API
 * Example: `$('#some-element').Loading().toggle()`
 *
 * @param {Object} [options] Initialization options. If new options are given
 * to a previously initialized object, the old ones are overriden and the
 * plugin restarted
 * @return {Loading}
 */
$.fn.Loading = function(options) {
  var loading = $(this).data(dataAttr);

  if (!loading || options !== undefined) {
    $(this).data(dataAttr, (loading = new Loading($(this), options)));
  }

  return loading;
};

/**
 * Create the `:loading` jQuery selector
 * Return all the jQuery elements with the loading state active
 *
 * Using the `:not(:loading)` will return all jQuery elements that are not
 *  loading, even the ones with the plugin not attached.
 *
 * Examples of usage:
 *  `$(':loading')` to get all the elements with the loading state active
 *  `$('#my-element').is(':loading')` to check if the element is loading
 */
$.expr[":"].loading = function(element) {
  var loadingObj = $.data(element, dataAttr);

  if (!loadingObj) {
    return false;
  }

  return loadingObj.active();
};
$.Loading = Loading;



"use strict";
  window.onload = function(){
    $(document).ready(function() {
      $("#datatable_wrapper").removeClass("dataTables_wrapper form-inline dt-bootstrap no-footer");
      $("#datatable_wrapper").addClass("dataTables_wrapper dt-bootstrap4 no-footer");

      $("#datatable-minor_wrapper").removeClass("dataTables_wrapper form-inline dt-bootstrap no-footer");
      $("#datatable-minor_wrapper").addClass("dataTables_wrapper dt-bootstrap4 no-footer");
    });

    $("div.datesearchbox").html('<div class="input-group"> <div class="input-group-addon"> <i class="glyphicon glyphicon-calendar"></i> </div><input type="text" class="form-control pull-right" id="datesearch" placeholder="Search by date range"> </div>');
    document.getElementsByClassName("datesearchbox")[0].style.textAlign = "center";
    $("#datesearch").attr("readonly",true);
    $('#datesearch').daterangepicker({
       autoUpdateInput: false
     });
  };


  $.fn.CopyToClipboard = function() {
      var textToCopy = false;
      if(this.is('select') || this.is('textarea') || this.is('input')){
          textToCopy = this.val();
      }else {
          textToCopy = this.text();
      }
      CopyToClipboard(textToCopy);
  };

  function CopyToClipboard( val ){
      var hiddenClipboard = $('#_hiddenClipboard_');
      if(!hiddenClipboard.length){
          $('body').append('<textarea readonly style="position:absolute;top: -9999px;" id="_hiddenClipboard_"></textarea>');
          hiddenClipboard = $('#_hiddenClipboard_');
      }
      hiddenClipboard.html(val);
      hiddenClipboard.select();
      document.execCommand('copy');
      document.getSelection().removeAllRanges();
      hiddenClipboard.remove();
  }

  $(function(){
      $('[data-clipboard-target]').each(function(){
          $(this).click(function() {
              $($(this).data('clipboard-target')).CopyToClipboard();
          });
      });
      $('[data-clipboard-text]').each(function(){
          $(this).click(function(){
              CopyToClipboard($(this).data('clipboard-text'));
          });
      });
  });
